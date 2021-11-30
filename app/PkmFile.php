<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PkmFile extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['title','pkm_type_id','class_lecturer_id'];

	public function pkm_student()
    {
        return $this->hasMany('App\PkmStudent','pkm_file_id','id');
    }

	public function class_lecturer()
    {
        return $this->hasOne('App\ClassLecturer','id','class_lecturer_id');
    }

}
