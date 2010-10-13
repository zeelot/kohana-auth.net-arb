<?php defined('SYSPATH') or die('No direct script access.');

class ARB_Request_Cancel extends ARB_Request {

	protected $_view_path = 'auth-arb/cancel_subscription.xml';

	public function validation_object()
	{
		return parent::validation_object()
			->rule('subscription_id', 'not_empty', array());
	}
}
