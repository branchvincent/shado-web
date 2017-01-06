
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

class Operator
{
//  Public member functions

    function __construct($name = "New", $tasks = array())
    {
        $this->name = $name;
        $this->tasks = $tasks;
        // echo "Constructing Operator..." . "\r\n";
    }

    function updateDataFromFile($file)
    {
        $this->name = strtolower(trim(strstr(fgets($file), "\t")));
        $this->tasks = array_map('intval', explode(" ", strstr(fgets($file), "\t")));
        // echo "Updating Operator..." . "\r\n";
    }

    function writeDataToFile($file)
    {
        fwrite($file, "op_name\t\t\t$this->name\n");
		fwrite($file, "tasks\t\t\t" . implode(" ", $this->tasks) . "\n");
    }

//  Public data members

    var $name;
    var $tasks;
    // var $description;
}

// $d = new Operator(1); //"hi",1);
// echo "Name: ";
// print_r($d->name);
// echo "Tasks: ";
// print_r($d->tasks);
