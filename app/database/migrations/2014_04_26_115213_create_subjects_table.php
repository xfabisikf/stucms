<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration {

	public function up()
    {
        Schema::create('subjects', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('body')->nullable();
            $table->boolean('semester');
            $table->boolean('visible');
            $table->integer('user_id');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('subjects');
    }

}