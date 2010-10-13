<?php 
/**
 * XML for creating a subscription
 * Parameters:
 * - api_login_id
 * - transaction_key
 * - ref_id
 * - subscription_name
 * - interval_length
 * - interval_unit
 * - start_date
 * - total_occurences
 * - amount
 * - card_number
 * - card_expiration_date
 * - card_code
 * - invoice_number
 * - invoice_description
 * - user_id
 * - user_email
 * - user_phone
 * - billing_first_name
 * - billing_last_name
 */
echo "<?xml version='1.0' encoding='utf-8'?>"; ?>
<ARBCreateSubscriptionRequest xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
	<merchantAuthentication>
		<name><?php echo $api_login_id; ?></name>
		<transactionKey><?php echo $transaction_key; ?></transactionKey>
	</merchantAuthentication>
	<?php if (isset($ref_id)): ?>
	<refId><?php echo $ref_id; ?></refId>
	<?php endif; ?>
	<subscription>
		<?php if (isset($subscription_name)): ?>
		<name><?php echo $subscription_name; ?></name>
		<?php endif; ?>
		<paymentSchedule>
			<interval>
				<length><?php echo $interval_length; ?></length>
				<unit><?php echo $interval_unit; ?></unit>
			</interval>
			<startDate><?php echo $start_date; ?></startDate>
			<totalOccurrences><?php echo $total_occurrences; ?></totalOccurrences>
		</paymentSchedule>
		<amount><?php echo $amount; ?></amount>
		<payment>
			<creditCard>
				<cardNumber><?php echo $card_number; ?></cardNumber>
				<expirationDate><?php echo $card_expiration_date; ?></expirationDate>
				<?php if (isset($card_code)): ?>
				<cardCode><?php echo $card_code; ?></cardCode>
				<?php endif; ?>
			</creditCard>
		</payment>
		<order>
			<?php if (isset($invoice_number)): ?>
			<invoiceNumber><?php echo $invoice_number; ?></invoiceNumber>
			<?php endif; ?>
			<?php if (isset($invoice_description)): ?>
			<description><?php echo $invoice_description; ?></description>
			<?php endif; ?>
		</order>
		<customer>
			<?php if (isset($user_id)): ?>
			<id><?php echo $user_id; ?></id>
			<?php endif; ?>
			<?php if (isset($user_email)): ?>
			<email><?php echo $user_email; ?></email>
			<?php endif; ?>
			<?php if (isset($user_phone)): ?>
			<phoneNumber><?php echo $user_phone; ?></phoneNumber>
			<?php endif; ?>
		</customer>
		<billTo>
			<firstName><?php echo $billing_first_name; ?></firstName>
			<lastName><?php echo $billing_last_name; ?></lastName>
		</billTo>
	</subscription>
</ARBCreateSubscriptionRequest>
