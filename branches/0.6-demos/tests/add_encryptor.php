<?php

require 'config.php';
require_once "$C->add_dir/init.php";

$string = 'bryan requinala';
$key = add_encryptor::generate_key();
$encrypted_string = add_encryptor::string_encrypt($string,$key);
$decrypted_string = add_encryptor::string_decrypt($string,$key);

debug::var_dump($encrypted_string, $decrypted_string);



?>