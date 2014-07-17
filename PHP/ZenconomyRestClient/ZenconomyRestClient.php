<?php

/**
 * ZenconomyRestClient
 *
 * Class for connecting to the Zenconony REST API
 * For documentation see https://www.zenconomy.se/API-application-programming-interface
 * 
 * This class extends the functionality of the Pest REST API library
 * See Pest.php or http://github.com/educoder/pest
 *
 * This code is licensed for use, modification, and distribution
 * under the terms of the MIT License (see http://en.wikipedia.org/wiki/MIT_License)
 */

require_once 'Pest.php';

class ZenconomyRestClient extends Pest
{
	
	private $secret = false;
	private $key = false;
	
	public function __construct($base_url, $key, $secret) {
		$this->key = $key;
		$this->secret = $secret;
		return parent::__construct($base_url);
	}
	
	public function prepData($data) {
		$data['key'] = $this->key;
		$data['timestamp'] = $this->makeTimestamp();
		$data['signature'] = $this->sign( $this->key, $data['timestamp'], $this->secret );
		
		return parent::prepData($data);
	}
	
	protected function makeTimestamp() {
		return round(microtime(true) * 1000);
	}
	
	protected function sign($key, $timestamp, $secret) {
		return hash_hmac( 'sha256', $key . $timestamp, $secret );
	}
	
	protected function prepRequest($opts, $url) {
		$opts[CURLOPT_HTTPHEADER][] = 'Accept: application/json';
		return parent::prepRequest($opts, $url);
	}
	
	public function processBody($body) {
		return json_decode($body, true);
	}
	
}

