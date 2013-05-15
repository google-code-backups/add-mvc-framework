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

}