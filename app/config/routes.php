<?php
/*
    This file is used to route all the apis to the correct controller & action
*/

use Phalcon\Mvc\Router;

$di->setShared(
    'router',
    function () {
        $router = new Router();

        $router->setDefaultModule('hotels');

        // TO GET AVAILABLE HOTELS (CRAZY & BEST) SORTED BASED ON THE RATE DESC
        $router->addGet('/availableHotels', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'hotels',
            'action'     => 'list',
        ]);

        // TO GET BESTHOTELS ONLY
        $router->addGet('/bestHotels', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'best-hotels',
            'action'     => 'list',
        ]);
        
        // TO CREATE NEW BESTHOTEL
        $router->addPost('/bestHotels', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'hotels',
            'action'     => 'create',
            'provider'   => 'BestHotels'
        ]);
            
        // TO UPDATE EXISTING BESTHOTEL
        $router->addPut('/bestHotels/{id}', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'hotels',
            'action'     => 'update',
            'id'         => 1,
            'provider'   => 'BestHotels'
        ]);

        // TO DELETE SPECIFIC BESTHOTEL
        $router->addDelete('/bestHotels/{id}', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'hotels',
            'action'     => 'delete',
            'id'         => 1,
            'provider'   => 'BestHotels'
        ]);

        // TO DELETE SPECIFIC CRAZY HOTEL
        $router->addDelete('/crazyHotels/{id}', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'hotels',
            'action'     => 'delete',
            'id'         => 1,
            'provider'   => 'CrazyHotels'
        ]);

        // TO GET ALL CRAZYHOTELS
        $router->addGet('/crazyHotels', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'crazy-hotels',
            'action'     => 'list',
        ]);
        
        // TO CREATE NEW CRAZY HOTEL
        $router->addPost('/crazyHotels', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'hotels',
            'action'     => 'create',
            'provider'   => 'CrazyHotels'
        ]);
 
        // TP UPDATE CRAZY HOTEL
        $router->addPut('/crazyHotels/{id}', [
            'namespace' => 'AlFuttaim\Modules\Hotels\Controllers',
            'module'     => 'hotels',
            'controller' => 'hotels',
            'action'     => 'update',
            'id'         => 1,
            'provider'   => 'CrazyHotels',
            
        ]);

        return $router;
    }
);
