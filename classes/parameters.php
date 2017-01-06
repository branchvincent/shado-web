<?php
/****************************************************************************
*                                                                           *
*	File:		parameters.php                                              *
*																              *
*	Author:		Branch Vincent                                                  *
*																			  *
*	Purpose:	To			                        *
*													     						*
****************************************************************************/

// echo "Loading Parameters.php..." . "\r\n";
require_once('classes/operator.php');
require_once('classes/task.php');

class Parameters
{
//  Public member functions

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
            $this->operators = array(new Operator);
            $this->tasks = array(new Task);
        }
    }

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

    function updateFromFile($file_path)
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
            $op->updateFromFile($file);
        }

        foreach ($this->tasks as $task)
        {
            $task->updateFromFile($file);
        }

        fclose($file);
    }

    function writeToFile($file_path)
    {
        $file = fopen($file_path, 'w') or die('Unable to open new parameter file! Please return to check and update your settings.');

    	fwrite($file, "output_path\t\t" . $_SESSION['session_dir'] . "\n");
    	fwrite($file, "num_hours\t\t$this->hours\n");
    	fwrite($file, "traff_levels\t" . implode(" ", $this->getTrafficNums()) . "\n");
    	fwrite($file, "num_reps\t\t$this->reps\n");
    	fwrite($file, "num_ops\t\t\t" . sizeof($this->operators) . "\n");
    	fwrite($file, "num_tasks\t\t" . sizeof($this->tasks) . "\n");

        foreach ($this->operators as $op)
        {
            $op->writeToFile($file);
        }
        foreach ($this->tasks as $task)
        {
            $task->writeToFile($file);
        }

        fclose($file);
    }

    function getActiveOperators()
    {
        $names = array();

        foreach ($this->operators as $op)
        {
            if ($op->active)
            {
                array_push($names, $op->name);
            }
        }

        return $names;
    }

    function set_operators($op_names)
    {
        foreach ($self->operators as $op)
        {
            if (array_search($op->name, $op_names))
            {
                $op->active = true;
            }
            else
            {
                $op->active = false;
            }
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
