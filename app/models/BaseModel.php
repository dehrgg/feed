<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Validator;

/**
 * Abstracts functionality common to all models in the application
 */
class BaseModel extends Eloquent {

	protected $rules = array();

	protected $errors;

	/**
	 * Validates that a model's attributes or a given set of data
	 * adhere to the rules specified by that model
	 * @param  array  $data optional attributes to be checked, 
	 *                      defaults to the model's currently set attributes
	 * @return Boolean	true if the attributes were succesfully validated
	 */
	public function validate($data = array()) {
		if (!$data) {
			$data = $this->getAttributes();
		}
		$validator = Validator::make($data, $this->rules);
		if ($validator->fails()) {
			$this->errors = $validator->errors();
			return false; 
		}
		unset($this->errors);
		return true;
	}

	public function getErrors() {
		return $this->errors;
	}
}

BaseModel::saving(function($model) {
	if ( ! $model->validate() ) return false;
});

?>