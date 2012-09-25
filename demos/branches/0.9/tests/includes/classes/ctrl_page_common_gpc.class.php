<?php

CLASS ctrl_page_common_gpc EXTENDS ctrl_tpl_page {

   protected $common_gpc = array(
      '_POST' => array ('first_name','last_name'),
   );

   protected $mode_gpc_my_age = array(
      '_POST' => array ('age', 'birthday'),
   );

   protected $mode_gpc_my_address = array(
      '_POST' => array ('address', 'city', 'state'),
   );


   public function process_mode_my_age($gpc) {
      extract($gpc);
      $this->full_name($first_name, $last_name);
      $this->assign('age', $age);
      $this->assign('bday', $birthday);
   }

   public function process_mode_my_address($gpc) {
      extract($gpc);
      $this->full_name($first_name, $last_name);
      $this->assign('street_no', $street_number);
      $this->assign('city', $city);
      $this->assign('state', $state);
   }

   public function full_name($first, $last) {
     $full_name = $first.' '.$last;
     $this->assign('name', $full_name);
   }

}