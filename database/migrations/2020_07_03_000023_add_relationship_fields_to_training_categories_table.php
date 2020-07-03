<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTrainingCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('training_categories', function (Blueprint $table) {
            $table->unsignedInteger('outlet_id');
            $table->foreign('outlet_id', 'outlet_fk_1758666')->references('id')->on('outlets');
        });
    }
}