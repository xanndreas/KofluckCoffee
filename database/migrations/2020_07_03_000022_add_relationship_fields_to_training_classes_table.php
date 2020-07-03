<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTrainingClassesTable extends Migration
{
    public function up()
    {
        Schema::table('training_classes', function (Blueprint $table) {
            $table->unsignedInteger('training_category_id');
            $table->foreign('training_category_id', 'training_category_fk_1758676')->references('id')->on('training_categories');
        });
    }
}