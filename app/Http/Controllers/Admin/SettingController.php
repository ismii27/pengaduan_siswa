<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'Pengaduan Siswa'),
            'site_description' => Setting::get('site_description', 'Sistem Pengaduan Siswa Online'),
            'site_logo' => Setting::get('site_logo', ''),
            'admin_contact' => Setting::get('admin_contact', 'admin@example.com'),
            'site_status' => Setting::get('site_status', 'aktif'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'admin_contact' => 'required|string|max:255',
            'site_status' => 'required|in:aktif,nonaktif',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        Setting::set('site_name', $request->site_name);
        Setting::set('site_description', $request->site_description);
        Setting::set('admin_contact', $request->admin_contact);
        Setting::set('site_status', $request->site_status);

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logo'), $filename);
            Setting::set('site_logo', 'uploads/logo/' . $filename);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}
