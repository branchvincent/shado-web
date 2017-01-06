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

//	Start session

	session_start();

	echo "INIT!" . "\r\n";

	spl_autoload_register(function ($class_name)
	{
    	include("classes/$class_name.php");
	});

	require_once('classes/parameters.php');
	// require_once('classes/database.php');
	// require_once('classes/operator.php');
	// require_once('classes/task.php');

	if (empty($_SESSION['session_started']))
	{
		echo "NEW SESSION!";

		$_SESSION['session_id'] = uniqid();
	    $dir = sys_get_temp_dir() . '/' . $_SESSION['session_id'];
	    mkdir($dir);
	    $_SESSION['session_dir'] = $dir . '/';
	    $_SESSION['des_version'] = '1.0.0';

		$_SESSION['parameters'] = new Parameters('includes/session_management/default_params.txt');
		$_SESSION['defaults'] = new Parameters('includes/session_management/default_params.txt');

		$_SESSION['database'] = new Database;

		// $_SESSION['session_started'] = true;
	    // $_SESSION['session_results'] = false;
	}
	else
	{
		echo "SESSION AREADY STARTED!";
		print_r($_SESSION);
	}

// /****************************************************************************
// *																			*
// *	Function:	connect_database											*
// *																			*
// *	Purpose:	To create and return a connection to a mySQL database 		*
// *																			*
// ****************************************************************************/
//
// function connect_database() {
//
// //	Store login credentials
//
// 	$servername = "localhost";
// 	$username = "show_usr";
// 	$password = "trainz";
// 	$dbname = "show_des";
//
// //	Create and check connection
//
// 	$conn = new mysqli($servername, $username, $password, $dbname);
//
// 	if ($conn->connect_error) {
// 	    die("Database connection failed: " . $conn->connect_error);
// 	}
//
// //	Return connection
//
// 	return $conn;
// }
//
// /****************************************************************************
// *																			*
// *	Function:	update_database()											*
// *																			*
// *	Purpose:	To update the mySQL database						 		*
// *																			*
// ****************************************************************************/
//
// function update_database() {
//
// 	$conn = connect_database();
// 	$sql = 'INSERT INTO
// 				runs(
// 					session_folder_name,
// 					show_des_version,
// 					start_time,
// 					end_time,
// 					hours,
// 					traffic_levels,
// 					reps,
// 					operators,
// 					num_task_types
// 				)
// 			values(
// 				"' . $_SESSION['session_id'] . '",' .
// 				'"' . $_SESSION['des_version'] . '",' .
// 				'"' . substr($_SESSION['parameters']['begin'], 0, -3) . '",' .
// 				'"' . substr($_SESSION['parameters']['end'], 0, -3) . '",' .
// 				'"' . $_SESSION['parameters']['hours'] . '",' .
// 				'"' . implode(", ", $_SESSION['parameters']['traffic_nums']) . '",' .
// 				'"' . $_SESSION['parameters']['reps'] . '",' .
// 				'"' . implode(", ", $_SESSION['parameters']['assistants']) . '",' .
// 				'"' . sizeof($_SESSION['tasks']) .
// 			'")';
//
// 	if ($conn->query($sql) === TRUE) {
// 		$run_id = $conn->insert_id;
// 	} else {
// 		echo "Error: " . $sql . "<br>" . $conn->error;
// 	}
//
// 	$num = 0;
// 	foreach (array_keys($_SESSION['tasks']) as $task) {
//
// 		$taskArr = $_SESSION['tasks'][$task];
// 		$ops = array();
// 		foreach ($_SESSION['parameters']['assistants'] as $assistant)
// 			if (in_array($num, $_SESSION['assistants'][$assistant]['tasks']))
// 				$ops[] = $assistant;
// 		$num++;
//
// 		$sql = 'INSERT INTO
// 					task_settings(
// 						run_id,
// 						name,
// 						priority,
// 						arrival_distribution_type,
// 						arrival_distribution_parameters,
// 						service_distribution_type,
// 						service_distribution_parameters,
// 						expiration_distribution_type,
// 						expiration_distribution_parameters_low_traffic,
// 						expiration_distribution_parameters_high_traffic,
// 						affected_by_traffic,
// 						operator_names
// 					)
// 				values(
// 					"' . $run_id . '",' .
// 					'"' . $task . '",' .
// 					'"' . implode(", ", $taskArr['priority']) . '",' .
// 					'"' . $taskArr['arrDist'] . '",' .
// 					'"' . implode(", ", $taskArr['arrPms']) . '",' .
// 					'"' . $taskArr['serDist'] . '",' .
// 					'"' . implode(", ", $taskArr['serPms']) . '",' .
// 					'"' . $taskArr['expDist'] . '",' .
// 					'"' . implode(", ", $taskArr['expPmsLo']) . '",' .
// 					'"' . implode(", ", $taskArr['expPmsHi']) . '",' .
// 					'"' . implode(", ", $taskArr['affByTraff']) . '",' .
// 					'"' . implode(", ", $ops) .
// 				'")';
//
// 		if ($conn->query($sql) === TRUE) {
// 		} else {
// 			echo "Error: " . $sql . "<br>" . $conn->error;
// 		}
// 	}
// }

