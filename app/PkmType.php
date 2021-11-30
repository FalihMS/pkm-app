<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PkmType extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	 protected $table = 'pkm_types';

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
}
