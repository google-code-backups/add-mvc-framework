<?php

/**
 * Edit profile
 *
 */
CLASS ctrl_page_member EXTENDS ctrl_tpl_page {

/**
 * Request variables for mode edit - username and password
 *
 */
   public $mode_gpc_edit = array( '_REQUEST' => array('username','password') );
/**
 * Mode - edit
 *
 */
   public function process_mode_edit($gpc) {
      member::require_logged_in();
      extract($gpc);

      # see session_user and i_auth_entity
      $member = member::current_logged_in();

      # $name from $gpc['name']
      $member->name = $name;

      if ($password) {
         if ($password == $confirm_password) {
            $member->password = $password;
         }
         else {
            throw new e_user_input("Password mismatched");
         }
      }
      else {
         # do nothing if password is not filled
      }
   }
}