/****************************************************************************
*																			*
*	Function:	create_param_file()											*
*																			*
*	Purpose:	To create a parameter file with the current session values	*
*																			*
****************************************************************************/

// function create_param_file() {
// 	// unlink($_SESSION['files']['params']) or die("did not unlink");
// 	// $_SESSION['files']['params'] = tempnam(sys_get_temp_dir(), "params");
//
// 	$file = fopen($_SESSION['session_dir'] . "params", "w") or die("Unable to open parameter file. Please return to check and update your settings.");
// 	fwrite($file, "output_path\t\t" . $_SESSION['session_dir'] . "\n");
// 	fwrite($file, "num_hours\t\t" . $_SESSION['parameters']['hours'] . "\n");
// 	fwrite($file, "traff_levels\t" . implode(" ", $_SESSION['parameters']['traffic_chars']) . "\n");
// 	fwrite($file, "num_reps\t\t" . $_SESSION['parameters']['reps'] . "\n");
// 	fwrite($file, "num_ops\t\t\t" . sizeof($_SESSION['parameters']['assistants']) . "\n");
// 	fwrite($file, "num_tasks\t\t" . sizeof($_SESSION['tasks']) . "\n");
//
// //	Write operator data
//
// 	foreach ($_SESSION['parameters']['assistants'] as $assistant) {
// 		fwrite($file, "\nop_name\t\t\t$assistant\n");
// 		fwrite($file, "tasks\t\t\t" . implode(" ", $_SESSION['assistants'][$assistant]['tasks']) . "\n");
// 	}
//
// 	foreach (array_keys($_SESSION['tasks']) as $task) {
// 		$taskArr = $_SESSION['tasks'][$task];
// 		fwrite($file, "\ntask_name\t\t$task\n");
// 		fwrite($file, "prty\t\t\t" . implode(" ", $taskArr['priority']) . "\n");
// 		fwrite($file, "arr_dist\t\t" . $taskArr['arrDist'] . "\n");
// 		fwrite($file, "arr_pms\t\t\t" . implode(" ", $taskArr['arrPms']) . "\n");
// 		fwrite($file, "ser_dist\t\t" . $taskArr['serDist'] . "\n");
// 		fwrite($file, "ser_pms\t\t\t" . implode(" ", $taskArr['serPms']) . "\n");
// 		fwrite($file, "exp_dist\t\t" . $taskArr['expDist'] . "\n");
// 		fwrite($file, "exp_pms_lo\t\t" . implode(" ", $taskArr['expPmsLo']) . "\n");
// 		fwrite($file, "exp_pms_hi\t\t" . implode(" ", $taskArr['expPmsHi']) . "\n");
// 		fwrite($file, "aff_by_traff\t" . implode(" ", $taskArr['affByTraff']) . "\n");
// 	}
//
// 	fclose($file);
// }
