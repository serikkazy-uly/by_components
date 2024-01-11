<?php

class Session
{
    // public static function start()
    // {
    //     if (session_status() == PHP_SESSION_NONE) {
    //         session_start();
    //     }
    // }


    public static function put($name, $value) // запись сессии
    {
        // self::start();
        // $_SESSION[$name] = $value;

        return $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        // self::start();
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public static function exists($name) // проверка на сущ-ие знач
    {
        // self::start();
        return isset($_SESSION[$name]);
    }

    public static function delete($name)
    {
        // self::start();
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    // public static function destroy()
    // {
    //     self::start();
    //     session_destroy();
    // }
}
