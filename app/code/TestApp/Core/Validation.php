<?php
namespace TestApp\Core;

class Validation {

    /**
     * 
     * @param string $name
     * @return boolean
     */
    public static function name($name = null) {
        // check if name only contains letters and whitespace
        return !preg_match("/^[a-zA-Z ]*$/", $name) ? FALSE : TRUE;
    }

    /**
     * 
     * @param string $phone
     * @return boolean
     */
    public static function phone($phone = null,$pattern="/^[+][0-9]*$/") {
        //CHECK if phone only contains numbers 
        return preg_match($pattern,$phone) ? true : false;
    }

    /**
     * 
     * @param string $email
     * @return boolean
     */
    public static function email($email = null) {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email) ? true : false;
    }

    public function website($website = null) {
        // check if URL address syntax is valid
        !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website) ? TRUE : FALSE;
    }

    /**
     * 
     * @param string $password
     * @return boolean
     */
    public static function password($password = null) {
        return preg_match("/^[A-Za-z0-9!@#$%^&*()_ ]*$/", $password) ? true : false;
    }
    public static function date($date = null) {
        return preg_match("/^[0-9\/\-]*$/", $date) ? true : false;
    }

    /**
     * 
     * @param string $word
     * @return boolean
     */
    public function validate($word = null, $pattern = "/^[a-zA-Z0-9 ]*$/") {
        return preg_match($pattern, $word) ? true : false;
    }

    public function permission($currentPage="",$permissionPageList=array())
    {
        return in_array($currentPage,$permissionPageList)? true:false;
    }

    public function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
 

}
