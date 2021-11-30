<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkmStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pkm_students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student_info_id');
			$table->integer('pkm_file_id');
			$table->integer('roles')->default(2);
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
		Schema::drop('pkm_students');
	}

}
