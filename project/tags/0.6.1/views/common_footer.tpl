{*SMARTY*}
         </div>
         <div id="footer">
            <div class="generator">
               Generated by ADD MVC Framework
            </div>
         </div>
      </div>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      {block name=post_body_scripts}
      <script type="text/javascript">
         $('*[data-href]').click(
               function() {
                  location.href = $(this).attr('data-href');
               }
            );
      </script>
      {/block}

   </body>
</html>