<?php
/**
 * ctrl_tpl_page abstract model class
 *
 * @author albertdiones@gmail.com
 *
 * @package ADD MVC\Controllers
 * @since ADD MVC 0.0
 * @version 1.0
 *
 * @todo ADD MVC version 1.0: implement i_ctrl (version 0.9) for this
 *
 */
ABSTRACT CLASS ctrl_tpl_page EXTENDS ctrl_abstract IMPLEMENTS i_ctrl_with_view {

   /**
    * The mode of the process
    *
    * @deprecated see ctrl_abstract property
    *
    * @since ADD MVC 0.3, ctrl_tpl_page 0.2.3
    */
   protected $mode;

   /**
    * The sub mode of the mode
    *
    * @deprecated see ctrl_abstract property
    *
    * @since ADD MVC 0.3, ctrl_tpl_page 0.2.3
    */
   protected $sub_mode;

   /**
    * Mime type of this resource
    *
    * @deprecated see ctrl_abstract property
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
    * @deprecated see ctrl_abstract property
    *
    * @since ADD MVC 0.6
    */
   protected $data = array();

   /**
    * __call() magic function
    *
    * @since ADD MVC 0.6
    */
   public function __call($function_name,$arguments) {
      static $renamed_functions = array(
            'page'         => 'execute',
            'process'      => 'process_data',
            'display_view' => 'print_response'
         );

      if (isset($renamed_functions[$function_name])) {
         call_user_func_array(array($this,$renamed_functions[$function_name]),$arguments);
      }
      else {
         throw new e_developer("Undefined function: ".get_called_class()." $function_name",func_get_args());
      }

   }

   /**
    * Process the page response (former $this->page())
    *
    * @todo remove the automatic assigning of {$C}
    *
    * @since ADD MVC 0.0
    * @version 0.2
    */
   public function execute() {

      # ADD MVC 0.5 backward support
      if (method_exists($this,'page')) {
         return $this->page();
      }

      # Set Content Type
      $this->content_type($this->content_type);

      try {

         $this->set_mode();

         $this->process_data(
               isset($this->common_gpc)
               ? $this->recursive_compact( $this->common_gpc )
               : array()
            );

      }
      catch(e_user $e) {

         if ($e instanceof e_user_malicious) {
            $e->handle_exception();
            die();
         }

         if ($this->mode)
            $exception_label = "user_".$this->mode;
         else
            $exception_label = "user";
         /**
          *
          *
          * // what if $e is unrelated to $this->gpc_filter_exception
          * if ($this->gpc_filter_exception instanceof e_user_input) {
          *    $e = $this->gpc_filter_exception;
          * }
          *
          */

         $this->add_exception($e,$exception_label);
      }

      $this->assign('ctrl_basename',$this->basename());
      $this->assign('C',add::config());

      $error_messages =
            isset($this->data['error_messages']) && is_array($this->data['error_messages'])
            ? $this->data['error_messages']
            : array();

      if (is_array($error_messages) && isset($error_messages[0]))
         $this->assign('error_message',$error_messages[0]);

      if (add::is_development())
         add::config()->root_timer->lap("Before Printing");

      $this->print_response($this->data);
   }



   /**
    * The pre-display process of the controller
    * (former $this->process())
    *
    * @since ADD MVC 0.0
    * @version 0.1
    * @param array $gpc
    * @todo ADD MVC 1.0: remove version 0.5 and version 0.8 support
    */
   public function process_data( $common_gpc = array()/* ADD MVC 0.8 support */) {
      $this->pre_mode_process( $common_gpc );
      # ADD MVC 0.5 backward support
      if (method_exists($this,'process')) {
         return $this->process();
      }

      $process_mode_result = $this->process_mode( $common_gpc );

      $this->post_mode_process( $common_gpc );

   }




   /**
    * The view filepath of $this controller
    * @todo ADD MVC version 1.0: remove backward compatibility
    * @since ADD MVC 0.0
    */
   public static function view_filepath() {
      $view_filepath = 'pages/'.static::view_basename().'.tpl';

      if (!static::view()->TemplateExists($view_filepath) && (!isset($this) || ! $this instanceof ctrl_default_page) ) {
         $view_filepath = self::view_filepath_009();
      }

      return $view_filepath;
   }

   public static function view_filepath_009() {
      return static::view_basename().'.tpl';
   }
   /**
    * The view base file name of $this controller
    * @since ADD MVC 0.0
    * @version 0.1
    */
   public static function view_basename() {
      return static::basename();
   }

   /**
    * The controller's basename
    * @since ADD MVC 0.1, ctrl_tpl_page 0.1.1
    */
   static function basename() {
      return preg_replace('/^ctrl_page_/','',get_called_class());
   }

   /**
    * The Smarty view object of $this controller
    * @since ADD MVC 0.0
    */
   public function view() {
      $class = get_called_class();

      if (!isset(static::$views[$class])) {
         static::$views[$class] = new add_smarty();
      }

      return static::$views[$class];
   }

   /**
    * The canonical url path of this controller
    *
    * @since ADD MVC 0.5, ctrl_tpl_page 0.3
    */
   public function path() {
      return str_replace('_','-',self::basename());
   }

   /**
    * Redirect
    *
    * @since ADD MVC 0.5
    */
   public function redirect() {
      add::redirect(add::config()->path.self::path());
   }

   /**
    * display() the Smarty template of $this controller
    *
    * @since ADD MVC 0.0, ctrl_tpl_page 0.1
    * @version 0.2
    *
    * @todo remove ADD MVC 0.5 version support
    *
    */
   public function print_response($data) {

      # ADD MVC 0.5 backward support
      if (method_exists($this,'display_view')) {
         return $this->display_view();
      }

      $tpl = static::view_filepath();

      if ($this->view()->templateExists($tpl)) {
         $this->view()->assign($data);
         $this->view()->display($tpl);
      }
      else {
         $template_vars = $data;
         unset($template_vars['C']);
         $this->view()->assign('template_vars',$template_vars);
         $this->view()->display('debug/list_array_page.tpl');
      }
   }


   /**
    * Register an exception to the view
    *
    * @param Exception $e the exception object
    * @param string $label the label for the exception
    * In smarty:
    * <code>{$error_messages.label}</code>
    * Latest Error Message:
    * <code>{$error_message}</code>
    * @since ADD MVC 0.3, ctrl_tpl_page 0.2.2
    */
   public function add_exception(Exception $e,$label=null) {
      $error_messages = $this->data['error_messages'];

      if (!$error_messages)
         $error_messages = array();

      array_unshift($error_messages,$e->getMessage());

      if ($label) {
         $error_messages[$label] = $e->getMessage();
      }

      $this->assign('error_messages',$error_messages);
   }


# DEPRECATED FUNCTIONS

   /**
    * The default page title
    *
    * @since ADD MVC 0.1, ctrl_tpl_page 0.1
    * @deprecated use the view instead
    * @version 0.1
    */
   public function meta_title() {
      return add::config()->default_meta_title;
   }

   /**
    * meta description
    *
    * @since ADD MVC 0.1, ctrl_tpl_page 0.1
    * @deprecated use the view instead
    */
   public function meta_description() {
      return isset(add::config()->default_meta_description) ? add::config()->default_meta_description : null;
   }

   /**
    * meta keywords
    *
    * @since ADD MVC 0.1, ctrl_tpl_page 0.1
    * @deprecated use the view instead
    */
   public function meta_keywords() {
      return isset(add::config()->default_meta_keywords) ? add::config()->default_meta_keywords : null;
   }


   /**
    * sets the content_type or get the current one
    *
    * @param string $new_content_type
    *
    * @since ADD MVC 0.8
    */
   public function content_type($new_content_type = null) {
      if ($new_content_type) {
         $this->content_type = $new_content_type;
         header("Content-type: ".$this->content_type);
      }
      return $this->content_type;
   }

   /**
    * Process before the main mode process
    *
    * @param array $common_gpc
    * @since ADD MVC 0.9
    */
   public function pre_mode_process($common_gpc) {
   }

   /**
    * Process after the main mode process
    *
    * @param array $common_gpc
    * @since ADD MVC 0.9
    */
   public function post_mode_process($common_gpc) {
   }
}