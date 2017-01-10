<?php

class Database
{
//  Public data members

    var $servername;
    var $username;
    var $password;
    var $dbname;

//  Public member functions

    function __construct()
    {
        $this->servername = "localhost";
    	$this->username = "show_usr";
    	$this->password = "trainz";
    	$this->dbname = "show_des";
    }

    /****************************************************************************
    *																			*
    *	Function:	connect_database											*
    *																			*
    *	Purpose:	To create and return a connection to a mySQL database 		*
    *																			*
    ****************************************************************************/

    function connect()
    {
    //	Create and check connection

    	$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

    	if ($conn->connect_error)
        {
    	    die("Database connection failed: " . $conn->connect_error);
    	}

    //	Return connection

    	return $conn;
    }

    /****************************************************************************
    *																			*
    *	Function:	update_database()											*
    *																			*
    *	Purpose:	To update the mySQL database						 		*
    *																			*
    ****************************************************************************/

    function update()
    {
    	$conn = $this->connect();
    	$sql = 'INSERT INTO
    				runs(
    					session_folder_name,
    					show_des_version,
    					start_time,
    					end_time,
    					hours,
    					traffic_levels,
    					reps,
    					operators,
    					num_task_types
    				)
    			values(
    				"' . $_SESSION['session_id'] . '",' .
    				'"' . $_SESSION['des_version'] . '",' .
    				'"' . substr($_SESSION['parameters']['begin'], 0, -3) . '",' .
    				'"' . substr($_SESSION['parameters']['end'], 0, -3) . '",' .
    				'"' . $_SESSION['parameters']['hours'] . '",' .
    				'"' . implode(", ", $_SESSION['parameters']['traffic_nums']) . '",' .
    				'"' . $_SESSION['parameters']['reps'] . '",' .
    				'"' . implode(", ", $_SESSION['parameters']['assistants']) . '",' .
    				'"' . sizeof($_SESSION['tasks']) .
    			'")';

    	if ($conn->query($sql) === TRUE) {
    		$run_id = $conn->insert_id;
    	} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
    	}

    	$num = 0;
    	foreach (array_keys($_SESSION['tasks']) as $task) {

    		$taskArr = $_SESSION['tasks'][$task];
    		$ops = array();
    		foreach ($_SESSION['parameters']['assistants'] as $assistant)
    			if (in_array($num, $_SESSION['assistants'][$assistant]['tasks']))
    				$ops[] = $assistant;
    		$num++;

    		$sql = 'INSERT INTO
    					task_settings(
    						run_id,
    						name,
    						priority,
    						arrival_distribution_type,
    						arrival_distribution_parameters,
    						service_distribution_type,
    						service_distribution_parameters,
    						expiration_distribution_type,
    						expiration_distribution_parameters_low_traffic,
    						expiration_distribution_parameters_high_traffic,
    						affected_by_traffic,
    						operator_names
    					)
    				values(
    					"' . $run_id . '",' .
    					'"' . $task . '",' .
    					'"' . implode(", ", $taskArr['priority']) . '",' .
    					'"' . $taskArr['arrDist'] . '",' .
    					'"' . implode(", ", $taskArr['arrPms']) . '",' .
    					'"' . $taskArr['serDist'] . '",' .
    					'"' . implode(", ", $taskArr['serPms']) . '",' .
    					'"' . $taskArr['expDist'] . '",' .
    					'"' . implode(", ", $taskArr['expPmsLo']) . '",' .
    					'"' . implode(", ", $taskArr['expPmsHi']) . '",' .
    					'"' . implode(", ", $taskArr['affByTraff']) . '",' .
    					'"' . implode(", ", $ops) .
    				'")';

    		if ($conn->query($sql) === TRUE) {
    		} else {
    			echo "Error: " . $sql . "<br>" . $conn->error;
    		}
    	}
    }
}
