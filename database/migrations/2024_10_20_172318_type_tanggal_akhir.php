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
        //
        Schema::table('penugasans', function (Blueprint $table) {
            $table->timestamp('Tanggalsurat')->nullable()->change();
            $table->timestamp('tanggalterbitSurat')->nullable()->change();
            $table->timestamp('TanggalAkhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('penugasans', function (Blueprint $table) {
            $table->string('Tanggalsurat')->change();
            $table->string('tanggalterbitSurat')->change();
            $table->dropColumn('TanggalAkhir');
        });
    }
};
