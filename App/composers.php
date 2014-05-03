<?php
	View::composer('core.page', 'App\Composers\CorePageComposer');

	View::composer('feed.search', 'App\Composers\SearchComposer');

	View::composer('feedlist.index', 'App\Composers\FeedlistIndexComposer');

	View::composer('feed.index', 'App\Composers\FeedIndexComposer');

	// For use if blade templates are converted to mustache
	// View::composer('core.demonav', function($view) {
	// 	return $view->with('user', App::make('user.current'))
	// 				->with('authenticated', Auth::check())
	// 				->with('asset', function($text){
	// 					return asset(trim($text));
	// 				});
	// });
?>