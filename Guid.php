<?php

require_once 'System/Random.php';

if(!function_exists('hex2bin')) {
	function hex2bin($hex) {
		$raw 		= '';
		for($c = 0; $c < strlen($hex); $c += 2)
			$raw .= chr(hexdec(substr($hex, $c, 2))); 
		return $raw;
		
	}
}

class NetAddress {

	private $_name 		= 'localhost';
	private $_ip 			= '127.0.0.1';
	
	public static function getLocalHost() {
		$address = new NetAddress();
		try {
			$address->_name 	= $_SERVER['SERVER_NAME'];
			$address->_ip 		= $_SERVER["SERVER_ADDR"];
		} catch(Exception $e) {
			
		}
		return $address;
	}

  public function __toString() {
		return strtolower($this->_name . '/' . $this->_ip);
	}

}

class System_Guid {

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
					throw new System_ArgumentOutOfRangeException('value', 'Se ha especificado una cadena GUID no válida', $value);
				}
			}
		} elseif($value instanceof System_Guid) {
			$this->raw = $value->getRaw();
		} else {
			require_once 'ArgumentOutOfRangeException.php';
			throw new System_ArgumentOutOfRangeException('value', 'Se esperaba una cadena', $value);
		}
	}
	
	// Returns a empty Guid
	public static function getEmpty() {
		return new self(str_repeat(chr(0), 16));
	}
	
	// Returns a new Guid object
	public static function NewGuid() {
		return new self(self::getNewRaw());
	}
	
	// Returns if a guid is null or empty
	public static function isEmpty(System_Guid $id = null) {
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
		$address = NetAddress::getLocalHost();
		$value = $address . ':' . System_DateTime::NowMillisecond() . ':' . System_Random::nextLong();
		return self::createRaw(md5($value));
	}
	
	// Returns the raw value from a guid string
	protected static function createRaw($value) {
		$value	= str_replace('-', '', $value);
		try {
			return @hex2bin($value);
		} catch(Exception $ex) {
			return false;
		}
	}
	
}