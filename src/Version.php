<?php declare(strict_types = 1);
/**
 * Numero de versión
 *
 * Description. Identifica una versión
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */
namespace System;

use function explode;
use function intval;
use function is_string;

/**
 * Identifica una versión de una librería
 */
class Version {
    
    private $major;
    private $minor;
    private $build;
    private $revision;
    
    public function __construct($major, $minor = 0, $build = 0, $revision = 0) {
        if (is_string($major)) {
            $values = explode('.', $major, 4);
            $this->major    = intval($values[0]);
            if (isset($values[1])) {
                $minor      = intval($values[1]);
            }
            if (isset($values[2])) {
                $build      = intval($values[2]);
            }
            if (isset($values[3])) {
                $revision   = intval($values[3]);
            }
        } else {
            $this->major    = intval($major);
        }

        $this->minor        = intval($minor);
        $this->build        = intval($build);
        $this->revision     = intval($revision);
    }
        
    public function getMajor() {
        return $this->major;
    }
    
    public function getMinor() {
        return $this->minor;
    }
    
    public function getBuild() {
        return $this->build;
    }
    
    public function getRevision() {
        return $this->revision;
    }
    
    public function __toString() {
        return ($this->build != 0 && $this->revision != 0)
            ? $this->major . '.' . $this->minor . '.' . $this->build . '.' . $this->revision
            : $this->major . '.' . $this->minor;
    }
    
}
