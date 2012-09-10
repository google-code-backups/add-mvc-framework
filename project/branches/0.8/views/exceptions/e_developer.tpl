{*SMARTY*}
{extends file='exceptions/e_add.tpl'}
{block name='main'}
{add_debug::var_dump(add::current_controller()->content_type)}
<h1>Developer Error</h1>
   {if $user_message}
      {$user_message}
   {else}
      <p>A developer error occured. Our developers has been notified about this and we will fix it as soon as we can.</p>
   {/if}
{/block}