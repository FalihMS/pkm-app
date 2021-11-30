<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkmFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pkm_files', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('pkm_type_id');
			$table->integer('class_lecturer_id');
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
		Schema::drop('pkm_files');
	}

}
