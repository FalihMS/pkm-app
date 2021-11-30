<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassLecturersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class_lecturers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('academic_years_id');
			$table->integer('regions_id');
			$table->integer('lecturers_id');
			$table->string('class');
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
		Schema::drop('class_lecturers');
	}

}
