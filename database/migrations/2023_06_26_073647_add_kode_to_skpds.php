<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeToSkpds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skpds', function (Blueprint $table) {
            //
             $table->foreignId('id_pegawai')->after('id')->nullable();
             $table->foreignId('id_bendahara')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skpds', function (Blueprint $table) {
            //
        });
    }
}
