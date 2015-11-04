<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workshops', function(Blueprint $table)
		{
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('title', 100);

            $table->text('text');

            $table->dateTime('shows_at');

            $table->dateTime('expires_at')->nullable();

            $table->timestamps();

            $table->boolean('is_featured');

            $table->timestamp('begins_at');

            $table->timestamp('ends_at');

            $table->integer('max_signups');

            $table->string('teacher_name', 100);

            $table->string('teacher_email', 255);

            $table->string('location', 50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('workshops');
	}

}