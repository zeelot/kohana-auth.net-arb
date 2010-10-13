<?php defined('SYSPATH') or die('No direct script access.');

class ARB_Validation_Exception extends Kohana_Exception {

	public $object = array();

	public function __construct(Validate $object)
	{
		$this->object = $object;

		Exception::__construct('errors.validation-errors');
	}

	public function errors($file = NULL, $translate = TRUE)
	{
		return $this->object->errors($file, $translate);
	}
} // End ARB_Validation_Exception
