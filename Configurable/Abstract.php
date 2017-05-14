<?php
require_once 'Interface.php';

// Implementa las funcionalidades básicas de Kansas_Module_Interface y la carga de la configuración por defecto desde un archivo .ini
abstract class System_Configurable_Abstract 
  implements System_Configurable_Interface {
  
  /// Campos
  protected $options;
  private $_onOptionChangedCallbacks = [];

/**
  * Constructor
  *
  * @param array $options Array asociativos de opciones
  */
  public function __construct(array $options) {
    global $environment;
    $this->options = $this->getDefaultOptions($environment->getStatus());
    foreach($options as $key => $value)
      $this->setOption($key, $value);
  }
  
/**
  * Registra una función para que sea llamada cuando se produzca un cambio en la configuración
  *
  * @param callback $callback
  * @throws System_ArgumentOutOfRangeException
  * @return void
  */
  protected function registerOptionChange($callback) {
    if(is_callable($callback))
      $this->_onOptionChangedCallbacks[] = $callback;
    else {
      require_once 'System/ArgumentOutOfRangeException.php';
      throw new System_ArgumentOutOfRangeException('callback', 'Se esperaba un delegado', $callback);
    }
  }

  private function raiseOptionChanged($optionName) {
    foreach($this->_onOptionChangedCallbacks as $callback)
      call_user_func($callback, $optionName);
  }

  /**
    * Establece una opción de configuración
    *
    * @param  string $name
    * @param  mixed  $value
    * @throws System_ArgumentOutOfRangeException
    * @return void
    */
  public function setOption($name, $value) {
    if (!is_string($name)) {
      require_once 'System/ArgumentOutOfRangeException.php';
      throw new System_ArgumentOutOfRangeException('name', "Se esperaba una cadena", $name);
    }
    $name = strtolower($name);
    if (array_key_exists($name, $this->options) &&
      $this->options[$name] !== $value) {
        if(is_array($this->options[$name]) && is_array($value))
          $value = array_replace_recursive($this->options[$name], $value);
      $this->options[$name] = $value;
      $this->raiseOptionChanged($name);
    }
  }

  public function getOptions() {
    return $this->options;
  }
  
}