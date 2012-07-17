{*SMARTY*}

<div style="{block name='error.style'}margin:5px 10px;border:1px solid #333; background: #FFAAAA; padding:5px 10px;width:720px{/block}">
   <div style='float:left;width:40%;'>
      <small>{$error.type}</small>
      <p>{$error.message}</p>
      <small>
         {$error.file} : {$error.line}
         {foreach $error['file_lines'] as $error_file_line}
            &lt; <small>{$error_file_line.file} : {$error_file_line.line}</small>
         {/foreach}
      </small>
   </div>
   <div style='float:right;font-size:8px;width:40%;background:#eee;padding:5px 10px;border:1px solid #333;overflow:hidden;'>
      {$code_on_error}
   </div>
   <div style='clear:both'></div>
</div>