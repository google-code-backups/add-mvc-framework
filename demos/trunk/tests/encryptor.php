<?php
/**
 * add_encryptor test
 * @see https://code.google.com/p/add-mvc-framework/issues/detail?id=111
 */
require 'add_configure.php';

CLASS my_encryptor EXTENDS add_encryptor {
   public $key = 'foo';
}

CLASS my_encryptor2 EXTENDS add_encryptor {
   public $key = 'baz';
}

$string = 'The way, the truth and the life';

debug::var_dump($string);

$encryptor = new my_encryptor($string);

$encrypted = $encryptor->encrypt();

debug::var_dump($encrypted);

$encryptor2 = new my_encryptor2($encrypted);

$encrypted2 = $encryptor2->encrypt();

debug::var_dump($encrypted2);

$encryptor3 = new my_encryptor($encrypted2,'lalala');

$encrypted3 = $encryptor3->encrypt();

debug::var_dump($encrypted3);

$encryptor4 = new my_encryptor2($encrypted3,'lololo');

$encrypted4 = $encryptor4->encrypt();

debug::var_dump($encrypted4);


$decryptor = my_encryptor2::from_encrypted($encrypted4,'lololo');

$decrypted = $decryptor->string;

debug::var_dump($decrypted);

$decryptor2 = my_encryptor::from_encrypted($decrypted,'lalala');

$decrypted2 = $decryptor2->string;

debug::var_dump($decrypted2);

$decryptor3 = my_encryptor2::from_encrypted($decrypted2);

$decrypted3 = $decryptor3->string;

debug::var_dump($decrypted3);

$decryptor4 = my_encryptor::from_encrypted($decrypted3);

$decrypted4 = $decryptor4->string;

debug::var_dump($decrypted4);



# Post construct setting of key
echo "<b>Post construct setting of key</b><br>";
$string = "No mind has imagined";

$encryptor5 = new my_encryptor("No Eyes Have Seen","No Ear Has Heard");

$encryptor5->key = "Nothing is impossible";

debug::var_dump($encryptor5->encrypt());

$decryptor5 = my_encryptor::from_encrypted($encryptor5->encrypt(),"Nothing is impossible");

debug::var_dump($decryptor5->string);


# Cross class
echo "<b>Cross Class</b><br>";
$string = "No mind has imagined";

$encryptor6 = new my_encryptor("No Eyes Have Seen","No Ear Has Heard");

$encryptor6->key = "Nothing is impossible";

debug::var_dump($encryptor6->encrypt());

$decryptor6 = my_encryptor2::from_encrypted($encryptor6->encrypt(),"Nothing is impossible",$encryptor6->cypher,$encryptor6->mode);

debug::var_dump($decryptor6->string);

# Custom Cypher
echo "<b>Custom Cypher</b><br />";
CLASS my_encryptor3 EXTENDS my_encryptor2 {
   public $key = 'DFGJHKLO:FGDSDFGHJKLJHGDFHJKL';
   public $cypher = MCRYPT_BLOWFISH;
}

$string = 'The mountains melt like wax';

$encryptor7 = new my_encryptor3($string);

$encryptor8 = new my_encryptor($string);

$encryptor9 = new my_encryptor2($string);

debug::var_dump(
      $encryptor7 -> encrypt(),
      $encryptor8 -> encrypt(),
      $encryptor9 -> encrypt()
   );


$decryptor7 = my_encryptor3::from_encrypted($encryptor7 -> encrypt());
$decryptor8 = my_encryptor::from_encrypted($encryptor8 -> encrypt());
$decryptor9 = my_encryptor2::from_encrypted($encryptor9 -> encrypt());

debug::var_dump(
      $decryptor7 -> string,
      $decryptor8 -> string,
      $decryptor9 -> string
   );


# Post Construct Custom Cypher
echo "<b>Post Construct Custom Cypher</b><br />";
CLASS my_encryptor4 EXTENDS my_encryptor2 {
   public $key = 'DFGJHKLO:FGDSDFGHJKLJHGDFHJKL';
   public $cypher = MCRYPT_BLOWFISH;
}

$string = 'The mountains melt like wax';

$encryptor10 = new my_encryptor4($string);
$encryptor10 -> key = 'barrr';
$encryptor10 -> cypher = MCRYPT_CAST_128;

$encryptor11 = new my_encryptor($string);
$encryptor11 -> cypher = MCRYPT_GOST;

$encryptor12 = new my_encryptor2($string);
$encryptor12 -> cypher = MCRYPT_LOKI97;

debug::var_dump(
      $encryptor10 -> encrypt(),
      $encryptor11 -> encrypt(),
      $encryptor12 -> encrypt()
   );


$decryptor10 = my_encryptor3::from_encrypted($encryptor10 -> encrypt(),'barrr',MCRYPT_CAST_128);
$decryptor11 = my_encryptor::from_encrypted($encryptor11 -> encrypt(),false,MCRYPT_GOST);
$decryptor12 = my_encryptor2::from_encrypted($encryptor12 -> encrypt(),false,MCRYPT_LOKI97);

debug::var_dump(
      $decryptor10 -> string,
      $decryptor11 -> string,
      $decryptor12 -> string
   );



echo "<hr><b>Fail Tests</b><br>";


$string = 'The way, the truth and the life';

debug::var_dump($string);

$encryptor = new my_encryptor($string);

$encrypted = $encryptor->encrypt();

debug::var_dump($encrypted);

$encryptor2 = new my_encryptor2($encrypted);

$encrypted2 = $encryptor2->encrypt();

debug::var_dump($encrypted2);

$encryptor3 = new my_encryptor($encrypted2,'lalala');

$encrypted3 = $encryptor3->encrypt();

debug::var_dump($encrypted3);

$encryptor4 = new my_encryptor2($encrypted3,'wrong key');

$encrypted4 = $encryptor4->encrypt();

debug::var_dump($encrypted4);


$decryptor = my_encryptor2::from_encrypted($encrypted4,'lololo');

$decrypted = $decryptor->string;

debug::var_dump($decrypted);

$decryptor2 = my_encryptor::from_encrypted($decrypted,'lalala');

$decrypted2 = $decryptor2->string;

debug::var_dump($decrypted2);

$decryptor3 = my_encryptor2::from_encrypted($decrypted2);

$decrypted3 = $decryptor3->string;

debug::var_dump($decrypted3);

$decryptor4 = my_encryptor::from_encrypted($decrypted3);

$decrypted4 = $decryptor4->string;

debug::var_dump($decrypted4);


# No key

$encryptor5 = new add_encryptor('of the Great Amen',null);
try {
   debug::var_dump($encryptor5->encrypt(),$encryptor5);
}
catch (Exception $e) {
   add::handle_exception($e);
}

# Invalid key

$encryptor6 = new add_encryptor('of the Great Amen',array());

try {
   debug::var_dump($encryptor6->encrypt(),$encryptor6);
}
catch (Exception $e) {
   add::handle_exception($e);
}



