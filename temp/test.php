<?php
// require_once('includes/php_session/init.php');
// require_once('classes/Dispatcher.php');

// $t = new Dispatcher();
// print_r($t->trains);

$a['a']['b'] = 'here';

echo $['a'];


// echo $s->getDuration();

// $date = DateTime::createFromFormat('Y-m-d h:i A T', '2017-1-1 5:00 PM UTC');
// echo $date->format('Y-m-d h:i A');

//
// $d1 = new DateTime('2016-01-01 08:00:00 UTC');
// $d2 = new DateTime('2016-01-01 22:30:00 UTC');
// // $d1 = $d1->format('h:i A');
// $a = array(new DateTime('2016-01-01 08:00:00 UTC'), new DateTime('2016-01-01 08:00:00 UTC'));
//
//
class MyClass
{
    function __construct($data = '')
    {
        $this->s = "hi"
    }

    function update() {$this->s = 'no';}
}

$c = new MyClass()->update();
echo $c->s;

$a = array();
array_push($a, 'k' => 'v');
echo $a;


//
// $params = array('param1' => 'new');
// $defaults = array(
//         'param1' => 'foo',
//         'param2' => 'bar',
//         'param3' => 'baz'
//     );
// $params = array_merge($defaults, $params);
// // echo $params;
//
// $data = array("a" => 'new');
// $t = new MyClass($data);
// // echo $t->a;// . $t->b . $t->c;
// // echo $d2;
// $diff = date_diff($d1,$d2);
//
// $d1 = new DateTime('2016-01-01 08:00:00 UTC');
// $d2 = new DateTime('2016-01-01 09:55:00 UTC');
// if ($d1 >= $d2) date_add($d2, date_interval_create_from_date_string('1 day'));
// $diff = date_diff($d1, $d2);
// $hours = $diff->h + $diff->i/60.;
// echo ceil($hours);
// // echo ceil($hours);
// // echo $diff->format('h:i A');
