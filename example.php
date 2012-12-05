<?php

require_once 'ZenconomyRestClient/ZenconomyRestClient.php';

$myKey = '1234';
$mySecret = '1234';



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




# Fetch all events for organization

$params = array(
	'organization_id' => 1,
);

$response = $restClient->post( '/event/list', $params );

print_r($response);
