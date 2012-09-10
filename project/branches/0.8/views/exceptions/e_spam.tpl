{*SMARTY*}
{extends file='exceptions/e_add.tpl'}
{block name='main'}
{if add::content_type() == 'text/plain'}
Spam Detected!

   {$user_message|default:'The system has detected spam attemps.'}
{else}
<h1>Spam Detected!</h1>
   {if $user_message}
      {$user_message}
   {else}
      <p>The system has detected spam attemps.</p>
   {/if}
{/if}   
{/block}