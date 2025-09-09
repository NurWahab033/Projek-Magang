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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulir_id');
            $table->string('nomor_sertifikat')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->enum('status', ['belum tersedia', 'izin terbit', 'tersedia'])->default('belum tersedia');
            $table->timestamps();

            $table->foreign('formulir_id')->references('id')->on('formulir_pendaftaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
