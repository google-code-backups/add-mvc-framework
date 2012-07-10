<?php

/**
 * Test add_encryptor reversible encryption class
 *
 * @since ADD MVC 0.6
 */
CLASS ctrl_page_reversible_encryption EXTENDS ctrl_tpl_page {

   public function execute() {
      $string = 'Foo Bar Baz';

      echo "Unencrypted String: $string<br />";

      $key = add_encryptor::generate_key();

      echo "Correct Key: $key<br />";

      $encrypted_string = add_encryptor::string_encrypt($string,$key);

      echo "Encrypted String: $encrypted_string <br />";

      $decrypted_string = add_encryptor::string_decrypt($encrypted_string,$key);

      echo "Decrypted String: $decrypted_string <br />";

      $decrypted_string = add_encryptor::string_decrypt($encrypted_string, '$E%^&*(f125');

      echo "Result of decryption with wrong key: $decrypted_string";
   }
}
?>