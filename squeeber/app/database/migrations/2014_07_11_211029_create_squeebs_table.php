<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSqueebsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('squeebs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('branch_id')->unsigned();
			$table->string('model', 10);
			$table->integer('views')->unsigned();
			$table->integer('shares')->unsigned();
			$table->integer('reports')->unsigned();
			$table->boolean('active');
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
		Schema::drop('squeebs');
	}

}
