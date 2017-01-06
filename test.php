<?php

include('classes/operator.php');
include('classes/task.php');

$file = fopen('includes/session_management/default_params.txt', 'r') or die('Unable to open default parameter file! Please return to check and update your settings.');

$reps = fscanf($file, "%s %d");
$num_ops = fscanf($file, "%s %d")[1];
$num_tasks = fscanf($file, "%s %d")[1];
// $tasks = array_fill(0, $num_tasks, 0);
// $operators = array_fill(0, $num_ops, 0);

//  Initialize arrays

$operators = array();
$tasks = array();
for ($i = 0; $i < $num_ops; $i++)
{
    $operators[$i] = new Operator;
}
for ($i = 0; $i < $num_tasks; $i++)
{
    $tasks[$i] = new Task;
}

//  Fill arrays

foreach ($operators as $op)
{
    $op->updateDataFromFile($file);
}

foreach ($tasks as $task)
{
    $task->updateDataFromFile($file);
}
fclose($file);

//  Test data output

$file = fopen('temp.txt', 'w') or die('Unable to open new parameter file! Please return to check and update your settings.');

foreach ($operators as $op)
{
    $op->writeDataToFile($file);
}
foreach ($tasks as $task)
{
    $task->writeDataToFile($file);
}
