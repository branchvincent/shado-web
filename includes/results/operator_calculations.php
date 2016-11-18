<?php
/****************************************************************************
*																			*
*	File:		operator_calculations.php  									*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file calculates the workload counts for the specified 	*
*				operator.			    									*
*																			*
****************************************************************************/

//	Initialize session

    require_once('includes/session_management/init.php');

    read_csv($_SESSION['session_dir'] . 'stats_engineer.csv', 'engineer');

	$low_count_0 = $_SESSION['results']['engineer']['low_count'];
	$normal_count_0 = $_SESSION['results']['engineer']['med_count'];
	$high_count_0 = $_SESSION['results']['engineer']['high_count'];

	if (!in_array('conductor', $_SESSION['parameters']['assistants'])) {
		$operator2Style = 'display:none; ';
		$low_count_1 = 0;
		$normal_count_1 = 0;
		$high_count_1 = 0;
	} else {
        $operator2Style = ' ';
		read_csv($_SESSION['session_dir'] . 'stats_conductor.csv', 'conductor');
		$low_count_1 = $_SESSION['results']['conductor']['low_count'];
		$normal_count_1 = $_SESSION['results']['conductor']['med_count'];
		$high_count_1 = $_SESSION['results']['conductor']['high_count'];
	}
?>

<style>
	#low_work_0 {
		color:
		<?php
			if(($low_count_0+$high_count_0)>$normal_count_0) {
				if($low_count_0>$high_count_0) {
					echo "red";
				} else {
					echo "black";
				}
			} else {
				echo "black";
			}
		?>;
	}
	#normal_work_0{
		color:
		<?php
			if(($low_count_0+$high_count_0)<$normal_count_0) {
				echo "green";
			} else {
				echo "black";
			}
		?>;
	}
	#high_work_0 {
		color:
		<?php
			if(($low_count_0+$high_count_0)>$normal_count_0) {
				if($high_count_0>$low_count_0) {
					echo "red";
				} else {
					echo "black";
				}
			} else {
				echo "black";
			}
		?>;
	}

	#low_work_1 {
		color:
		<?php
			if(($low_count_1+$high_count_1)>$normal_count_1) {
				if($low_count_1>$high_count_1) {
					echo "red";
				} else {
					echo "black";
				}
			} else {
				echo "black";
			}
		?>;
	}

	#normal_work_1 {
		color:
		<?php
			if(($low_count_1+$high_count_1)<$normal_count_1){
				echo "green";
			} else {
				echo "black";
			}
		?>;
	}

	#high_work_1 {
		color:
		<?php
			if(($low_count_1+$high_count_1)>$normal_count_1) {
				if($high_count_1>$low_count_1) {
					echo "red";
				} else {
					echo "black";
				}
			} else {
				echo "black";
			}
		?>;
	}
</style>
