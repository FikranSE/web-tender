<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketTable extends Migration
{
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nama_paket', 255);
            $table->text('deskripsi')->nullable();
            $table->decimal('nilai_pagu', 20, 2);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paket');
    }
}