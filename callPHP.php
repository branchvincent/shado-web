<?php
require_once('includes/php_session/init.php');

if (isset($_POST['funct']))
{
    $f = $_POST['funct'];
    $f();
}
