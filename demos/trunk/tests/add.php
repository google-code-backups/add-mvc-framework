<?php

require '../config.php';

require $C->add_dir.'/init.php';

date_default_timezone_set('UTC');

session_start();
session_set_cookie_params(3600,$C->path,$C->domain,true);

#add::canonicalize_path();
add::current_controller()->execute();