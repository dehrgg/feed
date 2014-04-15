<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App;
use Auth;


class GuestServiceProvider extends ServiceProvider {
	
	public function register() {
		$this->app->singleton('user.guest', function($app){
			return User::where('email', 'guest')->first();
		});

		$this->app->bind('user.current', function($app){
			if (Auth::check()) {
				return Auth::user();
			}
			else {
				return App::make('user.guest');
			}
		});
	}
}

?>