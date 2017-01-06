<?php
/****************************************************************************
*                                                                           *
*	File:		parameters.php                                              *
*																			    *
*	Author:		Branch Vincent                                                  *
*																			  *
*	Purpose:	To			                        *
*													     						*
****************************************************************************/

require_once('classes/operator.php');
require_once('classes/task.php');

class Parameters
{
//  Public member functions

    function __construct()
    {
        $this->hours = 8;
        $this->begin = '09:00 AM';
        $this->end = '05:00 PM';
        $this->traffic = array_fill(0, $this->hours, 'm');
        $this->reps = 100;
        $this->operators = new Operator;
        $this->tasks = new Task;
    }

    function getTrafficChars()
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

    function updateDataFromFile($file_path)
    {
        $file = fopen($file_path, 'r') or die('Unable to open default parameter file! Please return to check and update your settings.');

        $this->reps = fscanf($file, "%s %d")[1];
        $num_ops = fscanf($file, "%s %d")[1];
        $num_tasks = fscanf($file, "%s %d")[1];
        // $tasks = array_fill(0, $num_tasks, 0);
        // $operators = array_fill(0, $num_ops, 0);

    //  Initialize arrays

        $this->operators = array();
        $this->tasks = array();
        for ($i = 0; $i < $num_ops; $i++)
        {
            $this->operators[$i] = new Operator;
        }
        for ($i = 0; $i < $num_tasks; $i++)
        {
            $this->tasks[$i] = new Task;
        }

    //  Fill arrays

        foreach ($this->operators as $op)
        {
            $op->updateDataFromFile($file);
        }

        foreach ($this->tasks as $task)
        {
            $task->updateDataFromFile($file);
        }

        fclose($file);
    }

    function writeDataToFile($file_path)
    {
        $file = fopen($file_path, 'r') or die('Unable to open new parameter file! Please return to check and update your settings.');

    	fwrite($file, "output_path\t\t" . $_SESSION['session_dir'] . "\n");
    	fwrite($file, "num_hours\t\t$this->hours\n");
    	fwrite($file, "traff_levels\t" . implode(" ", $this->getTrafficChars()) . "\n");
    	fwrite($file, "num_reps\t\t$this->reps\n");
    	fwrite($file, "num_ops\t\t\t" . sizeof($this->operators) . "\n");
    	fwrite($file, "num_tasks\t\t" . sizeof($this->tasks) . "\n");
        foreach ($this->operators as $op)
        {
            $op->writeDataToFile($file);
        }
        foreach ($this->tasks as $task)
        {
            $task->writeDataToFile($file);
        }
    }

//  Public data members

    var $hours;
    var $begin;
    var $end;
    var $traffic;
    var $reps;
    var $operators;
    var $tasks;
}

$t = new Parameters;
$t->updateDataFromFile('includes/session_management/default_params.txt');
$t->writeDataToFile('temp.txt');
