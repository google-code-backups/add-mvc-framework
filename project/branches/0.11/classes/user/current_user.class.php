<?php

/**
 * class that track user activities
 *
 */
CLASS current_user EXTENDS add_current_user {

   /**
    * static array variable containing option what to track
    *
    */
   static $do_track = array(
         self::TRACK_REFERER,
         self::TRACK_SESSION,
         self::TRACK_REQUEST,
         self::TRACK_SERVER
      );
}