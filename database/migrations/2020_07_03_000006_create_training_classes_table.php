<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingClassesTable extends Migration
{
    public function up()
    {
        Schema::create('training_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}