<?php
/**
 * ADD test
 *
 *
 */
require '../config.php';
require_once "$C->add_dir/init.php";

$required_functions = array ('mail');


foreach ($required_functions as $required_function) {
   if (function_exists($required_function)) {
      echo "$required_function() exists<br />";
   }
   else {
      echo "$required_function() does not exist<br />";
   }
}