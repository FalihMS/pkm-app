<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'regions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['key','value','status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	// protected $hidden = ['password', 'remember_token'];

	public function classes()
    {
        return $this->hasMany('App\ClassRegion');
    }
}
