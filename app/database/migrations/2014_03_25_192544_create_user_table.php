<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Create table 'users'
		Schema::create('users', function($table)
        {
            // Add auto-increment column named 'id'.
            $table->increments('id');

            $table->string('firstname', 35)->nullable();

            $table->string('lastname', 35)->nullable();

            $table->string('email', 255)->unique();

            $table->string('password', 255);

            // Adds 'deleted_at'.
            $table->softDeletes();

            // Foreign keys should be unsigned.
            $table->integer('group_id')->unsigned();

            // Required by laravel
            $table->string('remember_token', 255)->nullable();

            $table->string('reset_password', 255)->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // Drop table 'users'
        Schema::drop('users');
	}

}
