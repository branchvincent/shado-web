<?php
/****************************************************************************
*                                                                           *
*	File:		Parameters.php                                              *
*																            *
*	Author:		Branch Vincent                                              *
*																			*
*	Purpose:	To define the Parameter class. 			                    *
*													     				    *
****************************************************************************/

// require_once('classes/Agent.php');
// require_once('classes/Task.php');

class Parameters
{
//  Public member functions

    /****************************************************************************
    *															                *
    *	Function:	__construct													*
    *																			*
    *	Purpose:	To construct a default Parameter                          	*
    *																			*
    ****************************************************************************/

    function __construct($params)
    {
        $default = array(
            'reps' = 100;
            'teams' = array();
            'batched trains' = array();
        )
        $params = array_merge($defaults, $params);
        $this->reps = $params['reps'];
        $this->teams = $params['teams'];
        $this->batched_trains = $params['batched trains'];
    }

    fuction get()
    {
        $data = array(
            'reps' => $this->reps,
            'teams' => $this->teams,
            'batched trains' => $this->batched_trains
        )
        return $data;
    }

    function update($params)
    {
        $this->reps = $params['reps'];
        $this->teams = array();
        $this->batched_trains = array();

    //  Teams

        $train = new Train;
        $train->update($params['train']);
        array_push($this->teams, $train);

        $dispatcher = new Dispatcher;
        $dispatcher->update($params['dispatcher']);
        array_push($this->teams, $dispatcher);

    //  Batch

        // foreach ($this->teams as $i => $t)
        //     $t->update($params['teams'][$i]);

        foreach ($params['batched trains'] as $bt)
            array_push($this->batched_trains, new BatchedTrain);
        foreach ($this->batched_trains as $i => $bt)
            $bt->update($params['batched trains'][$i]);
    }

//  Public data members

    var $reps;
    var $teams;
    var $batched_trains;
}
