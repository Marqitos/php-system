<?php
/**
 * Contiene cadenas en español para mensajes de error y otros
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.4
 */

namespace System\Localization;

class Resources {

    public const ArgumentExceptionDefaultMessage = 'Se ha especificado un argumento no válido';
    public const ArgumentNullExceptionDefaultMessage = 'El argumento no puede ser null';
    public const ArgumentOutOfRangeExceptionDefaultMessage = 'Se ha especificado un argumento fuera de rango';
    public const ArgumentOutOfRangeExceptionIntExpected = 'Se esperaba un entero';
    public const ArgumentOutOfRangeExceptionStringExpected = 'Se esperaba una cadena';
    public const ArgumentOutOfRangeExceptionGUIDStringExpected = 'Se esperaba una cadena GUID válida';
    public const ArgumentOutOfRangeExceptionUrlExpected = 'Se esperaba una url válida';
    public const DirectoryNotFoundExceptionDefaultMessage = 'No se ha podido encontrar el directorio especificado';
    public const FileNotFoundExceptionDefaultMessage = 'No se ha podido encontrar el archivo especificado';
    public const InvalidOperationExceptionDefaultMessage = 'Se ha producido una operación no permitida';
    public const IOExceptionDefaultMessage = 'Error E/S';
    public const KeyNotFoundExceptionDefaultMessage = 'La clave especificada no existe';
    public const KeyNotFoundExceptionFormatedHttpCode = 'No se ha encontrado un codigo http con valor %s';
    public const KEY_NOT_FOUND_EXCEPTION_NO_EVENT_FORMAT        = 'No se ha definido el evento indicado (%s)';
    public const NotImplementedExceptionDefaultMessage = 'Instrucción no implementada';
    public const NotImplementedExceptionNeedIconv = 'Se necesita la funcion "iconv"';
    public const NotSupportedExceptionDefaultMessage = 'Instrucción no soportada';
    public const WebException304Message = 'El recurso no se ha modificado desde la última solicitud.';
    public const WebException400Message = 'La solicitud no se puede cumplir debido a una sintaxis incorrecta';
    public const WebException401Message = 'Acceso no autorizado, se requieren credenciales';
    public const WebException403Message = 'Acceso prohibido';
    public const WebException404Message = 'El documento no ha sido encontrado';
    public const WebException405Message = 'Se realizó una solicitud de un recurso utilizando un método no admitido';
    public const WebException406Message = 'El recurso solicitado solo es capaz de generar contenido no aceptable de acuerdo con los encabezados Accept enviados en la solicitud.';
    public const WebException412Message = 'Solicitud no válida, Se ha denegado el acceso al recurso solicitado.';
    public const WebException500Message = 'Error interno de la aplicación';
    public const WebException501Message = 'El servidor no reconoce el método de solicitud o carece de la capacidad para cumplir con la solicitud.';
    public const WebException503Message = 'El servidor no está disponible actualmente (sobrecargado o en mantenimiento).';

}

global $lang;
if(!isset($lang)) {
    $lang = 'es';
}