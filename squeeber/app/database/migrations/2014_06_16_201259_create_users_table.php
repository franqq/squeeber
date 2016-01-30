<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email', 60);
			$table->string('phone_number', 10)->nullable();
			$table->string('password', 60);
			$table->string('password_temp', 60);
			$table->string('code', 60);
			$table->string('firstname', 60)->nullable();
			$table->string('lastname', 60)->nullable();
			$table->string('gender', 10)->nullable();
			$table->boolean('active');
			$table->timestamps();
			$table->string('remember_token', 60);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
