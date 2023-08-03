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
        Schema::create('manga', function (Blueprint $table) {
            $table->id('id_manga');
            $table->string('judul_manga', 100);
            $table->string('judul_jepang', 100);
            $table->unsignedInteger('id_mangaka');
            $table->unsignedInteger('id_penerbit');
            $table->integer('jml_vol');
            $table->date('tgl_tersedia');
            $table->string('slug_manga')->unique()->nullable();

            $table->foreign('id_mangaka')->references('id_mangaka')->on('mangaka')->onDelete('cascade');
            $table->foreign('id_penerbit')->references('id_penerbit')->on('penerbit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manga');
    }
};
