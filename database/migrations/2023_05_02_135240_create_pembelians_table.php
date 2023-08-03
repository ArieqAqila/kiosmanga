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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id('id_pembelian');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_vol');
            $table->date('tgl_pembelian');

            $table->foreign('id_transaksi')->references('id_user')->on('transaksi')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_vol')->references('id_vol')->on('vol_manga')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
