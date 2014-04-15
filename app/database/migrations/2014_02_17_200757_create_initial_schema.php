<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialSchema extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function($table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->string('email', 128);
			$table->string('password', 255);
			$table->boolean('active')->default(false);
			$table->timestamps();
		});

		Schema::create('feeds', function($table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->string('url', 10000);
			$table->timestamps();
		});

		Schema::create('feedlists', function($table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('name', 250);	
			$table->boolean('public')->default(false);		
			$table->foreign('user_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('pins', function($table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('feed_id');
			$table->string('name', 250);
			$table->string('color', 25)->default('#ccc');	
			$table->foreign('feed_id')
				  ->references('id')->on('feeds')
				  ->onDelete('cascade');
			$table->foreign('user_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');
			$table->timestamps();
			$table->unique(array('user_id', 'feed_id'));
		});

		Schema::create('feedlist_pin', function($table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->unsignedInteger('feedlist_id');
			$table->unsignedInteger('pin_id');
			$table->foreign('pin_id')
				  ->references('id')->on('pins')
				  ->onDelete('cascade');
			$table->foreign('feedlist_id')
				  ->references('id')->on('feedlists')
				  ->onDelete('cascade');
			$table->unique(array('feedlist_id', 'pin_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('feedlist_pin');
		Schema::drop('pins');
		Schema::drop('feedlists');
		Schema::drop('feeds');
		Schema::drop('users');		
	}
}
