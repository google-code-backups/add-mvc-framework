{*SMARTY*}
{extends file='common_layout.tpl'}
{block name='main'}
<h1>System Error</h1>
   {if $user_message}
      {$user_message}
   {else}
      <p>A system error occured. Our developers has been notified about this and we will fix it as soon as we can.</p>
   {/if}
{/block}