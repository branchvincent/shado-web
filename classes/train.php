<?php
/****************************************************************************
*																			*
*	File:		train.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To			                    *
*																			*
****************************************************************************/

class Train 
{
//  Public data members

    var $id;
    var $tasks;
    var $operators;

//  Public member functions

    function __construct($id = "New")
    {
        $this->id = $id;
        $this->tasks = array(new Task);
    }

    function updateFromFile($file)
    {
        $this->name = strtolower(trim(strstr(fgets($file), "\t")));
        $this->tasks = array_map('intval', explode(" ", strstr(fgets($file), "\t")));
        if ($this->name == "engineer")
        {
            $this->active = true;
        }
    }
    //
    // function writeToFile($file)
    // {
    //     fwrite($file, "op_name\t\t\t$this->name\n");
	// 	fwrite($file, "tasks\t\t\t" . implode(" ", $this->tasks) . "\n");
    // }
}
