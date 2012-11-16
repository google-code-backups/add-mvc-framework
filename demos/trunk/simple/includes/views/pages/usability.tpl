{extends file='common_layout.tpl'}
{block name='main'}
   <form>
      <input id="ctrlv" type="text" placeholder="Anti CTRL+V input">
      <input id="ctrlc" type="text" value="Anti CTRL+C input">
   </form>
{/block}
{block name='post_body_scripts'}
<script src="/add-usability/project/trunk/js/all.js"></script>
<script type="text/javascript">
   $('#ctrlv').disallow_paste();
   $('#ctrlc').disallow_copy();
   $('#ctrlc').return_key(function() { alert('test') });
</script>
{/block}