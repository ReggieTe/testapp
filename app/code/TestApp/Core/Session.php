<?php 
namespace TestApp\Core;

class Session {

    public  function init() {
        @session_start();
    }
/**
 * 
 * @param string $key
 * @param string $value
 */
    public  function set($key, $value) {
        $_SESSION[$key] = $value;
    }
/**
 * 
 * @param string $key
 * @return string
 */
    public  function get($key) {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
    }
/**
 * 
 */
    public  function destroy() {
        //unset($_SESSION);
        session_destroy();
    }

}
