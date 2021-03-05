<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('penyewa_id')->default(0)->comment('relasi ke penyewa kalau admin nilainya 0');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level',['admin','penyewa']);
            $table->enum('aktif',['nonaktif','aktif'])->default('nonaktif');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
