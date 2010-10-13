<?php defined('SYSPATH') or die('No direct script access.');

class Arb {

	protected $_config = array();

	// URLs to communicate with Auth.net
	protected $_url = 'https://api.authorize.net/xml/v1/request.api';
	protected $_dev_url = 'https://apitest.authorize.net/xml/v1/request.api';
	protected $_xml_schema = 'https://api.authorize.net/xml/v1/schema/AnetApiSchema.xsd';

	protected $_data = array();
	protected $_xml;

	public static function factory()
	{
		return new Arb;
	}

	public function __construct()
	{
		$this->_config += Kohana::config('arb')->as_array();
	}

	public function test()
	{
		$this->_data = array
		(
			'api_login_id' => $this->_config['api_login_id'],
			'transaction_key' => $this->_config['transaction_key'],
			'ref_id' => '1002',
			'name'  => 'my subscription',
			'length' => '1',
			'unit' => 'months',
			'start_date' => date_create('+5 day')->format('Y-m-d'),
			'total_occurrences' => '9999',
			'amount' => '10.00',
			'card_number' => '4111111111111111',
			'expiration_date' => '2013-07',
			'first_name' => 'Lorenzo',
			'last_name' => 'Pisani',
		);

		$this->_xml = View::factory('auth-arb/create_subscription.xml')
			->set($this->_data)
			->render();

		echo Kohana::debug($this->_xml);
		echo Kohana::debug($this->execute());die;
	}

	protected function execute()
	{
		$url = $this->_dev_url;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_xml);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);

		return $response;
	}
}
