<?php

require 'add_configure.php';

ob_start('ob_gzhandler');
echo 'test output';
#ob_end_flush(); # Required for output, shouldn't be
add::shutdown();