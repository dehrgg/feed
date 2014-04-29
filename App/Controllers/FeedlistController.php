<?php

namespace App\Controllers;

use App\FeedReader\FeedReaderInterface;
use App\Models\Feed;
use App\Models\Feedlist;
use App;
use View;
use Request;
use Input;
use Redirect;
use DateTime;

/**
 * Controller for the feedlist resource, feeds grouped by the user
 */
class FeedlistController extends BaseController {

	private $feedReader;

	public function __construct(FeedReaderInterface $feedReader) {
		$this->feedReader = $feedReader;
	}

	/**
	 * Display a listing of the user's lists.
	 *
	 * @return Response
	 */
	public function index() {
		$user = App::make('user.current');
		$lists = $user->feedlists;
		if (Request::wantsJson()) {
			$this->setStatus(static::STATUS_SUCCESS);
			$this->setData($lists->toJson());
			return $this->jsendResponse();
		}
		return View::make('feedlist.index', array('lists' => $lists->toArray()));
	}

	/**
	 * Store a newly created feedlist 
	 * @return Response
	 */
	public function store() {

		if (!Input::has('name')) {
			$this->setStatus(static::STATUS_ERROR);
			$this->setMessage('Name is required');
		}
		else {
			$user = App::make('user.current');
			$lists = $user->feedlists;
			if ($lists->count() < 10) {
				$list = new FeedList(Input::all());
				$user->feedlists()->save($list);
				$this->setStatus(static::STATUS_SUCCESS);
				$this->setData($list->toJson());
			}
			else {
				$this->setStatus(static::STATUS_ERROR);
				$this->setMessage('Maximum number of lists has been reached');
			}
		}
		return $this->jsendResponse();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$list = $this->checkList($id);
		if (Request::wantsJson()) {
			return $this->showJson($list);
		}
		else {
			return $this->showHtml($list);
		}
	}

	/**
	 * Gives the JSON representation of a specified list
	 * @param  Feedlist $list the feedlist to be displayed
	 * @return Response       JSON response with the contents of the list
	 */
	public function showJson($list) {
		if ($list) {
			$this->setStatus(static::STATUS_SUCCESS);
			$this->setData($list->toJson());
		}
		return $this->jsendResponse();
	}

	/**
	 * Gives the HTML representation of a specified list
	 * @param  Feedlist $list the feedlist to be displayed
	 * @return Response 	HTML content of the feedlist view
	 */
	public function showHtml($list) {
		if ($list) {
			$allEntries = array();
			$list->pins->load('feed');
			foreach ($list->pins as $pin) {
				$response = $this->feedReader->loadFeed($pin->feed->url);
				$response['entries'] = array_map(function($entry) use ($pin) {
					return array_add($entry, 'pin', $pin->toArray());
				}, $response['entries'] );
				$allEntries = array_merge($allEntries, $response['entries'] );
			}

			uasort($allEntries, function($a, $b) {
				$aDate = new DateTime($a['publishedDate']);
				$bDate = new DateTime($b['publishedDate']);
				if ($aDate == $bDate) return 0;
				return ($aDate > $bDate) ? -1 : 1;
			});
			
			return View::make('feedlist.show', array('stories' => $allEntries));
		}
		else {
			return Redirect::to('lists');
		}
	}

	/**
	 * Update the specified feedlist in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		// return 'updating list ' . $id;
	}

	/**
	 * Remove the specified feedlist from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$list = $this->checkList($id);

		if ($list) {
			$list->delete();
			$this->setStatus(static::STATUS_SUCCESS);
			$this->setMessage('List ' . $id . ' deleted');
		}
		
		return $this->jsendResponse();		
	}

	/**
	 * Adds a feed to the specified list. Feed details are given as request parameters
	 * @param Integer $listId id of the list to which the feed should be added
	 */
	public function addPin($listId) {
		$list = $this->checkList($listId);
		$user = App::make('user.current');
		if ($list) {
			$url = Input::get('url');
			$name = Input::get('name');
			$feed = Feed::firstOrNew(array('url' => $url));
			if ($feed->validate()) {
				if (!$feed->exists) {
					$feed->save();
				}
				$message = '';
				$success = $list->addFeed($feed, array('name' => $name), $message);
				if ($success) {
					$this->setStatus(static::STATUS_SUCCESS);
				}
				else {
					$this->setStatus(static::STATUS_ERROR);
					$this->setMessage($message);
				}				
			}
			else {
				$this->setStatus(static::STATUS_ERROR);
				$this->setData($this->getErrors()->getMessages());
			}			
		}
		return $this->jsendResponse();
	}

	/**
	 * Checks that the list represented by the given id is valid and can be accessed / modified
	 * @param  Integer $listId id of the list to be checked
	 * @return Feedlist         The feedlist created from the id parameter if succcesful, false otherwise
	 */
	public function checkList($listId) {
		// Check that the given id is valid
		$list = Feedlist::find($listId);
		if (is_null($list)) {
			$this->setStatus(static::STATUS_ERROR);
			$this->setMessage('List ' . $listId . ' does not exist');
			return false;
		}
		// Ensure the authenticated user owns the specified list
		if (!$this->checkListAuthorization($list)) {
			$this->setStatus(static::STATUS_ERROR);
			$this->setMessage('No authorization for list ' . $listId);
			return false;
		}
		return $list;
	}

	/**
	 * Indicates whether or not the authenticated or specified user has
	 * permissions to view the specified list.
	 * @param  Feedlist $list the list to be checked
	 * @param  User $user optional user to check permissions for. Authenticated user is assumed.
	 * @return Boolean       true if the user can view the list
	 */
	public function checkListAuthorization($list, $user = NULL) {
		if (is_null($user)) {
			$user = App::make('user.current');
		}
		if (!$list->public) {
			if ($user->id != $list->user->id) {
				return false;
			}
		}
		return true;
	}
}