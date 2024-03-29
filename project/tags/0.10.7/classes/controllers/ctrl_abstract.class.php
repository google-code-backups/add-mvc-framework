<?php

/**
 * Abstract Controller
 *
 * @since ADD MVC 0.10
 */
ABSTRACT CLASS ctrl_abstract {

   /**
    * The mode of the process
    * @since ADD MVC 0.3, ctrl_tpl_page 0.2.3
    */
   protected $mode;

   /**
    * The sub mode of the mode
    * @since ADD MVC 0.3, ctrl_tpl_page 0.2.3
    */
   protected $sub_mode;

   /**
    * Mime type of this resource
    *
    * @since ADD MVC 0.8
    */
   protected $content_type = 'text/html';

   /**
    * The views cache
    * @since ADD MVC 0.0
    */
   protected static $views = array();


   /**
    * The view data
    *
    * @since ADD MVC 0.6
    */
   protected $data = array();

   /**
    * Set mode function
    *
    * @since ADD MVC 0.10
    */
   public function set_mode() {
      if (isset($_REQUEST['mode']) && preg_match('/^\w+$/',$_REQUEST['mode'])) {
         $this->mode = $_REQUEST['mode'];
         if (isset($_REQUEST['sub_mode']) && preg_match('/^\w+$/',$_REQUEST['sub_mode'])) {
            $this->sub_mode = $_REQUEST['sub_mode'];
         }
      }

      if (!isset($this->mode))
         $this->mode = 'default';
   }

   /**
    * process_mode function
    * Processes any GPC requests
    *
    * @param array $gpc
    * @since ADD MVC 0.1
    *
    * @version 1.0
    */
   public function process_mode( $common_gpc = array() ) {
      $mode = $this->mode;

      $method_name = "process_mode_$mode";

      if (method_exists($this,$method_name)) {

         $gpc_key_var = "mode_gpc_$mode";

         $mode_gpc = array();

         if ( isset( $this->$gpc_key_var ) ) {
            $mode_gpc = $this->recursive_compact( $this->$gpc_key_var );
         }
         else if ($mode != 'default') {
            throw new e_developer(get_called_class()."->$gpc_key_var not declared");
         }

         $reserved_gpc = array('mode' => $this->mode);

         if (!empty($this->sub_mode)) {
            $reserved_gpc['sub_mode'] = $this->sub_mode;
         }

         $merged_gpc = array_merge($reserved_gpc, $common_gpc, $mode_gpc);

         $this->assign($merged_gpc);
         $this->assign('mode',$mode);
         $this->assign('sub_mode',$this->sub_mode);

         return $this->$method_name($merged_gpc);

      }
      else {
         $this->mode = 'default';
         $this->assign($common_gpc);
         $this->assign('mode','default');
      }

      return false;
   }

   /**
    * recursive compact($array_keys)
    * Returns an array of GPC from the $array_keys
    *
    * @since ADD MVC 0.1, ctrl_tpl_page 0.1
    */
   public static function recursive_compact($gpc_array_keys) {
      $compact_array = array();
      foreach ($gpc_array_keys as $gpc_key => $array_keys) {
         e_developer::assert(isset($GLOBALS[$gpc_key]),"Invalid GPC key $gpc_key");
         $gpc_array = $GLOBALS[$gpc_key];

         foreach ($array_keys as $array_key) {
            e_developer::assert(is_scalar($array_key),"Invalid GPC array key $array_key");
            $compact_array[$array_key] = empty($gpc_array[$array_key]) ? null : $gpc_array[$array_key];
         }

      }
      return $compact_array;
   }


   /**
    * Assign a variable to the view
    *
    * @since ADD MVC 0.6, ctrl_tpl_page 1.0
    */
   public function assign() {
      $arg1 = func_get_arg(0);

      if (is_array($arg1) || is_object($arg1)) {
         $this->data = array_merge($this->data,(array) $arg1);
      }
      else {
         $this->data[$arg1] = func_get_arg(1);
      }

   }



   /**
    * Returns the data
    *
    * @since ADD MVC 0.10
    */
   public function data() {
      return $this->data;
   }
}