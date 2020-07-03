<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransaksisTable extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedInteger('product_stuff_id')->nullable();
            $table->foreign('product_stuff_id', 'product_stuff_fk_1762111')->references('id')->on('product_stuffs');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_1762112')->references('id')->on('users');
        });
    }
}