{*SMARTY*}
{extends file='common_layout.tpl'}
{block name=main}
   <form action="?mode=login" method="post">
      <p>Login below</p>
      Username: foo <br />
      Password: bar <br />
      <div class="error_message">{$error_message}</div>
      <input name="username" value="{$username|escape}" placeholder="Username" type="text" />
      <input name="password" value="{$password|escape}" placeholder="Password" type="password" />
      <button type="submit">Login</button>
   </form>
{/block}