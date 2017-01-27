<?php
/****************************************************************************
*																			*
*	File:		Team.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Team class.    			                    *
*																			*
****************************************************************************/

require_once('classes/Agent.php');
require_once('classes/Task.php');
require_once('classes/Shift.php');

abstract class Team
{
//  Public member functions

    function __construct($params = array())
    {
        $defaults = array(
            'agents' => array(),
            'tasks' => array(),
            'shift' => new Shift()
        );
        $params = array_merge($defaults, $params);
        $this->agents = $params['agents'];
        $this->tasks = $params['tasks'];
        $this->shift = $params['shift'];
    }

    function update($params)
    {
        $this->tasks = array();
        foreach ($params['tasks'] as $name => $data)
        {
            $task = new Task;
            $data['name'] = $name;
            $task->update($data);
            array_push($this->tasks, $task);
        }

        $this->agents = array();
        foreach ($param['agents'] as $type => $tasks)
            $agt = new Agent;
            $agt-
            array_push($this->agents, new Agent)

    }

    /****************************************************************************
    *																			*
    *	Function:	getActiveAgents 											*
    *																			*
    *	Purpose:	To return an array of active agents                   	    *
    *																			*
    ****************************************************************************/

    function getActiveAgents()
    {
        $types = array();

        foreach ($this->agents as $agt)
        {
            if ($agt->active)
            {
                array_push($types, $agt->name);
            }
        }

        return $types;
    }

    /****************************************************************************
    *																			*
    *	Function:	setActiveAgents											    *
    *																			*
    *	Purpose:	To set the active agents                             	    *
    *																			*
    ****************************************************************************/

    function setActiveAgents($agt_types)
    {
        foreach ($this->agents as $agt)
        {
            if (array_search($agt->type, $agt_types))
            {
                $agt->active = true;
            }
            else
            {
                $agt->active = false;
            }
        }
    }

    /****************************************************************************
    *																			*
    *	Function:	getAgent  											*
    *																			*
    *	Purpose:	To get the agents by type                                 	*
    *																			*
    ****************************************************************************/

    function getAgent($agt_type)
    {
        foreach ($this->agents as $agt)
        {
            if ($agt->type = strtolower($agt_type))
            {
                return $agt;
            }
        }
    }

//  Public data members

    var $agents;
    var $tasks;
    var $shift;
}
