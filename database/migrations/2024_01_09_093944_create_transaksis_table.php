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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_transaksi');
            $table->integer('id_order')->unsigned();
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');
            $table->integer('total_harga');
            $table->enum('status', ['updaid', 'paid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
