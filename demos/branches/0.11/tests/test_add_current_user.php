<?php
require '../config.php';
require $C->add_dir.'/init.php';

CLASS this_debug EXTENDS debug {
   public static function current_user_allowed() {
      return true;
   }
}

if ($_REQUEST['mode'] == 'reset') {
   session_start();
   session_destroy();
}

$user = current_user::singleton();

?>
<a href="?rand=<?php echo rand() ?>">Test Referer</a>
<a href="?mode=reset">Reset session</a>
<form method="post">
   <label>
      Random Text:
      <textarea name="rand<?php echo rand() ?>"></textarea>
   </label><br />
   <label>Password: <input name="password" type="password" /></label><br />
   <label>Undetectable Password: <input name="wertyuio" type="password" /></label><br />

   <button type="submit">Submit</button>
</form>
<?php
this_debug::var_dump(
      iterator_to_array(
            new user_request_iterator(
                  array(
                        '_GET' => array(
                              'username' => 'albert',
                              'password' => 'test123',
                              'passwd'   => 'test321',
                              'pass'     => 'test234',
                           ),
                        '_POST'  => array(
                              'credit_card' => '4111111111111111',
                              'mycc'        => '4111111111111111',
                              'cc_01'       => '4110144110144115',   //Visa
                              'cc_02'       => '5115915115915118',   //MasterCard
                              'cc_03'       => '6011000990139424',   //Discover
                              'cc_04'       => '378734493671000',    //American Express
                              'cc_05'       => '38520000023237',     //Diners Club
                              'cc_06'       => '3566002020360505',   //JCB

                              # Should be detected as password and obfuscated
                              'capsyCapsy'  => 'IamAwEirdP',
                              'simblock'    => 'hey!notsure',
                              'nomnom'      => 'hoygising6547',

                              # Should not be detected as password
                              'message'     => "Hey how are you!!!"
                              '20130520105824+0800' => 'Shalom!',
                              '1234'                => 'I come in peace!?'
                           ),
                        '_COOKIE' => array(
                              'PHPSESSID' => 'uivtqjg6748rj812fkef9o4u71',
                              'password' => 'test123',
                              'undetectable_s3ssid' => '6jas16vkpp9m87s2h01g9ijdk1'
                           ),
                     )
               )
         )
   );

this_debug::var_dump($user->request_data());
?>