<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturedImage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('news', function(Blueprint $table) {
            $table->string('featured_image')->nullable();
            $table->boolean('featured_visible')->default(false);
        });

        Schema::table('workshops', function(Blueprint $table){
            $table->string('featured_image')->nullable();
            $table->boolean('featured_visible')->default(false);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('news', function($table)
        {
            $table->dropColumn(array('featured_image', 'featured_visible'));
        });

        Schema::table('workshops', function($table)
        {
            $table->dropColumn(array('featured_image', 'featured_visible'));
        });
	}

}
