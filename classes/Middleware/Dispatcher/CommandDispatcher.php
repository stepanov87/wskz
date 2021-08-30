<?php

namespace Middleware\Dispatcher;

use Middleware\Dispatcher\DispatcherInterface;
use Command\MiddlewareInterface;
use Middleware\Dispatcher\DispatcherTrait;

/**
 * A class used to dispatch command line
 */
class CommandDispatcher implements DispatcherInterface, MiddlewareInterface {
    use DispatcherTrait;

    public function dispatch() { }

    public function process() { }

}
