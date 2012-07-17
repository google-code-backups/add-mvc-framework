<?php
require '../config.php';
require_once "$C->add_dir/init.php";

add::config()->environment_status = 'live';

$email = $_GET['email'];
if ($email) {
   e_add::$email_addresses = 'albertdiones@247talk.net, jezieltabora@247talk.net, brian.requinala@247talk.net';
   $exceptions = array('e_developer','e_syntax','e_hack','e_spam','e_system');
   $rand_excemption = $exceptions[array_rand($exceptions)];
   throw new $rand_excemption('ERROR! '.$rand_excemption);
}
?>
<form method="GET">
   <input type="text" name="email" />
   <input type="submit" />
</form>