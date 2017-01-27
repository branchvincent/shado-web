<?php
/****************************************************************************
*																			*
*	File:		Dispatcher.php  									        *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Dispatcher class.    			                *
*																			*
****************************************************************************/

class Dispatcher extends Team
{
//  Public member functions

    function __construct($params = array())
    {
        parent::__construct($params);
        $defaults = array(
            'trains' => array()
        );
        $params = array_merge($defaults, $params);
        $this->trains = $params['trains'];

        foreach ($this->trains as $t)
        {
            $t->dispatcher = $this;
        }
    }

    // function update($agents, $tasks, $shift)
    // {
    //
    // }

//  Public data members

    var $trains;
}
