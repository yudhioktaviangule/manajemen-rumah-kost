<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->unique();
            $table->string('name');
            $table->enum('metode',['tunai','transfer']);
            $table->longtext('bukti_trf');
            $table->enum('virtual_account',['verifikasi','selesai']);
            $table->integer('kamar_sewa_id');
            $table->integer('user_id');
            $table->double('pembayaran');
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
        Schema::dropIfExists('pembayarans');
    }
}
