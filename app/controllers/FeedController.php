<?php

namespace App\Controllers;

use App;
use View;

class FeedController extends BaseController {

	/**
	 * Displays the search page used to find feeds
	 * @return Response HTML representation of the search page
	 */
	public function findFeeds() {
		$user = App::make('user.current');
		$lists = $user->feedlists;
		$lists->load('pins');
		return View::make('feed.search', array(
			'results' => array(),
			'lists' => $lists,
		));
	}

}