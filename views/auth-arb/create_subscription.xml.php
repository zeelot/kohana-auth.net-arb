<?php 
/**
 * XML for creating a subscription
 * Parameters:
 * - api_login_id
 * - transaction_key
 * - ref_id
 * - name
 * - length
 * - unit
 * - start_date
 * - total_occurences
 * - amount
 * - card_number
 * - expiration_date
 * - first_name
 * - last_name
 */
echo "<?xml version='1.0' encoding='utf-8'?>"; ?>
<ARBCreateSubscriptionRequest xmlns='AnetApi/xml/v1/schema/AnetApiSchema.xsd'>
	<merchantAuthentication>
		<name><?php echo $api_login_id; ?></name>
		<transactionKey><?php echo $transaction_key; ?></transactionKey>
	</merchantAuthentication>
	<refId><?php echo $ref_id; ?></refId>
	<subscription>
		<name><?php echo $name; ?></name>
		<paymentSchedule>
			<interval>
				<length><?php echo $length; ?></length>
				<unit><?php echo $unit; ?></unit>
			</interval>
			<startDate><?php echo $start_date; ?></startDate>
			<totalOccurrences><?php echo $total_occurrences; ?></totalOccurrences>
		</paymentSchedule>
		<amount><?php echo $amount; ?></amount>
		<payment>
			<creditCard>
				<cardNumber><?php echo $card_number; ?></cardNumber>
				<expirationDate><?php echo $expiration_date; ?></expirationDate>
			</creditCard>
		</payment>
		<billTo>
			<firstName><?php echo $first_name; ?></firstName>
			<lastName><?php echo $last_name; ?></lastName>
		</billTo>
	</subscription>
</ARBCreateSubscriptionRequest>
