<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class UpdateUsersTable
 */
class UpdateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Update the users table
		Schema::table('users', function(Blueprint $table)
		{
			$table->softDeletes();
			$table->string('website')->nullable();
			$table->string('country')->nullable();
			$table->string('gravatar')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Update the users table
		Schema::table('users', function($table)
		{
			$table->dropColumn('deleted_at', 'website', 'country', 'gravatar');
		});
	}

}
