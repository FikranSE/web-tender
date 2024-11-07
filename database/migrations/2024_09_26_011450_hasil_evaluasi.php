<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilEvaluasiTable extends Migration
{
    public function up()
    {
        Schema::create('hasil_evaluasi', function (Blueprint $table) {
            $table->id('id_hasil_evaluasi');
            $table->foreignId('id_tender')->constrained('tender')->onDelete('cascade');
            $table->foreignId('id_peserta')->constrained('peserta')->onDelete('cascade');
            $table->foreignId('id_legend')->constrained('legend')->onDelete('cascade');
            $table->enum('status_evaluasi', ['lulus', 'tidak_lulus', 'catatan']);
            $table->text('alasan')->nullable();
            $table->decimal('skor', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_evaluasi');
    }
}