<?php
$C = (object) array(
      'add_dir'            => dirname(__FILE__).'/../0.6'),
      'super_domain'       => preg_replace('/^www\./','',$_SERVER['HTTP_HOST']),
      'sub_domain'         => 'www',
      'path'               => preg_replace('/\/[^\/]*?$/','/',$_SERVER['REQUEST_URI']),
      'root_dir'           => realpath('./'),

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