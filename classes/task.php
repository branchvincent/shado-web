<?php
/****************************************************************************
*																			*
*	File:		task.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To			                    *
*																			*
****************************************************************************/

// echo "Loading Task.php..." . "\r\n";

$descriptions = array();
$descriptions['communicating'] = 'Filtering through relevant information for the operation and communicating information that may impact the macro-level network of operations';
$descriptions['exception handling'] = "Manual tasks outside of the locomotive cab that may be passed on to the conductor";
$descriptions['paperwork'] = 'Recording information about the train (apart from the locomotive) that is not of concern to the engineer but essential for the business of freight';
$descriptions['maintenance of way interactions'] = 'Supporting the engineer in meeting required speed limits throughout the trip';
$descriptions['temporary speed restrictions'] = 'Supporting the engineer in meeting required speed limits throughout the trip';
$descriptions['signal response management'] = 'Supporting the engineer in meeting required speed limits throughout the trip';
$descriptions['monitoring inside'] = 'Paying attention to the engineer’s task performance';
$descriptions['monitoring outside'] = 'Maintaining attentiveness to warnings and environmental conditions that may affect operations';
$descriptions['planning ahead'] = 'Supporting the engineer in meeting required speed limits throughout the trip';

class Task
{
//  Public member functions

    function __construct($name = 'New')
    {
        $this->name = $name;
        $this->priority = array(3, 3, 3);
        $this->interarrival = array("type" => "E", "vals" => array(1/30, 1/30, 1/30));
        $this->service = array("type" => "E", "vals" => array(5, 5));
        $this->expiration = array("type" => "E", "lo" => array(0, 0, 0), "hi" => array(0, 0, 0));
        $this->traffic = array(0, 0, 0);
        $this->description = "You have defined this task";
    }

    function updateFromFile($file)
    {
    //  Set task name
        $this->name = strtolower(trim(strrchr(fgets($file), "\t")));
        // echo "Setting name to " . $this->name . "\r\n";

    //  Set priority
        $this->priority = array_slice(fscanf($file, "%s %d %d %d"), 1, 3);

    //  Set arrival distribution
        $this->interarrival['type'] = strtoupper(fscanf($file, "%s %s")[1]);;
        $this->interarrival['vals'] = array_slice(fscanf($file, "%s %f %f %f"), 1, 3);

    //  Set service distribution
        $this->service['type'] = strtoupper(fscanf($file, "%s %s")[1]);
        $this->service['vals'] = array_slice(fscanf($file, "%s %f %f"), 1, 3);

    //  Set expiration distribution
        $this->expiration['type'] = strtoupper(fscanf($file, "%s %s")[1]);
        $this->expiration['lo'] = array_slice(fscanf($file, "%s %f %f %f"), 1, 3);
        $this->expiration['hi'] = array_slice(fscanf($file, "%s %f %f %f"), 1, 3);

    //  Set affected by traffic
        $this->traffic = array_slice(fscanf($file, "%s %d %d %d"), 1, 3);

    //  Set description

        // if (array_key_exists($this->name, $descriptions))
        // {
        //     $this->description = $descriptions[$this->name];
        //     echo $this->description;
        // }

    // //  Set results for each task's assistants
    //     for ($j = 0; $j < $num_ops; $j++)
    //         if (in_array($i, $_SESSION['assistants'][$op_names[$j]]['tasks']))
    //             $_SESSION['tasks'][$curr_task]['results'][$op_names[$j]] = array();
    }

    function writeToFile($file)
    {
		fwrite($file, "name\t\t\t$this->name\n");
		fwrite($file, "priority\t\t" . implode(' ', $this->priority) . "\n");
		fwrite($file, "arr_dist\t\t" . $this->interarrival['type'] . "\n");
		fwrite($file, "interarrival\t" . implode(' ', $this->interarrival['vals']) . "\n");
		fwrite($file, "ser_dist\t\t" . $this->service['type'] . "\n");
		fwrite($file, "service\t\t\t" . implode(' ', $this->service['vals']) . "\n");
		fwrite($file, "exp_dist\t\t" . $this->expiration['type'] . "\n");
		fwrite($file, "expiration_lo\t" . implode(" ", $this->expiration['lo']) . "\n");
		fwrite($file, "expiration_hi\t" . implode(" ", $this->expiration['hi']) . "\n");
		fwrite($file, "traffic\t\t\t" . implode(" ", $this->traffic) . "\n");
    }

//  Public data members

    var $name;
    var $priority;
    var $interarrival;
    var $service;
    var $expiration;
    var $traffic;
    var $description;
    var $results;
}
