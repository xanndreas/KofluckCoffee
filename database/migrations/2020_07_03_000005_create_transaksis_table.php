<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('qty');
            $table->decimal('price', 15, 2)->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}