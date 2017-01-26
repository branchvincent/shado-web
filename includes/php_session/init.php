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

//	Load class definitions

spl_autoload_register(function ($class)
{
	require_once("classes/$class.php");
});

// require_once('includes/php_session/globals.php');
// require_once('includes/php_session/util.php');

//	Resume session

Util::resumeSession();
