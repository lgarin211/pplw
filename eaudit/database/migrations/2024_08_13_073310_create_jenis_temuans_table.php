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
        Schema::create('jenis_temuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_temuan');
            $table->string('kode_temuan');
            $table->string('rekomendasi');
            $table->string('pengembalian');
            $table->string('keterangan');
            $table->string('kode_rekomendasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_temuans');
    }
};
