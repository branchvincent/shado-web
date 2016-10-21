<?php

	function graphText($op_name) {

		session_start();

		$task_names = array_keys($_SESSION['tasks']);

	//	Initialize values

		for ($i=0; $i<count($task_names); $i++)
		{
			$_SESSION['tasks'][$task_names[$i]]['results'][$op_name]['phase1']['high'] = 0;
			$_SESSION['tasks'][$task_names[$i]]['results'][$op_name]['phase1']['low'] = 0;

			$_SESSION['tasks'][$task_names[$i]]['results'][$op_name]['phase2']['high'] = 0;
			$_SESSION['tasks'][$task_names[$i]]['results'][$op_name]['phase2']['low'] = 0;

			$_SESSION['tasks'][$task_names[$i]]['results'][$op_name]['phase3']['high'] = 0;
			$_SESSION['tasks'][$task_names[$i]]['results'][$op_name]['phase3']['low'] = 0;

			$_SESSION['results'][$op_name]['Utilization'][$task_names[$i]] = array_sum($_SESSION['tasks'][$task_names[$i]]['results'][$op_name]['Utilization']);
			$_SESSION['results'][$op_name]['counts']['high'][$task_names[$i]] = 0;
			$_SESSION['results'][$op_name]['counts']['low'][$task_names[$i]] = 0;

		}

	//	Set values

		for ($i=0; $i < $_SESSION['results'][$op_name]['simLength']; $i++)
		{

		//	For each task...

			for ($j=0; $j<count($task_names); $j++)
			{
			//	High workload

				if ($_SESSION['results'][$op_name]['sum'][$i] > 0.7)
				{
				//	Phase 1

					if ($i < 3)
					{
						$util = $_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['Utilization'][$i];
						$length = count($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase1']['Utilization']);
						$sum = array_sum($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase1']['Utilization']);

						if($util > ($sum/$length))
						{
							$_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase1']['high'] ++;
							$_SESSION['results'][$op_name]['counts']['high'][$task_names[$j]] ++;
						}
					}

				//	Phase 3

					else if ($i > ($_SESSION['results'][$op_name]['simLength'] - 4))
					{
						$util = $_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['Utilization'][$i];
						$length = count($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase3']['Utilization']);
						$sum = array_sum($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase3']['Utilization']);

						if($util > ($sum/$length))
						{
							$_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase3']['high'] ++;
							$_SESSION['results'][$op_name]['counts']['high'][$task_names[$j]] ++;
						}
					}

				//	Phase 2

					else
					{
						$util = $_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['Utilization'][$i];
						$length = count($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase2']['Utilization']);
						$sum = array_sum($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase2']['Utilization']);

						if($util > ($sum/$length))
						{
							$_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase2']['high'] ++;
							$_SESSION['results'][$op_name]['counts']['high'][$task_names[$j]] ++;
						}
					}
				}

			//	Low workload

				if ($_SESSION['results'][$op_name]['sum'][$i] < 0.3)
				{
				//	Phase 1

					if ($i < 3)
					{
						$util = $_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['Utilization'][$i];
						$length = count($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase1']['Utilization']);
						$sum = array_sum($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase1']['Utilization']);

						if($util < ($sum/$length))
						{
							$_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase1']['low'] ++;
							$_SESSION['results'][$op_name]['counts']['low'][$task_names[$j]] ++;
						}
					}

				//	Phase 3

					else if ($i > ($_SESSION['results'][$op_name]['simLength'] - 4))
					{
						$util = $_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['Utilization'][$i];
						$length = count($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase3']['Utilization']);
						$sum = array_sum($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase3']['Utilization']);

						if($util < ($sum/$length))
						{
							$_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase3']['low'] ++;
							$_SESSION['results'][$op_name]['counts']['low'][$task_names[$j]] ++;
						}
					}

				//	Phase 2

					else
					{
						$util = $_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['Utilization'][$i];
						$length = count($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase2']['Utilization']);
						$sum = array_sum($_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase2']['Utilization']);

						if($util < ($sum/$length))
						{
							$_SESSION['tasks'][$task_names[$j]]['results'][$op_name]['phase2']['low'] ++;
							$_SESSION['results'][$op_name]['counts']['low'][$task_names[$j]] ++;
						}
					}
				}
			}
		}


	//	Calculate penalty

		$penalty_high = 0;
		$count_high = 0;
		$count_low = 0;
		$count_norm = 0;
		for ($i=0; $i<$_SESSION['results'][$op_name]['simLength']; $i++)
		{
			if ($_SESSION['results'][$op_name]['sum'][$i] > 0.7)
			{
				$penalty_high = $penalty_high + (3.33 * $_SESSION['results'][$op_name]['sum'][$i] - 2.33);
				$count_high++;
			}
			else if ($_SESSION['results'][$op_name]['sum'][$i] < 0.3)
			{
				$count_low++;
			}
			else
			{
				$count_norm++;
			}
		}
		print "<pre>";
		print_r($_SESSION['tasks']);
		print "</pre>";


		print "<pre>";
		print_r($_SESSION['results']);
		print "</pre>";

		$assistant = $op_name;

		require_once('includes/results/graphTextBox/graph_navBar.php');
		require_once('includes/results/graphTextBox/graph_whenTab.php');
		require_once('includes/results/graphTextBox/graph_whyTab.php');
	}
?>
