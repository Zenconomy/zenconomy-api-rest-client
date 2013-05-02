<?php

require_once 'ZenconomyRestClient/ZenconomyRestClient.php';

$myKey = '1234'; // API public key - submitted with API request
$mySecret = '1234'; // Api private key - used to hash data



# Initialize Rest Client

$restClient = new ZenconomyRestClient(
	'https://www.zenconomy.se/api',
	$myKey,
	$mySecret
);



# Fetch all records for organization and period

$params = array(
	'organization_id' => 1,
	'period_id' => 1,
);

$response = $restClient->post( '/record/list', $params );

print_r($response);



# Create a record

$params = array(
	'period_id' => 1, // ID number of accounting period
	'transaction_date' => '2013-01-01',
	'text' => 'A test record',
	'row' => array(
		array(
			'account' => '1910', // Int: Account number
			'amount' => '-20000' // Int: Amount in 1/100ths of currency. Positive = Debit, Negative = Credit
		),
		array(
			'account' => '1930', // Int: Account number
			'amount' => '20000' // Int: Amount in 1/100ths of currency. Positive = Debit, Negative = Credit
		)
	)
);

$response = $restClient->post( '/record/create', $params );

print_r($response);



# Fetch all invoices for organization

$params = array(
	'organization_id' => 1,
);

$response = $restClient->post( '/invoice/list', $params );

print_r($response);
