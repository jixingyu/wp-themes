<?php
if (!session_id()) session_start();
class Xysession
{
    public static function set($name, $data, $expire = 7200) {
        $_SESSION[$name] = array(
            'expire' => time() + $expire,
            'data' => $data,
        );
    }

    public static function get($name) {
        if (isset($_SESSION[$name]) && isset($_SESSION[$name]['expire'])) {
            $data = $_SESSION[$name];
            if ($data['expire'] > time() && isset($data['data'])) {
                return $data['data'];
            }
        }
        return false;
    }

    public static function clear($name){
        unset($_SESSION[$name]);
    }
}
