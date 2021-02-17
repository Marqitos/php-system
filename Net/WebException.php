<?php

namespace System\Net;

use System\ArgumentOutOfRangeException;
use System\Collections\KeyNotFoundException;
use System\InvalidOperationException;
use System\Localization\Resources;

use function is_int;
use function intval;

require_once 'System/InvalidOperationException.php';

/**
 * Excepción que se produce cuando ocurre un error al acceder a la red mediante un protocolo acoplable.
 */
class WebException extends InvalidOperationException {
    
    private $status;
    
    public function __construct($status, $message = null) {
      $this->status = intval($status);
      if($message == null) {
        switch ($this->status) {
          case 403:
            $message = Resources::WebException403Message;
            break;
          case 404:
            $message = Resources::WebException404Message;
            break;
          default:
            $message = Resources::WebException500Message;
            break;
        }
      }
      parent::__construct($message);
    }
    
    public function getStatus() {
      return $this->status;
    }

    public static function getCodeMessage($code) {
      $intCode = is_int($code)
        ? $code
        : @intval($code);
      if($intCode == 0) {
        require_once 'System/ArgumentOutOfRangeException.php';
        throw new ArgumentOutOfRangeException('code', Resources::ArgumentOutOfRangeExceptionIntExpected);
      }
      $resource = 'WebException' . $intCode . 'Message';
      if(isset(Resources::$resource)) {
        return Resources::$resource;
      }
      
      require_once 'System/Collections/KeyNotFoundException.php';
      throw new KeyNotFoundException(sprintf(Resources::KeyNotFoundExceptionFormatedHttpCode, $code));
    }
    
  }