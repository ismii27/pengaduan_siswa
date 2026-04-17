<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load('siswa'); // Load siswa if role is siswa

        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'nama' => 'required|string|max:255',
        ];

        if ($user->role === 'siswa') {
            $rules['no_telp'] = 'nullable|string|max:15';
            $rules['alamat'] = 'nullable|string';
        }

        $request->validate($rules);

        $user->nama = $request->nama;
        $user->save();

        if ($user->role === 'siswa' && $user->siswa) {
            $user->siswa->no_telp = $request->no_telp;
            $user->siswa->alamat = $request->alamat;
            $user->siswa->save();
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diubah.');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profil'), $filename);

            // Delete old photo if exists
            if ($user->foto_profil && file_exists(public_path($user->foto_profil))) {
                unlink(public_path($user->foto_profil));
            }

            $user->foto_profil = 'uploads/profil/' . $filename;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
        ]);

        $user = Auth::user();
        $email = $request->email;
        
        // Generate 6 digit OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        // Store OTP in cache for 10 minutes
        Cache::put('otp_' . $user->id, ['otp' => $otp, 'email' => $email], now()->addMinutes(10));
        
        // Log OTP (simulating email send)
        Log::info("OTP for email change ({$email}): {$otp}");
        
        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'OTP telah dikirim. Cek log aplikasi untuk melihat OTP (simulasi).',
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $user = Auth::user();
        $cacheKey = 'otp_' . $user->id;
        
        if (Cache::has($cacheKey)) {
            $data = Cache::get($cacheKey);
            if ($data['otp'] === $request->otp) {
                // Update email
                $user->email = $data['email'];
                $user->save();
                
                Cache::forget($cacheKey);
                
                return redirect()->back()->with('success', 'Email berhasil diperbarui.');
            }
        }
        
        return back()->withErrors(['otp' => 'OTP tidak valid atau telah kedaluwarsa.'])->with('otp_error', true);
    }
}
