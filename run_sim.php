<?php
/****************************************************************************
*																			*
*	File:		run_sim.php  												*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This page creates a parameter file, executes the 			*
*				simulation program, and shows the user a mock progress bar 	*
*				page.														*
*																			*
****************************************************************************/

//	Initialize session

	require_once('includes/php_session/init.php');

//	Update database

	if (PHP_OS == "Linux")
	{
		// $_SESSION['database']->update();
	}

//	Create parameter file and run simulation

	$_SESSION['parameters']->writeToFile($_SESSION['session_dir'] . "params");

	if (PHP_OS == "Darwin")
	{
		echo passthru("bin/des_mac " . $_SESSION['session_dir'] . "params");
	}
	else if (PHP_OS == "Linux")
	{
		exec("bin/des_unix " . $_SESSION['session_dir'] . "params");
	}
	else
	{
		die("Operating system not recognized.");
	}

	$_SESSION['session_results'] = true;
	// $data = file($_SESSION['session_dir'] . "des_status") or die('Could not open des_status!');
	//
	// 	$line = $data[count($data) - 1];
	// 	if ((int)$line > 10) {
	//
	// 	}

	$HTML_HEADER = '<link rel="stylesheet" href="styles/loading_bar.css">';
	$HTML_HEADER .= "<script src='scripts/loading_bar.js'></script>";
	require_once('includes/page_parts/header.php');
?>

				<div id="php"></div>
				<div class="progress">
					<div class="circle">
						<span class="label">1</span>
						<span class="title">Fetching Input</span>
					</div>
					<span class="bar"></span>
					<div class="circle">
						<span class="label">2</span>
						<span class="title">Formatting Data</span>
					</div>
					<span class="bar"></span>
					<div class="circle">
						<span class="label">3</span>
						<span class="title">Running Simulation</span>
					</div>
					<span class="bar"></span>
					<div class="circle">
						<span class="label">4</span>
						<span class="title">Fetching Results</span>
					</div>
				</div>

<?php require_once('includes/page_parts/footer.php');?>
