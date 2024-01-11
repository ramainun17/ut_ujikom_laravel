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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id_order');
            $table->integer('id_kendaraan')->unsigned();
            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraans')->onDelete('cascade');
            $table->string('nomor_mesin');
            $table->string('nomor_polisi');
            $table->string('seri_kendaraan');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('nomor_telpon');
            $table->integer('id_layanan')->unsigned();
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('cascade');
            $table->dateTime('tgl_booking');
            $table->string('alamat');
            $table->string('status')->default('pending');
            $table->string('teknisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
