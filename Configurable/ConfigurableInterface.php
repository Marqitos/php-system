<?php

namespace System\Configurable;

/**
 * Representa un objeto con opciones de configuración, mediante clave-valor
 */
interface ConfigurableInterface {
    /**
     * Establece el valor de un parametro
     * @param string $key Clave de configuración
     * @param mixed $value Valor de configuración
     * @return void
     */
    public function setOption($key, $value) : void;
    /**
     * Obtiene toda la configuración
     * @return array Datos de configuración actuales
     */
    public function getOptions() : array;
}