<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_infos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim')->nullable()->unique();
			$table->string('name')->nullable();
			$table->string('phone_no')->nullable();
			$table->integer('major_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('address')->nullable();		
			$table->string('email')->nullable()->unique();		
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
		Schema::drop('student_infos');
	}

}
