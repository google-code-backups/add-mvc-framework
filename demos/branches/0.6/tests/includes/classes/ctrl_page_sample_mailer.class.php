<?php
CLASS ctrl_page_sample_mailer EXTENDS ctrl_tpl_page {

   public function execute() {
   
      //$mailer = new ctrl_mailer_test();
      
      //$mailer->Send();
      
      $to      = 'jezieltabora@247talk.net';
      $subject = 'Sample Subject';
      $message = 'Sample Message';
      $headers = 'From: wjezieltabora@247talk.net' . "\r\n" .
          'Reply-To: jezieltabora@247talk.net' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);
      
      if (function_exists('mail'))
         echo "Exist";
      else 
         echo "Not Exist";
   }

}