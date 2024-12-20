<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpds', function (Blueprint $table) {
            $table->id();
            $table->string('instansi');
            $table->string('skpd');
            $table->string('alamat');
            $table->string('telp');
            $table->string('website');
            $table->string('email');
            $table->string('kodepos');
            $table->string('logo');
            $table->string('nomordalam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skpds');
    }
}
