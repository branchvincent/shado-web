<?php
/****************************************************************************
*																			*
*	File:		read_file.php  												*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Date:		Sep 9, 2016													*
*																			*
*	Purpose:	This file reads and outputs the provided file.			    *
*																			*
****************************************************************************/

//	Initialize session

    require_once('includes/session_management/init.php');

//  Read file

    $file = fopen($_SESSION['session_dir'] . $_GET['filename'], "r") or die("Cannot open " . $_SESSION['session_dir'] . $_GET['filename'] . " Please return to check and update your settings.");
    while(($line = fgets($file)) !== false){
        echo $line;
    }
    fclose($file);
