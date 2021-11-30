<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PkmUpload extends Model {

	//
	protected $fillable = ['pkm_file_id','collection_session_id','file_location', 'upload_count'];

}
