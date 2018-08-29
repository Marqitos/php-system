<?php

namespace System\IO\File;

class FileSystem extends File {

       /**
     * Devuelve el contenido de un archivo
     *
     * @param  string $filename Nombre completo del archivo
     * @return string Contenido del archivo (o FALSE en caso de error)
     */
    public function Read($mode = 'rb') {
        $result = false;
        if (!is_file($this->filename))
            return false;
        $abort = ignore_user_abort();
        ignore_user_abort(true);
        try {
            $f = @fopen($this->filename, $mode);
            if ($f) {
                @flock($f, LOCK_SH);
                $result = stream_get_contents($f);
                @flock($f, LOCK_UN);
                @fclose($f);
            }
        } finally {
            ignore_user_abort($abort);
        }
    return $result;
    }

     /**
     * Escribe el contenido en un archivo
     *
     * @param  string $string Contenido a almacenar
     * @param  int $mode permisos del archivo 
     * @return mixed FALSE en caso de error, sino el numero de bytes escritos
     */
    public function Write($string, $mode = 'ab+', $perm = 0600) {
        $result = false;
        $abort = ignore_user_abort();
        ignore_user_abort(TRUE);
        try {
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
        } finally {
            ignore_user_abort($abort);
        }
        return $result;
    }

}