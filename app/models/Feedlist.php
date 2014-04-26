<?php

namespace App\Models;

/**
 * Model representing a user's combination of RSS Feeds
 */
Class Feedlist extends BaseModel {

	protected $fillable = array("name");

	const MAX_FEEDS = 10;

	/**
	 * Gives the owner (user) for this list
	 * @return HasOne user
	 */
	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	/**
	 * Gives the feeds that belong to this list
	 * @return HasMany feeds
	 */
	public function pins(){
		return $this->belongsToMany('App\Models\Pin');
	}

	public function addFeed($feed, $pivot, &$error = null){
		if ($this->isFull()){
			$error = 'A list can only have '. MAX_FEEDS .' feeds';
			return false;
		}
		if ($this->user->pinFeed($feed, $pivot, $error)) {
			$pin = Pin::where('user_id', $this->user->id)
					->where('feed_id', $feed->id)
					->first();
			$this->pins()->attach($pin);
			return true;
		}		
		return false;
	}

	public function isFull() {
		return $this->pins->count() >= self::MAX_FEEDS;
	}
}

?>