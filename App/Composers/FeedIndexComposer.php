<?php namespace App\Composers;

class FeedIndexComposer extends SubPageComposer {
	protected $minified = array(
		array( 'internal' => 'js/templates/feed.js'),
		array( 'internal' => 'js/views/picklist.js'),
		array( 'internal' => 'js/views/feed.js'),
		array( 'internal' => 'js/models/feedlist.js'),
		array( 'internal' => 'js/models/feed.js'),
		array( 'internal' => 'js/views/pin-form.js')
	);
}