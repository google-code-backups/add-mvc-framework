<?php

/**
 * Test exception on live
 *
 * @since ADD MVC Demo 0.8
 */
CLASS ctrl_page_live_exception EXTENDS ctrl_tpl_page {
   /**
    * Throw an exception
    *
    */
   public function process_data() {
      add::config()->environment_status("live");
      throw new e_developer();
   }
}