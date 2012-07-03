<?php

require 'config.php';

require $C->add_dir.'/init.php';

e_add::$email_addresses = 'albertdiones@247talk.net, jezieltabora@247talk.net, brian.requinala@247talk.net';

adodb_ssc::singleton();

model_rwd::$D = adodb_ssc::singleton();


date_default_timezone_set('UTC');

$G_errors = array();

session_start();
session_set_cookie_params(3600,$C->path,$C->domain,true);

setlocale(LC_MONETARY,$C->lc_monetary);

#add::canonicalize_path();
add::current_controller()->execute();