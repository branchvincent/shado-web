<?php
/****************************************************************************
*																			*
*	File:		Agent.php  								    	            *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Agent class.	       		                    *
*																			*
****************************************************************************/

class Agent
{
//  Public member functions

    function __construct($params)
    {
        $defaults = array(
            'name' => 'engineer',
            'tasks' => array(),
            'active' => false,
            'custom' => false,
            'description' => 'You can define this assistant'
        );
        $params = array_merge($defaults, $params);
        $this->type = $params['type'];
        $this->tasks = $params['tasks'];
        $this->active = $params['active'];
        $this->description = $params['description'];
    }

//  Public data members

    var $name;
    var $tasks;
    var $active;
    var $custom;
    var $description;
}
