<?php
/****************************************************************************
*																			*
*	File:		Team.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Team class.    			                    *
*																			*
****************************************************************************/

class Team
{
//  Public member functions

    function __construct($name = "DefaultTeam", $tasks = array(), $agents = array())
    {
        $this->name = $name;
        $this->tasks = $tasks;
        $this->agents = $agents;
    }

    function updateFromFile($file)
    {

    }

    function writeToFile($file)
    {
        if ($this->active and !empty($this->tasks))
        {
            fwrite($file, "op_name\t\t\t$this->name\n");
            fwrite($file, "tasks\t\t\t" . implode(" ", $this->tasks) . "\n");
        }
    }

//  Public data members

    var $name;
    var $tasks;
    var $agents;
}
