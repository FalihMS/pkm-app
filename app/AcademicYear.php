<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'academic_years';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['year','semester','status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	// protected $hidden = ['password', 'remember_token'];

}
