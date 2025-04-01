<?php declare(strict_types = 1);
/**
  * Implementación falsa de SyncReaderWriter
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.6
  */

namespace System\Fake;

/**
  * Clase con los metodos de SyncReaderWriter, pero sin implementación.
  * Para utilizar cuando el SyncReaderWriter, no está definido de forma nativa
  */
final class FakeSyncReaderWriter {

    /**
      * Debería obtener un bloqueo de lectura
      *
      * @param  integer $wait    Deberían ser el número de milisegundos de espera para obtener un bloqueo.
      *                          No se utiliza en esta implementación
      * @return boolean          false, ya que no realiza ningun bloqueo
      */
    #[SuppressWarnings("php:S1172")]
    public function readlock(int $wait = -1): bool {
        return false;
    }

    public function readunlock(): bool {
        return false;
    }

    #[SuppressWarnings("php:S1172")]
    public function writelock(int $wait = -1): bool {
        return false;
    }

    public function writeunlock(): bool {
        return false;
    }

}
