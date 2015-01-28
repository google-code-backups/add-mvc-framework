<?php
/**
 * Created by PhpStorm.
 * @author albert
 * Date: 1/29/15
 * Time: 1:10 AM
 */
require 'add_configure.php';


CLASS my_db EXTENDS add_adodb_mysql {
   public function Connect() {
      $this->adodb->Connect('localhost','root','wrongPassword');
      return $this;
   }
}

my_db::singleton();