<?php

namespace App\Models;

class Pin extends BaseModel {

	protected $fillable = array('name', 'color');

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function feed() {
		return $this->belongsTo('App\Models\Feed');
	}

	public function feedlists() {
		return $this->belongsToMany('App\Models\Feedlist');	
	}
}

?>