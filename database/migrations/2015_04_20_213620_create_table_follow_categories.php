<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTableFollowCategories
 */
class CreateTableFollowCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follow_categories', function(Blueprint $table) {
			$table->integer('user_id')->index('user_id');
			$table->integer('category_id')->index('category_id');
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
		Schema::drop('follow_categories');
	}

}
