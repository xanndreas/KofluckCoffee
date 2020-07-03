<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletsTable extends Migration
{
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('maps');
            $table->longText('description')->nullable();
            $table->date('est');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}