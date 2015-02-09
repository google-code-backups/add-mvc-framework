<?php

/**
 * Member session user class
 *
 */
CLASS member EXTENDS session_user {
   CONST SESSION_KEY = 'member';

/**
 * Login method
 *
 */
   public static function login($username, $password) {
      if ($username != 'foo') {
         throw new e_user_input("Invalid username");
      }
      if ($password != 'bar') {
         throw new e_user_input("Invalid password");
      }

      $member = static::singleton();

      $member -> username = $username;
      $member -> password = $password;

      return $member;
   }

   /**
    * login_redirect()
    *
    * @since ADD MVC 0.0
    */
   static function login_redirect() {
      add::redirect(add::config()->path.'login?redirect='.urlencode($_SERVER['REQUEST_URI']));
   }

}