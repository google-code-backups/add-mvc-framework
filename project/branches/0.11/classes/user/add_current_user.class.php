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
   const TRACK_GPC     = 8;
   const TRACK_SESSION = 16;

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
            'record_time'  => microtime(true),
            'request_time' => $_SERVER['REQUEST_TIME']
         );

      if (
            in_array(static::TRACK_REFERER,static::$do_track)
            &&
            isset($_SERVER['HTTP_REFERER'])
         ) {
         $track_data['referer'] = $_SERVER['HTTP_REFERER'];

         $is_referer_recorded = false;

         if ($activities) {
            $last_activity = array_pop($activities);
            if (!empty($last_activity['record_time'])) {
               $is_referer_recorded = $last_activity['url'] == $track_data['referer'];
               if ($is_referer_recorded) {
                  $last_activity['time_on_page'] = $track_data['request_time'] - $last_activity['record_time'];
               }
            }
            array_push(
                  $activities,
                  $last_activity
               );
         }
         # Record the referer data
         if (!$is_referer_recorded) {
            $referer_data = array(
                  'url'          => $track_data['referer']
               );
            array_push(
                  $activities,
                  $referer_data
               );
         }
      }

      if (in_array(static::TRACK_BROWSER,static::$do_track)) {
         $track_data['browser'] = $_SERVER['HTTP_USER_AGENT'];
      }

      if (in_array(static::TRACK_IP,static::$do_track)) {
         $track_data['ip'] = $_SERVER['REMOTE_ADDR'];
      }

      if (in_array(static::TRACK_GPC,static::$do_track)) {
         $track_data['gpc'] = array(
               '_GET'    => $_GET,
               '_POST'   => $_POST,
               '_COOKIE' => $_COOKIE
            );
      }

      if (in_array(static::TRACK_SESSION,static::$do_track)) {
         $track_data['session'] = $_SESSION;
      }

      array_push(
            $activities,
            $track_data
         );

      $singleton->activities = $activities;

   }



   /**
    * session key
    *
    */
   public function session_key() {
      return get_called_class();
   }
}

