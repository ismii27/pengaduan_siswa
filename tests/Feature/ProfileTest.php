<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->siswaUser = User::create([
            'username' => 'siswa123',
            'nama' => 'Test Siswa',
            'password' => Hash::make('password123'),
            'role' => 'siswa'
        ]);

        Siswa::create([
            'nis' => 'siswa123',
            'nama' => 'Test Siswa',
            'kelas' => 'XII',
            'id_user' => $this->siswaUser->id
        ]);
    }

    public function test_user_can_view_profile_page()
    {
        $response = $this->actingAs($this->siswaUser)->get('/profil');

        $response->assertStatus(200);
        $response->assertSee('Profil Saya');
        $response->assertSee('Test Siswa');
    }

    public function test_user_can_update_profile_info()
    {
        $response = $this->actingAs($this->siswaUser)->post('/profil', [
            'nama' => 'Nama Baru Siswa',
            'no_telp' => '081234567890',
            'alamat' => 'Alamat Baru'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $this->siswaUser->id,
            'nama' => 'Nama Baru Siswa'
        ]);

        $this->assertDatabaseHas('siswa', [
            'id_user' => $this->siswaUser->id,
            'no_telp' => '081234567890',
            'alamat' => 'Alamat Baru'
        ]);
    }

    public function test_user_can_change_password()
    {
        $response = $this->actingAs($this->siswaUser)->post('/profil/password', [
            'current_password' => 'password123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertTrue(Hash::check('newpassword123', $this->siswaUser->fresh()->password));
    }

    public function test_user_can_request_email_otp()
    {
        $response = $this->actingAs($this->siswaUser)->postJson('/profil/otp/send', [
            'email' => 'newemail@example.com'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertTrue(Cache::has('otp_' . $this->siswaUser->id));
    }

    public function test_user_can_verify_email_otp()
    {
        Cache::put('otp_' . $this->siswaUser->id, [
            'otp' => '123456',
            'email' => 'newemail@example.com'
        ]);

        $response = $this->actingAs($this->siswaUser)->post('/profil/otp/verify', [
            'otp' => '123456'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $this->siswaUser->id,
            'email' => 'newemail@example.com'
        ]);
    }
}
