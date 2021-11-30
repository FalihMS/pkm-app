<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model {

	//
	protected $fillable = ['user_id','nim','name','phone_no','major_id','address'];

	public function pkm_student()
    {
        return $this->hasMany('App\PkmStudent','student_info_id','id');
    }

}
