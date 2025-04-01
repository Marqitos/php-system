<?php declare(strict_types = 1);
/**
  * Representa un identificador unico (UUID), de 16 bytes de longitud
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.4
  * @version    v0.6
  */

namespace System;

use Exception;
use System\ArgumentOutOfRangeException;
use System\Localization\Resources;

use function chr;
use function is_string;
use function ord;
use function random_bytes;
use function sprintf;
use function strlen;
use function strpos;
use function strtoupper;
use function str_repeat;
use function substr;

const ARGUMENT_OUT_OF_RANGE_EXCEPTION_FILE = 'System/ArgumentOutOfRangeException.php';
const RESOURCES_FILE = 'System/Localization/Resources.php';

class Guid {

    /**
      * Valor binario del UUID
      */
    protected $raw;

    /**
      * Crea un UUID con un valor específico
      *
      * @param string|Guid $value valor inicial
      * @throws ArgumentOutOfRangeException
      */
    public function __construct(Guid|string $value) {
        if(is_string($value)) {
            if(strlen($value) == 16) {
                $this->raw = $value;
            } else {
                try {
                    $this->raw = $this->createRaw($value);
                } catch(Exception $e) {
                    require_once ARGUMENT_OUT_OF_RANGE_EXCEPTION_FILE;
                    require_once RESOURCES_FILE;
                    throw new ArgumentOutOfRangeException('value', Resources::E_ARGUMENT_OUT_OF_RANGE_GUID_STRING_EXPECTED, $value, null, $e);
                }
            }
        } elseif($value instanceof Guid) {
            $this->raw = $value->getRaw();
        } else {
            require_once ARGUMENT_OUT_OF_RANGE_EXCEPTION_FILE;
            require_once RESOURCES_FILE;
            throw new ArgumentOutOfRangeException('value', Resources::E_ARGUMENT_OUT_OF_RANGE_STRING_EXPECTED, $value);
        }
    }

    /**
      * Obtiene un UUID vacío
      *
      * @return Guid
      */
    public static function getEmpty() : Guid {
        return new self(str_repeat(chr(0), 16));
    }

    /**
      * Intenta crear un UUID a partir de una valor
      *
      * @param mixed $parse Valor a comprobar
      * @param Guid|Exception $guid [out] UUID en caso de exito, o la exceción que causo que no se pudiese analizar
      *
      * @return bool True en caso de exito
      */
    public static function tryParse($value, &$guid) : bool {
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
      * Devuelve un nuevo UUID con un valor aleatorio
      *
      * @return System\Guid Nuevo objecto con un valor aleatorio
      */
    public static function newGuid() : Guid {
        return new self(random_bytes(16));
    }

    /**
      * Devuelve si el contenido de System\Guid es vacío, o es null
      *
      * @param Guid $id Valor a comprobar
      * @return bool true en caso de estar vacío
      */
    public static function isEmpty(Guid $id = null) : bool {
        return $id === null ||
            $id->raw == str_repeat(chr(0), 16);
    }

    /**
      * Obtiene el valor como una cadena hexadecimal, de 32 caracteres de longitud, toda en mayusculas
      *
      * @return string Cadena con el valor en hexadecimal
      */
    public function getHex() : string {
        $cadena = '';
        for($c = 0; $c < strlen($this->raw); $c++) {
            $cadena .= sprintf('%02X', ord(substr($this->raw, $c, 1)));
        }
        return strtoupper($cadena);
    }

    /**
      * Devuelve la representación como cadena que representa el UUID
      *
      * @return string Cadena con el valor
      */
    public function __toString() : string {
        $cadena = $this->getHex();
        return substr($cadena, 6, 2) . substr($cadena, 4, 2) . substr($cadena, 2, 2) . substr($cadena, 0, 2) . '-' . substr($cadena, 10, 2) . substr($cadena, 8, 2) . '-' . substr($cadena, 12, 4) . '-' . substr($cadena, 16, 4) . '-' . substr($cadena, 20);
    }

    /**
      * Obtiene el valor como una cadena binaria, de 16 caracteres de longitud
      *
      * @return string Cadena con el valor binario
      */
    public function getRaw() : string {
        return $this->raw;
    }

    /**
      * Obtiene si el elemento actual representa un UUID vacío
      *
      * @return bool true en caso de tener un valor vacío
      */
    public function getIsEmpty() : bool {
        return $this->raw == str_repeat(chr(0), 16);
    }

    /**
      * Devuelve los datos en binario a partir de una cadena UUID
      *
      * @return string Cadena binaria
      */
    protected static function createRaw($value) : string {
        $isGuid = strpos($value, '-') !== -1;
        if ($isGuid) {
            $cadena = str_replace('-', '', $value);
            if (strlen($cadena) != 32) {
                require_once ARGUMENT_OUT_OF_RANGE_EXCEPTION_FILE;
                require_once RESOURCES_FILE;
                throw new ArgumentOutOfRangeException('value', Resources::E_ARGUMENT_OUT_OF_RANGE_GUID_STRING_EXPECTED, $value);
            }
            $value = substr($cadena, 6, 2) . substr($cadena, 4, 2) . substr($cadena, 2, 2) . substr($cadena, 0, 2) . substr($cadena, 10, 2) . substr($cadena, 8, 2) . substr($cadena, 12, 4) . '-' . substr($cadena, 16, 4) . substr($cadena, 20);
        }
        $raw = @hex2bin($value);
        if (strlen($raw) != 16) {
            require_once ARGUMENT_OUT_OF_RANGE_EXCEPTION_FILE;
            require_once RESOURCES_FILE;
            throw new ArgumentOutOfRangeException('value', Resources::E_ARGUMENT_OUT_OF_RANGE_GUID_STRING_EXPECTED, $value);
        }
        return $raw;
    }

}
