<?php
/****************************************************************************
*																			*
*	File:		TeamBatch.php  									            *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the TeamBatch class.    			                *
*																			*
****************************************************************************/

class TeamBatch
{
//  Public member functions

    function __construct($name = "DefaultTeamBatch", $teams = array())
    {
        $this->name = $name;
        $this->teams = $teams;
        $this->begin = "8:00 AM";
        $this->end = "5:00 PM";
        $this->traffic = array_fill(0, $this->hours, 'm');
    }

    function updateFromFile($file)
    {
    }

    function writeToFile($file)
    {
    }

//  Public data members

    var $name;
    var $teams;
    var $begin;
    var $end;
}
