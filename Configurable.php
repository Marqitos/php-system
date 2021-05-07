<?php declare(strict_types = 1 );
/**
 * Implementa un objeto con opciones de configuración
 *
 * @package System
 * @author Marcos Porto
 * @copyright 2021, Marcos Porto
 * @since v0.4
 */

namespace System;

use System\Collections\KeyNotFoundException;
use System\Configurable\ConfigurableInterface;
use System\Localization\Resources;

use function array_key_exists;
use function array_replace_recursive;
use function call_user_func;
use function is_array;
use function strtolower;

require_once 'System/Configurable/ConfigurableInterface.php';

/**
 * Implementa las funcionalidades básicas un objeto que se puede configurar al inicializar
 */
abstract class Configurable implements ConfigurableInterface {

	protected const EVENT_CHANGING 	= 'onChanging';
	protected const EVENT_CHANGED	= 'onChanged';
	/// Campos
	protected $options;
	private $callbacks = [
		self::EVENT_CHANGING => [],
		self::EVENT_CHANGED	 => []  
	];

	/**
	* Constructor
	*
	* @param array $options Array asociativo de opciones
	*/
	public function __construct(array $options) {
		global $environment;
		$this->options = $this->getDefaultOptions($environment->getStatus());
		foreach($options as $key => $value) {
			$this->setOption($key, $value);
		}
	}

	/**
	* Registra una función para que sea llamada cuando se produzca el evento indicado
	*
	* @param string $eventName Nombre predefinido del evento
	* @param callback $callback Función que se ejecutará
	* @throws KeyNotFoundException Si el nombre del evento no es válido
	* @return void
	*/
	protected function registerEvent(string $eventName, callable $callback) : void {
		if(!array_key_exists($eventName, $this->callbacks)) {
			require_once 'System/Collections/KeyNotFoundException.php';
			throw new KeyNotFoundException(sprintf(Resources::KEY_NOT_FOUND_EXCEPTION_NO_EVENT_FORMAT, $eventName));
		}
		$this->callbacks[$eventName][] = $callback;
	}

	private function raiseOptionChanged($optionName) : void {
		foreach($this->callbacks[self::EVENT_CHANGED] as $callback) {
			call_user_func($callback, $optionName);
		}
	}

	private function raiseOptionChanging($optionName, $value) : bool {
		$result = true;
		foreach($this->callbacks[self::EVENT_CHANGING] as $callback) {
			$result = call_user_func($callback, $optionName, $value);
			if(!$result) {
				break;
			}
		}
		return $result;
	}

	// Miembros de System\Configurable\ConfigurableInterface

	/**
	* Establece una opción de configuración,
	* solo se pueden establecer claves de configuración ya existentes
	*
	* @param  string $name
	* @param  mixed  $value
	* @return void
	*/
	public function setOption(string $name, $value) : void {
		$name = strtolower($name);
		if (array_key_exists($name, $this->options) &&
			$this->options[$name] !== $value &&
			$this->raiseOptionChanging($name, $value)) {
			
			if(is_array($this->options[$name]) && is_array($value)) {
				$value = array_replace_recursive($this->options[$name], $value);
			}
			$this->options[$name] = $value;
			$this->raiseOptionChanged($name);
		}
	}

    /**
     * Obtiene toda la configuración
     * @return array Datos de configuración actuales
     */
	public function getOptions() : array {
		return $this->options;
	}

	/**
     * Obtiene la configuración por defecto para un entorno especifico
	 * 
     * @param string $environment Entorno de trabajo
     * @return array Datos de configuración por defecto
     */
    abstract public function getDefaultOptions($environment) : array;


}