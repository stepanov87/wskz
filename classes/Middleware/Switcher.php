<?php

namespace Middleware;

use Middleware\Dispatcher\CommandLineDispatcher;
use Middleware\Dispatcher\HttpDispatcher;
use Config\Config;

/**
 * A class used to switch between dispatchers
 */
class Switcher {
    private $dispatcher;

    public function __construct() {
        if ( php_sapi_name() == "cli" ) {
            $config = new Config('/config/Commandline/');

            $this->dispatcher = new CommandLineDispatcher();

        } else {
            $config = new Config('/config/Http/');

            $this->dispatcher = new HttpDispatcher();
        }

        $this->dispatcher->setConfig($config);
    }

    public function execute() {
        return $this->dispatcher->dispatch();
    }

}
