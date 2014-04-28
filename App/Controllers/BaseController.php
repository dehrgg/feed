<?php

namespace App\Controllers;

use Illuminate\Routing\Controller As Controller;
use Response;

/**
 * Abstracts away features that are common to all controllers
 */
class BaseController extends Controller {

	const STATUS_ERROR = 'error';
	const STATUS_SUCCESS = 'success';
	const STATUS_FAIL= 'fail';

	protected $status = self::STATUS_SUCCESS;

	protected $message;

	protected $data;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Sends a standardized json response for all AJAX requests.
	 * See http://labs.omniti.com/labs/jsend
	 * @return Illuminate\Http\Response a jsend style json response with status/data/message
	 */
	protected function jsendResponse() {
		return Response::jsend($this->status, $this->data, $this->message);
	}

	protected function setData($data){
		$this->data = $data;
	}

	protected function setMessage($message){
		$this->message = $message;
	}

	protected function setStatus($status) {
		$this->status = $status;
	}

}