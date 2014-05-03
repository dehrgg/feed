<?php namespace App\Composers;

use App;
abstract class SubPageComposer {

	protected $scripts = array();
	protected $minified = array();

	public function compose($view) {
		return $view->with('scripts', $this->getScripts());
	}

	function getScripts() {
		if ( ! App::environment('production')) {
			return array_merge($this->scripts, $this->minified);
		}
		else {
			return $this->scripts;
		}
	}
}