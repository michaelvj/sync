<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScreenToggle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('news', function(Blueprint $table)
        {
            $table->boolean('is_screen')->default(false);
        });

        Schema::table('workshops', function(Blueprint $table)
        {
            $table->boolean('is_screen')->default(false);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('news', function(Blueprint $table)
        {
            $table->dropColumn('is_screen');
        });

        Schema::table('workshops', function(Blueprint $table)
        {
            $table->dropColumn('is_screen');
        });
	}

}
