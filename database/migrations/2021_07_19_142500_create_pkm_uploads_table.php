<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkmUploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pkm_uploads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pkm_file_id');
			$table->integer('collection_session_id');
			$table->string('file_location');
			$table->integer('upload_count');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pkm_uploads');
	}

}
