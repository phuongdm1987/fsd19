<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTableRecommendPosts
 */
class CreateTableRecommendPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recommend_posts', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('user_id');
			$table->bigInteger('post_id');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recommend_posts');
	}

}
