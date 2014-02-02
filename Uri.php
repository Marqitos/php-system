<?php

class System_Uri {
	private $data; // array()
//		scheme - e.g. http
//		host
//		port
//		user
//		pass
//		path
//		query - after the question mark ?
//		fragment - after the hashmark #	

	private static $defaultPorts = array(
		'http'	=>	80,
		'https'	=>	443,
		'ftp'		=> 	21
	);
	
	public function __construct($url) {
		if(is_string($url)) {
			$this->data = parse_url($url);
			if(!$this->data)
				throw new System_ArgumentOutOfRangeException('url', 'Se esperaba una url válida', $url);
		} elseif(is_array($url)) {
			$this->data = $url;
		} elseif(is_a($url, 'System_Uri')) {
			$this->data = array_merge($url->data);
		}
	}
	
	public function getScheme() {
		return $this->data['scheme'];
	}
	
	public function setScheme($value) {
		$this->data['scheme'] = $value;
	}
	
	public function __toString() {
		$result = $this->data['scheme'] . '://';
		if(array_key_exists('user', $this->data) && array_key_exists('pass', $this->data)) {
			$result .= $this->data['user'] . ':' . $this->data['pass'] .'@';
		}
		$result .=  $this->data['host'];
		if(array_key_exists('port', $this->data) && !self::isDefaultPort($this->data['scheme'], $this->data['port'])) {
			$result .= ':' . $this->data['port'];
		}
		if(array_key_exists('path', $this->data))
			$result .= '/' . $this->data['path'];
		if(array_key_exists('query', $this->data))
			$result .= '?' . $this->data['query'];
		if(array_key_exists('fragment', $this->data))
			$result .= '#' . $this->data['fragment'];
		
		return $result;
	}
	
	public static function isDefaultPort($scheme, $port) {
		return 	!array_key_exists($scheme, self::defaultPorts) ||
						self::$defaultPorts[$scheme] == $port;
	}
	
	
}

