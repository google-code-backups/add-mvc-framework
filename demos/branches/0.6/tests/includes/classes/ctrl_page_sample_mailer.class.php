<?php
CLASS ctrl_page_sample_mailer EXTENDS ctrl_tpl_page {

   public function execute() {
   
      //$mailer = new ctrl_mailer_test();
      
      //$mailer->Send();
      
      // The message
      $message = "Line 1\nLine 2\nLine 3";

      // Send
      mail('jezieltabora@247talk.net', 'My Subject', $message);
      
      if (function_exists('mail'))
         echo "Exist";
      else 
         echo "Not Exist";
   }

}