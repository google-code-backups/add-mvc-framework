<?php
/**
 * ADD test
 *
 *
 */
$C = (object) array(
      'add_dir'            => '/xampp/htdocs/add/trunk',
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

require_once "$C->add_dir/init.php";

class add_test {

   public static function load_classes() {
      static::load_dir_classes(add::config()->add_dir.'/classes');
   }

   public static function load_dir_classes($dir) {
      $class_files = new DirectoryIterator($dir);
      foreach ($class_files as $class_file) {
         if ($class_file->isDot())
            continue;
         if ($class_file->isDir()) {
            static::load_dir_classes($class_file->getPathName());
            continue;
         }
         if (preg_match('/(\.class)?\.php$/',$class_file->getFileName())) {
            $class_name = $class_file->getBaseName('.class.php');
            if (!$class_name) {
               var_dump($class_file->getPathName());
               die();
            }
            if (add::load_class($class_name)) {
               static::println("$class_name successfully loaded");
            }
            #echo $class_name." | ".$class_file->getFileName()."<br />";
         }

      }
   }

   public static function println($line) {
      print("<br />$line<br />");
   }

}

add_test::load_classes();