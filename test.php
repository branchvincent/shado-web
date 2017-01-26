<?php
require_once('includes/php_session/init.php');

$d1 = new DateTime('2016-01-01 08:00:00 UTC');
$d1 = $d1->format('h:i A');

echo $d1;
