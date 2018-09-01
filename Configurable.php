<?php

namespace System;

use System\Configurable\ConfigurableInterface;
use System\ArgumentOutOfRangeException;

use function array_key_exists;
use function array_replace_recursive;
use function call_user_func;
use function is_array;
use function is_callable;
use function is_string;

require_once 'System/Configurable/ConfigurableInterface.php';

// Implementa las funcionalidades básicas un objeto que se puede configurar al inicializar
abstract class Configurable implements ConfigurableInterface {

	/// Campos
	protected $options;
	private $callbacks = [
		'onChanging' => [],
		'onChanged'	 => []  
	];
	private $onOptionChangedCallbacks = [];

	/**
	* Constructor
	*
	* @param array $options Array asociativo de opciones
	*/
	public function __construct(array $options) {
		global $environment;
		$this->options = $this->getDefaultOptions($environment->getStatus());
		foreach($options as $key => $value)
			$this->setOption($key, $value);
	}

	/**
	* Registra una función para que sea llamada cuando se vaya a producir un cambio en la configuración
	*
	* @param callback $callback
	* @throws System\ArgumentOutOfRangeException
	* @return void
	*/
	protected function registerOptionChanging($callback) {
		if(is_callable($callback))
			$this->callbacks['onChanging'][] = $callback;
		else {
			require_once 'System/ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('callback', 'Se esperaba un delegado', $callback);
		}
	}

	/**
	* Registra una función para que sea llamada cuando se produzca un cambio en la configuración
	*
	* @param callback $callback
	* @throws System\ArgumentOutOfRangeException
	* @return void
	*/
	protected function registerOptionChanged($callback) {
		if(is_callable($callback))
			$this->callbacks['onChanged'][] = $callback;
		else {
			require_once 'System/ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('callback', 'Se esperaba un delegado', $callback);
		}
	}

	private function raiseOptionChanged($optionName) {
		foreach($this->callbacks['onChanged'] as $callback)
			call_user_func($callback, $optionName);
	}

	private function raiseOptionChanging($optionName, $value) {
		$result = true;
		foreach($this->callbacks['onChanging'] as $callback) {
			$result = call_user_func($callback, $optionName, $value);
			if($result != true)
				break;
		}
		return $result;
	}

	/**
	* Establece una opción de configuración
	*
	* @param  string $name
	* @param  mixed  $value
	* @throws System\ArgumentOutOfRangeException
	* @return void
	*/
	public function setOption($name, $value) {
		if (!is_string($name)) {
			require_once 'System/ArgumentOutOfRangeException.php';
			throw new ArgumentOutOfRangeException('name', "Se esperaba una cadena", $name);
		}
		$name = strtolower($name);
		if (array_key_exists($name, $this->options) &&
			$this->options[$name] !== $value &&
			$this->raiseOptionChanging($name, $value)) {
			
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