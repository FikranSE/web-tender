<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderTable extends Migration
{
    public function up()
    {
        Schema::create('tender', function (Blueprint $table) {
            $table->id('id_tender');
            $table->foreignId('id_paket')->constrained('paket')->onDelete('cascade');
            $table->string('kode_tender', 50)->unique();
            $table->string('nama_tender', 255);
            $table->string('tahapan_tender_saat_ini', 255);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('dokumen_pemilihan', 255)->nullable();
            $table->text('hasil_evaluasi')->nullable();
            $table->string('berita_acara', 255)->nullable();
            $table->enum('status', ['draft', 'aktif', 'selesai', 'dibatalkan'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tender');
    }
}