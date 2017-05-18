<?php

interface System_Configurable_Interface {
    public function setOption($name, $value);
    public function getOptions();
    public function getDefaultOptions($environment);
}