<?php

namespace App\Controllers;

use Auth;
use View;
use Input;
use Redirect;
use App\Models\User;

class HomeController extends BaseController {

	public function showWelcome() {
		return View::make('welcome');
	}

	public function showSignup() {
		return View::make('signup', array(
			'title' => ''
		));
	}

	public function doLogin() {
		//$remember = Input::get('remember');
		$user = array(
			'email' => Input::get('email'), 
			'password' => Input::get('password')
		);
		$success = Auth::attempt($user);
		if ($success) {
			return Redirect::intended('/lists');
		}
		else {
			return Redirect::to('login')
					->withInput(Input::except('password'));
		}
	}

	public function logout() {
		Auth::logout();
		return Redirect::to('lists');
	}

	/**
	 * logout the form for user login
	 * @return View representing the login page
	 */
	public function showLogin() {
		return View::make('login');
	}
}