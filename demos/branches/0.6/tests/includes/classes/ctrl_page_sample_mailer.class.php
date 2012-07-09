<?php
CLASS ctrl_page_sample_mailer EXTENDS ctrl_tpl_page {

   public function execute() {
      error_reporting(E_ALL);
      debug::var_dump(ini_set('sendmail_from', 'jezieltabora@247talk.net'));
      // Send
      $mail = mail('jezieltabora@247talk.net', 'My Subject', 'test body','From: jezieltabora@247talk.net');

      var_dump($mail);
      var_dump(`sendmail`);

      $mailer = new ctrl_mailer_test();

      $mailer->IsSendmail();

      $mailer->Send();

      if (function_exists('mail'))
         echo "Exist";
      else
         echo "Not Exist";
   }

}