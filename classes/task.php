<?php
/****************************************************************************
*																			*
*	File:		Task.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Task class.			                        *
*																			*
****************************************************************************/

require_once('classes/Distribution.php');

class Task
{
//  Public member functions

    function __construct($params)
    {
        $defaults = array(
            'name' => 'DefaultTask',
            'priority' => array(3,3,3),
            'interarrival' => new Distribution('e', array(1/30, 1/30, 1/30)),
            'service' => new Distribution('e', array(5,5)),
            'expiration' => new Distribution('e', array(0,0,0)),
            'traffic' => array(false,false,false),
            'description' => 'You have defined this task.'
        );
        $params = array_merge($defaults, $params);
        $this->name = $params['name'];
        $this->priority = $params['priority'];
        $this->interarrival = $params['interarrival'];
        $this->service = $params['service'];
        $this->expiration = $params['expiration'];
        $this->traffic = $params['traffic'];
        $this->description = $params['description'];
        $this->results = array();
    }

    function update($new_data)
    {
    }

    function updateFromFile($file)
    {

    }

    function writeToFile($file)
    {
    }

//  Public data members

    var $name;
    var $priority;
    var $interarrival;
    var $service;
    var $expiration;
    var $traffic;
    var $description;
    var $results;
}
