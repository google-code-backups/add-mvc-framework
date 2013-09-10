<?php
/**
 * Login controller demo
 */
CLASS ctrl_page_login EXTENDS ctrl_tpl_page {

   /**
    * Login Request variables - username and password from $_REQUEST
    *
    */
   protected $mode_gpc_login = array( '_REQUEST' => array( 'username', 'password' , 'redirect' ));

   /**
    * Login
    *
    * @param array $gpc - contains $gpc['username'] and $gpc['password']
    *
    */
   public function process_mode_login($gpc) {

      # validation on controller
      if (empty($gpc['username'])) {
         throw new e_user_input("Blank username");
      }
      if (empty($gpc['password'])) {
         throw new e_user_input("Blank password");
      }

      # login the session user class
      if (member::login($gpc['username'],$gpc['password']) instanceof member) {
         add::redirect(add::config()->path);
      }
   }



   /**
    * Logout request variables - none
    *
    */
   protected $mode_gpc_logout = array();
   /**
    * Logout mode
    *
    * @param array $gpc - blank array
    *
    */
   public function process_mode_logout($gpc) {
      member::logout();
   }

}