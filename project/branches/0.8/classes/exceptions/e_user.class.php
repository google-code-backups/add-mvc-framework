<?php
/**
 * e_user class
 * Custom Exception Class for user errors
 *
 * @author albertdiones@gmail.com
 *
 * @package ADD MVC\Exceptions
 * @since ADD MVC 0.0
 * @version 0.0
 */
CLASS e_user EXTENDS e_add {

   public static assert($condition, $message = null, $data=NULL, $error_number=NULL)  {
      if (!$message) {
         $message ="Failed to validate $function ($arguments) "
      }
      parent::assert($condition, $message, $data, $error_number);
   }
}