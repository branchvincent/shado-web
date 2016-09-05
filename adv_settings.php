<?php
	// session_start();
	$page_title='Advanced Settings';
	$curr_page='advSettingsPage';
	$html_head_insertions .= '<script type="text/javascript" src="scripts/adv_settings.js"></script>';
	require_once("includes/page_parts/header.php");
	require_once("includes/run_sim/side_navigation.php");
?>
			<div id="settingsPage" class="page">
				<div id="myData" class="hidden" data-session='<?php echo json_encode($_SESSION)?>'></div>
				<h1 class="pageTitle">Input Advanced Trip Conditions</h1>
				<form id="taskParameters" action="adv_settings_send.php" method="post">
					<h2>Replications</h2>
					Enter the number of replications, or the number of simulated trips. Note that more trips provides more precise results, but it may also increase the processing time.
					<div class="centerOuter">
						<div class="stepBox startEndTime">
							<h3 class="whiteFont" style="width: 150px;">Number of Replications: <span class="tooltip" onmouseover="tooltip.pop(this, 'You might be wondering how many trips you need. Well, it depends on how precise and robust you want the model to test parameters. The more replications, generally, the more precise the stochastic results since there are more instances to test out different situations. However, more replications may increase the processing time.')">(?)</span></h3>
							<select name='num_reps'>
								<?php
									for ($i = 100; $i <= 1000; $i+=100) {
										if ($i==$_SESSION['numReps']) { $selected_string = ' selected="selected"'; } else { $selected_string = ''; }
										$val = sprintf('%02d', $i);
										echo "<option$selected_string>$val</option>";
									}
								?>
							</select>
						</div>
					</div>

					<h2>Task Details</h2>
					Below, you can see and change the underlying assumptions for each task.
					<!-- <form id="taskParameters" action="adv_settings_send.php" method="post"> -->
					<div id='taskParameterTable'>
						<?php
							for ($i = 0; $i < $_SESSION['numTaskTypes']; $i++) {
								$taskNum = $i;
								echo "<div id=task_".$taskNum.">";
						        include("includes/adv_settings/task_settings_table.php");
								echo "<br> </div>";
						    }
						?>
					</div>
					<div style="text-align: center;">
						<input type="submit" id="submit" value="Save and Return" style="text-align: center;">
					</div>
				</form>
				<div>
					<button type="button" class="roundButton" onclick="addTask()" style="background-color: #4CAF50;"><strong>+</strong></button>
				</div>
				<div style="text-align: center;">
					<button class="button" onclick="location.href='reset_session_vars.php';" style="color: black;">Restore Defaults</button>
				</div>
			</div>

<?php
	require_once("includes/page_parts/footer.php");
?>