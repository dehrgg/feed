<?php namespace App\Composers;

use App;

class CorePageComposer {
	
	protected $scripts = array(
		array(
			'external' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
			'conditional' => 'js/vendor/jquery.min.js',
			'check' => '$'
		),
		array(
			'external' => '//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js',
			'conditional' => 'js/vendor/bootstrap.min.js',
			'check' => '$.fn.carousel'
		),
		array(
			'external' => '//twitter.github.io/hogan.js/builds/2.0.0/hogan-2.0.0.min.js',
			'conditional' => '/js/vendor/hogan.min.js',
			'check' => 'Hogan'
		),
		array(
			'external' => '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js',
			'conditional' => '/js/vendor/underscore-min.js',
			'check' => '_'
		),
		array(
			'external' => '//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js',
			'conditional' => '/js/vendor/backbone-min.js',
			'check' => 'Backbone'
		),
	);

	protected $minified = array(
		array( 'internal' => 'js/app.js')
	);

	public function compose($view) {
		return $view->with('scripts', $this->getScripts());
	}

	function getScripts() {
		if (App::environment('production')) {
			return array_merge($this->scripts, array(array( 'internal' => 'js/dist/feed.min.js')));
		}
		else {
			return array_merge($this->scripts, $this->minified);
		}
	}

}

