{*SMARTY*}
{extends file='common_layout.tpl'}
{block name=main}
   {if $mode == 'edit'}
   <form action="?mode=edit" method="post">
      <h1>Edit Profile</h1>
      <div class="error_message">{$error_message}</div>
      <label>Name<input name="name" value="{$name|default:$username}" placeholder="e.g. John Doe" type="text" /></label>
      <label>New Password<input name="password" placeholder="XXXXXX" type="password" /></label>
      <label>Confirm <input name="confirm_password" placeholder="XXXXXX" type="password" /></label>
      <button type="submit">Submit</button>
   </form>
   {/if}
{/block}