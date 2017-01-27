<?php
require_once('include/php_session/init.php');

$DEFAULT_REPS = 100;

// Batch

$DEFAULT_TASKS = array(
    new Task(array(
        'name' => 'communicating',
        'priority' => array(4, 3, 4),
        'interarrival' => new Distribution('e', array(0.95, 0.1, 0.75)),
        'service' => new Distribution('e', array(7.5, 0)),
        'expiration' => new Distribution('e', array(0, 0.11, 0)),
        'traffic' => array(false, true, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['communicating']
    )),
    new Task(array(
        'name' => 'exception handling',
        'priority' => array(5, 4, 5),
        'interarrival' => new Distribution('e', array(0, 0.00033, 0.00033)),
        'service' => new Distribution('l', array(0.98, 1.39)),
        'expiration' => new Distribution('e', array(0, 0.045, 0.045)),
        'traffic' => (false, true, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['exception handling']
    )),
    new Task(array(
        'name' => 'paperwork',
        'priority' => array(3, 0, 2),
        'interarrival' => new Distribution('e', array(0.15, 0.05, 0.3)),
        'service' => new Distribution('u', array(0.05, 1.5)),
        'expiration' => new Distribution('e', array(0, 0, 0)),
        'traffic' => array(false, true, true),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['paperwork']
    )),
    new Task(array(
        'name' => 'maintenance of way interactions',
        'priority' => array(0, 5, 0),
        'interarrival' => new Distribution('e', array(0, 0.0017, 0.017)),
        'service' => new Distribution('u', array(0.17, 2.5)),
        'expiration' => new Distribution('e', array(0, 0.184, 0)),
        'traffic' => array(false, true, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['maintenance of way interactions']
    )),
    new Task(array(
        'name' => 'temporary speed restrictions',
        'priority' => array(0, 5, 0),
        'interarrival' => new Distribution('e', array(0, 0.033, 0)),
        'service' => new Distribution('u', array(0, 0.5)),
        'expiration' => new Distribution('e', array(0, 0.184, 0))
        'traffic' => array(false, true, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['maintenance of way interactions']
    )),
    new Task(array(
        'name' => 'signal response management',
        'priority' => array(0, 5, 0),
        'interarrival' => new Distribution('e', array(0.033, 0.1, 0.067))
        'service' => new Distribution('u', array(0.5, 2)),
        'expiration' => new Distribution('e', array(0, 0.184, 0.184)),
        'traffic' => array(false, true, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['signal response management']
    )),
    new Task(array(
        'name' => 'monitoring inside',
        'priority' => array(2, 2, 1),
        'interarrival' => new Distribution('e', array(0.29, 0.37, 0.37)),
        'service' => new Distribution('e', array(7.52, 0)),
        'expiration' => new Distribution('e', array(0, 0, 0)),
        'traffic' => array(false, false, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['monitoring inside']
    )),
    new Task(array(
        'name' => 'monitoring outside',
        'priority' => array(1, 1, 3),
        'interarrival' => new Distribution('e', array(0.11, 0.2, 0.57)),
        'service' => new Distribution('e', array(6.67, 0)),
        'expiration' => new Distribution('e', array(0, 0, 0)),
        'traffic' => array(false, true, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['monitoring outside']
    )),
    new Task(array(
        'name' => 'planning ahead',
        'priority' => array(0, 5, 0),
        'interarrival' => new Distribution('e', array(0.067, 0.2, 0.4)),
        'service' => new Distribution('e', array(3, 0)),
        'expiration' => new Distribution('e', array(0, 0.17, 0)),
        'traffic' => array(false, true, false),
        'description' => $ENGINEER_TASK_DESCRIPTIONS['planning ahead']
    ))
);

$DEFAULT_TRAIN = new Train(array(
    'agents' => array(
        new Agent(
            'name' => 'engineer',
            'tasks' => $DEFAULT_TASKS,
            'active' => true,
            'description' => $ASSISTANT_DESCRIPTIONS['engineer']
        ),
        new Agent(
            'name' => 'conductor',
            'tasks' => array($DEFAULT_TASKS[5], $DEFAULT_TASKS[6], $DEFAULT_TASKS[8]),
            'description' => $ASSISTANT_DESCRIPTIONS['conductor']
        ),
        new Agent(
            'name' => 'positive train control',
            'tasks' => array($DEFAULT_TASKS[1], $DEFAULT_TASKS[5], $DEFAULT_TASKS[6]),
            'description' => $ASSISTANT_DESCRIPTIONS['positive train control']
        ),
        new Agent(
            'name' => 'cruise control',
            'tasks' => array($DEFAULT_TASKS[8]),
            'description' => $ASSISTANT_DESCRIPTIONS['cruise control']
        ),
        new Agent(
            'name' => 'custom',
            'tasks' => array(),
            'custom' => true,
            'description' => $ASSISTANT_DESCRIPTIONS['custom']
        )
    ),
    'tasks' => $DEFAUL_TASKS;
);

// Dispatch
$DEFAULT_DISPATCHER = new Dispatcher(array(
    'agents' => array(new Agent(
        'name' => 'dispatcher',
        'tasks' => $DEFAUL_TASKS,
    )),
    'tasks' => $DEFAUL_TASKS
))


);
