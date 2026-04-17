<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->boolean('is_anonim')->default(false)->after('id_user');
            $table->string('nama_siswa')->nullable()->after('is_anonim');
            $table->string('kelas')->nullable()->after('nama_siswa');
            $table->string('jenis_perundungan')->nullable()->after('kelas');
            $table->string('pelaku')->nullable()->after('jenis_perundungan');
            $table->string('lokasi_kejadian')->nullable()->after('pelaku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropColumn(['is_anonim', 'nama_siswa', 'kelas', 'jenis_perundungan', 'pelaku', 'lokasi_kejadian']);
        });
    }
};
