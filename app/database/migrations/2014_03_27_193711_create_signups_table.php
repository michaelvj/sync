<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('signups', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('workshop_id')->unsigned();

            $table->integer('student_number');

            $table->string('firstname', 35);

            $table->string('lastname', 35);

            $table->string('email', 255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('signups');
	}

}
