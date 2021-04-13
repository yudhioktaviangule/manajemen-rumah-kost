<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewas', function (Blueprint $table) {
            $table->id();
            $table->string('nik',16)->unique();
            $table->string('name');
            $table->string('hp',20);
            $table->string('kota_asal');
            $table->string('nama_contact');
            $table->string('hubungan_keluarga');
            $table->string('telepon_contact');
            $table->enum('jenis_kelamin',['laki-laki','perempuan']);
            $table->enum('pekerjaan',['swasta',"pns","pelajar"]);
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
        Schema::dropIfExists('penyewas');
    }
}
