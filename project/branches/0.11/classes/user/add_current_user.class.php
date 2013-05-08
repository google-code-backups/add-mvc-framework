<?php
/**
 * Current user class abstract
 *
 */
ABSTRACT CLASS add_current_user EXTENDS session_entity IMPLEMENTS i_singleton {


   /**
    * Singleton variable
    *
    */
   protected static $singleton;

   /**
    * Tracking Constants
    *
    */
   const TRACK_BROWSER = 1;
   const TRACK_REFERER = 2;
   const TRACK_IP      = 4;
   const TRACK_REQUEST = 8;
   const TRACK_SESSION = 16;
   const TRACK_SERVER  = 32;


   /**
    * Server variables indexes to track (aside from http_*)
    *
    */
   protected static $_SERVER_indexes = array(
         'REQUEST_TIME','REQUEST_URI','REMOTE_ADDR'
      );

   /**
    * Whether to track pages or not
    *
    */
   static $do_track = false;
   /*
    *
    # Sample
   static $do_track = array(
         self::TRACK_BROWSER,
         self::TRACK_REFERER,
         self::TRACK_IP
      );
   /**/

   /**
    * Singleton constructor
    *
    */
   protected function __construct(&$session_var) {
      #debug::lines_backtrace();
      parent::__construct($session_var);
      static::load_components();
      if (static::$do_track) {
         static::track();
      }
   }

   /**
    * Singleton function
    *
    */
   public static function singleton() {
      if (!session_id()) {
         session_start();
      }
      if (!isset(static::$singleton)) {
         static::$singleton = new static($_SESSION[static::session_key()]);
      }
      return static::$singleton;
   }


   /**
    * Cloning not allowed
    *
    */
   public function __clone() {
      throw new e_developer("Cloning not allowed for class ".get_called_class());
   }


   /**
    * The IP of the user
    *
    */
   public static function ip() {

      $singleton = static::singleton();

      if (!isset($singleton->ip)) {

         $ip_server_var_keys = array(
               'HTTP_CLIENT_IP',
               'HTTP_X_FORWARDED_FOR'
            );

         foreach ($ip_server_var_keys as $key) {
            if (!empty($_SERVER[$key])) {
               $singleton->ip = $_SERVER[$key];
               break;
            }
         }

         if (empty($singleton->browser)) {
            $singleton->browser = $_SERVER['HTTP_USER_AGENT'];
         }

         if (empty($singleton->ip)) {
            $singleton->ip = $_SERVER['REMOTE_ADDR'];
         }


      }
      return $singleton->ip;
   }

   /**
    * current user is in network
    *
    */
   public static function ip_in_network() {
      $ip = static::ip();
      if (
            preg_match('/^(10\.\d+|192\.168)\.\d+\.\d+$/',$ip)
            ||
            in_array($ip, array('127.0.0.1','::1'))
         ) {
         return true;
      }
      else {
         return false;
      }
   }


   /**
    * load the libraries
    *
    */
   public static function load_components() {
      add::load_functions('url');
   }


   /**
    * current user is developer
    *
    */
   public function is_developer() {
      /**
       * @see http://code.google.com/p/add-mvc-framework/issues/detail?id=39
       */
      if (php_sapi_name() == "cli") {
         return true;
      }

      # Fix for issue #6
      if (current_ip_in_network())
         return true;

      if (isset(add::config()->developer_ips))
         return in_array(current_user_ip(), (array) add::config()->developer_ips);
      else
         return false;
   }


   /**
    * Tracking pages - record the current page
    *
    */
   public function track() {
      $singleton = isset($this) ? $this : static::singleton();

      $activities = $singleton->activities;

      if (!isset($activities)) {
         $activities = array();
      }

      $track_data = array(
            'url'          => current_url(),
            'type'         => 'page_visit',
            'record_time'  => microtime(true)
         );

      if ($activities) {
         $last_activity = array_pop($activities);
      }

      if (
            in_array(static::TRACK_REFERER,static::$do_track)
            &&
            isset($_SERVER['HTTP_REFERER'])
         ) {

         $is_referer_recorded = false;

         # If the referer is recorded, then calculate the time stayed on that page
         if ($last_activity) {
            if (!empty($last_activity['record_time'])) {
               $is_referer_recorded = $last_activity['url'] == $_SERVER['HTTP_REFERER'];
               if ($is_referer_recorded) {
                  $last_activity['time_on_page'] = $_SERVER['REQUEST_TIME'] - $last_activity['record_time'];
               }
            }
         }

         # Record the referer data if not recorded by this class
         if (!$is_referer_recorded) {
            $referer_data = array(
                  'url'          => $_SERVER['HTTP_REFERER']
               );
            array_push(
                  $activities,
                  $referer_data
               );
         }
      }

      $track_data = array_merge($track_data,$singleton->request_data());

      if ($last_activity) {
         array_push(
               $activities,
               $last_activity
            );
      }

      array_push(
            $activities,
            $track_data
         );

      $singleton->activities = $activities;
   }


   /**
    * Track stay records the stay on page of a user (good for ajax-ping)
    *
    */
   public function track_stay() {
      $singleton = isset($this) ? $this : static::singleton();

      $activities = $singleton->activities;

      if (!isset($activities)) {
         $activities = array();
      }

      if ($activities) {
         $last_activity = array_pop($activities);
         $last_activity['time_on_page'] = microtime(true) - $last_activity['request_time'];
         array_push(
               $activities,
               $last_activity
            );
      }
      $singleton->activities = $activities;
   }



   /**
    * session key
    *
    */
   public function session_key() {
      return get_called_class();
   }


   /**
    * request_data
    *
    */
   public function request_data() {
      $request_data = array();

      if (in_array(static::TRACK_REQUEST,static::$do_track)) {
         $request_data['_POST']    = $_POST;
         $request_data['_COOKIE']  = $_COOKIE;
         $request_data['_REQUEST'] = $_REQUEST;
      }

      if (in_array(static::TRACK_SESSION,static::$do_track)) {
         $request_data['_SESSION'] = $_SESSION;
         unset($request_data['_SESSION'][static::session_key()]);
      }

      if (in_array(static::TRACK_SERVER,static::$do_track)) {
         $request_data['_SERVER'] = array();
         $_SERVER_vars = $_SERVER;
         # Already on request
         unset($_SERVER_vars['HTTP_COOKIE']);

         foreach ($_SERVER_vars as $_SERVER_index => $_SERVER_value) {
            if ( strpos($_SERVER_index,'HTTP_') === 0 || in_array($_SERVER_index, static::$_SERVER_indexes) ) {
               $request_data['_SERVER'][$_SERVER_index] = $_SERVER_value;
            }
         }
      }

      return $request_data;
   }

   /**
    * trimed_activities
    *
    */
   public function trimmed_activities() {
      $singleton = isset($this) ? $this : static::singleton();

      $trimmed_activities = array();

      $previous_activity = null;

      foreach ($singleton->activities as $i => $activity) {

         $trimmed_activities[$i] = $activity;

         if ($previous_activity) {
            foreach (array('_POST','_COOKIE','_REQUEST','_SERVER','_SESSION') as $activity_field) {
               if (!empty($previous_activity[$activity_field])) {
                  if (is_array($previous_activity[$activity_field])) {
                     $array_diff = array_diff($trimmed_activities[$i][$activity_field], $previous_activity[$activity_field]);
                     foreach ( $previous_activity[$activity_field] as $previous_activity_field_field => $pactivity_field_field_value) {
                        # The value of the previous activity field is nulled
                        if (!isset($trimmed_activities[$i][$activity_field][$previous_activity_field_field])) {
                           $array_diff[$previous_activity_field_field] = null;
                        }
                     }

                     if ($array_diff) {
                        $trimmed_activities[$i][$activity_field] = $array_diff;
                     }
                     else {
                        unset($trimmed_activities[$i][$activity_field]);
                     }
                  }
                  else {
                     throw new e_developer("This shouldn't happen");
                  }
               }
               else {
                  # If the activity field value is empty, don't include it at all
                  if (empty($trimmed_activities[$i][$activity_field])) {
                     unset($trimmed_activities[$i][$activity_field]);
                  }
                  else {
                     # do nothing, get all the value cause the previous value is blank
                  }
               }
            }
         }

         $previous_activity = $activity;
      }

      return $trimmed_activities;
   }



}

