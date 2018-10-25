<?php
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Postgresql as DbAdapter;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Cli\Dispatcher;

define('BASE_PATH', dirname(__DIR__));

// CONTAIN DATABASE CONFIG
require __DIR__.'/app/config/infra/db.php';

$di = new FactoryDefault();

// Set up the database service
$di->setShared(
    'db',
    function () use ($db) {
        return new DbAdapter(
            [
                'host'     => $db["host"],
                'username' => $db["username"],
                'password' => $db["password"],
				'dbname'   => $db["dbname"],
            ]
        );
    }
);

$di->setShared('view', function () {
	$view = new View();
	return $view;
});

// TO ROUTE ALL APIS
require __DIR__.'/app/config/routes.php';

// Create an application
$application = new Application($di);


// TP REGISTER ALL MODULES
$application->registerModules(
    [
        'hotels' => [
            'className' => 'AlFuttaim\Modules\Hotels\Module',
            'path'      => __DIR__.'/app/modules/hotels/Module.php'
        ]
    ]
);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
	echo $e->getMessage();
    //echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
