<?php
/****************************************************************************
*																			*
*	File:		basic_settings.php  										*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This page allows the user to change basic settings for the 	*
*				simulation. 												*
*																			*
****************************************************************************/

//	Initialize session

	require_once('includes/php_session/init.php');

//	Include headers

	$PAGE_TITLE = 'Run Simulation';
	$HTML_HEADER = '<script type="text/javascript" src="scripts/basic_settings.js"></script>';
	$HTML_HEADER .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>';
	require_once('includes/page_parts/header.php');
	require_once('includes/page_parts/side_navigation.php');
?>
	<div id="runSimulationPage" class="page">
		<h1 class="pageTitle">Input Basic Trip Conditions</h1>
		<p>
			To get started, provide the following information. Then, you can either run the simulation or change more assumptions.
		</p>
		<br>
		<div class="">
			<strong>Batch:</strong>
			<select id='batch' onchange="">
				<?php
					$batch = (int)substr($_SESSION['parameters']->end, 3, 5);
					for ($i = 1; $i <= 5; $i++) {
						$selected = '';
						if ($i == $batch) $selected = ' selected="selected"';
						// $val = sprintf('%02d', $i);
						echo "<option$selected>$i</option>";
					}
				?>
			</select>
		</div>

		<!-- <div style="width: 100%; float: right;">
			<form action="adv_settings.php">
				<button class="button" type="submit" style="float: right; color: black;">
					<img src="images/settings-gear.png" width="40" height="40" align="top">
					<div style="display: inline-block;  text-align: left; padding: 3px;">
						Advanced <br> Settings
					</div>
				</button>
			</form>
		</div> -->

		<form class="centerOuter" action="adv_settings_debug" method="post">
			<div class="centerOuter">
				<div class="startEndTime stepBox" style="width: 220px;">
					<div class='stepCircle'>1</div>
					<h3 class="whiteFont">How Many Trains In This Batch? <span class="hint--bottom-right hint--rounded hint--large" aria-label= "Enter the number of trains that are in this batch."><sup>(?)</sup></span></h3>

					<select id='beginMin' onchange="calculate_time();">
						<?php
							$min = (int)substr($_SESSION['parameters']->end, 3, 5);
							for ($i = 1; $i <= 15; $i++) {
								$selected = '';
								if ($i == $min) $selected = ' selected="selected"';
								$val = sprintf('%02d', $i);
								echo "<option$selected>$val</option>";
							}
						?>
					</select>
					<input id="begin_time" name="begin_time" type="hidden" value="<?php echo $_SESSION['parameters']->begin;?>">
				</div>
				<br>
				<div class="startEndTime stepBox" style="width: 220px;">
					<div class='stepCircle'>2</div>
					<h3 class="whiteFont">When Does Your Trip Begin? <span class="hint--bottom-right hint--rounded hint--large" aria-label= "Enter the time of day that your engineer begins his/her shift."><sup>(?)</sup></span></h3>

					<select id='beginHour' onchange="calculate_time();">
						<?php
							$hr = (int)substr($_SESSION['parameters']->begin, 0, 2);
							for ($i = 1; $i <= 12; $i++) {
								$selected = '';
								if ($i == $hr) $selected = ' selected="selected"';
								$val = sprintf('%02d', $i);
								echo "<option$selected>$val</option>";
							}
						?>
					</select>:<select id='beginMin' onchange="calculate_time();">
						<?php
							$min = (int)substr($_SESSION['parameters']->end, 3, 5);
							for ($i = 0; $i <= 50; $i+=10) {
								$selected = '';
								if ($i == $min) $selected = ' selected="selected"';
								$val = sprintf('%02d', $i);
								echo "<option$selected>$val</option>";
							}
						?>
					</select>
					<select id='beginMd' onchange="calculate_time();">
						<?php
							$options = ['AM', 'PM'];
							$md = substr($_SESSION['parameters']->begin, 6);
							for ($i = 0; $i < sizeof($options); $i++) {
								$selected = '';
								if ($options[$i] == $md) $selected = ' selected="selected"';
								echo "<option$selected>$options[$i]</option>";
							}
						?>
					</select>
					<input id="begin_time" name="begin_time" type="hidden" value="<?php echo $_SESSION['parameters']->begin;?>">
				</div>

				<div class="startEndTime stepBox" style="width: 220px;">
					<div class='stepCircle'>3</div>
					<h3 class="whiteFont">When Does Your Trip End? <span class="hint--bottom-left hint--rounded hint--large" aria-label="Enter the time of day that your engineer is expected to end his/her shift."><sup>(?)</sup></span></h3>

					<select id='endHour' onchange="calculate_time();">
						<?php
							$hr = (int)substr($_SESSION['parameters']->end, 0, 2);
							for ($i = 1; $i <= 12; $i++) {
								$selected = '';
								if ($i == $hr) $selected = ' selected="selected"';
								$val = sprintf('%02d', $i);
								echo "<option$selected>$val</option>";
							}
						?>
					</select>:<select id='endMin' onchange="calculate_time();">
						<?php
							$min = (int)substr($_SESSION['parameters']->end, 3, 5);
							for ($i = 0; $i <= 50; $i+=10) {
								$selected = '';
								if ($i == $min) $selected = ' selected="selected"';
								$val = sprintf('%02d', $i);
								echo "<option$selected>$val</option>";
							}
						?>
					</select>
					<select id='endMd' onchange="calculate_time();">
						<?php
							$options = ['AM', 'PM'];
							$md = substr($_SESSION['parameters']->end, 6);
							for ($i = 0; $i < sizeof($options); $i++) {
								$selected = '';
								if ($options[$i] == $md) $selected = ' selected="selected"';
								echo "<option$selected>$options[$i]</option>";
							}
						?>
					</select>
					<input id="end_time" name="end_time" type="hidden" value="<?php echo $_SESSION['parameters']->end;?>">
					<input id="num_hours" name="num_hours" type="hidden" value="<?php echo $_SESSION['parameters']->hours;?>">
				</div>
			</div>

			<div class="trafficTableStepOuter stepBox centerOuter">
				<div class='stepCircle'>4</div>
					<h3 class="whiteFont">
						What are the Traffic Levels?
						<span class="hint--right hint--rounded hint--large" aria-label= "Enter the local levels of traffic during this shift. This will modify the frequency of certain task arrivals."><sup>(?)</sup></span>
					</h3>
					<div id="totalTime" style="overflow-x:auto;">
						<table id='table' class='trafficTable remove'>
							<?php
								echo '<tr id="traffic_levels">';
								$chars = ['h', 'm', 'l'];
								$labels = ['High', 'Med', 'Low'];
								for ($i = 0; $i < $_SESSION['parameters']->hours; $i++) {
									$val = $_SESSION['parameters']->traffic[$i];
									echo '<td>';
									for ($j = 0; $j < sizeof($labels); $j++) {
										$selected = '';
										if ($chars[$j] == $val) $selected = ' checked';
										echo "<input type='radio' name='traffic_level_$i' value='$chars[$j]'$selected>$labels[$j]</input><br>";
									}
									echo '</td>';
								}
								echo '</tr>';
								echo '<tr id="traffic_level_labels">';
								echo '</tr>';
							?>
						</table>

				</div>
			</div>
			<br><br>
			<div class="assistantsSelectStepOuter stepBox centerOuter">
				<div class='stepCircle'>5</div>
				<h3 id='assistants' class='whiteFont'>Who Will Assist the Engineer? <span class="hint--right hint--rounded hint--large" aria-label= "Identify any humans or technologies that will support the locomotive engineer. SHOW models their interaction by offloading certain tasks from the engineer."><sup>(?)</sup></span></h3>
				<div id="assist">
					<table id="assistantsTable" cellspacing="0">
						<tr>
							<?php
								$assistants = $_SESSION['parameters']->operators;
								for ($i = 1; $i < sizeof($assistants); $i++) {
									$assistant = $assistants[$i];
									$selected = '';
									if ($assistant->active) {
										$selected = ' checked';
									}
									echo '<td><input ';
									if ($assistant->name == 'custom') echo 'id="custom_assistant" onchange="toggle_custom_settings();"';
									echo 'type="checkbox" name="assistant_' . $i . '"' . $selected . '>' . ucwords($assistant->name) . ' ';
									echo "<span class='hint--right hint--rounded hint--large' aria-label= '". $assistant->description . "'><sup>(?)</sup></span>";
									echo '</td>';
								}
							?>
						</tr>
					</table>
				</div>
			</div>
			<br>
			<div class="custom remove" id="custom_assistant_settings">
				<div class='stepCircle'>5</div>

				<h3 id='custom_heading' class='whiteFont'>Which Tasks Will This Custom Assistant Handle? <span class="hint--right hint--rounded hint--large" aria-label= "Identify which tasks the custom assistant can offload from the locomotive engineer."><sup>(?)</sup></span></h3>
				<br>
				<table id='custom_table'>
					<tr>
						<?php $custom_name = $_SESSION['assistants']['custom']['name']; ?>
						<th>Assistant Name:</td>
						<td><input type='text' name="custom_op_name" value="<?php if ($custom_name != 'custom') echo ucwords($custom_name); ?>"></input></td>
					</tr>
				<?php
					if (isset($_SESSION['assistants']['custom']))
						$custom_tasks = $_SESSION['assistants']['custom']['tasks'];
					else
						$custom_tasks = array();
					$task_names = array_keys($_SESSION['tasks']);

					$i = 0;
					foreach ($task_names as $task) {
						echo "<tr><td>" . ucwords($task) . " <span class='hint--right hint--rounded hint--large' aria-label= '".  $_SESSION['tasks'][$task]['description'] . "'>";
						echo '<sup>(?)</sup></span></td><td>';
						echo '<input type="checkbox" name="custom_op_task_' . $i . '"';
						if (in_array($i++, $custom_tasks)) echo ' checked';
						echo '></input>';
						echo '</td></tr>';
					}
				?>
				</table>
			</div>

			<br>
			<div id="bottomNav">
				<ul>
					<li>
						<button class="button hide" type="button" onclick="location.href='adv_settings';" style="color: black;">&#8678 Run Simulation</button>
					</li>
					<li>
						<input type="submit" class="button" name="adv_settings" style="color: black;" value="Advanced Conditions">
					</li>
					<li>
						<button type="submit" class="button" name="run_sim" style="background-color: #4CAF50;">Run Simulation &#8680</button>
					</li>
				</ul>
			</div>
		</form>
	</div>
<?php require_once('includes/page_parts/footer.php');?>
