<?php
    class Encryptor extends CI_Controller{
        /**
        }
         * Returns an encrypted & utf8-encoded
         */
        function encrypt($pure_string,$encryption_key) {
            $encrypted_string=$pure_string.$encryption_key;
            return $encrypted_string;
        }

        /**
         * Returns decrypted original string
         */
        function encryptPwrd($string){
            return $this->encrypt($string,"ssdfbhsdbfsd");
        }
        
        
}
?>
