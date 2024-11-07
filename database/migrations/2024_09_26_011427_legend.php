<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegendTable extends Migration
{
    public function up()
    {
        Schema::create('legend', function (Blueprint $table) {
            $table->id('id_legend');
            $table->string('kode', 10);
            $table->string('keterangan', 100);
            $table->string('warna', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('legend');
    }
}