<?php
CLASS ctrl_page_sample_mailer EXTENDS ctrl_tpl_page {

   public function process_data() {

      $mailer = new ctrl_mailer_test();

      $mailer->execute();
      
   }

}