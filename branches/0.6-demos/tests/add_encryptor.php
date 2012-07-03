<?php

require '../config.php';
require_once "$C->add_dir/init.php";

$string = 'Bryan Requinala';

$key = add_encryptor::generate_key();

$encrypted_string = add_encryptor::string_encrypt($string,$key);
$decrypted_string = add_encryptor::string_decrypt($encrypted_string,$key);

debug::var_dump($encrypted_string);
debug::var_dump($decrypted_string);


$encrypted_string = add_encryptor::string_encrypt($string,$key);
$decrypted_string = add_encryptor::string_decrypt($encrypted_string, 'asdasdasd');

debug::var_dump($encrypted_string);
debug::var_dump($decrypted_string);

?>