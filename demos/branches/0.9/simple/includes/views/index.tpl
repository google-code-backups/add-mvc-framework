{*SMARTY*}
{extends file='common_layout.tpl'}
{block name=main}
   <h1>Simple Example</h1>
   <p>Hi! This is a very simple implementation of ADD MVC Framework.</p>

   <p>Just edit <b>{$C->views_dir|replace:'\\':'/'}/{$current_view}</b> to change the view</p>

   <p>You can also edit the controller: <b>{$current_controller}.class.php</b></p>

   <p>current UTC time: <b>{"Y-m-d h:i:s"|date:$utc_timestamp}</b></p>

{/block}