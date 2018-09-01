<?php

namespace System;

use Exception;
use System\ArgumentOutOfRangeException;
use function explode;
use function microtime;
use function rand;
use function strtoupper;
use function str_repeat;
use function substr;
use function sprintf;
use function ord;

class Guid {

	// guid value
	protected $raw;
	
	// Create a guid object with a specific value
	public function __construct($value) {
		if(is_string($value)) {
			if(strlen($value) == 16) {
				$this->raw = $value;
			} else {
				try {
					$this->raw = $this->createRaw($value);
				} catch(Exception $e) {
					require_once 'ArgumentOutOfRangeException.php';
					throw new ArgumentOutOfRangeException('value', 'Se ha especificado una cadena GUID no válida', $value);
				}
			}
		} elseif($value instanceof Guid) {
			$this->raw = $value->getRaw();
		} else {
			require_once 'ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('value', 'Se esperaba una cadena', $value);
		}
	}
	
	// Returns a empty Guid
	public static function getEmpty() {
		return new self(str_repeat(chr(0), 16));
	}
	
	public static function tryParse($value, &$guid) {
		if($value instanceof Guid) {
			$guid = $value;
			return true;
		} else {
			try {
				$guid = new self($value);
				return true;
			} catch(Exception $e) {
				return false;
			}
		}
	}
	
	// Returns a new Guid object
	public static function newGuid() {
		return new self(self::getNewRaw());
	}
	
	// Returns if a guid is null or empty
	public static function isEmpty(Guid $id = null) {
		return $id == null ||
			$id->raw == str_repeat(chr(0), 16);
	}
	
	// Returns a hex[32] string
	public function getHex() {
		$cadena = '';
		for($c = 0; $c < strlen($this->raw); $c++)
			//$cadena .= dechex(ord(substr($this->raw, $c, 1)));
			$cadena .= sprintf('%02X', ord(substr($this->raw, $c, 1)));
	  return strtoupper($cadena);
	}
	
	// Returns a string that represent a Guid
	public function __toString()	{
		$cadena = $this->getHex();
		return substr($cadena,0,8).'-'.substr($cadena,8,4).'-'.substr($cadena,12,4).'-'.substr($cadena,16,4).'-'.substr($cadena,20);
	}
	
	// Returns a binary[16] string 
	public function getRaw() {
		return $this->raw;
	}
	
	// Returns if this Guid is a empty guid
	public function getIsEmpty() {
		return $this->raw == str_repeat(chr(0), 16);
	}
	
	// Returns a new raw value
	protected static function getNewRaw() {
		require_once 'DateTime.php';
		$address = self::getNetAddressString();
		$value = $address . ':' . self::getNowMillisecond() . ':' . self::getRandomLong();
		return self::createRaw(md5($value));
	}
	
	// Returns the raw value from a guid string
	protected static function createRaw($value) {
		$value	= str_replace('-', '', $value);
		$raw = @hex2bin($value);
		if(strlen($raw) != 16) {
			require_once 'ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('value', 'Se ha especificado una cadena GUID no válida', $value);
		}
		return $raw;
	}

	public static function getNetAddressString() {
		$name = isset($_SERVER['SERVER_NAME'])
			? $_SERVER['SERVER_NAME']
			: 'localhost';
		$ip = isset($_SERVER['SERVER_ADDR'])
			? $_SERVER["SERVER_ADDR"]
			: '127.0.0.1';
		return $name . '/' . $ip;
	}

	public static function getRandomLong() {
		$tmp = rand(0,1)?'-':'';
		return $tmp.rand(1000, 9999).rand(1000, 9999).rand(1000, 9999).rand(100, 999).rand(100, 999);
	}

	public static function getNowMillisecond() 	{
		list($usec, $sec) = explode(" ", microtime());
		return $sec.substr($usec, 2, 3);
	}

}