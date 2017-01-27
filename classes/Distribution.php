<?php
/****************************************************************************
*																			*
*	File:		Distribution.php  									        *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Distribution class		                    *
*																			*
****************************************************************************/

class Distribution
{
//  Public member functions

    function __construct($type, $params)
    {
        $this->type = $type;
        $this->params = $params;
    }

//  Public data members

    var $type;
    var $params;
}
