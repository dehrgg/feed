<?php

namespace App\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	const MAX_LISTS = 10;
	const MAX_FEEDS = 10;

	/**
	 * Return the lists that belong to this user
	 * @return HasMany
	 */
	public function feedlists()
	{
		return $this->hasMany('App\Models\Feedlist');
	}

	public function pins()
	{
		return $this->hasMany('App\Models\Pin');
	}

	public function feeds() {
		$this->pins->load('feed');
		return $this->pins->map(function($pin){
			return $pin->feed;
		});
	}

	public function pinFeed($feed, $pivot, &$error = null){
		if (!$this->hasFeed($feed)) {
			if ($this->pins->count() < self::MAX_FEEDS) {
				$pin = new Pin($pivot);
				$pin->user()->associate($this);
				$pin->feed()->associate($feed);
				$pin->save();
				return $pin;
			}
			else {
				$error = 'Only '. self::MAX_FEEDS . ' feeds can be pinned at one time';
				return false;
			}
		}
		else {
			$error = 'That feed is already pinned';
			return false;
		}
	}

	public function unpin($pin) {
		Pin::destroy($pin);
	}

	public function hasFeed($feed){
		return $this->feeds()->contains($feed);
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
}