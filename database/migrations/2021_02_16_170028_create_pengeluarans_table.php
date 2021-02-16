<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('total_biaya');
            $table->enum('jenis_pengeluaran',['penambahan aset','pemeliharaan','perbaikan fasilitas']);
            $table->integer('fasilitas_id')->default(0);
            $table->integer('aset_id')->default(0);
            $table->integer('kamar_id')->default(0);
            $table->longtext('keterangan');
            $table->string('jenis_pemeliharaan')->default('-');
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
        Schema::dropIfExists('pengeluarans');
    }
}
