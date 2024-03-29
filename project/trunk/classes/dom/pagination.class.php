<?php
/**
 * Pagination HTML Element class
 *
 * <code>
 * $pagination = new pagination(30,2,5); # 30 items, 2nd page as current page, 5 items per page
 * echo $pagination;
 * </code>
 * @author albertdiones@gmail.com
 *
 * @package ADD MVC DOM Tools\Extras
 * @since ADD MVC 0.0
 * @version 0.0
 *
 * @todo view support
 *
 */
CLASS pagination EXTENDS dom_element_wrapper {

   /**
    * The total count of the elements
    *
    * @since ADD MVC 0.0
    */
   public $total_count;

   /**
    * The current page
    *
    * @since ADD MVC 0.0
    */
   public $current_page;


   /**
    * The base url of the pagination links
    *
    * @since ADD MVC 0.0
    */
   public $base_url;


   /**
    * Flag on merging the current $_GET
    *
    * @since ADD MVC 0.0
    */
   public $merge_get;


   /**
    * The index of $_GET that represent the page number
    *
    * @since ADD MVC 0.0
    */
   public $page_get_key;


   /**
    * The maximum number of pages to show from the left and right of the current page
    *
    * @since ADD MVC 0.0
    */
   public $hidden_page_padding = 3;

   /**
    * Creates a new pagination
    * @param int $total_count of items to paginates
    * @param int $current_page
    * @param int $per_page : number of items per page
    * @param $base_url of the pagination links
    * @param $page_get_key : the $_GET parameter
    * @param $merge_get : merge $_GET with the pagination $_GET parameter ($page_get_key)
    */
   public function __construct($total_count,$current_page=1,$per_page=10,$base_url="",$page_get_key='page',$merge_get=true) {
      $this->total_count  = (int) $total_count;
      $this->current_page = (int) $current_page;
      $this->per_page     = (int) $per_page;
      $this->base_url     = (string) $base_url;
      $this->merge_get    = (bool) $merge_get;
      $this->page_get_key = (string) $page_get_key;

      # https://code.google.com/p/add-mvc-framework/issues/detail?id=154
      if ($this->current_page <= 0) {
         throw new e_system("Invalid current page argument",func_get_args());
      }

      parent::__construct("div");

      $this->get_document();

      $this->attr("class","pagination");
   }

   /**
    * Returns the max page of the pagination
    *
    * @since ADD MVC 0.0
    */
   public function max_page() {
      return ceil($this->total_count / $this->per_page);
   }

   /**
    * Create the html and cache it
    *
    * @since ADD MVC 0.0
    */
   public function create_html() {

      $max_page = $this->max_page();

      if (!$max_page)
         return "";

      $visible_page_start = max(
         1,
         min($this->current_page,$max_page) - $this->hidden_page_padding
      );

      $visible_page_end = min(
         $max_page,
         $this->current_page + $this->hidden_page_padding
      );

      $visible_pages   = array();
      $visible_pages[] = 1;
      $visible_pages   = array_merge($visible_pages,range($visible_page_start,$visible_page_end));
      $visible_pages[] = $max_page;

      $visible_pages = array_unique($visible_pages);

      $this->append("Pages: ");

      foreach ($visible_pages as $pagex) {

         if (isset($previous_pagex) && $pagex > ($previous_pagex+1)) {
            $this->append("&#8230;&#32;");
         }

         if ( $this->current_page != $pagex ) {
            $page_query   = array( $this->page_get_key => $pagex );
            $query_array  =
               $this->merge_get
                  ? array_merge($_GET,$page_query)
                  : $page_query;

            unset($query_array['add_mvc_path']);

            $query_string = http_build_query($query_array);

            $page_url = strpos($this->base_url,"?") === false ? "$this->base_url?$query_string" : "$this->base_url&$query_string";

            $this->append("<a href='".htmlentities($page_url)."'>$pagex</a>");
         }
         else {
            $this->append("<b>$pagex</b>");
         }

         $this->append("&#32;");

         $previous_pagex = $pagex;

      }

   }

   /**
    * magic function __toString()
    * @see http://php.net/manual/en/language.oop5.magic.php#object.tostring
    * @since ADD MVC 0.0
    */
   public function __toString() {
      if (!$this->hasChildNodes())
         $this->create_html();
      return $this->get_document()->saveHTML();
   }
}