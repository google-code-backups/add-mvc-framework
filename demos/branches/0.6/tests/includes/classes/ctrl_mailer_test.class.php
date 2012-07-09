<?php

/**
 * ctrl_page_test
 *
 */
CLASS ctrl_mailer_test EXTENDS ctrl_tpl_mailer {

   public $From              = 'jezieltabora@247talk.net';

   public $FromName          = 'Testing';

  public $Subject           = 'Mailer Test';

  public function __construct() {
     parent::__construct();
     $this->AddAddress('jezieltabora@247talk.net');
     $this->Subject = "Test Only! This is the subject";
  }

}