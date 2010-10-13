<?php defined('SYSPATH') or die('No direct script access.');

abstract class Arb_Request {

	// URLs to communicate with Auth.net
	protected $_url = 'https://api.authorize.net/xml/v1/request.api';
	protected $_dev_url = 'https://apitest.authorize.net/xml/v1/request.api';

	public $test_mode = FALSE;

	protected $_data;
	protected $_view_path;
	protected $_request_type;

	protected $_xml;

	public function __construct()
	{
		// Start with the config values
		$this->_data = Kohana::config('arb')->as_array();

		$class = get_class($this);
		$this->_request_type = substr($class, 12);
	}

	public function test_mode($new_mode)
	{
		$this->test_mode = $new_mode;

		return $this;
	}

	public function set($key, $value)
	{
		if (is_array($key))
		{
			foreach ($key as $k => $v)
			{
				$this->__set($k, $v);
			}
		}
		else
		{
			$this->__set($key, $value);
		}

		return $this;
	}

	public function __set($key, $value)
	{
		$this->_data[$key] = $value;

		return $this;
	}

	public function raw_response()
	{
		return $this->_raw_response;
	}

	public function execute()
	{
		// Validating will throw an exception if the object is not ready to execute
		$this->validate();
		$this->compile();

		// Decide which API url to use based on whether test_mode was set
		$url = $this->test_mode ? $this->_dev_url : $this->_url;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_xml);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);

		// Return a response object of matching type
		$response_class = 'ARB_Response_'.$this->_request_type;
		return new $response_class($response);
	}

	public function compile()
	{
		$this->_xml = View::factory($this->_view_path)
			->set($this->_data)
			->render();

		return $this;
	}

	function validation_object()
	{
		return Validate::factory($this->_data)
			// Optional Field
			->rule('ref_id', 'max_length', array(20))
			// Credentials are always required
			->rule('api_login_id', 'not_empty', array())
			->rule('api_login_id', 'max_length', array(25))
			->rule('transaction_key', 'not_empty', array())
			->rule('transaction_key', 'exact_length', array(16));
	}

	public function validate()
	{
		$object = $this->validation_object();

		if ($object->check())
			return TRUE;

		throw new ARB_Validation_Exception($object);
	}
}
