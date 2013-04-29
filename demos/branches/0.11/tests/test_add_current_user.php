<?php
require '../config.php';
require $C->add_dir.'/init.php';

/**
 * Blank concrete class for overloading
 *
 */
CLASS current_user EXTENDS add_current_user {
   static $do_track = array(
         self::TRACK_BROWSER,
         self::TRACK_REFERER,
         self::TRACK_IP,
         self::TRACK_GPC,
         self::TRACK_SESSION
      );
}

if ($_REQUEST['mode'] == 'reset') {
   session_destroy();
}

debug::print_eval('current_user::ip_in_network()');
debug::print_eval('current_user::is_developer()');
debug::print_eval('current_user::track()');
#debug::print_eval('current_user::v()');

?>
<a href="?rand=<?php echo rand() ?>">Test Referer</a>
<a href="?mode=reset">Reset session</a>
