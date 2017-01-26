<?php
/****************************************************************************
*                                                                           *
*	File:		Parameters.php                                              *
*																            *
*	Author:		Branch Vincent                                              *
*																			*
*	Purpose:	To define the Parameter class. 			                    *
*													     				    *
****************************************************************************/

require_once('classes/Agent.php');
require_once('classes/Task.php');

class Parameters
{
//  Public member functions

    /****************************************************************************
    *															                *
    *	Function:	__construct													*
    *																			*
    *	Purpose:	To construct a default Parameter                          	*
    *																			*
    ****************************************************************************/

    function __construct($file_path = '')
    {
        $this->hours = 8;
        $this->begin = '09:00 AM';
        $this->end = '05:00 PM';
        $this->traffic = array_fill(0, $this->hours, 'm');

        if ($file_path)
        {
            $this->updateFromFile($file_path);
        }
        else
        {
            $this->reps = 100;
            $this->agents = array(new Agent);
            $this->tasks = array(new Task);
        }
    }

    /****************************************************************************
    *																			*
    *	Function:	getTrafficNums												*
    *																			*
    *	Purpose:	To convert traffic characters to multipliers                *
    *																			*
    ****************************************************************************/

    function getTrafficNums()
    {
        $traffic_chars = array();

        foreach ($this->traffic as $t)
        {
            if ($t == 'l')
            {
                $num = 2;
            }
            elseif ($t == 'm')
            {
                $num = 1;
            }
            elseif ($t == 'h')
            {
                $num = 0.5;
            }
            array_push($traffic_chars, $num);
        }

        return $traffic_chars;
    }

    /****************************************************************************
    *																			*
    *	Function:	updateFromFile												*
    *																			*
    *	Purpose:	To update the data members from a parameter file            *
    *																			*
    ****************************************************************************/

    function updateFromFile($file_path)
    {
        $file = fopen($file_path, 'r') or die('Unable to open default parameter file! Please return to check and update your settings.');

        $this->reps = fscanf($file, "%s %d")[1];
        $num_agts = fscanf($file, "%s %d")[1];
        $num_tasks = fscanf($file, "%s %d")[1];

    //  Initialize arrays

        $this->agents = array();
        $this->tasks = array();
        for ($i = 0; $i < $num_agts; $i++)
        {
            $this->agents[$i] = new Agent;
        }
        for ($i = 0; $i < $num_tasks; $i++)
        {
            $this->tasks[$i] = new Task;
        }

    //  Fill arrays

        foreach ($this->agents as $agt)
        {
            $agt->updateFromFile($file);
        }

        foreach ($this->tasks as $task)
        {
            $task->updateFromFile($file);
        }

        fclose($file);
    }

    /****************************************************************************
    *																			*
    *	Function:	writeToFile													*
    *																			*
    *	Purpose:	To output the data members to a parameter file              *
    *																			*
    ****************************************************************************/

    function writeToFile($file_path)
    {
        $file = fopen($file_path, 'w') or die('Unable to open new parameter file! Please return to check and update your settings.');

    	fwrite($file, "output_path\t\t" . $_SESSION['session_dir'] . "\n");
    	fwrite($file, "num_hours\t\t$this->hours\n");
    	fwrite($file, "traff_levels\t" . implode(" ", $this->getTrafficNums()) . "\n");
    	fwrite($file, "num_reps\t\t$this->reps\n");
    	fwrite($file, "num_agts\t\t\t" . sizeof($this->agents) . "\n");
    	fwrite($file, "num_tasks\t\t" . sizeof($this->tasks) . "\n");

        foreach ($this->agents as $agt)
        {
            $agt->writeToFile($file);
        }
        foreach ($this->tasks as $task)
        {
            $task->writeToFile($file);
        }

        fclose($file);
    }

    /****************************************************************************
    *																			*
    *	Function:	getActiveAgents 											*
    *																			*
    *	Purpose:	To return an array of active agents                   	    *
    *																			*
    ****************************************************************************/

    function getActiveAgents()
    {
        $names = array();

        foreach ($this->agents as $agt)
        {
            if ($agt->active)
            {
                array_push($names, $agt->name);
            }
        }

        return $names;
    }

    /****************************************************************************
    *																			*
    *	Function:	setActiveAgents											    *
    *																			*
    *	Purpose:	To set the active agents                             	    *
    *																			*
    ****************************************************************************/

    function setActiveAgents($agt_names)
    {
        foreach ($this->agents as $agt)
        {
            if (array_search($agt->name, $agt_names))
            {
                $agt->active = true;
            }
            else
            {
                $agt->active = false;
            }
        }
    }

    /****************************************************************************
    *																			*
    *	Function:	getAgentByName											    *
    *																			*
    *	Purpose:	To get the agent by name                            	    *
    *																			*
    ****************************************************************************/

    function getAgentByName($agt_name)
    {
        foreach ($this->agents as $agt)
        {
            if ($agt->name = ucwords($agt_name))
            {
                return $agt;
            }
        }
    }

    /****************************************************************************
    *																			*
    *	Function:	getAgentByType  											*
    *																			*
    *	Purpose:	To get the agents by type                                 	*
    *																			*
    ****************************************************************************/

    function getAgentByType($agt_type)
    {
        foreach ($this->agents as $agt)
        {
            if ($agt->type = strtolower($agt_type))
            {
                return $agt;
            }
        }
    }

//  Public data members

    var $hours;
    var $begin;
    var $end;
    var $traffic;
    var $reps;
    var $agents;
    var $tasks;
}
