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

      add::redirect(add::config()->path);


      return $member;
   }
}