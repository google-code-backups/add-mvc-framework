<?php
require '../config.php';
require $C->add_dir.'/init.php';

if ($_REQUEST['mode'] == 'reset') {
   session_start();
   session_destroy();
}

debug::print_eval('current_user::ip_in_network()');
debug::print_eval('current_user::is_developer()');
#debug::print_eval('current_user::v()');

$user = current_user::singleton();

debug::var_dump($user->trimmed_activities());


?>
<a href="?rand=<?php echo rand() ?>">Test Referer</a>
<a href="?mode=reset">Reset session</a>
<form method="post">
   <textarea name="rand<?php echo rand() ?>"></textarea><br />
   <button type="submit">Submit</button>
</form>
