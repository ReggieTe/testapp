<?php
namespace TestApp\Core;

class Secure {  
    
    /**
     * Returns an encrypted & utf8-encoded
     */
    public static function encrypt($pure_string, $encryption_key="1234344") {       
        return openssl_encrypt(json_encode($pure_string),"AES-128-ECB",$encryption_key);
    }
    
    /**
     * Returns decrypted original string
     */
    public static  function decrypt($encrypted_string, $encryption_key="1234344") {
        
        return openssl_decrypt($encrypted_string,"AES-128-ECB",$encryption_key);;
    }
}