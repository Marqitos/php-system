<?php

namespace System\Configurable;

// Representa un objeto con opciones de configuración
interface ConfigurableInterface {
    // Establece el valor de un parametro
    public function setOption($key, $value);
    // Obtiene toda la configuración
    public function getOptions();
    // Obtiene la configuración por defecto para un entorno especifico
    public function getDefaultOptions($environment);
}