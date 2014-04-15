<?php

namespace App\Models;

/**
 * Model representing a single RSS feed 
 */
class Feed extends BaseModel {

	protected $fillable = array('url');

	protected $rules = array(
		'url' => 'required|url',
	);
	
	/**
	 * Returns all of the lists this feed belongs to
	 * @return BelongsToMany
	 */
	public function lists() {
		return $this->belongsToMany('App\Models\Feedlist');
	}

	/**
	 * Returns all the users who have pinned this feed
	 * @return HasManyThrough
	 */
	public function pins() {
		return $this->hasMany('App\Models\Pin');
	}

	public function users() {
		return $this->hasManyThrough('App\Models\User', 'App\Models\Pin');
	}

	public function scopeHottest($query, $count) {
		return $query->sortBy(function($feed){
			return $feed->users()->unique()->count();
		})->slice($count);
	}

	/**
	 * Gives the most popular feeds based on number of users
	 * who have pinned them
	 * @param  int $count number of feeds to return
	 * @return Illuminate\Database\Eloquent\Collection 	the top $count feeds
	 */
	public function hottest($count){
		return $this->has('users')->sortBy(function($feed){
			return $feed->users()->unique()->count();
		})->slice($count);
	}
}

?>