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
Schema::create('formulir_pendaftaran', function (Blueprint $table) {
    $table->id();
    $table->uuid('user_id'); // relasi ke tabel users
    $table->string('nama_lengkap');
    $table->text('alamat');
    $table->string('no_telp', 20);
    $table->string('email')->unique();
    $table->string('nama_institusi');
    $table->string('jurusan');
    $table->date('tanggal_mulai_magang');
    $table->date('tanggal_selesai_magang');
    $table->enum('grade', ['Mahasiswa', 'Siswa']);
        $table->string('fakultas')->nullable(); 
    $table->enum('jenjang', ['S1', 'S2'])->nullable(); 
    $table->string('file_surat'); 
    $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
    $table->string('alasan', 255)->nullable();
    $table->timestamps();

    // foreign key ke users
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir');
    }
};
