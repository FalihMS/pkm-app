<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRegion extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'classes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['code','region_id','status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	// protected $hidden = ['password', 'remember_token'];
	public function class_lecturer()
    {
        return $this->hasMany('App\ClassLecturer','class','id');
    }

}
