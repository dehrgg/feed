<?php 

namespace App\Controllers;

use Illuminate\Routing\Controller;

/**
 * PHP implementation of the Google Feed API
 * see https://developers.google.com/feed/
 */
class GoogleFeedReader implements FeedReaderInterface {

	protected $baseUrl = 'http://ajax.googleapis.com/ajax/services/feed/';
	protected $version = '1.0';

	/**
	 * Searches for feeds using a given query string
	 * @param  String $query search string for feeds
	 * @return [type]        [description]
	 */
	public function findFeeds($query){
		return $this->execute('find', $query);
	}

	public function loadFeed($url){
		return $this->execute('load', $url);
	}

	private function execute($command, $query){
		$url = $this->baseUrl . $command . '?v=' . $this->version . 
				'&q=' . urlencode($query) .'&userip=' . $_SERVER['REMOTE_ADDR'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, 'http://dehrg.com');
		$body = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($body, true);
		return $response['responseData']['feed'];
		// return json_decode($body)->responseData->feed;
	}
}

?>