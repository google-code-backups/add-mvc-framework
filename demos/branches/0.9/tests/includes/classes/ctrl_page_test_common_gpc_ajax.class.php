<?php

/**
 * testing for ajax common_gpc
 * Query for testing "test_common_gpc_ajax?mode=testing&testing=test&query=testing_query&name=test%20name&age=test%20age"
 * @since ADD_MVC 0.9
 */
CLASS ctrl_page_test_common_gpc_ajax EXTENDS ctrl_tpl_ajax {

   /**
    * gpc that are common in this ctrl_page_test_common_gpc_ajax
    *
    * @since ADD_MVC 0.9
    */
   protected $common_gpc = array (
      '_REQUEST' => array (
            'testing','query'
      ),
   );

   /**
    * gpc for mode testing
    *
    * @since ADD_MVC 0.9
    */
   protected $mode_gpc_testing = array (
         '_REQUEST' => array ('name','age'),
   );

   /**
    * process_mode_testing
    * @param array $gpc
    * @since ADD_MVC 0.9
    */
   public function process_mode_testing($gpc) {
      extract($gpc);
      echo "These are the common gpc: $testing and $query <br />";
      echo "These are the mode gpc: $name and $age <br />";
   }


}