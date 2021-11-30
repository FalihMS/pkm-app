<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassLecturer extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['academic_years_id','lecturers_id','class'];

	public function classes()
    {
        return $this->hasOne('App\ClassRegion','id','class');
    }
	public function lecturer()
    {
        return $this->hasOne('App\Lecturer','id','lecturers_id');
    }
}
