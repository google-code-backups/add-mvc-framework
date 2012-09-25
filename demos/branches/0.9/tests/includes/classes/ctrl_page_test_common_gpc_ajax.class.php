<?php

/**
 * testing for ajax common_gpc
 * Query for testing "test_common_gpc_ajax?mode=testing&testing=test&query=testing_query&name=test%20name&age=test%20age"
 * @since add_mvc 0.9
 */
CLASS ctrl_page_test_common_gpc_ajax EXTENDS ctrl_tpl_ajax {

   protected $common_gpc = array (
      '_REQUEST' => array (
            'testing','query'
      ),
   );

   protected $mode_gpc_testing = array (
         '_REQUEST' => array ('name','age'),
   );

   public function process_mode_testing($gpc) {
      extract($gpc);
      echo "These are the common gpc: $testing and $query <br />";
      echo "These are the mode gpc: $name and $age <br />";
   }


}