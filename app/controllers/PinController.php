<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Feed;
use App;
use Input;
use View;

class PinController extends BaseController {


	/**
	 * Display a listing of the user's pinned feeds.
	 *
	 * @return Response HTML represenation of the pins view
	 */
	public function index() {
		$user = App::make('user.current');
		$lists = $user->feedlists;
		$user->pins->load('feed');
		return View::make('feed.index', array(
			'feeds' => $user->pins->toArray(),
			'lists' => $lists
		));
	}

	/**
	 * Handles POST to /pins
	 * @return [type] [description]
	 */
	public function store() {
		$url = Input::get('url');
		$name = Input::get('name');
		$pivot = array('name' => $name);
		$feed = Feed::firstOrCreate(array('url' => $url));
		if (!$feed->exists) {
			$this->setData($feed->errors()->toJson());
			$this->setStatus(static::STATUS_FAIL);
		}
		else {
			$user = App::make('user.current');
			$pin = $user->pinFeed($feed, $pivot, $message);
			if ($pin) {
				$this->setStatus(static::STATUS_SUCCESS);
				$this->setData($pin->toJson());
			}
			else {
				$this->setStatus(static::STATUS_ERROR);
				$this->setMessage($message);
			}
		}
		return $this->jsendResponse();
	}

	/**
	 * Deletes a user's pin
	 * handles DELET to /pins/{id}
	 * @param  Integer $pinId identifying the pin to delete
	 * @return Response json response 
	 */
	public function destroy($pinId) {
		$user = App::make('user.current');
		if ($user->pins->contains($pinId)) {
			$user->unpin($pinId);
			$this->setStatus(static::STATUS_SUCCESS);
		}
		else {
			$this->setMessage('Specified pin does not belong to the user');
			$this->setStatus(static::STATUS_ERROR);
		}
		return $this->jsendResponse();
		
	}

	public function update($pinId) {
		$user = App::make('user.current');
		$pin = $user->pins->find($pinId);
		if ($pin) {
			$pin->color = Input::get('color');
			$pin->name = Input::get('name');
			$pin->save();
			$this->setStatus(static::STATUS_SUCCESS);
			$this->setData($pin->toJson());
		}
		else {
			$this->setMessage('Specified pin does not belong to the user');
			$this->setStatus(static::STATUS_ERROR);
		}
		return $this->jsendResponse();
	}
}
