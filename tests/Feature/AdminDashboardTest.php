<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Hash;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->adminUser = User::create([
            'username' => 'admin',
            'nama' => 'Administrator',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        $this->siswaUser = User::create([
            'username' => 'siswa1',
            'nama' => 'Siswa Test',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);

        Pengaduan::create([
            'id_user' => $this->siswaUser->id,
            'is_anonim' => false,
            'nama_siswa' => 'Siswa Test',
            'kelas' => 'XII',
            'jenis_perundungan' => 'Verbal',
            'pelaku' => 'Siswa',
            'lokasi_kejadian' => 'Kelas',
            'judul' => 'Pengaduan Pending',
            'isi_laporan' => 'Isi laporan pending',
            'status' => 'pending',
            'tanggal_lapor' => now()->toDateString()
        ]);

        Pengaduan::create([
            'id_user' => $this->siswaUser->id,
            'is_anonim' => true,
            'nama_siswa' => null,
            'kelas' => 'XI',
            'jenis_perundungan' => 'Fisik',
            'pelaku' => 'Bukan Siswa',
            'lokasi_kejadian' => 'Kantin',
            'judul' => 'Pengaduan Selesai',
            'isi_laporan' => 'Isi laporan selesai',
            'status' => 'selesai',
            'tanggal_lapor' => now()->toDateString()
        ]);
    }

    public function test_admin_can_view_dashboard_with_correct_stats()
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/dashboard');

        $response->assertStatus(200);
        
        $response->assertViewHas('totalPengaduan', 2);
        $response->assertViewHas('menunggu', 1);
        $response->assertViewHas('diproses', 0);
        $response->assertViewHas('selesai', 1);

        $response->assertSee('Pengaduan Pending');
        $response->assertSee('Pengaduan Selesai');
        $response->assertSee('Anonim');
    }

    public function test_non_admin_cannot_access_admin_dashboard()
    {
        $response = $this->actingAs($this->siswaUser)->get('/admin/dashboard');

        $response->assertStatus(403);
    }
}
