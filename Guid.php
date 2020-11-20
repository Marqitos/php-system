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

	/**
	 * Valor binario del UUID
	 */
	protected $raw;
	
	/**
	 * Crea un GUID con un valor específico
	 * 
	 * @param string|System\Guid $value valor inicial
	 * @throws System\ArgumentOutOfRangeException
	 */
	public function __construct($value) {
		if(is_string($value)) {
			if(strlen($value) == 16) {
				$this->raw = $value;
			} else {
				try {
					$this->raw = $this->createRaw($value);
				} catch(Exception $e) {
					require_once 'ArgumentOutOfRangeException.php';
					throw new ArgumentOutOfRangeException('value', Resources::ArgumentOutOfRangeExceptionGUIDStringExpected, $value, null, $e);
				}
			}
		} elseif($value instanceof Guid) {
			$this->raw = $value->getRaw();
		} else {
			require_once 'ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('value', Resources::ArgumentOutOfRangeExceptionStringExpected, $value);
		}
	}
	
	/**
	 * Obtiene un UUID vacío
	 * 
	 * @return System\Guid
	 */
	public static function getEmpty() {
		return new self(str_repeat(chr(0), 16));
	}
	
	/**
	 * Intenta crear un GUID a partir de una valor
	 * 
	 * @param mixed $parse Valor a comprobar
	 * @param System\Guid|Exception GUID en caso de exito, o la exceción que causo que no se pudiese analizar
	 * 
	 * @return bool True en caso de exito
	 */
	public static function tryParse($value, &$guid) {
		if($value instanceof Guid) {
			$guid = $value;
			return true;
		} else {
			try {
				$guid = new self($value);
				return true;
			} catch(Exception $e) {
				$guid = $e;
				return false;
			}
		}
	}
	
	/**
	 * Devuelve un nuevo GUID con un valor aleatorio
	 * 
	 * @return System\Guid Nuevo objecto con un valor aleatorio
	 */
	public static function newGuid() {
		return new self(self::getNewRaw());
	}
	
	/**
	 * Devuelve si el contenido de System\Guid es vacío, o es null
	 * 
	 * @return bool true en caso de estar vacío
	 */
	public static function isEmpty(Guid $id = null) {
		return $id == null ||
			$id->raw == str_repeat(chr(0), 16);
	}
	
	/**
	 * Obtiene el valor como una cadena hexadecimal, de 32 caracteres de longitud, toda en mayusculas
	 * 
	 * @return string Cadena con el valor en hexadecimal
	 */
	public function getHex() {
		$cadena = '';
		for($c = 0; $c < strlen($this->raw); $c++)
			//$cadena .= dechex(ord(substr($this->raw, $c, 1)));
			$cadena .= sprintf('%02X', ord(substr($this->raw, $c, 1)));
	  return strtoupper($cadena);
	}
	
	/**
	 * Devuelve la representación como cadena que representa el UUID
	 * 
	 * @return string Cadena con el valor
	 */
	public function __toString()	{
		$cadena = $this->getHex();
		return substr($cadena,0,8).'-'.substr($cadena,8,4).'-'.substr($cadena,12,4).'-'.substr($cadena,16,4).'-'.substr($cadena,20);
	}
	
	/**
	 * Obtiene el valor como una cadena binaria, de 16 caracteres de longitud
	 * 
	 * @return string Cadena con el valor binario
	 */
	public function getRaw() {
		return $this->raw;
	}
	
	/**
	 * Obtiene si el elemento actual representa un UUID vacío
	 * 
	 * @return bool true en caso de tener un valor vacío
	 */
	public function getIsEmpty() {
		return $this->raw == str_repeat(chr(0), 16);
	}
	
	/**
	 * Obtiene una nueva cadena binaria aleatoria de 16 caracteres de longitud
	 * 
	 * @return string Cadena binaria aleatoria
	 */
	protected static function getNewRaw() {
		return self::createRaw(md5(uniqid()));
	}
	
	/**
	 * Devuelve una cadena binaria a partir de una cadena UUID
	 * 
	 * @return string Cadena binaria
	 */
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