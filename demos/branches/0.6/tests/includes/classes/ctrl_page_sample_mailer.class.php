<?php
CLASS ctrl_page_sample EXTENDS ctrl_tpl_page {

   public function execute() {
   
      $mailer = new ctrl_mailer_test();
      
      $mailer->Send();
      
      if (function_exists('mail')) {
         echo "Exist";
      } else {
         echo "Not Exist";
      }
   }

}