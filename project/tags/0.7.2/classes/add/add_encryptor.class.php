<?php

/**
 * add_encryptor
 *
 * @author albertdiones@gmail.com
 *
 * @since ADD MVC 0.6
 * @version 0.1
 */
CLASS add_encryptor {


   /**
    * Default encryption cypher
    *
    * @since ADD MVC 0.6
    */
   const DEFAULT_CYPHER = MCRYPT_RIJNDAEL_256;


   /**
    * Default encryption mode
    *
    * @since ADD MVC 0.6
    */
   const DEFAULT_MODE = MCRYPT_MODE_ECB;

   /**
    * The string to encrypt
    *
    * @since ADD MVC 0.6
    */
   public $string;

   /**
    * The key to use on encryption
    *
    * @since ADD MVC 0.6
    */
   public $key;

   /**
    * cypher to use on encryption
    *
    * @since ADD MVC 0.6
    */
   public $cypher = self::DEFAULT_CYPHER;

   public $mode = self::DEFAULT_MODE;


   /**
    * construct
    *
    * @param string $string the string to encrypt
    * @param string $key the string to use as key
    * @since ADD MVC 0.6
    */
   public function __construct($string, $key=false ) {
      $this->string = $string;

      if ($key === false)
         $this->key = static::generate_key(30);

   }

   /**
    * encrypt $this->string
    *
    * @since ADD MVC 0.6
    */
   public function encrypt() {
      return static::string_encrypt($this->string,$this->key,$this->cypher,$this->mode);
   }

   /**
    * decrypt the string and create a new instance
    *
    * @since ADD MVC 0.6
    */
   public static function from_encrypted($encrypted_string, $key, $cypher = false, $mode = false) {

      if ($cypher === false) {
         $cypher = static::DEFAULT_CYPHER;
      }
      if ($mode === false) {
         $mode = static::DEFAULT_MODE;
      }

      $decrypted_string = static::string_decrypt($encrypted_string, $key, $cypher, $mode);

      $instance = new static($decrypted_string, $key);
      $instance -> cypher = $cypher;
      $instance -> mode   = $mode;

      return $instance;

   }

   /**
    * Encrypt $string
    *
    * @param string $string string to encrypt
    * @param string $key key to use on encryption
    * @param int $cypher cypher to use
    * @param int $mode mode to use
    *
    * @since ADD MVC 0.6
    */
   public static function string_encrypt($string, $key, $cypher = false, $mode = false) {

      if ($cypher === false) {
         $cypher = static::DEFAULT_CYPHER;
      }

      if ($mode === false) {
         $mode = static::DEFAULT_MODE;
      }

      $iv = mcrypt_create_iv(
            mcrypt_get_iv_size($cypher, $mode),
            MCRYPT_RAND
         );

      $encrypted = mcrypt_encrypt(
            $cypher,
            $key,
            $string,
            $mode,
            $iv
         );

      return base64_encode($encrypted);
   }

   /**
    * Decrypt $string
    *
    * @param string $string encrypted string
    * @param string $key key to used on encryption
    * @param int $cypher cypher used
    * @param int $mode mode used
    *
    * @since ADD MVC 0.6
    */
   public static function string_decrypt($string, $key, $cypher = false, $mode = false) {

      if ($cypher === false) {
         $cypher = static::DEFAULT_CYPHER;
      }

      if ($mode === false) {
         $mode = static::DEFAULT_MODE;
      }

      $iv = mcrypt_create_iv(
            mcrypt_get_iv_size($cypher, $mode),
            MCRYPT_RAND
         );

      $decrypted = mcrypt_decrypt(
            $cypher,
            $key,
            base64_decode($string),
            static::DEFAULT_MODE,
            $iv
         );

      return trim($decrypted);
   }

   /**
    * Key generator
    *
    * @param int $length an integer to determine the length of key to be generated
    *
    * @since ADD MVC 0.6
    *
    * @author Bryan Requinala <brian.requinala@247talk.net>
    */

   public static function generate_key($length = 30) {
      $key = "";
      
      $key_content = "abcdefghijklamnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+~";

      for ($x=1; $x<=$length; $x++) {
         $random_character = $key_content{array_rand(str_split($key_content))};
         $key .= $random_character;
      }

      return $key;
   }

}