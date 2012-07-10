<?php
/**
 * ADD test
 *
 *
 */
require '../config.php';
require_once "$C->add_dir/init.php";
class add2 extends add {
   static function load_class($classname) {
      if (parent::load_class($classname)) {
         add_test::println("$classname successfully loaded");
      }
   }
}
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
            add2::load_class($class_name);
         }

      }
   }

   public static function println($line) {
      print("<br />$line<br />");
   }

}

add_test::load_classes();