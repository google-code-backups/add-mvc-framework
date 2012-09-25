<?php

CLASS ctrl_page_test_ajax EXTENDS ctrl_tpl_ajax {

   public function process_data( $common_gpc ) {
      $query = 'testing testing lang';
      $testing = array('testing' => 'arena', 'tester' => 'tesst');
      $this->assign('query', $query);
      $this->assign($testing);
   }


}