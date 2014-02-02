<?php

class System_Net_CurlException
	extends Exception {
		
	public function __contruct($curlResource) {
		parent::__construct(curl_error($curlResource), curl_errno($curlResource));
	}
		
}