<?php
/**
 * Listado de codigos de error
 *
 * Description. Constantes con números de error
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */

namespace System;

class HResults {
    public const E_NOTIMPL                  = 0x80004001;
    public const E_POINTER                  = 0x80004003;
	public const COR_E_FILENOTFOUND         = 0x80070002;
	public const COR_E_DIRECTORYNOTFOUND    = 0x80070003;
	public const COR_E_ENDOFSTREAM          = 0x80070026;
    public const COR_E_ARGUMENT             = 0x80070057;
    public const COR_E_PATHTOOLONG          = 0x800700CE;
    public const COR_E_ARGUMENTOUTOFRANGE   = 0x80131502;
    public const COR_E_INVALIDOPERATION     = 0x80131509;
    public const COR_E_NOTSUPPORTED         = 0x80131515;
    public const COR_E_DLLNOTFOUND          = 0x80131577;
    public const COR_E_IO                   = 0x80131620;
	public const COR_E_FILELOAD             = 0x80131621;

}