<?php declare(strict_types = 1);
/**
 * Representa una excepción que es lanzada cuando se intenta subir un archivo.
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.4
 */

namespace System\IO;

use System\IO\IOException;
use System\Localization\Resources;
use function sprintf;
use const UPLOAD_ERR_CANT_WRITE;

require_once 'System/IO/IOException.php';

/*
 * Excepción que es lanzada cuando se intenta subir un archivo.
 */
class FileUploadException extends IOException {

    public function __construct(int $uploadError, $message = null) {
        if($message === null) {
            require_once 'System/Localization/Resources.php';
            $message = Resources::UPLOAD_ERROR_MESSAGES[$uploadError];
        }
        parent::__construct($message, $uploadError);
    }

    public static function dueToUnwritableTarget($targetDirectory) {
        $message = sprintf(Resources::UPLOAD_ERROR_CANT_WRITE_TARGET_DIRECTORY_FORMAT, $targetDirectory);
        return new FileUploadException(UPLOAD_ERR_CANT_WRITE, $message);
    }

    public static function dueToUnwritablePath() {
        return new FileUploadException(UPLOAD_ERR_CANT_WRITE, Resources::UPLOAD_ERROR_CANT_WRITE_TARGET_PATH);
    }

    public static function forUnmovableFile() {
        return new FileUploadException(UPLOAD_ERR_CANT_WRITE, Resources::UPLOAD_ERR_CANT_MOVE_FILE);
    }

}
