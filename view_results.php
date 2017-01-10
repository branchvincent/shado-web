<?php
/****************************************************************************
*																			*
*	File:		view_results.php 											*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file defines the results page.							*
*																			*
****************************************************************************/

//	Initialize session

	require_once('includes/php_session/init.php');

//	Include headers

	$page_title = 'Results';
	require_once('includes/page_parts/header.php');
	require_once('includes/page_parts/side_navigation.php');
	require_once('includes/results/operator_calculations.php');
	require_once('includes/results/operator.html');
?>
			<br><br><br>
		</div>

		<div id="bottomNav" style="padding-left: 200px">
			<ul>
				<!-- <li>
					<button type="button" class="button remove" onclick="location.href='final_report.php';" style="color: black">Print Report</button>
				</li> -->
				<li>
					<button class="button" type="button" onclick="location.href='basic_settings';" style="color: black">&#8678 Change Inputs</button>
				</li>
				<!-- <li>
					<button type="button" class="button hide remove" onclick="location.href='view_detailed_results?operator=engineer';" style="color: black;">Detailed Results &#8680</button>
				</li> -->
			</ul>
		</div>

<?php require_once('includes/page_parts/footer.php'); ?>
