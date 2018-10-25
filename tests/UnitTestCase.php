<?php

use Phalcon\Di;
use Phalcon\Test\UnitTestCase as PhalconTestCase;

abstract class UnitTestCase extends PhalconTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp() {
        require __DIR__.'/../app/config/infra/db.php';
        // Load any additional services that might be required during testing
        $di = new \Phalcon\Di\FactoryDefault;

        $di->setShared('db', function () use ($db) {
           
            return new Phalcon\Db\Adapter\Pdo\Postgresql($db);
        });

        parent::setUp($di);


        $this->_loaded = true;
    }


    /**
     * Check if the test case is setup properly
     *
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError(
                "Please run parent::setUp()."
            );
        }
    }
}