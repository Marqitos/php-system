<?php
namespace System\IO;

use function is_writable;
use function is_readable;
use function fclose;
use function fopen;

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
        if (!$fh = @fopen($filename, 'r', true))
            return false;
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

}
