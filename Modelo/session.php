<?php

class session
{

    public function __construct()
    {
        self::sessionExists() ? session_start() : FALSE;
    }

    public static function cargarDatosSession($sessiondata)
    {
        if (!self::sessionActiva()) return FALSE;
        if (!empty($sessiondata)) {
            foreach ($sessiondata as $tag => $data) {
                $_SESSION[(string)$tag] = $data;
            }
            return TRUE;
        }
        return FALSE;
    }

    public function obtenerDatosSession($clave)
    {
        if (!self::sessionActiva()) return FALSE;
        if (isset($_SESSION[(string) $clave])) return $_SESSION[(string) $clave];
        return FALSE;
    }

    public function cerrarSession(): bool
    {
        if (self::sessionActiva()) {
            unset($_SESSION);
            session_destroy();
            return TRUE;
        }
        return FALSE;
    }

    public static function sessionActiva(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    }

    public static function sessionExists(): bool
    {
        return session_status() === PHP_SESSION_NONE ? TRUE : FALSE;
    }
}
