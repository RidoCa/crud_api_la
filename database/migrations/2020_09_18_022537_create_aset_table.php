<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->bigIncrements('id_aset');
            $table->string('kode_aset')->unique();
            $table->string('nama_aset');
            $table->integer('jumlah');
            $table->string('merk');
            $table->string('desc');
            $table->integer('id_user');
            $table->timestamps();
            
            $table->foreign('id_user')
            ->references('id')->on('users')
            ->on('users');  
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aset');
    }
}
