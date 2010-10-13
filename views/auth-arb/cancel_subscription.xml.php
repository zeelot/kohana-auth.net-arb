<?php 
/**
 * XML for cancelling a subscription
 * Parameters:
 * - api_login_id
 * - transaction_key
 * - ref_id
 * - subscription_id
 */
echo "<?xml version='1.0' encoding='utf-8'?>"; ?>
<ARBCancelSubscriptionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
	<merchantAuthentication>
		<name><?php echo $api_login_id; ?></name>
		<transactionKey><?php echo $transaction_key; ?></transactionKey>
	</merchantAuthentication>
	<?php if (isset($ref_id)): ?>
	<refId><?php echo $ref_id; ?></refId>
	<?php endif; ?>
	<subscriptionId><?php echo $subscription_id; ?></subscriptionId>
</ARBCancelSubscriptionRequest>
