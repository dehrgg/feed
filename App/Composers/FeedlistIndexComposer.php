<?php namespace App\Composers;

class FeedlistIndexComposer extends SubPageComposer {
	protected $minified = array(
		array( 'internal' => 'js/models/feedlist.js'),
		array( 'internal' => 'js/models/feed.js'),
		array( 'internal' => 'js/templates/feedlist.js'),
		array( 'internal' => 'js/views/feedlist.js')
	);
}