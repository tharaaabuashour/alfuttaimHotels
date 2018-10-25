<?php
namespace AlFuttaim\Modules\Hotels;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'AlFuttaim\Modules\Hotels\Models' => __DIR__ . '/models/',
            'AlFuttaim\Modules\Hotels\Services' => __DIR__ . '/services/',
            'AlFuttaim\Modules\Hotels\Controllers' => __DIR__ . '/controllers/',
            'AlFuttaim\Modules\Hotels\Repositories' => __DIR__ . '/repositories/',
            'AlFuttaim\Modules\Hotels\Views' => __DIR__ . '/views/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
    }
}
