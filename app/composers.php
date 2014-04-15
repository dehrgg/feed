<?php
	View::composer('core.page', function($view){
		return $view->with('scripts', array(
			array(
				'external' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
				'failsafe' => 'js/vendor/jquery.min.js',
				'check' => '$'
			),
			array(
				'external' => '//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js',
				'failsafe' => 'js/vendor/bootstrap.min.js',
				'check' => '$.fn.carousel'
			),
			array(
				'external' => '//twitter.github.io/hogan.js/builds/2.0.0/hogan-2.0.0.min.js',
				'failsafe' => '/js/vendor/hogan.min.js',
				'check' => 'Hogan'
			),
			array(
				'external' => '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js',
				'failsafe' => '/js/vendor/underscore-min.js',
				'check' => '_'
			),
			array(
				'external' => '//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js',
				'failsafe' => '/js/vendor/backbone-min.js',
				'check' => 'Backbone'
			),
			array( 'internal' => 'js/app.js')
		));
	});

	View::composer('feed.search', function($view){
		return $view->with('scripts', array(
			array('external'=> 'https://www.google.com/jsapi'),
			array('internal' => 'js/google-feed-provider.js'),
			array( 'internal' => 'js/templates/feed.js'),
			array( 'internal' => 'js/views/pages/search.js'),
			array( 'internal' => 'js/views/picklist.js'),
			array( 'internal' => 'js/views/feed.js'),
			array( 'internal' => 'js/models/feedlist.js'),
			array( 'internal' => 'js/models/feed.js'),
		));
	});

	View::composer('feedlist.index', function($view){
		return $view->with('scripts', array(
			array( 'internal' => 'js/models/feedlist.js'),
			array( 'internal' => 'js/models/feed.js'),
			array( 'internal' => 'js/templates/feedlist.js'),
			array( 'internal' => 'js/views/feedlist.js')
		));
	});

	View::composer('feed.index', function($view){
		return $view->with('scripts', array(
			array( 'internal' => 'js/templates/feed.js'),
			array( 'internal' => 'js/views/picklist.js'),
			array( 'internal' => 'js/views/feed.js'),
			array( 'internal' => 'js/models/feedlist.js'),
			array( 'internal' => 'js/models/feed.js'),
			array( 'internal' => 'js/views/pin-form.js')
		));
	});

	// For use if blade templates are converted to mustache
	// View::composer('core.demonav', function($view) {
	// 	return $view->with('user', App::make('user.current'))
	// 				->with('authenticated', Auth::check())
	// 				->with('asset', function($text){
	// 					return asset(trim($text));
	// 				});
	// });
?>