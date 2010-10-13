<?php defined('SYSPATH') or die('No direct script access.');

abstract class ARB_Response {

	protected $_raw;
	protected $_xml;
	protected $_data;

	public function __construct($response_string)
	{
		// SimpleXML is too picky otherwise
		libxml_use_internal_errors(TRUE);

		$this->_raw = $response_string;
		$this->_xml = substr($response_string, strpos($response_string, '<?xml version="1.0" encoding="utf-8"?>'));
		$this->_data = new SimpleXMLElement($this->_xml);
	}

	public function data()
	{
		return $this->_data;
	}

	public function code()
	{
		return $this->_data->messages->message->code;
	}

	public function text()
	{
		return $this->_data->messages->message->text;
	}

	public function result_code()
	{
		return $this->_data->messages->resultCode;
	}
}
