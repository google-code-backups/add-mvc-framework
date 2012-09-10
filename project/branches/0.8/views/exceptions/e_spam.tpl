{*SMARTY*}
{extends file='exceptions/e_add.tpl'}
{block name='main'}
{if add::content_type() == 'text/html'}
<h1>Spam Detected!</h1>
   {if $user_message}
      {$user_message}
   {else}
      <p>The system has detected spam attemps.</p>
   {/if}
   
{else}
Spam Detected!

   {$user_message|default:'The system has detected spam attemps.'}
{/if}   
{/block}