<?php

namespace System;

use Exception;
use System\ArgumentOutOfRangeException;
use System\Localization\Resources;

use function chr;
use function explode;
use function is_string;
use function md5;
use function microtime;
use function ord;
use function rand;
use function sprintf;
use function strlen;
use function strtoupper;
use function str_repeat;
use function substr;
use function uniqid;

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
					throw new ArgumentOutOfRangeException('value', Resources::ArgumentOutOfRangeExceptionGUIDStringExpected, $value);
				}
			}
		} elseif($value instanceof Guid) {
			$this->raw = $value->getRaw();
		} else {
			require_once 'ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('value', Resources::ArgumentOutOfRangeExceptionStringExpected, $value);
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
		return self::createRaw(md5(uniqid()));
	}
	
	// Returns the raw value from a guid string
	protected static function createRaw($value) {
		$value	= str_replace('-', '', $value);
		$raw = @hex2bin($value);
		if(strlen($raw) != 16) {
			require_once 'ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('value', Resources::ArgumentOutOfRangeExceptionGUIDStringExpected, $value);
		}
		return $raw;
	}

}