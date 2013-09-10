<?php
/**
 * 404 page
 */
CLASS ctrl_page_404 EXTENDS ctrl_tpl_page {

   /**
    * Override execute - no view
    *
    * @since ADD MVC 0.0
    */
   public function execute() {
      echo "<h1 style='text-align:center'>Not Found</h1>";
   }

}