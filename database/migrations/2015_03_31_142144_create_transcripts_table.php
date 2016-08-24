<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranscriptsTable extends Migration 
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transcripts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->mediumInteger('user_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->mediumInteger('grade')->unsigned();
            $table->date('completion_date');
            $table->softDeletes();
			$table->timestamps();        
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transcripts');
	}

}
