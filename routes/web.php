<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Redirect dashboard berdasarkan role
Route::get('dashboard', function () {
    $user = auth()->user();
    
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'siswa') {
        return redirect()->route('siswa.dashboard');
    }
    
    return redirect()->route('login');
})->middleware('auth')->name('dashboard');

// Authenticated Global Routes
Route::middleware(['auth'])->group(function () {
    Route::get('profil', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profil', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profil/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('profil/foto', [\App\Http\Controllers\ProfileController::class, 'updateFoto'])->name('profile.foto');
    Route::post('profil/otp/send', [\App\Http\Controllers\ProfileController::class, 'sendOtp'])->name('profile.otp.send');
    Route::post('profil/otp/verify', [\App\Http\Controllers\ProfileController::class, 'verifyOtp'])->name('profile.otp.verify');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('pengaduan', [\App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/{pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::put('pengaduan/{pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'update'])->name('pengaduan.update');
    
    Route::get('siswa', [\App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('siswa.index');
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

// Siswa Routes
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('pengaduan', [\App\Http\Controllers\Siswa\PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/create', [\App\Http\Controllers\Siswa\PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('pengaduan', [\App\Http\Controllers\Siswa\PengaduanController::class, 'store'])->name('pengaduan.store');
});

