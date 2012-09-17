<?php

/**
 * test fatal error
 *
 * @since ADD MVC Demo 0.8
 */
CLASS ctrl_page_test_fatal EXTENDS ctrl_tpl_aux {
   /**
    * Trigger fatal erro
    *
    */
   public function process_data() {
      # call an undefined function
      add::config()->environment_status = 'live';
      throw new e_system('test2',$_GET);
      erqesddjhfhjhyqyuwquiujklfgghhgadbnbnxjkhdsfhagaw();
   }
}