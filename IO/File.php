<?php

class System_IO_File {

   /**
     * Escribe el contenido en un archivo
     *
     * @param  string $filename Nombre completo del archivo
     * @param  string $string Contenido a almacenar
     * @param  int $mode permisos del archivo 
     * @return mixed FALSE en caso de error, sino el numero de bytes escritos
     */
    public static function Write($filename, $string, $mode = 0600) {
        $result = false;
        $f = @fopen($filename, 'ab+');
        if ($f) {
            @flock($f, LOCK_EX);
            fseek($f, 0);
            ftruncate($f, 0);
            $result = @fwrite($f, $string);
            @flock($f, LOCK_UN);
            @fclose($f);
            @chmod($filename, $mode);
        }
        return $result;
    }

   /**
     * Devuelve el contenido de un archivo
     *
     * @param  string $filename Nombre completo del archivo
     * @return string Contenido del archivo (o FALSE en caso de error)
     */
    public static function Read($filename) {
        $result = false;
        if (!is_file($filename))
            return false;
        $f = @fopen($filename, 'rb');
        if ($f) {
            @flock($f, LOCK_SH);
            $result = stream_get_contents($f);
            @flock($f, LOCK_UN);
            @fclose($f);
        }
        return $result;
    }

}
