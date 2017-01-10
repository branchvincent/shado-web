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

	require_once('includes/php_session/init.php');

//	Include headers

	$html_head_insertions = '<script src="http://d3js.org/d3.v3.min.js"></script>' . "\r\n\t\t";
	$html_head_insertions .= '<script type="text/javascript" src="scripts/d3_graph.js"></script>';
	$page_title = 'Detailed Analysis';
	require_once('includes/page_parts/header.php');
	require_once('includes/page_parts/side_navigation.php');
	// require_once('includes/results/d3_graph.php');
	echo "<div id='page' class='page'>";
	if ($_GET['operator'] == 'conductor') {
		$assistant = "conductor";
		require_once('includes/results/d3_graph.php');
		createGraphCsv('conductor');
		graphText('conductor');
		echo "</div>";
	} else if ($_GET['operator'] == 'engineer') {
		$assistant = "Engineer";
		require_once('includes/results/d3_graph.php');
		createGraphCsv('engineer');
		graphText('engineer');
		echo "</div>";
	} else {
		die('There was an error');
	}
?>
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
