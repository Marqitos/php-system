<?php

namespace System\Net;

use System\InvalidOperationException;
use System\Localization\Resources;

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
    
  }