<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStuffsTable extends Migration
{
    public function up()
    {
        Schema::create('product_stuffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('stock');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}