<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../app/config.php';

use Silex\Provider\TwigServiceProvider;

//
//$sql  = "SELECT * FROM developer d
//		INNER JOIN developer_expertise de ON de.developerId = d.id
//		INNER JOIN expertise e ON e.id = de.expertiseId
//		INNER JOIN level l ON l.id = d.levelId
//		WHERE (e.discipline = 'back-end' OR e.discipline = 'front-end') AND l.indication = 'intern'";
//$devs = $app['db']->fetchAll( $sql );
//var_dump($devs);

require_once __DIR__ . '/../app/actions.php';

$app->run();
