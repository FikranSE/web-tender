<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('id_peserta');
            $table->foreignId('id_tender')->constrained('tender')->onDelete('cascade');
            $table->string('nama_perusahaan', 255);
            $table->string('npwp', 50)->unique();
            $table->string('email', 255)->unique();
            $table->string('nomor_telepon', 20);
            $table->string('alamat', 255);
            $table->string('dokumen_perusahaan', 255)->nullable();
            $table->string('dokumen_penawaran', 255)->nullable();
            $table->decimal('harga_penawaran', 20, 2)->nullable();
            $table->enum('status', ['terdaftar', 'lolos', 'gagal', 'menang'])->default('terdaftar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peserta');
    }
}