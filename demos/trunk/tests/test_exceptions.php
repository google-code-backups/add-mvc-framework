<?php
require '../config.php';
require_once "$C->add_dir/init.php";



$exceptions = array('e_developer','e_syntax','e_hack','e_spam','e_system');
$exception = (string) $_GET['exception'];
$email = (string) $_GET['email'];
if ($exception) {
   if ($_REQUEST['is_live'])
      add::environment_status( 'live' );
   add::content_type($_REQUEST['content_type']);
   e_add::$email_addresses = $email;
   $e = new $exception("Test Error Message");
   debug::var_dump($e->mail_body());
   #throw new $exception("Test Error Message");
}
?>
<form method="GET">
   <select name="exception">
      <option><?php echo implode("</option><option>",$exceptions) ?></option>
   </select>
   <label>Email<input type="text" name="email" /></label>
   <label><input name="is_live" type="checkbox" />Live</label>
   <label>
      Content Type<select name="content_type">
         <option>text/html</option>
         <option>text/plain</option>
      </select>
   </label>
   <input type="submit" />
</form>