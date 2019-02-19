<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTableFollows
 */
class CreateTableFollows extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follow_users', function(Blueprint $table) {
			$table->integer('user_id')->index('user_id');
			$table->integer('friend_id')->index('friend_id');
			$table->integer('create_time');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('follow_users');
	}

}
