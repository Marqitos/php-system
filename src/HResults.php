<?php declare(strict_types = 1);
/**
  * Listado de codigos de error, basado en la API de Win32
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto
  * @since      v0.1
  */

namespace System;

class HResults {
    // Errores generales
    public const S_OK                       = 0x00000000; // Operación exitosa
    public const S_FALSE                    = 0x00000001; // Operación exitosa sin resultados significativos
    public const E_FAIL                     = 0x80004005; // Error no especificado
    public const E_ACCESSDENIED             = 0x80070005; // Acceso denegado
    public const E_OUTOFMEMORY              = 0x8007000E; // Memoria insuficiente
    public const E_INVALIDARG               = 0x80070057; // Argumento inválido
    public const E_POINTER                  = 0x80004003; // Puntero nulo
    public const E_NOTIMPL                  = 0x80004001; // Método no implementado

    // Errores relacionados con archivos y directorios
    public const COR_E_FILENOTFOUND         = 0x80070002; // Archivo no encontrado
    public const COR_E_DIRECTORYNOTFOUND    = 0x80070003; // Directorio no encontrado
    public const COR_E_PATHTOOLONG          = 0x800700CE; // Ruta demasiado larga

    // Errores de operaciones E/S
    public const COR_E_IO                   = 0x80131620; // Error de entrada/salida
    public const COR_E_FILELOAD             = 0x80131621; // Error al cargar archivo
    public const COR_E_ENDOFSTREAM          = 0x80070026; // Final inesperado del flujo

    // Errores relacionados con argumentos
    public const COR_E_ARGUMENT             = 0x80070057; // Argumento inválido
    public const COR_E_ARGUMENTOUTOFRANGE   = 0x80131502; // Argumento fuera del rango permitido
    public const COR_E_INVALIDOPERATION     = 0x80131509; // Operación inválida
    public const COR_E_NOTSUPPORTED         = 0x80131515; // Operación no soportada

    // Errores específicos de DLLs
    public const COR_E_DLLNOTFOUND          = 0x80131577; // DLL no encontrada

    // Errores adicionales
    public const E_ABORT                    = 0x80004004; // Operación abortada
    public const E_UNEXPECTED               = 0x8000FFFF; // Error inesperado
    public const E_HANDLE                   = 0x80070006; // Descriptor no válido
    public const E_NOINTERFACE              = 0x80004002; // No se admite la interfaz solicitada
    public const E_NOTSET                   = 0x80070490; // Valor no establecido
}
