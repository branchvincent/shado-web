<?php

// require_once('classes/parameters.php');

class Session
{
//  Public member functions

    function __construct()
    {
        $this->id = uniqid();
        $this->dir = sys_get_temp_dir() . '/' . $this->id;

    }

    function updateFromFile($file)

//  Public data members

    var $id;
    var $dir;
    var $parameters;
}

if (empty($_SESSION['session_started'])) {
    // require_once('includes/session_management/set_session_vars.php');

    echo "NEW SESSION!";
    require_once('classes/parameters.php');

    $_SESSION['session_id'] = uniqid();
    $dir = sys_get_temp_dir() . '/' . $_SESSION['session_id'];
    mkdir($dir);
    $_SESSION['session_dir'] = $dir . '/';
    $_SESSION['des_version'] = '1.0.0';

    $_SESSION['parameters'] = new Parameters('includes/session_management/default_params.txt');
    $_SESSION['defaults'] = new Parameters('includes/session_management/default_params.txt');
}
else
{
    echo "SESSION STARTED!";
}
