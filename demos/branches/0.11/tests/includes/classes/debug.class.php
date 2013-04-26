<?php

CLASS debug EXTENDS add_debug {
   public static function current_user_allowed() {

      add::load_functions('network');

      if (current_ip_in_network()) {
         return true;
      }
      else {
         return false;
      }

   }
}