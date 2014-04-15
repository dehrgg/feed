<?php

use App\Models\User;
use App\Models\Feedlist;
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('ListTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();
		$guestPass = Hash::make(Hash::make('guestpass'));
		User::create(array('email' => 'guest', 'password' => $guestPass));
	}
}

class ListTableSeeder extends Seeder {

	public function run() {
		DB::table('feedlists')->delete();
		$guest = App::make('user.guest');
		$list = new FeedList(array('name' => 'Guest List 1'));

		$guest->feedlists()->save($list);

		$list = new FeedList(array('name' => 'Guest List 2'));

		$guest->feedlists()->save($list);
	}
}