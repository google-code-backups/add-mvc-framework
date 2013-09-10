{*SMARTY*}
{extends file='common_layout.tpl'}
{block name=main}
   {if $mode == 'edit'}
   <form action="">
      <h1>Edit Profile</h1>
      <div class="error_message">{$error_message}</div>
      <label>Name<input name="name" value="{$name|default:$username}" placeholder="Name" type="text" /></label>
      <label>New Password<input name="password" placeholder="XXXXXX" type="password" /></label>
      <label>Confirm <input name="password" placeholder="XXXXXX" type="password" /></label>
   </form>
   {/if}
{/block}