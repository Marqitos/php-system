<?php

class System_Net_WebException
  extends System_InvalidOperationException {
    
    private $_status;
    
    public function __construct($status, $message = null) {
      $this->_status = intval($status);
      if($message == null) {
        switch ($this->_status) {
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
      return $this->_status;
    }
    
  }