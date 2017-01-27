<?php
$arr = array();
$arr['num_reps'] = 100;

// Batch



// Train
$arr['teams'][] = array(
                    'name' => 'train',
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
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.95, 0.1, 0.75)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(7.5, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.11, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'exception handling' => array(
                            'priority' => array(5, 4, 5),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.00033, 0.00033)
                            ),
                            'service' => array(
                                'type' => 'l',
                                'vals' => array(0.98, 1.39)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.045, 0.045)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'paperwork' => array(
                            'priority' => array(3, 0, 2),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.15, 0.05, 0.3)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0.05, 1.5)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0, 0)
                            ),
                            'traffic' => array(0, 1, 1)
                        ),
                        'maintenance of way interactions' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.0017, 0.017)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0.17, 2.5)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.184, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'temporary speed restrictions' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.033, 0)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0, 0.5)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.184, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'signal response management' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.033, 0.1, 0.067)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0.5, 2)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.184, 0.184)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'monitoring inside' => array(
                            'priority' => array(2, 2, 1),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.29, 0.37, 0.37)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(7.52, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0, 0)
                            ),
                            'traffic' => array(0, 0, 0)
                        ),
                        'monitoring outside' => array(
                            'priority' => array(1, 1, 3),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.11, 0.2, 0.57)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(6.67, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'planning ahead' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.067, 0.2, 0.4)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(3, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.17, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        )
                    )
                );

// Dispatch
$arr['teams'][] = array(
                    'name' => 'dispatch center',
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
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.95, 0.1, 0.75)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(7.5, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.11, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'exception handling' => array(
                            'priority' => array(5, 4, 5),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.00033, 0.00033)
                            ),
                            'service' => array(
                                'type' => 'l',
                                'vals' => array(0.98, 1.39)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.045, 0.045)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'paperwork' => array(
                            'priority' => array(3, 0, 2),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.15, 0.05, 0.3)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0.05, 1.5)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0, 0)
                            ),
                            'traffic' => array(0, 1, 1)
                        ),
                        'maintenance of way interactions' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.0017, 0.017)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0.17, 2.5)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.184, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'temporary speed restrictions' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.033, 0)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0, 0.5)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.184, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'signal response management' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.033, 0.1, 0.067)
                            ),
                            'service' => array(
                                'type' => 'u',
                                'vals' => array(0.5, 2)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.184, 0.184)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'monitoring inside' => array(
                            'priority' => array(2, 2, 1),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.29, 0.37, 0.37)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(7.52, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0, 0)
                            ),
                            'traffic' => array(0, 0, 0)
                        ),
                        'monitoring outside' => array(
                            'priority' => array(1, 1, 3),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.11, 0.2, 0.57)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(6.67, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        ),
                        'planning ahead' => array(
                            'priority' => array(0, 5, 0),
                            'interarrival' => array(
                                'type' => 'e',
                                'vals' => array(0.067, 0.2, 0.4)
                            ),
                            'service' => array(
                                'type' => 'e',
                                'vals' => array(3, 0)
                            ),
                            'expiration' => array(
                                'type' => 'e',
                                'vals' => array(0, 0.17, 0)
                            ),
                            'traffic' => array(0, 1, 0)
                        )
                    )
                );

$file = fopen("includes/php_session/config_shado.json", "w") or die("Unable to open file!");
fwrite($file, json_encode($arr, JSON_PRETTY_PRINT));
fclose($file);
