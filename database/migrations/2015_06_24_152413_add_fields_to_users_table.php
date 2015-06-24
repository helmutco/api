<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ht_users', function(Blueprint $table)
		{
			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->string('gender', 20);
			$table->string('locale', 10);
			$table->integer('timezone', 1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ht_users', function(Blueprint $table)
		{
			//
		});
	}

}
