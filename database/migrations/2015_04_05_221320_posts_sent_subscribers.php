<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class PostsSentSubscribers
 */
class PostsSentSubscribers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts_sent_subscribers', function(Blueprint $table) {
			$table->integer('post_id');
			$table->tinyInteger('queue');
			$table->tinyInteger('sent');
			$table->integer('sent_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts_sent_subscribers');
	}

}
