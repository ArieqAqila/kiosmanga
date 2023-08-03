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
        Schema::create('genre_manga', function (Blueprint $table) {
            $table->unsignedBigInteger('id_manga');
            $table->unsignedInteger('id_genre');

            $table->foreign('id_manga')->references('id_manga')->on('manga')->onDelete('cascade');
            $table->foreign('id_genre')->references('id_genre')->on('genre')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
