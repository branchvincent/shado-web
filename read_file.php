<?php
/****************************************************************************
*																			*
*	File:		read_file.php  												*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file reads and outputs the provided file.			    *
*																			*
****************************************************************************/

//	Initialize session

    require_once('includes/php_session/init.php');

//  Read file

    $file = fopen($_SESSION['session_dir'] . $_GET['filename'], "r") or die("Cannot open " . $_SESSION['session_dir'] . $_GET['filename'] . " Please return to check and update your settings.");
    while(($line = fgets($file)) !== false){
        echo $line;
    }
    fclose($file);
