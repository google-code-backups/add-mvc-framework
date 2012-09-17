<?php
CLASS ctrl_page_test_view_exception EXTENDS ctrl_tpl_page {

   public static throw_exception() {
      throw new e_developer("Test!");
   }
}