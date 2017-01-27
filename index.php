<?php
/****************************************************************************
*																			*
*	File:		index.php  													*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file sets the homepage.								*
*																			*
****************************************************************************/

//	Initialize session

	require_once('includes/php_session/init.php');

//	Include headers

	$PAGE_TITLE = 'SHADO';
	require_once('includes/page_parts/header.php');
?>
	<div id="homePage" class="page">
		<h1 class="pageTitle">Welcome to SHADO!</h1>
		<h2>Introduction</h2>
		<p>
			Welcome to the <u>S</u>imulator of <u>H</u>umans and <u>A</u>utomation in <u>D</u>ispatch <u>O</u>perations (SHADO)! This tool, designed by Duke University researchers, simulates the workload of a dispatch operator and associated freight rail operators across the duration of a given shift. With SHADO, you can choose a trip with unique conditions and then see the operators' average workload after thousands of similar shifts.
		</p>
		<p>
			You should use this tool to answer the following questions:
			<ul style="margin-top: -15px;">
				<li><em>When</em> are my operators over or under-utilized at work?</li>
				<li><em>Why</em> are my operators over or under-utilized at work?</li>
				<li><em>How</em> might we improve operator workload, as well as overall system efficiency and safety?</li>
			</ul>
		</p>
		<h2>Background</h2>
		<p>
			A core set of tasks has been defined and implemented to encompass tasks that rail crew members may encounter during their trip. These tasks and their descriptions are summarized below. To see more underlying assumptions, visit advanced settings.
			<table align="center" width="1000" style="margin-top: 30px;">
			    <tr>
			        <th>Task Type</th>
			        <th>Description</th>
			    </tr>
			<?php foreach (array_keys(Util::$ENGINEER_TASK_DESCRIPTIONS) as $task_name): ?>
				<tr>
					<td><?=ucwords($task_name)?></td>
					<td><?=Util::$ENGINEER_TASK_DESCRIPTIONS[$task_name]?></td>
				</tr>
			<?php endforeach ?>
			</table>
		</p>
		<h2>Getting Started</h2>
		<p>
			 Note that this site is currently only compatible with Chrome and Firefox. If you're ready to get started, then let's <a href="basic_settings.php">go</a>! And if you encounter any issues or have questions about the simulation, please <a href="contact_us.php">contact us</a>!
		</p>
	</div>

	<footer style='text-align: center; padding: 20px 0; font-size: 18;'>
		<strong>NOTE: </strong>This decision support tool is intended to inform rather than dictate decisions.
	</footer>
<?php require_once('includes/page_parts/footer.php');?>
