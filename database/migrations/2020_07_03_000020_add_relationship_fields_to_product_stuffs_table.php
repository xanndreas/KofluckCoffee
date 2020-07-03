<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductStuffsTable extends Migration
{
    public function up()
    {
        Schema::table('product_stuffs', function (Blueprint $table) {
            $table->unsignedInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_fk_1758629')->references('id')->on('product_categories');
        });
    }
}