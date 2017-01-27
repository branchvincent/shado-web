<?php

$arr = array();
$arr['reps'] = 100;

// Train
$arr['train'] = array(
    'agents' => array(
        'engineer' => array(
            'communicating',
            'exception handling',
            'paperwork',
            'maintenance of way interactions',
            'temporary speed restrictions',
            'signal response management',
            'monitoring inside',
            'monitoring outside',
            'planning ahead'
        ),
        'conductor' => array(
            'signal response management',
            'monitoring inside',
            'planning ahead'
        ),
        'positive train control' => array(
            'exception handling',
            'signal response management',
            'monitoring inside'
        ),
        'cruise control' => array(
            'planning ahead'
        ),
        'custom' => array()
    ),
    'tasks' => array(
        'communicating' => array(
            'priority' => array(4, 3, 4),
            'interarrival' => array('type' => 'e', 'vals' => array(0.95, 0.1, 0.75)),
            'service' => array('type' => 'e', 'vals' => array(7.5, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.11, 0)),
            'traffic' => array(false, true, false)
        ),
        'exception handling' => array(
            'priority' => array(5, 4, 5),
            'interarrival' => array('type' => 'e', 'vals' => array(0, 0.00033, 0.00033)),
            'service' => array('type' => 'l', 'vals' => array(0.98, 1.39)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.045, 0.045)),
            'traffic' => array(false, true, false)
        ),
        'paperwork' => array(
            'priority' => array(3, 0, 2),
            'interarrival' => array('type' => 'e', 'vals' => array(0.15, 0.05, 0.3)),
            'service' => array('type' => 'u', 'vals' => array(0.05, 1.5)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0, 0)),
            'traffic' => array(false, true, true)
        ),
        'maintenance of way interactions' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0, 0.0017, 0.017)),
            'service' => array('type' => 'u', 'vals' => array(0.17, 2.5)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.184, 0)),
            'traffic' => arrayarray(false, true, false)
        ),
        'temporary speed restrictions' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0, 0.033, 0)),
            'service' => array('type' => 'u', 'vals' => array(0, 0.5)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.184, 0)),
            'traffic' => array(false, true, false)
        ),
        'signal response management' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0.033, 0.1, 0.067)),
            'service' => array('type' => 'u', 'vals' => array(0.5, 2)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.184, 0.184)),
            'traffic' => array(false, true, false)
        ),
        'monitoring inside' => array(
            'priority' => array(2, 2, 1),
            'interarrival' => array('type' => 'e', 'vals' => array(0.29, 0.37, 0.37)),
            'service' => array('type' => 'e', 'vals' => array(7.52, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0, 0)),
            'traffic' => array(false, false, false)
        ),
        'monitoring outside' => array(
            'priority' => array(1, 1, 3),
            'interarrival' => array('type' => 'e', 'vals' => array(0.11, 0.2, 0.57)),
            'service' => array('type' => 'e', 'vals' => array(6.67, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0, 0)),
            'traffic' => array(false, true, false)
        ),
        'planning ahead' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0.067, 0.2, 0.4)),
            'service' => array('type' => 'e', 'vals' => array(3, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.17, 0)),
            'traffic' => array(false, true, false)
        )
    )
);

// Dispatch
$arr['dispatcher'] = array(
    'agents' => array(
        'dispatcher' => array(
            'communicating',
            'exception handling',
            'paperwork',
            'maintenance of way interactions',
            'temporary speed restrictions',
            'signal response management',
            'monitoring inside',
            'monitoring outside',
            'planning ahead'
        )
    ),
    'tasks' => array(
        'communicating' => array(
            'priority' => array(4, 3, 4),
            'interarrival' => array('type' => 'e', 'vals' => array(0.95, 0.1, 0.75)),
            'service' => array('type' => 'e', 'vals' => array(7.5, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.11, 0)),
            'traffic' => array(false, true, false)
        ),
        'exception handling' => array(
            'priority' => array(5, 4, 5),
            'interarrival' => array('type' => 'e', 'vals' => array(0, 0.00033, 0.00033)),
            'service' => array('type' => 'l', 'vals' => array(0.98, 1.39)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.045, 0.045)),
            'traffic' => array(false, true, false)
        ),
        'paperwork' => array(
            'priority' => array(3, 0, 2),
            'interarrival' => array('type' => 'e', 'vals' => array(0.15, 0.05, 0.3)),
            'service' => array('type' => 'u', 'vals' => array(0.05, 1.5)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0, 0)),
            'traffic' => array(false, true, true)
        ),
        'maintenance of way interactions' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0, 0.0017, 0.017)),
            'service' => array('type' => 'u', 'vals' => array(0.17, 2.5)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.184, 0)),
            'traffic' => array(false, true, false)
        ),
        'temporary speed restrictions' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0, 0.033, 0)),
            'service' => array('type' => 'u', 'vals' => array(0, 0.5)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.184, 0)),
            'traffic' => array(false, true, false)
        ),
        'signal response management' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0.033, 0.1, 0.067)),
            'service' => array('type' => 'u', 'vals' => array(0.5, 2)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.184, 0.184)),
            'traffic' => array(false, true, false)
        ),
        'monitoring inside' => array(
            'priority' => array(2, 2, 1),
            'interarrival' => array('type' => 'e', 'vals' => array(0.29, 0.37, 0.37)),
            'service' => array('type' => 'e', 'vals' => array(7.52, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0, 0)),
            'traffic' => array(false, false, false)
        ),
        'monitoring outside' => array(
            'priority' => array(1, 1, 3),
            'interarrival' => array('type' => 'e', 'vals' => array(0.11, 0.2, 0.57)),
            'service' => array('type' => 'e', 'vals' => array(6.67, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0, 0)),
            'traffic' => array(false, true, false)
        ),
        'planning ahead' => array(
            'priority' => array(0, 5, 0),
            'interarrival' => array('type' => 'e', 'vals' => array(0.067, 0.2, 0.4)),
            'service' => array('type' => 'e', 'vals' => array(3, 0)),
            'expiration' => array('type' => 'e', 'vals' => array(0, 0.17, 0)),
            'traffic' => array(false, true, false)
        )
    )
);

// Batch

$arr['batched teams'][] = array(
    array(
        'team' => 'train',
        'count' => 1,
        'begin' => '9:00 AM',
        'end' => '5:00 PM',
        'traffic' => 'm'
    )
);

$file = fopen("includes/php_session/config_shado.json", "w") or die("Unable to open file!");
fwrite($file, json_encode($arr, JSON_PRETTY_PRINT));
fclose($file);
