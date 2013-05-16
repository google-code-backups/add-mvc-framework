<?php

/**
 * Inverted regex iterator
 *
 */
CLASS inverted_regex_iterator EXTENDS RecursiveRegexIterator {

/**
 * Simply invert the accept() function
 *
 */
   public function accept() {
      return !parent::accept();
   }


   /**
    * lock the mode to match
    *
    */
   public function __construct() {
      $args = func_get_args();

      if ($args[2] != static::MATCH) {
         throw new e_developer("Wrong parameter on ".get_called_class(),$args[2]);
      }

      return call_user_func_array('parent::'.__FUNCTION__,$args);
   }


   /**
    * setMode must not work cause we are not expecting or gonna use any matches here
    *
    * @param int $mode RegexIterator::MATCH
    *
    */
   public function setMode($mode) {
      if ($mode != static::MATCH) {
         throw new e_developer('Wrong parameter on setMode($mode)',$mode);
      }
   }

}