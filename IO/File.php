<?php
namespace System\IO;

use function explode;
use function get_include_path;
use function is_writable;
use function is_readable;
use function fclose;
use function fopen;
use function preg_split;
use function strrpos;
use function strtolower;
use function substr;

abstract class File {

    protected $filename;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public abstract function write($string, $mode = 'ab+', $perm = 0600);
    public abstract function read($mode = 'rb');
    public abstract function modify(callable $action, $perm = 0600);

    /**
     * Returns TRUE if the $filename is readable, or FALSE otherwise.
     * This function uses the PHP include_path, where PHP's is_readable()
     * does not.
     *
     * Note : this method comes from Zend_Loader (see #ZF-2891 for details)
     *
     * @param string   $filename
     * @return boolean
     */
    public static function isReadable($filename) {
        if (!$fh = @fopen($filename, 'r', true)) {
            return false;
        }
        @fclose($fh);
        return true;
    }

   /**
    * Verify if the given temporary directory is readable and writable
    *
    * @param $dir temporary directory
    * @return boolean true if the directory is ok
    */
    public static function isGoodTmpDir($dir) {
        return is_readable($dir) && is_writable($dir);
    }
    
    public static function getExtension($filename) {
        $extPos = strrpos($filename, '.');
        return ($extPos === false)
            ? false
            : strtolower(substr($filename, $extPos + 1));
    }

    public static function getFileNameWithoutExtension($filename) {
        $extPos = strrpos($filename, '.');
        return ($extPos === false)
            ? $filename
            : substr($filename, 0, $extPos);
    }

    /**
     * Corta una ruta de inclusión en una matriz
     *
     * Si no se proporciona una ruta, usa include_path actual.
     * Resuelve los problemas que ocurren cuando la ruta incluye esquemas de transmisión.
     *
     * @param  string|null $path
     * @return array
     */
    public static function explodeIncludePath($path = null) {
        if(null === $path) {
            $path = get_include_path();
        }

        if (PATH_SEPARATOR == ':') { // En sistemas *nix, include_paths que incluyen rutas con un esquema de flujo no se pueden explotar de forma segura, por lo que tenemos que ser un poco más inteligentes en el enfoque.
            $paths = preg_split('#:(?!//)#', $path);
        } else {
            $paths = explode(PATH_SEPARATOR, $path);
        }
        return $paths;
    }


}
