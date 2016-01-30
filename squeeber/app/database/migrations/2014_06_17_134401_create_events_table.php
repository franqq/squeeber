<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventsqs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('squeebs_id')->unsigned();
			$table->integer('users_id')->unsigned();
			$table->string('title', 200);
			$table->text('description');
			$table->string('squeeb', 400);
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
		Schema::drop('eventsqs');
	}

}
