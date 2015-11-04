<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Create 'groups' table
		Schema::create('groups', function($table){
            $table->increments('id');

            $table->string('name', 50)->unique();

            $table->text('permissions');

        });

        // Add foreign key on users to groups
        Schema::table('users', function($table){
           $table->foreign('group_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
