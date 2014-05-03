<?php namespace App\Composers;

class SearchComposer extends SubPageComposer {
	protected $scripts = array(
		array('external'=> 'https://www.google.com/jsapi'),
		array('internal' => 'js/google-feed-provider.js')
	);
	protected $minified = array(
		array( 'internal' => 'js/templates/feed.js'),
		array( 'internal' => 'js/views/pages/search.js'),
		array( 'internal' => 'js/views/picklist.js'),
		array( 'internal' => 'js/views/feed.js'),
		array( 'internal' => 'js/models/feedlist.js'),
		array( 'internal' => 'js/models/feed.js')
	);
}