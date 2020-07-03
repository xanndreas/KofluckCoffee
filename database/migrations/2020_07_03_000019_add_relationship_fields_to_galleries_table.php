<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGalleriesTable extends Migration
{
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->unsignedInteger('outlet_id');
            $table->foreign('outlet_id', 'outlet_fk_1758688')->references('id')->on('outlets');
        });
    }
}