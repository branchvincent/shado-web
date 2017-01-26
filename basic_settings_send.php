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

	// $data = array(
	// 	'hours' => $_POST['num_hours'],
	// 	'begin' => $_POST['begin_time'],
	// 	'end' => $_POST['end_time'],
	// 	'traffic' => $_POST['traffic_levels']
	// );

	$_SESSION['parameters']->hours = $_POST['num_hours'];
	$_SESSION['parameters']->begin = $_POST['begin_time'];
	$_SESSION['parameters']->end = $_POST['end_time'];
	$_SESSION['parameters']->traffic = $_POST['traffic_levels'];
	$_SESSION['parameters']->setActiveAgents(array_keys($_POST['assistants']));

//	Store custom operator tasks

	// if (isset($_POST['assistants']['custom'])) {
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
	elseif (isset($_POST['adv_settings']))
	{
        header('Location: adv_settings');
    }
	else
	{
        die("Could not determine action. Please return to check and update your settings.");
    }
