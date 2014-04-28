<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RssServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->bind('App\FeedReader\FeedReaderInterface', 'App\FeedReader\GoogleFeedReader');
	}
}

?>