<?php

/**
 * Test add_encryptor reversible encryption class
 *
 * @since
 */
CLASS ctrl_page_reversible_encryption EXTENDS ctrl_tpl_page {

   public function execute() {
      $string = 'Bryan Requinala';

      $key = add_encryptor::generate_key();

      echo "Unencrypted String: $string<br />";

      $encrypted_string = add_encryptor::string_encrypt($string,$key);

      echo "Encrypted String: $encrypted_string <br />";

      $decrypted_string = add_encryptor::string_decrypt($encrypted_string,$key);

      echo "Decrypted String: $decrypted_string <br />";

      $decrypted_string = add_encryptor::string_decrypt($encrypted_string, '$E%^&*(f125');

      echo "Result of decryption with wrong key: $decrypted_string";
   }
}
?>