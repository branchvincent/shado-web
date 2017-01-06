
<?php
/****************************************************************************
*																			*
*	File:		operator.php  									            *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To			                    *
*																			*
****************************************************************************/

echo "Loading Operator.php..." . "\r\n";

class Operator
{
//  Public member functions

    function __construct($name = "New", $tasks = array())
    {
        $this->name = $name;
        $this->tasks = $tasks;
        $this->active = false;

        $this->descriptions = array();
        $this->descriptions['engineer'] = 'The engineer is responsible for operating the train';
        $this->descriptions['conductor'] = 'The freight conductor supervises train conditions on the ground at terminal points and remains attentive to the engineer while the train is in motion in the case of emergency, when action could be needed';
        $this->descriptions['positive train control'] = 'Positive Train Control (PTC), set to be fully implemented by 2018, is an embedded feature of railroads that automatically manages speed restrictions and emergency braking without human input';
        $this->descriptions['cruise control'] = 'Cruise control can offload motion planning tasks that involve the locomotive control system of throttle and dynamic braking';
        $this->descriptions['custom'] = 'You can define this assistant';
    }

    function updateFromFile($file)
    {
        $this->name = strtolower(trim(strstr(fgets($file), "\t")));
        $this->tasks = array_map('intval', explode(" ", strstr(fgets($file), "\t")));
        if ($this->name == "engineer")
        {
            $this->active = true;
        }
        $this->description = $this->descriptions[$this->name];
    }

    function writeToFile($file)
    {
        fwrite($file, "op_name\t\t\t$this->name\n");
		fwrite($file, "tasks\t\t\t" . implode(" ", $this->tasks) . "\n");
    }

//  Public data members

    var $name;
    var $tasks;
    var $active;
    var $description;
    var $descriptions;
}

// $d = new Operator(1); //"hi",1);
// echo "Name: ";
// print_r($d->name);
// echo "Tasks: ";
// print_r($d->tasks);
