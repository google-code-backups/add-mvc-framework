<?php

require '../config.php';
require_once "$C->add_dir/init.php";

$exception_classes = array('user','developer','system');

try {
   e_user::assert(is_int('a'));
}
catch (Exception $e) {
   $e->print_exception();
}