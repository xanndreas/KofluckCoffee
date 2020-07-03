<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCandidatesTable extends Migration
{
    public function up()
    {
        Schema::create('training_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('whatsapp');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}