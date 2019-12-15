<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();

class LibSSN
{

    public static function get($key) : bool
    {
        if (isset($_SESSION[$key]))
        {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    public static function set($key)
    {
        $_SESSION[$key] = true;
    }
}

?>