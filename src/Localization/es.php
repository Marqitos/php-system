<?php declare(strict_types = 1);
/**
  * Contiene cadenas en español para mensajes de error y otros
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto
  * @since      v0.4
  */

namespace System\Localization;

use const UPLOAD_ERR_OK;
use const UPLOAD_ERR_INI_SIZE;
use const UPLOAD_ERR_FORM_SIZE;
use const UPLOAD_ERR_PARTIAL;
use const UPLOAD_ERR_NO_FILE;
use const UPLOAD_ERR_NO_TMP_DIR;
use const UPLOAD_ERR_CANT_WRITE;
use const UPLOAD_ERR_EXTENSION;

require_once 'System/String/es-concatenate.php';

class Resources {

    public const E_ARGUMENT_EXCEPTION                           = 'Se ha especificado un argumento no válido';
    public const E_ARGUMENT_NULL                                = 'El argumento no puede ser null';
    public const E_ARGUMENT_OUT_OF_RANGE                        = 'Se ha especificado un argumento fuera de rango';
    public const E_ARGUMENT_OUT_OF_RANGE_INT_EXPECTED           = 'Se esperaba un entero';
    public const E_ARGUMENT_OUT_OF_RANGE_STRING_EXPECTED        = 'Se esperaba una cadena';
    public const E_ARGUMENT_OUT_OF_RANGE_GUID_STRING_EXPECTED   = 'Se esperaba una cadena GUID válida';
    public const E_ARGUMENT_OUT_OF_RANGE_URL_EXPECTED           = 'Se esperaba una url válida';
    public const E_DIRECTORY_NOT_FOUND_EXCEPTION_DEFAULT_MESSAGE = 'No se ha podido encontrar el directorio especificado';
    public const FILE_NOT_FOUND_EXCEPTION_DEFAULT_MESSAGE       = 'No se ha podido encontrar el archivo especificado';
    public const INVALID_OPERATION_EXCEPTION_DEFAULT_MESSAGE    = 'Se ha producido una operación no permitida';
    public const IO_EXCEPTION_DEFAULT_MESSAGE                   = 'Error E/S';
    public const KEY_NOT_FOUND_EXCEPTION_DEFAULT_MESSAGE        = 'La clave especificada no existe';
    public const KEY_NOT_FOUND_EXCEPTION_NO_HTTP_FORMAT         = 'No se ha encontrado un codigo http con valor %s';
    public const KEY_NOT_FOUND_EXCEPTION_NO_EVENT_FORMAT        = 'No se ha definido el evento indicado (%s)';
    public const NOT_IMPLEMENTED_EXCEPTION_DEFAULT_MESSAGE      = 'Instrucción no implementada';
    public const NOT_IMPLEMENTED_EXCEPTION_NEED_ICONV           = 'Se necesita la funcion "iconv"';
    public const NOT_SUPPORTED_EXCEPTION_DEFAULT_MESSAGE        = 'Instrucción no soportada';
    public const NOT_SUPPORTED_EXCEPTION_NO_ENVIRONMENT_FORMAT  = 'Entorno no soportado: "%s"';
    public const UPLOAD_ERROR_CANT_WRITE_TARGET_DIRECTORY_FORMAT = 'Error al escribir el archivo en el directorio destino: %s';
    public const UPLOADED_FILE_ALREADY_MOVED_EXCEPTION_DEFAULT_MESSAGE = 'El archivo ya ha sido movido';
    public const UPLOAD_ERR_CANT_MOVE_FILE                      = 'No se ha podido mover el archivo';
    public const UPLOAD_ERROR_CANT_WRITE_TARGET_PATH            = 'No se ha podido escribir el archivo en la ruta de destino';
    public const WEB_EXCEPTION_MESSAGES = [
        304 => 'El recurso no se ha modificado desde la última solicitud.',
        400 => 'La solicitud no se puede cumplir debido a una sintaxis incorrecta',
        401 => 'Acceso no autorizado, se requieren credenciales',
        403 => 'Acceso prohibido',
        404 => 'El documento no ha sido encontrado',
        405 => 'Se realizó una solicitud de un recurso utilizando un método no admitido',
        406 => 'El recurso solicitado solo es capaz de generar contenido no aceptable de acuerdo con los encabezados Accept enviados en la solicitud.',
        412 => 'Solicitud no válida, Se ha denegado el acceso al recurso solicitado.',
        500 => 'Error interno de la aplicación',
        501 => 'El servidor no reconoce el método de solicitud o carece de la capacidad para cumplir con la solicitud.',
        503 => 'El servidor no está disponible actualmente (sobrecargado o en mantenimiento).'
    ];
    public const UPLOAD_ERROR_MESSAGES = [
        UPLOAD_ERR_OK         => 'El archivo se ha subido correctamente.',
        UPLOAD_ERR_INI_SIZE   => 'El archivo supera el tamaño maximo permitido por el servidor.', // php.ini
        UPLOAD_ERR_FORM_SIZE  => 'El archivo supera el tamaño maximo permitido.', // form
        UPLOAD_ERR_PARTIAL    => 'El archivo solo se ha subido parcialmente',
        UPLOAD_ERR_NO_FILE    => 'No se ha subido ningun archivo',
        UPLOAD_ERR_NO_TMP_DIR => 'No se encuentra el directorio temporal',
        UPLOAD_ERR_CANT_WRITE => 'Error al escribir el archivo en el disco',
        UPLOAD_ERR_EXTENSION  => 'Una extensión del servidor ha bloqueado la subida del archivo.',
    ];
    const AND   = [
        0       => " y ",
        1       => " e "];
}

global $lang;
if(!isset($lang)) {
    $lang = 'es';
}
