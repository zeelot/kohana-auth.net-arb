<?php 
/**
 * XML for updating a subscription
 * Parameters:
 * - api_login_id
 * - transaction_key
 * - subscription_id
 * - ref_id
 * - subscription_name
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
<ARBUpdateSubscriptionRequest xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
	<merchantAuthentication>
		<name><?php echo $api_login_id; ?></name>
		<transactionKey><?php echo $transaction_key; ?></transactionKey>
	</merchantAuthentication>
	<?php if (isset($ref_id)): ?>
	<refId><?php echo $ref_id; ?></refId>
	<?php endif; ?>
	<subscriptionId><?php echo $subscription_id; ?></subscriptionId>
	<subscription>
		<?php if (isset($subscription_name)): ?>
		<name><?php echo $subscription_name; ?></name>
		<?php endif; ?>
		<?php if (isset($amount)): ?>
		<amount><?php echo $amount; ?></amount>
		<?php endif; ?>
		<payment>
			<creditCard>
				<?php if (isset($card_number)): ?>
				<cardNumber><?php echo $card_number; ?></cardNumber>
				<?php endif; ?>
				<?php if (isset($card_expiration_date)): ?>
				<expirationDate><?php echo $card_expiration_date; ?></expirationDate>
				<?php endif; ?>
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
			<?php if (isset($billing_first_name)): ?>
			<firstName><?php echo $billing_first_name; ?></firstName>
			<?php endif; ?>
			<?php if (isset($billing_last_name)): ?>
			<lastName><?php echo $billing_last_name; ?></lastName>
			<?php endif; ?>
		</billTo>
	</subscription>
</ARBUpdateSubscriptionRequest>
