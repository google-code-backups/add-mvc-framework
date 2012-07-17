{*SMARTY*}

<div style='margin:5px 10px;border:1px solid #333; background: #FF0000; color: #FFF; padding:5px 10px'>
   <small>{$error.type}</small>
   <p>{$error.message}</p>
   <small>{$error.file} : {$error.line}</small>
   {foreach $error.file_lines as $file_line}
      &lt; <small>{$file_line.file} : {$file_line.line}</small>
   {/foreach}
</div>


