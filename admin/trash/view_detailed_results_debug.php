<?php
/****************************************************************************
*																			*
*	File:		view_detailed_results.php  									*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file defines the View Detailed Analysis page. 			*
*																			*
****************************************************************************/

//	Initialize session

	require_once('includes/session_management/init.php');

//	Include headers

	$html_head_insertions = '<script src="http://d3js.org/d3.v3.min.js"></script>' . "\r\n\t\t";
	$html_head_insertions .= '<script type="text/javascript" src="scripts/d3_graph.js"></script>';
	$page_title = 'Detailed Analysis';
	require_once('includes/page_parts/header.php');
	require_once('includes/page_parts/side_navigation.php');
?>
	<div class="centerOuter">
		<br>
		<br>
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

	<div class="centerOuter">
		<img src="img.png">
	</div>

	<div id="bottomNav">
		<ul>
			<li>
				<button class="button" type="button" onclick="location.href='view_results.php';" style="color: black">&#8678 Results</button>
			</li>
			<li>
				<button type="button" class="button" onclick="location.href='final_report.php';" style="color: black; visibility: hidden;">Print Report</button>
			</li>
			<li>
				<button type="button" class="button" onclick="location.href='final_report.php';" style="color: black;">Preview Report &#8680</button>
			</li>
		</ul>
	</div>

<?php require_once('includes/page_parts/footer.php');?>
