<?php
require_once('includes/php_session/init.php');

echo "here";

if (isset($_POST['funct']) and isset($_POST['args']))
{
    $f = $_POST['funct'];
    $a = $_POST['args'];
    echo 'POST: calling ' + $f + '(' + $a + ')';
    // eval("$f($a);");
    // $f($a);
}
elseif (isset($_POST['funct']))
{
    $f = $_POST['funct'];
    echo 'POST: calling ' + $f;
    // $f();
}
elseif (isset($_GET['f']) and isset($_GET['a']))
{
    $f = $_GET['f'];
    $a = $_GET['a'];
    echo 'GET: calling ' + $f + '(' + $a + ')';
    // print "<pre>";
    // eval("$f($a);");
    // print "</pre>";
}
elseif (isset($_GET['f']))
{
    $f = $_GET['f'];
    echo 'GET: calling ' + $f;
    // print "<pre>";
    // $f();
    // print "</pre>";
}

echo "done";
