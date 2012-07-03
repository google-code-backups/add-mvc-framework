<?php

/**
 * add_encryptor
 *
 * @since ADD MVC 0.6
 */
CLASS add_encryptor {

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

   public function __construct($string,$key=false) {
      $this->string = $string;

      if ($key === false)
         $this->key = static::generate_key(30);

   }

   public encrypt() {
      return static::string_encrypt($this->string,$this->key);
   }


   public static function string_encrypt($string,$key) {

      $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(static::DEFAULT_CYPHER, static::DEFAULT_MODE),
            MCRYPT_RAND
         );

      $encrypted = mcrypt_encrypt(
            static::DEFAULT_CYPHER,
            $key,
            $string,
            static::DEFAULT_MODE, $iv
         );

      return base64_encode($encrypted);
   }

   public static function string_decrypt($string,$key) {
      $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(static::DEFAULT_CYPHER, static::DEFAULT_MODE),
            MCRYPT_RAND
         );

      $decrypted = mcrypt_decrypt(
            static::DEFAULT_CYPHER,
            $key,
            base64_decode($string),
            static::DEFAULT_MODE,
            $iv
         );

      return $decrypted;
   }

   public static function generate_key($length = 30) {
      return 'dwfekiloiytrewqe34567890';
   }

}