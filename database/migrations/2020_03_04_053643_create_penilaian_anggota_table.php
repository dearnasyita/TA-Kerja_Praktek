<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaianAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skill');
            $table->integer('kerapihan');
            $table->integer('sikap');
            $table->integer('keaktifan');
            $table->integer('perhatian');
            $table->integer('kehadiran');
            $table->integer('mahasiswa_id')->unsigned();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_anggota');
    }
}
