<?php
/****************************************************************************
*                                                                           *
*	File:		util.php                                                    *
*																            *
*	Author:		Branch Vincent                                              *
*																			*
*	Purpose:	To define utility functions. 			                    *
*													     				    *
****************************************************************************/

/****************************************************************************
*																			*
*	Function:	resumeSession           									*
*																			*
*	Purpose:	To resume the current session or, if necessary, initialize  *
*               a new session                  	                            *
*																			*
****************************************************************************/

function resumeSession()
{
//  Start session

    if (session_status() == PHP_SESSION_NONE)
    {
    	session_start();
    }

//  Initiliaze new session, if necessary

    if (empty($_SESSION))
    {
        initSession();
    }
}

/****************************************************************************
*																			*
*	Function:	initSession           										*
*																			*
*	Purpose:	To initialize a new session                  	            *
*																			*
****************************************************************************/

function initSession()
{
//  Create session variables

    $_SESSION['session_id'] = uniqid();
    $dir = sys_get_temp_dir() . "/" . $_SESSION['session_id'];
    mkdir($dir);
    $_SESSION['session_dir'] = $dir . '/';
    $_SESSION['des_version'] = '1.0.0';

//  Create parameters

    $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
    $_SESSION['defaults'] = new Parameters('includes/php_session/default_params.txt');
    $_SESSION['database'] = new Database;

//  Start session

    $_SESSION['session_results'] = false;
}

/****************************************************************************
*																			*
*	Function:	clearSession           										*
*																			*
*	Purpose:	To clear the current session                  	            *
*																			*
****************************************************************************/

function clearSession()
{
    $_SESSION = array();
    initSession();
}

/****************************************************************************
*																			*
*	Function:	resetTasks           										*
*																			*
*	Purpose:	To reset the tasks                  	                    *
*																			*
****************************************************************************/

function resetTasks()
{
    $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
}

/****************************************************************************
*																			*
*	Function:	           										*
*																			*
*	Purpose:	To reset the tasks                  	                    *
*																			*
****************************************************************************/

function updateParameters()
{
    $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
}
