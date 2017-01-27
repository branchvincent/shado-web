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

//	Define local variables

	$begin_hr = (int)substr($_SESSION['parameters']->begin, 0, 2);
	$begin_min = (int)substr($_SESSION['parameters']->begin, 3, 5);
	$begin_md = substr($_SESSION['parameters']->begin, 6);

	$end_hr = (int)substr($_SESSION['parameters']->end, 0, 2);
	$end_min = (int)substr($_SESSION['parameters']->end, 3, 5);
	$end_md = substr($_SESSION['parameters']->end, 6);
?>
	<div id='runSimulationPage' class='page'>
		<h1 class='pageTitle'>Input Basic Trip Conditions</h1>
		<p>
			To get started, provide the following information. Then, you can either run the simulation or change more assumptions.
		</p>

		<!-- Form -->
		<form class='centerOuter' action='basic_settings_send' method='post'>
			<div class="centerOuter">

				<!-- Begin time -->
				<div class="startEndTime stepBox" style="width: 220px;">
					<div class='stepCircle'>1</div>
					<h3 class='whiteFont'>
						When Does This Batch Trip Begin?
						<?=Util::createTooltip('Enter the time of day that your engineer begins his/her shift.')?>
					</h3>

					<select id='beginHour' onchange='calculate_time()'>
						<?=Util::getSelectOptions(range(1,12), $begin_hr, true)?>
					</select> :

					<select id='beginMin' onchange="calculate_time()">
						<?=Util::getSelectOptions(range(0,50,10), $begin_min, true)?>
					</select>

					<select id='beginMd' onchange="calculate_time()">
						<?=Util::getSelectOptions(['AM', 'PM'], $begin_md)?>
					</select>

					<input id="begin_time" name="begin_time" type="hidden" value="<?=$_SESSION['parameters']->begin?>">
				</div>

				<!-- End time -->
				<div class="startEndTime stepBox" style="width: 220px;">
					<div class='stepCircle'>2</div>
					<h3 class="whiteFont">
						When Does This Batch Trip End?
						<?=Util::createTooltip('Enter the time of day that your engineer is expected to end his/her shift.')?>
					</h3>

					<select id='endHour' onchange="calculate_time()">
					<?=Util::getSelectOptions(range(1,12), $end_hr, true)?>
					</select> :

					<select id='endMin' onchange="calculate_time()">
					<?=Util::getSelectOptions(range(0,50,10), $end_min, true)?>
					</select>

					<select id='endMd' onchange="calculate_time()">
					<?=Util::getSelectOptions(['AM', 'PM'], $end_md)?>
					</select>

					<input id="end_time" name="end_time" type="hidden" value="<?=$_SESSION['parameters']->end?>">
					<input id="num_hours" name="num_hours" type="hidden" value="<?=$_SESSION['parameters']->hours?>">
				</div>
			</div>

			<!-- Traffic levels -->
			<div class="trafficTableStepOuter stepBox centerOuter">
				<div class='stepCircle'>3</div>
					<h3 class="whiteFont">
						What are the Batch Traffic Levels?
						<?=Util::createTooltip('Enter the local levels of traffic during this shift. This will modify the frequency of certain task arrivals.')?>
					</h3>
					<div style="overflow-x:auto;">
						<table id='table' class='trafficTable remove'>
							<tr id="trafficLevels"></tr>
							<tr id="trafficLevelLabels"></tr>
						</table>

						<input id="traffic_levels" name="traffic_levels" type='hidden' value='<?=json_encode($_SESSION['parameters']->traffic)?>'>
				</div>
			</div>

			<br><br>

			<!-- Assistants -->
		    <div class="assistantsSelectStepOuter stepBox centerOuter">
		        <div class='stepCircle'>4</div>
		        <h3 id='assistants' class='whiteFont'>Who Will Assist the Engineer?
					<?=Util::createTooltip('Identify any humans or technologies that will support the locomotive engineer. SHOW models their interaction by offloading certain tasks from the engineer.')?>
				</h3>
		        <div id="assist">
		            <table id="assistantsTable" cellspacing="0">
		                <tr>
	                    <?php
							foreach ($_SESSION['parameters']->agents as $agt):
	                        	$checked = $custom = '';
	                            if ($agt->active)
									$checked = ' checked';
								if ($agt->type == 'custom')
									$custom = ' id="custom_assistant" onchange="toggle_custom_settings()"';
								if ($agt->name == 'engineer') continue;
						?>
							<td>
		                        <input <?=$custom?> type="checkbox" name="assistants[<?=$agt->name?>]"<?=$checked?>><?=ucwords($agt->name) . " " . Util::createTooltip($agt->description)?>
							</td>
	                    <?php endforeach ?>
		                </tr>
		            </table>
		        </div>
		    </div>

			<br>

			<!-- Custom assistant settings -->
			<div class="custom remove" id="custom_assistant_settings">
		        <div class='stepCircle'>5</div>
		        <h3 id='custom_heading' class='whiteFont'>Which Tasks Will This Custom Assistant Handle?
					<?=Util::createTooltip('Identify which tasks the custom assistant can offload from the locomotive engineer.')?>
				</h3>
		        <br>
		        <table id='custom_table'>
		            <tr>
		                <?php $asst = $_SESSION['parameters']->getAgentByType('custom')?>
		                <th>Assistant Name:</td>
		                <td><input type='text' name="custom_op_name" value="<?=ucwords($asst->name)?>"></input></td>
		            </tr>
					<?php foreach ($_SESSION['parameters']->getAgentByName('engineer')->tasks as $i => $task):
							$checked = '';
							if (in_array($i, $asst->tasks)) $checked = ' checked';
					?>
						<tr>
							<td>
								<?=ucwords($_SESSION['parameters']->tasks[$i]->name);?>
							</td>
							<td>
								<input type="checkbox" name="assistants[<?=$asst->name?>][tasks][<?=$i?>]"<?=$checked?>>
								</input>
							</td>
						</tr>
			        <?php endforeach?>
		        </table>
		    </div>

			<!-- Bottom navigation -->
			<div id="bottomNav">
				<ul>
					<li>
						<button class="button hide" type="button" onclick="location.href='adv_settings';" style="color: black;">&#8678 Run Simulation</button>
					</li>
					<li>
						<input type="submit" class="button" name="adv_settings" style="color: black;" value="Advanced Conditions">
					</li>
					<li>
						<input type="submit" class="button" name="run_sim" style="background-color: #4CAF50;" value="Run Simulation &#8680">
					</li>
				</ul>
			</div>

		</form>
	</div>
<?php require_once('includes/page_parts/footer.php');?>
