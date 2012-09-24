<?php

/**
 * aux controller
 *
 * @since ADD MVC Demo 0.8
 */
CLASS ctrl_page_text EXTENDS ctrl_tpl_aux {

   /**
    * Test echo
    *
    * @since ADD MVC 0.8
    */
   public function process_data() {
      echo "Hello World\r\n";
      echo "This is a test";
   }

   /**
    * Can run this script?
    *
    * @since since
    */
   public function can_run() {
      return true;#add::is_developer();
   }
}