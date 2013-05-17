<?php

/**
 * Request data iterator
 *
 */
CLASS user_request_iterator EXTENDS inverted_regex_iterator {

   public $sensitive_keys_regex = '/^(pa?s?s(wo?r?d)?|c(redit)?_?c(ard)?|PHPSESSID)/';

   /**
    * Hash | Credit Card | password
    *
    */
   public $sensitive_values_regex = '
         /
               ^[0-9a-f]{32,40}$
               |
               # credit cards
               ^(?:
                  4(?:\d{1}|\d{4})       # Visa
                  |
                  5[1-5]\d{3}            # MasterCard
                  |
                  6(?:011|5\d{2})\d      # Discover
                  |
                  3[47]\d{2}             # American Express
                  |
                  3(?:0[0-5]|[68]\d)     # Diners Club
                  |
                  (?:2131|1800|35\d{3})  # JCB
               )\d{11}$
               |
               # passwords
               (?:

                  ^
                  (?=.{6}) # min char
                  (?!.{25}) # min char
                  .+
                  (?![^\S\ ]) # has no white spaces except space
                  (
                     (?=[a-z]\d|\d[a-z]) # has number on it and letter on it
                     |
                     (?=[A-Z]) # has capitalized letters inside it
                     |
                     (?=[^\W\daeiou_]{4}) # has consonant cluster on it
                     |
                     (?=\w[[:punct:]]|[[:punct:]]\w) # has the keyboard symbols on it
                  )
                  .+
                  $

                  |

                  # invalid initial consonant cluster
                  ^
                  [^\W\daeiou_]{3}
                  (?<!bl|br|cl|cr|dr|fl|fr|gl|gr|pl|prsc|sk|sl|sm|sn|sp|squ|st|str|sw|tr)
                  .{3,22} # 6-25 characters
                  $

                  |

                  # invalid final consonant cluster
                  ^
                  .{4,23} # 6-25 characters
                  (?!ct|ft|lb|lt|mp|nd|ng|nk|nt|pt|sk|sp|st|ht|th)
                  [^\W\daeiou_]{2}
                  $
               )
         /x';

   /**
    * instead of returning false, we will obfuscate the data instead
    *
    *
    *
    */
   public function accept() {
      $current = $this->current();
      if (is_scalar($current)) {
         if (!parent::accept()) {
            $this->OffsetSet($this->key(),static::obfuscate($current));
         }
         if (preg_match($this->sensitive_values_regex, $current)) {
            $this->OffsetSet($this->key(),static::obfuscate($current));
         }
      }
      return true;
   }

/**
 * Construct
 *
 */
   public function __construct($array) {
      parent::__construct(new RecursiveArrayIterator($array),$this->sensitive_keys_regex);

      $this->setFlags(static::USE_KEY);



      foreach ($this as $index => $value) {
         if ($this->hasChildren()) {
            $this->offsetSet($index, iterator_to_array($this->getChildren()));
         }
      }
   }

   /**
    * Obfuscate the credit card number or other details
    *
    * @param string $string
    *
    */
   public static function obfuscate($string, $obfuscation_char = '*') {
      if (!is_scalar($string)) {
         throw new e_developer("Wrong parameter for ".__FUNCTION__,$string);
      }
      $len = strlen($string);
      return preg_replace('/\S(?!.{0,'.(round(($len/4)-1)).'}$)/',$obfuscation_char,$string);
   }

}