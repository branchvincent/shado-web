<?php
/****************************************************************************
*																			*
*	File:		time.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To			                    *
*																			*
****************************************************************************/

class Time
{
//  Public data members

    var $time;
    var $operators;

//  Public member functions

    function __construct($time = "00:00 AM")
    {
        $this->time = ;
    }

    // function updateFromFile($file)
    // {
    //     $this->name = strtolower(trim(strstr(fgets($file), "\t")));
    //     $this->tasks = array_map('intval', explode(" ", strstr(fgets($file), "\t")));
    //     if ($this->name == "engineer")
    //     {
    //         $this->active = true;
    //     }
    // }
    //
    // function writeToFile($file)
    // {
    //     fwrite($file, "op_name\t\t\t$this->name\n");
	// 	fwrite($file, "tasks\t\t\t" . implode(" ", $this->tasks) . "\n");
    // }
}
