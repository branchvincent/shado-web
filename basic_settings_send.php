<?php
/****************************************************************************
*																			*
*	File:		basic_settings_send.php  									*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file gets and stores the basic settings.				*
*																			*
****************************************************************************/

//	Start session

	require_once('includes/php_session/init.php');

//	Store time

	$_SESSION['parameters']->hours = $_POST['num_hours'];
	$_SESSION['parameters']->begin = $_POST['begin_time'];
	$_SESSION['parameters']->end = $_POST['end_time'];

//  Store traffic levels

	$_SESSION['parameters']->traffic = array();

	for ($i = 0; $i < $_SESSION['parameters']->hours; $i++)
	{
		$_SESSION['parameters']->traffic[$i] = $_POST["traffic_level_$i"];
	}

//  Store assistants

    // $_SESSION['parameters']->operators = array();
    // $_SESSION['parameters']['assistants'][] = 'engineer';

	for ($i = 0; $i < sizeof($_SESSION['parameters']->operators); $i++)
	{
		if (isset($_POST["assistant_$i"]))
		{
			$_SESSION['parameters']->operators[$i]->active = true;
		}
		else
		{
			$_SESSION['parameters']->operators[$i]->active = false;
		}
	}

//	Store custom operator tasks

	// if (isset($_POST['assistant_4'])) {
	// 	$_SESSION['assistants']['custom']['name'] = $_POST['custom_op_name'];
	// 	$_SESSION['assistants']['custom']['tasks'] = array();
	// 	for ($i = 0; $i < sizeof($_SESSION['tasks']); $i++)
	// 		if (isset($_POST['custom_op_task_' . $i]))
	// 			$_SESSION['assistants']['custom']['tasks'][] = $i;
	// }

//	Continue to next page

    if (isset($_POST['run_sim']))
	{
        header('Location: run_sim');
    }
	else if (isset($_POST['adv_settings']))
	{
        header('Location: adv_settings');
    }
	else
	{
        die("Could not determine action. Please return to check and update your settings.");
    }
