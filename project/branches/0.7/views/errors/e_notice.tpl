{*SMARTY*}

<div style='margin:5px 10px;border:1px solid #333; background: #FFAAAA; padding:5px 10px'>
   <small>{$error.type}</small><p>{$error.message}</p><small>{$error.file} : {$error.line}</small>
   <div style='float:left'>
      {$code_on_error}
   </div>
</div>
