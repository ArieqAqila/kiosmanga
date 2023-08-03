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
        Schema::create('vol_manga', function (Blueprint $table) {
            $table->id('id_vol');
            $table->unsignedBigInteger('id_manga');
            $table->integer('vol_ke');
            $table->text('deskripsi');
            $table->string('bahasa', 25);
            $table->integer('jml_hal');
            $table->integer('harga');
            $table->string('slug_vol')->unique()->nullable();
            $table->string('visual_art')->nullable();

            $table->foreign('id_manga')->references('id_manga')->on('manga')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vol_manga');
    }
};
