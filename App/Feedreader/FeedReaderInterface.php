<?php

namespace App\FeedReader;

interface FeedReaderInterface {

	/**
	 * Returns a list of RSS feeds which match the query
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public function findFeeds($query);

	/**
	 * Returns the entries for a given feed
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function loadFeed($url);
	
}
?>