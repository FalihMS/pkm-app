<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PkmStudent extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['title','student_info_id','pkm_file_id', 'roles'];

	public function pkm_file()
    {
        return $this->belongsTo('App\PkmFile','pkm_file_id','id');
    }

}
