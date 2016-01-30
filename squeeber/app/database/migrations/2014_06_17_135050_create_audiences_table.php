<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audiences', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('users_id')->unsigned();
			$table->integer('notices_id')->unsigned();
			$table->integer('eventsqs_id')->unsigned();
			$table->integer('jobs_id')->unsigned();
			$table->integer('offers_id')->unsigned();
			$table->integer('branchs_id')->unsigned();
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
		Schema::drop('audiences');
	}

}
