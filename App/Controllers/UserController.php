<?php

namespace App\Controllers;

use App\Models\User;
use App;
use View;
use Auth;
use Validator;
use Input;
use Redirect;
use Hash;
use Illuminate\Support\MessageBag;

class UserController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', array(
			'except' => array('store')
		));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
		'email' => 'required|email|unique:users',
		'password' => 'required|min:6|confirmed'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('signup')
				->withErrors($validator)
				->withInput(Input::except('password'));
		}
		else {
			$user = new User();
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::to('welcome');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$user = App::make('user.current');
		return View::make('shared.user.edit-user', $user->toArray());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'password' => 'required|min:6|confirmed',
			'email' => 'required'
		);

		$user = User::find($id);
		if (! $user) {
			$this->setStatus(static::STATUS_ERROR);
			$this->setMessage('User does not exist');
			return $this->jsendResponse();
		}
		$validator = Validator::make(Input::all(), $rules);
		$credentials = array(
			'password' => Input::get('old-password'),
			'email' => Input::get('email')
		);

		if (!Auth::validate($credentials)) {
			$message = new MessageBag;
			$message->add('old-password', 'Current password is incorrect');
			$this->setStatus(static::STATUS_FAIL);
			$this->setData($message->toJson());
			$validator->errors()->merge($message->toArray());
		}
		else if ($validator->fails()) {
			$this->setStatus(static::STATUS_FAIL);
			$this->setData($validator->errors()->toJson());
		}
		else {
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			$this->setStatus(static::STATUS_SUCCESS);
			$this->setData($user->toJson());
			return View::make('shared.user.edit-user', array_merge($user->toArray(), array('wasUpdated' => true)));
		}
		return Redirect::to('profile')->withErrors($validator);
		// return $this->jsendResponse();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}