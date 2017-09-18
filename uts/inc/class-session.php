<?php
if (!session_id()) session_start();
class Xysession
{
    public static $expire = null;

    public static function referesh(){
        if (self::$expire > time() || self::$expire === null) {
            self::$expire = time() + 7200;
        }
    }

    public static function set($name, $data) {
        $_SESSION[$name] = $data;
    }

    public static function get($name) {
        if (self::$expire > time() && isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return false;
    }

    private static function clear($name){
        unset($_SESSION[$name]);
    }
}
Xysession::referesh();
