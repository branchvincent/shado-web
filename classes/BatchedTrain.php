<?php
/****************************************************************************
*																			*
*	File:		BatchedTrain.php  									        *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the BatchedTeam class.    			            *
*																			*
****************************************************************************/

class BatchedTrain
{
//  Public member functions

    function __construct($train, $num)
    {
        $this->trains = array();
        for ($i = 0; $i < $num; $i++)
            $this->trains.append(new Train($train->get()))

        $this->traffic = $train->traffic;
        $this->shift = $train->shift;
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

//  Public data members

    var $trains;
    var $traffic;
    var $shift;
}
