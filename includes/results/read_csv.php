<?php

	function read_csv($file_name, $op_name) {

		require_once('includes/session_management/init.php');
		$task_names = array_keys($_SESSION['tasks']);
		// print_r($task_names);

		$file = fopen($file_name,'r') or die("Could not open $file_name! ");
		$count = array();
		$check = 0;
		$skip = 1;

		while (!feof($file)) {
			$line_of_text = fgetcsv($file,2048,',');

			if($line_of_text[1] == "Sum") {

				$cols = count($line_of_text);
				$_SESSION['results'][$op_name]['sum'] = array();
				$_SESSION['results'][$op_name]['low_count'] = 0;
				$_SESSION['results'][$op_name]['med_count'] = 0;
				$_SESSION['results'][$op_name]['high_count'] = 0;
				$_SESSION['results'][$op_name]['simLength'] = $cols-2;

			//	Read in sum line and then exit loop

				for ($i = 2; $i < $cols; $i++)
				{
					$value=(float)$line_of_text[$i];
					$_SESSION['results'][$op_name]['sum'][] = $value;

					if($value<0.3) {
						$_SESSION['results'][$op_name]['low_count']++;
					} else if($value<0.7) {
						$_SESSION['results'][$op_name]['med_count']++;
					} else {
						$_SESSION['results'][$op_name]['high_count']++;
					}
				}

				break;
			}

		//	Skip first line

			if($check==0)
			{
				$check++;
				continue;
			}


		//	Read in even lines

			if ($skip==1) {
				$cols = count($line_of_text);
				$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['Utilization'] = array();
				$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['phase1']['Utilization'] = array();
				$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['phase2']['Utilization'] = array();
				$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['phase3']['Utilization'] = array();

			//	Read in values

				for ($i = 2; $i < $cols; $i++)
				{
					$value=(float)$line_of_text[$i];
					$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['Utilization'][] = $value;
					if ($i<5)
					{
						$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['phase1']['Utilization'][] = $value;
					}
					else if ($i>($cols-4))
					{
						$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['phase3']['Utilization'][] = $value;
					}
					else
					{
						$_SESSION['tasks'][$task_names[(float)$line_of_text[1]]]['results'][$op_name]['phase2']['Utilization'][] = $value;
					}
				}

				$skip = 0;

				continue;
			}

		//	Skip odd lines

			if ($skip == 0) {
				$skip = 1;
			}
		}
		// print "<pre>";
		// print_r($_SESSION['tasks']);
		// print "</pre>";
		//
		// print "<pre>";
		// print_r($_SESSION['results']);
		// print "</pre>";
	}
?>
