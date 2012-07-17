<?php

require '../config.php';

require $C->add_dir.'/init.php';

e_add::$email_addresses = 'albertdiones@247talk.net, jezieltabora@247talk.net, brian.requinala@247talk.net';
date_default_timezone_set('UTC');

session_start();
session_set_cookie_params(3600,$C->path,$C->domain,true);
