<?php

namespace System\Net;

use System\InvalidOperationException;

require_once 'System/InvalidOperationException.php';

class WebException extends InvalidOperationException {
    
    private $status;
    
    public function __construct($status, $message = null) {
      $this->status = intval($status);
      if($message == null) {
        switch ($this->status) {
          case 403:
            $message = 'Acceso prohibido';
            break;
          case 404:
            $message = 'El documento no ha sido encontrado';
            break;
          case 500:
            $message = 'Error interno de la aplicación';
            break;
        }
      }
      parent::__construct($message);
    }
    
    public function getStatus() {
      return $this->status;
    }
    
  }