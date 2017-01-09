<?php
/****************************************************************************
*																			*
*	File:		init.php  													*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file initializes php.									*
*																			*
****************************************************************************/

//	Load class and function definitions

spl_autoload_register(function ($class_name)
{
	require_once("classes/$class_name.php");
});

require_once('includes/php_session/util.php');
require_once('includes/php_session/globals.php');

//	Resume session

resumeSession();
// clearSession();
