<?php
/****************************************************************************
*																			*
*	File:		Train.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Train class.    			                    *
*																			*
****************************************************************************/

class Train extends Team
{
//  Public member functions

    function __construct($params = array())
    {
        parent::__construct($params);
        $defaults = array(
            'traffic' => array_fill(0, $this->shift->getDuration(), 'm'),
            'dispatcher' => null
        );
        $params = array_merge($defaults, $params);
        $this->traffic = $params['traffic'];
        $this->dispatcher = $params['dispatcher'];

    //  Check that traffic is an array

        if (!is_array($this->traffic))
            $this->traffic = array_fill(0, $this->shift->getDuration(), $this->traffic);
    }

    function get()
    {
        $data = array(
            'traffic' = $this->traffic,
            'dispatcher' = $this->dispatcher
        );

        return $data;
    }

//  Public data members

    var $traffic;
    var $dispatcher;
}
