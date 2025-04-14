<?php declare(strict_types = 1);
/**
  * Manipulación de archivos en modo POO
  *
  * Description: Determina si el principio de una cadena coincide con una cadena especificada,
  * opcionalmente puede ignorar distinciones entre minusculas y mayusculas.
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  */

namespace System\IO\File;

use System\IO\File;
use function chmod;
use function fclose;
use function flock;
use function fopen;
use function fseek;
use function ftruncate;
use function ignore_user_abort;
use function stream_get_contents;

require_once 'System/IO/File.php';

/**
  * Manipulación de archivos
  */
class FileSystem extends File {

    /**
      * Devuelve el contenido de un archivo
      *
      * @param  string  $mode   Especifica el tipo de acceso que se necesita para el flujo
      * @return string          Contenido del archivo (o false en caso de error)
      */
    public function read($mode = 'rb') {
        if (! is_file($this->filename)) {
            return false;
        }
        $result = false;
        ignore_user_abort(true);
        $f = @fopen($this->filename, $mode);
        if ($f) {
            @flock($f, LOCK_SH);
            $result = stream_get_contents($f);
            @flock($f, LOCK_UN);
            @fclose($f);
        }
        return $result;
    }

    /**
      * Escribe el contenido en un archivo
      *
      * @param  string  $string Contenido a almacenar
      * @param  string  $mode   Especifica el tipo de acceso que se necesita para el flujo
      * @param  int     $perm   Consiste en tres componentes numéricos octales que especifican las restricciones de acceso para el propietario, el grupo de usuarios al que pertenece el propietario, y para todos los demás
      * @return mixed           false en caso de error, sino el numero de bytes escritos
      */
    public function write($string, $mode = 'ab+', $perm = 0600) {
        $result = false;
        ignore_user_abort(true);
        $f = @fopen($this->filename, $mode);
        if ($f) {
            @flock($f, LOCK_EX);
            fseek($f, 0);
            ftruncate($f, 0);
            $result = @fwrite($f, $string);
            @flock($f, LOCK_UN);
            @fclose($f);
            @chmod($this->filename, $perm);
        }
        return $result;
    }

    /**
      * Modifica el contenido de un archivo
      *
      * @param  callable    $action Acción que se debe realizar con el contenido del archivo
      * @param  integer     $perm   Consiste en tres componentes numéricos octales que especifican las restricciones de acceso para el propietario, el grupo de usuarios al que pertenece el propietario, y para todos los demás
      * @return mixed               false en caso de error, sino el numero de bytes escritos
      */
    public function modify(callable $action, $perm = 0600) {
        if (file_exists($this->filename) && !is_file($this->filename)) {
            return false;
        }
        $result = false;
        ignore_user_abort(true);
        $f = @fopen($this->filename, 'cb+');
        if ($f) {
            @flock($f, LOCK_EX);
            $read = stream_get_contents($f);
            $write = call_user_func($action, $read);
            fseek($f, 0);
            $result = @fwrite($f, $write);
            ftruncate($f, $result);
            @flock($f, LOCK_UN);
            @fclose($f);
            @chmod($this->filename, $perm);
        }
        return $result;
    }

}
