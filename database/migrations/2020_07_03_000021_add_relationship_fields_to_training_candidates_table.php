<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTrainingCandidatesTable extends Migration
{
    public function up()
    {
        Schema::table('training_candidates', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1758683')->references('id')->on('users');
            $table->unsignedInteger('training_class_id');
            $table->foreign('training_class_id', 'training_class_fk_1764626')->references('id')->on('training_classes');
        });
    }
}