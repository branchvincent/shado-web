<?php
/****************************************************************************
*                                                                           *
*	File:		util.php                                                    *
*																            *
*	Author:		Branch Vincent                                              *
*																			*
*	Purpose:	To define utility functions. 			                    *
*													     				    *
****************************************************************************/

/****************************************************************************
*																			*
*	Section:	Session           									        *
*																			*
****************************************************************************/

/****************************************************************************
*																			*
*	Function:	resumeSession           									*
*																			*
*	Purpose:	To resume the current session or, if necessary, initialize  *
*               a new session                  	                            *
*																			*
****************************************************************************/

function resumeSession()
{
//  Start session

    if (session_status() == PHP_SESSION_NONE)
    {
    	session_start();
    }

//  Initiliaze new session, if necessary

    if (empty($_SESSION))
    {
        initSession();
    }
}

/****************************************************************************
*																			*
*	Function:	initSession           										*
*																			*
*	Purpose:	To initialize a new session                  	            *
*																			*
****************************************************************************/

function initSession()
{
//  Create session variables

    $_SESSION['session_id'] = uniqid();
    $dir = sys_get_temp_dir() . "/" . $_SESSION['session_id'];
    mkdir($dir);
    $_SESSION['session_dir'] = $dir . '/';
    $_SESSION['des_version'] = '1.0.0';

//  Create parameters

    $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
    $_SESSION['database'] = new Database;

//  Start session

    $_SESSION['session_results'] = false;
    echo "NEW SESS";
}

/****************************************************************************
*																			*
*	Function:	clearSession           										*
*																			*
*	Purpose:	To clear the current session                  	            *
*																			*
****************************************************************************/

function clearSession()
{
    $_SESSION = array();
    initSession();
}

/****************************************************************************
*																			*
*	Function:	resetTasks           										*
*																			*
*	Purpose:	To reset the tasks                  	                    *
*																			*
****************************************************************************/

function resetTasks()
{
    $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
}

/****************************************************************************
*																			*
*	Function:	           										*
*																			*
*	Purpose:	To reset the tasks                  	                    *
*																			*
****************************************************************************/

function updateParameters()
{
    $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
}

/****************************************************************************
*																			*
*	Function:     read_csv 											*
*																			*
*	Purpose:      This file fetches the simulation results.					*
*																			*
****************************************************************************/

function read_csv($file_name, $op_name)
{
	$task_names = array_keys($_SESSION['tasks']);

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

/****************************************************************************
*																			*
*	Function:	createGraphCsv												*
*																			*
*	Purpose:	To create a d3-compatible file 						 		*
*																			*
****************************************************************************/

function createGraphCsv($assistant) {

    $file = fopen($_SESSION['session_dir'] . "stats_$assistant.csv", 'r') or die("Could not find $assistant file! Please return to check and update your settings.");
    $d3_file = fopen($_SESSION['session_dir'] . "mod_type_data_$assistant.txt", 'w') or die ("Could not open $assistant file! Please return to check and update your settings.");

    $count=array();
    $s_dev=array();
    $temp_count_dev=0;
    $temp_count=0;
    $skip=1;
    $num=0;

    while (! feof($file) )
    {
        if($temp_count==1)
        {
            $skip=1;
        }
        $line_of_text = fgetcsv($file,2048,',');
        if($line_of_text[1]=="Sum")
        {
            break;
        }
        if($skip==1)
        {
            $num=count($line_of_text);
            $count[$temp_count]=array();
            for($i=1;$i<$num;$i++)
            {
                if($temp_count==0)
                {
                    $count[$temp_count][$i-1]=$line_of_text[$i];
                }
                else
                {
                    $count[$temp_count][$i-1]=(float)$line_of_text[$i];
                }

            }
            $skip=0;
            $temp_count++;
            continue;
        }
        if($skip==0)
        {
            $num=count($line_of_text);
            $s_dev[$temp_count_dev]=array();
            for($i=2;$i<$num;$i++)
            {
                // $s_dev[$type_names[$temp_count_dev]][$count[0][$i-1]]=(float)$line_of_text[$i];
                $s_dev[array_keys($_SESSION['tasks'])[$temp_count_dev]][$count[0][$i-1]]=(float)$line_of_text[$i];	// Fix
            }
            $temp_count_dev++;
            $skip=1;
            continue;
        }
    }

    fclose($file);
    $count[0][0]='time';

    $taskNames = array_keys($_SESSION['tasks']);
    for($i=0;$i<$temp_count-1;$i++)
    {
        $count[$i+1][0] = ucwords($taskNames[$i]);	// fix
    }

    for($i=0;$i<$num-1;$i++)
    {
        for($j=0;$j<$temp_count-1;$j++)
        {
            fwrite($d3_file,$count[$j][$i].",");
        }
        fwrite($d3_file,$count[$temp_count-1][$i]."\n");
    }

    fclose($d3_file);

    $_SESSION['n_columnsCsv']=$num;
    echo "<script>d3_visual('" . ucwords($assistant) . "'," . (string)$num . ", 'mod_type_data_" . strtolower($assistant) . ".txt')</script>";
}

/****************************************************************************
*																			*
*	Function:	graphText													*
*																			*
*	Purpose:	To calculate the high and low workload for each operator 	*
*																			*
****************************************************************************/

function graphText($op_name)
{

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
