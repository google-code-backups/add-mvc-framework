{*SMARTY*}
{extends file='exceptions/e_add.tpl'}
{block name='main'}
{if add::content_type() == 'text/html'}
<h1>Syntax Error</h1>
   {if $user_message}
      {$user_message}
   {else}
      <p>A syntax error occured. Our developers has been notified about this and we will fix it as soon as we can.</p>
   {/if}
{else}
Syntax Error

   {$user_message|default:'A syntax error occured. Our developers has been notified about this and we will fix it as soon as we can.'}
{/if}
{/block}


