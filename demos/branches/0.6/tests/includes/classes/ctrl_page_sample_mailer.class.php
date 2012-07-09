<?php
CLASS ctrl_page_sample_mailer EXTENDS ctrl_tpl_page {

   public function execute() {

      // Send
      $mail = mail('jezieltabora@247talk.net', 'My Subject', 'test body','From: jezieltabora@247talk.net');

      var_dump($mail);

      $mailer = new ctrl_mailer_test();

      $mailer->Send();

      if (function_exists('mail'))
         echo "Exist";
      else
         echo "Not Exist";
   }

}