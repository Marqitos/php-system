<?php declare(strict_types = 1);
/**
 * Al implementarse, el objeto debe liberar los recursos en el metodo dispose
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.5
 */

namespace System;

use System\DisposableInterface;

require_once 'System/DisposableInterface.php';

/**
 * Implementación del patrón IDisposable
 */
abstract class Disposable implements DisposableInterface {

    function __destruct() {
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

    protected abstract function disposing(bool $disposing);

}
