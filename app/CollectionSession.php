<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionSession extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'collection_sessions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['title','deadline','pkm_type_id','academic_year_id'];

	public function academic_year()
    {
        return $this->hasOne('App\AcademicYear','id','academic_year_id');
    }

}
