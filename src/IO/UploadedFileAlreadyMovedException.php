<?php
/**
  * Representa una excepción que es lanzada cuando se intenta subir un archivo.
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto <lib-system@marcospor.to>
  * @since      v0.4
  */

namespace System\IO;

use System\IO\IOException;
use System\Localization\Resources;

require_once 'System/IO/IOException.php';

/**
  * Excepción que es lanzada cuando se intenta subir un archivo.
  */
class UploadedFileAlreadyMovedException extends IOException {

    public function __construct(string $message = Resources::UPLOADED_FILE_ALREADY_MOVED_EXCEPTION_DEFAULT_MESSAGE) {
        parent::__construct($message);
    }

}
