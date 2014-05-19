<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	public function up()
    {
        Schema::create('settings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('style');
            $table->string('depart');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('settings');
    }

}
