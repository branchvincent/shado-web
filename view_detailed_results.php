<?php
	require_once('includes/php_session/init.php');

	$html_head_insertions = '<script src="http://d3js.org/d3.v3.min.js"></script>' . "\r\n\t\t";
	$html_head_insertions .= '<script type="text/javascript" src="includes/results/d3_graph.js"></script>';
	$page_title = 'Detailed Analysis';
	require_once('includes/page_parts/header.php');
	require_once('includes/page_parts/side_navigation.php');
	require_once('includes/results/graph_navBar_calculations.php');
?>

<?php if ($_GET != 'dispatcher'):
	<div class="centerOuter">
		<div class="startEndTime stepBox" style="width: 220px;">
			<!-- <div class='stepCircle'>1</div> -->
			<h3 class='whiteFont'>
				What Batch Do You Want to See?
				<?=Util::createTooltip('Enter the batch number.')?>
			</h3>

			<select>
				<?=Util::getSelectOptions(range(1,3), 1)?>
			</select>
		</div>
	</div>
<?php endif?>

	<div class="centerOuter">
		<div style="width: 220px;">
			
		</div>
	</div>

	<div id="bottomNav">
		<ul>
			<li>
				<button class="button" type="button" onclick="location.href='view_results.php';" style="color: black">&#8678 Results</button>
			</li>
			<li>
				<button type="button" class="button" onclick="location.href='sim_summary.php';" style="color: black; visibility: hidden;">Print Report</button>
			</li>
			<!-- <li>
				<button type="button" class="button" onclick="location.href='sim_summary.php';" style="color: black;">Preview Report &#8680</button>
			</li> -->
		</ul>
	</div>

<?php
	require_once('includes/page_parts/footer.php');
?>
