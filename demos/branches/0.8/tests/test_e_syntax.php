<?php

require '../config.php';
require_once "$C->add_dir/init.php";

if (!ini_get('safe_mode'))
   add::php_check_syntax(realpath('test_e_syntax2.php'));
else
   echo "Safemode is on";

var_dump(`whoami`);

var_dump(ini_get('safe_mode'),exec('php -l '.realpath('test_e_syntax.php')));
?>
Syntax checked