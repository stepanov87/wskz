<?php

namespace Middleware\Dispatcher;

use Config\Config;

/**
 * A set of common traits for dispatchers
 */
trait DispatcherTrait {
    private $config;

    public function setConfig(Config $config) {
        $this->config = $config;
    }

}
