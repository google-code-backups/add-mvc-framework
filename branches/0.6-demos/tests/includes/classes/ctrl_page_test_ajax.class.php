<?php

CLASS ctrl_page_test_ajax EXTENDS ctrl_tpl_ajax {

   public function execute() {
      $query = 'testing testing lang'
      $testing = array('testing' => 'arena', 'tester' => 'tesst');
      $this->assign('query', $query);
      $this->assign($testing);
   }
}