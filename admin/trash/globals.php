<?php
/****************************************************************************
*																			*
*	File:		globals.php  											    *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file declares the global variables.					*
*																			*
****************************************************************************/

//  Global variables

$DEBUG = true;

$ASSISTANT_DESCRIPTIONS = array(
    'engineer' => 'The engineer is responsible for operating the train',
    'conductor' => 'The freight conductor supervises train conditions on the ground at terminal points and remains attentive to the engineer while the train is in motion in the case of emergency, when action could be needed',
    'positive train control' => 'Positive Train Control (PTC), set to be fully implemented by 2018, is an embedded feature of railroads that automatically manages speed restrictions and emergency braking without human input',
    'cruise control' => 'Cruise control can offload motion planning tasks that involve the locomotive control system of throttle and dynamic braking',
    'custom' => 'You can define this assistant'
);

$ENGINEER_TASK_DESCRIPTIONS = array(
    'communicating' => 'Filtering through relevant information for the operation and communicating information that may impact the macro-level network of operations',
    'exception handling' => 'Attending to unexpected or unusual situations that must be handled in order to continue with the trip',
    'paperwork' => 'Reviewing and recording operating conditions',
    'maintenance of way interactions' => 'Maintaining situational awareness of other crews along the track',
    'temporary speed restrictions' => 'Recalling information issued on track bulletins and adapting to updates while train is in motion',
    'signal response management' => 'Maintaining attentiveness to direction from track signaling system and responsive to proper control system within a safely allotted time',
    'monitoring inside' => 'Maintaining attentiveness to informational displays and to engineer\'s performance to maintain a safe operation',
    'monitoring outside' => 'Maintaining attentiveness to warnings and environmental conditions that may affect operations',
    'planning ahead' => 'Maneuvering locomotive control system for throttle, braking and other subtasks like horn-blowing before railroad crossing'
);

$CONDUCTOR_TASK_DESCRIPTIONS = array(
    'communicating' =>'Filtering through relevant information for the operation and communicating information that may impact the macro-level network of operations',
    'exception handling' =>"Manual tasks outside of the locomotive cab that may be passed on to the conductor",
    'paperwork' =>'Recording information about the train (apart from the locomotive) that is not of concern to the engineer but essential for the business of freight',
    'maintenance of way interactions' =>'Supporting the engineer in meeting required speed limits throughout the trip',
    'temporary speed restrictions' =>'Supporting the engineer in meeting required speed limits throughout the trip',
    'signal response management' =>'Supporting the engineer in meeting required speed limits throughout the trip',
    'monitoring inside' =>'Paying attention to the engineer’s task performance',
    'monitoring outside' =>'Maintaining attentiveness to warnings and environmental conditions that may affect operations',
    'planning ahead' =>'Supporting the engineer in meeting required speed limits throughout the trip',
    'custom' => 'You defined this task'
);
