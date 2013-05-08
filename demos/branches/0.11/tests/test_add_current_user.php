<?php
require '../config.php';
require $C->add_dir.'/init.php';

if ($_REQUEST['mode'] == 'reset') {
   session_start();
   session_destroy();
}

$user = current_user::singleton();

debug::var_dump($user->trimmed_activities());


?>
<a href="?rand=<?php echo rand() ?>">Test Referer</a>
<a href="?mode=reset">Reset session</a>
<form method="post">
   <textarea name="rand<?php echo rand() ?>"></textarea>
   <button type="submit">Submit</button>
</form>
