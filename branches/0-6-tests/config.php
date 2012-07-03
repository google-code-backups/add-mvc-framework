<?php
$C = (object) array(
      'add_dir'            => realpath('../0.6/'),
      'super_domain'       => $_SERVER['HTTP_HOST'],
      'sub_domain'         => 'www',
      'path'               => '/add/',
      'root_dir'           => realpath(dirname(__FILE__)),

      /**
       * Library init files
       * @author albertdiones@gmail.com
       */
      'libs'            => (object) array(
            'adodb'     => 'adodb/adodb.inc.php',
            'smarty'    => 'smarty/Smarty.class.php',
            'phpmailer' => 'phpmailer/class.phpmailer.php',
         ),
   );