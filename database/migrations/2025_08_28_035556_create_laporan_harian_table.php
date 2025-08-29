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
        Schema::create('laporan_harian', function (Blueprint $table) {
            $table->id();
            $table->string('judul');               // judul laporan
            $table->text('isi');                   // isi laporan (laporanText)
            $table->string('lampiran')->nullable();// nama file lampiran opsional
            $table->date('tanggal_pengumpulan');   // tanggal submit
            $table->time('jam_pengumpulan');       // jam submit
            $table->uuid('user_id'); // foreign key ke peserta (kalau ada relasi)
            $table->timestamps();

            // relasi ke tabel peserta (opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_harian');
    }
};
