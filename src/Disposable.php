<?php declare(strict_types = 1);
/**
  * Al implementarse, el objeto debe liberar los recursos en el metodo dispose
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.5
  */

namespace System;

use System\DisposableInterface;

require_once 'System/DisposableInterface.php';

/**
 * Implementación del patrón Disposable
 */
abstract class Disposable implements DisposableInterface {

    public function __destruct() {
        $this->dispose();
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function dispose() : void {
        $this->disposing(true);
    }

    abstract protected function disposing(bool $disposing);

}
