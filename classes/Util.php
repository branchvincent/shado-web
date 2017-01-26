<?php
/****************************************************************************
*																			*
*	File:		Util.php  									                *
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	To define the Utility class.			                    *
*																			*
****************************************************************************/

class Util
{
//  Public member functions

    /****************************************************************************
    *																			*
    *	Section:	HTML Helpers          									    *
    *																			*
    ****************************************************************************/

    /****************************************************************************
    *																			*
    *	Function:     	           										*
    *																			*
    *	Purpose:	To reset the tasks                  	                    *
    *																			*
    ****************************************************************************/

    static function getSelectOptions($options, $selectedOption = "", $pad = false)
    {
        $output = '';

    //  Cycle through options

        foreach ($options as $opt)
        {
        //  Check selected option

            if ($opt == $selectedOption)
                $selected = ' selected="selected"';
            else
                $selected = '';

        //  Pad option, if necessary

            if ($pad)
                $opt = sprintf('%02d', $opt);

        //  Append option to output

            $output .= "<option$selected>$opt</option>\n";
        }

        echo $output;
    }

    /****************************************************************************
    *																			*
    *	Function:     	           										*
    *																			*
    *	Purpose:	To reset the tasks                  	                    *
    *																			*
    ****************************************************************************/

    static function printRadioButtons($buttonNames, $buttonValues, $selectedButtons = array(""), $id = "", $onchange = "", $tooltip = "")
    {
        $output = '';

    //  Cycle through options

        foreach ($buttonNames as $btn)
        {
        //  Check selected button

            if (in_array($btn, $selectedButtons))
                $checked = ' checked';
            else
                $checked = '';

        //  Append option to output

            $output .= "<input type='radio' name='$btn' value='$btn'$checked>$btn</input><br>\n";
        }

        return $output;
    }

    /****************************************************************************
    *																			*
    *   Function:   createTooltip      	           								*
    *																			*
    *	Purpose:	To return a tooltip formed from the provided string         *
    *																			*
    ****************************************************************************/

    static function createTooltip($text, $icon = "(?)")
    {
        return "<span class='hint--right hint--rounded hint--large' aria-label='$text'><sup>$icon</sup></span>";
    }

    /****************************************************************************
    *																			*
    *	Section:	Session           									        *
    *																			*
    ****************************************************************************/

    /****************************************************************************
    *																			*
    *	Function:	resumeSession           									*
    *																			*
    *	Purpose:	To resume the current session or, if necessary, initialize  *
    *               a new session                  	                            *
    *																			*
    ****************************************************************************/

    static function resumeSession()
    {
    //  Start session
        if (session_status() == PHP_SESSION_NONE) session_start();

    //  Initiliaze new session, if necessary
        if (empty($_SESSION)) self::initSession();
    }

    /****************************************************************************
    *																			*
    *	Function:	initSession           										*
    *																			*
    *	Purpose:	To initialize a new session                  	            *
    *																			*
    ****************************************************************************/

    static function initSession()
    {
    //  Create session variables

        $_SESSION['here'] = 1;
        $_SESSION['session_id'] = uniqid();
        $dir = sys_get_temp_dir() . "/" . $_SESSION['session_id'];
        mkdir($dir);
        $_SESSION['session_dir'] = $dir . '/';
        $_SESSION['des_version'] = '1.0.0';

    //  Create parameters

        $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
        $_SESSION['database'] = new Database;

    //  Start session

        $_SESSION['session_results'] = false;
    }

    /****************************************************************************
    *																			*
    *	Function:	clearSession           										*
    *																			*
    *	Purpose:	To clear the current session                  	            *
    *																			*
    ****************************************************************************/

    static function clearSession()
    {
        $_SESSION = array();
        self::initSession();
    }

    /****************************************************************************
    *																			*
    *	Function:	resetTasks           										*
    *																			*
    *	Purpose:	To reset the tasks                  	                    *
    *																			*
    ****************************************************************************/

    static function resetTasks()
    {
        $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
    }

    /****************************************************************************
    *																			*
    *	Function:	           										*
    *																			*
    *	Purpose:	To reset the tasks                  	                    *
    *																			*
    ****************************************************************************/

    static function updateParameters()
    {
        $_SESSION['parameters'] = new Parameters('includes/php_session/default_params.txt');
    }

//  Public data members

    static $DEBUG = true;

    static $ASSISTANT_DESCRIPTIONS = array(
        'engineer' => 'The engineer is responsible for operating the train',
        'conductor' => 'The freight conductor supervises train conditions on the ground at terminal points and remains attentive to the engineer while the train is in motion in the case of emergency, when action could be needed',
        'positive train control' => 'Positive Train Control (PTC), set to be fully implemented by 2018, is an embedded feature of railroads that automatically manages speed restrictions and emergency braking without human input',
        'cruise control' => 'Cruise control can offload motion planning tasks that involve the locomotive control system of throttle and dynamic braking',
        'custom' => 'You can define this assistant'
        );

    static $ENGINEER_TASK_DESCRIPTIONS = array(
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

    static $CONDUCTOR_TASK_DESCRIPTIONS = array(
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

}
