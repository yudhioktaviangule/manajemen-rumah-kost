<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutKamarSewasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_kamar_sewas', function (Blueprint $table) {
            $table->id();
            $table->integer('tmp_id');
            $table->integer('kamar_id');
            $table->integer('penyewa_id');
            $table->integer('lama_sewa');
            $table->double('total_sewa');
            $table->date('jatuh_tempo');            
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
        Schema::dropIfExists('checkout_kamar_sewas');
    }
}
