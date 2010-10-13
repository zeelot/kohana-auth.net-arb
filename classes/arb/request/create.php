<?php defined('SYSPATH') or die('No direct script access.');

class ARB_Request_Create extends ARB_Request {

	protected $_view_path = 'auth-arb/create_subscription.xml';

	public function validation_object()
	{
		return parent::validation_object()
			 // Merchant-assigned name for the subscription
			 // Optional
			->rule('subscription_name', 'max_length', array(50))
			// The measurement of time, in association with the Interval Unit,
			// that is used to define the frequency of the billing occurrences.
			->rule('interval_length', 'max_length', array(3))
			->rule('interval_length', 'not_empty', array())
			// The unit of time, in association with the Interval Length,
			// between each billing occurance (months or days)
			->rule('interval_unit', 'not_empty', array())
			->rule('interval_unit', 'in_array', array(array('months', 'days')))
			// The date the subscription begins (also the date the initial billing occurs)
			// YYYY-MM-DD
			// The date entered must be greater than or equal to the date the subscription
			// was created.
			// The validation checks against local server date, which is Mountain Time.
			// An error might possibly occur if you try to submit a subscription from a time
			// zone where the resulting date is different; for example, if you are in the
			// Pacific time zone and try to submit a subscription between 11:00 PM and
			// midnight, with a start date set for today.
			->rule('start_date', 'not_empty', array())
			// Number of billing occurrences or payments for the subscription.
			// To submit a subscription with no end date (an ongoing subscription), this
			// field must be submitted with a value of "9999."
			// If a trial period is specified, this number should include the Trial Occurrences.
			->rule('total_occurrences', 'not_empty', array())
			->rule('total_occurrences', 'max_length', array(4))
			// @TODO: implement trial occurrences
			// --
			// The amount to be billed to the customer for each payment in the subscription.
			// If a trial period is specified, this is the amount that will be charged after
			// the trial payments are completed.
			->rule('amount', 'not_empty', array())
			->rule('amount', 'max_length', array(15))
			// @TODO: implement trial_amount
			// --
			// @TODO: implement bank/cc choices
			// --
			->rule('card_number', 'not_empty', array())
			->rule('card_number', 'min_length', array(13))
			->rule('card_number', 'max_length', array(16))
			// YYYY-MM
			->rule('card_expiration_date', 'not_empty', array())
			->rule('card_expiration_date', 'exact_length', array(7))
			// The three- or four-digit card code on the back of most credit
			// cards, on the front for American Express.
			// This element should only be included when the merchant has set the card code
			// value field to required in the account settings. The value itself is never validated.
			->rule('card_code', 'min_length', array(3))
			->rule('card_code', 'max_length', array(4))
			// Merchant-assigned invoice number for the subscription.
			// Optional
			// The invoice number will be associated with each payment in the subscription.
			->rule('invoice_number', 'max_length', array(20))
			// Description of the subscription.
			// Optional
			// The description will be associated with each payment in the subscription.
			->rule('invoice_description', 'max_length', array(255))
			// Merchant-assigned identifier for the customer.
			// Optional
			->rule('user_id', 'max_length', array(20))
			// The customer’s email address.
			// Optional
			->rule('user_email', 'max_length', array(255))
			// The customer’s phone number.
			// Optional
			->rule('user_phone', 'max_length', array(25))
			// 
			->rule('billing_first_name', 'not_empty', array())
			->rule('billing_first_name', 'max_length', array(25))
			->rule('billing_last_name', 'not_empty', array())
			->rule('billing_last_name', 'max_length', array(25));
	}
}
