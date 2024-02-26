<?php declare(strict_types = 1);
/**
 * Numero de versión
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */

namespace System;

use System\ArgumentOutOfRangeException;
use System\Localization\Resources;

use function is_array;
use function is_string;
use function parse_url;
use function strtolower;

class Uri {
	private $data; // array()
//		scheme - e.g. http
//		host
//		port
//		user
//		pass
//		path
//		query - after the question mark ?
//		fragment - after the hashmark #	

	private static $defaultPorts = [
		'http'	=>	80,
		'https'	=>	443,
		'ftp'	=> 	21
	];
	
	public function __construct($url) {
		if(is_string($url)) {
			$this->data = parse_url($url);
			if(!$this->data) {
				require_once 'ArgumentOutOfRangeException.php';
				throw new ArgumentOutOfRangeException('url', Resources::ARGUMENT_OUT_OF_RANGE_URL_EXPECTED, $url);
			}
		} elseif(is_array($url)) {
			$this->data = $url;
		} elseif($url instanceof Uri) {
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
		if (isset($this->data['user']) &&
		    isset($this->data['pass'])) {
			$result .= $this->data['user'] . ':' . $this->data['pass'] . '@';
		}
		$result .=  $this->data['host'];
		if (isset($this->data['port']) &&
		   !self::isDefaultPort($this->data['scheme'], $this->data['port'])) {
			$result .= ':' . $this->data['port'];
		}
		if (isset($this->data['path'])) {
			$result .= '/' . $this->data['path'];
		}
		if (isset($this->data['query'])) {
			$result .= '?' . $this->data['query'];
		}
		if (isset($this->data['fragment'])) {
			$result .= '#' . $this->data['fragment'];
		}
		
		return $result;
	}
	
	public static function isDefaultPort(string $scheme, int $port) {
		return !isset(self::$defaultPorts[strtolower($scheme)]) ||
			   self::$defaultPorts[$scheme] == $port;
	}
	
	
}
