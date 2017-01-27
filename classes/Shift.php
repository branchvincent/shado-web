<?php
/****************************************************************************
*																			*
*	File:		Shift.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Shift class.    			                    *
*																			*
****************************************************************************/

class Shift
{
//  Public member functions

    function __construct($begin = '09:00 AM', $end = '5:00 PM')
    {
        $this->begin = DateTime::createFromFormat("Y-m-d h:i A T", "2016-01-01 $begin UTC");
        $this->end = DateTime::createFromFormat("Y-m-d h:i A T", "2016-01-01 $end UTC");
    }

    function getDuration()
    {
        if ($this->begin >= $this->end)
            date_add($this->end, date_interval_create_from_date_string('1 day'));
        $diff = date_diff($this->begin, $this->end);
        $hours = $diff->h + $diff->i/60;
        return ceil($hours);
    }

    function getBegin() {return $this->begin->format('h:i A');}
    function getEnd() {return $this->end->format('h:i A');}

    function setBegin($begin) {$this->begin = DateTime::createFromFormat("Y-m-d h:i A T", "2016-01-01 $begin UTC");}
    function setEnd($end) {$this->end = DateTime::createFromFormat("Y-m-d h:i A T", "2016-01-01 $end UTC");}

//  Public data members

    var $begin;
    var $end;
}
