<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/AutoLoader.php';

use Middleware\Switcher;
use Http\Output;

$switcher = new Switcher();

$response = $switcher->execute();

$output = new Output($response);

$output->send();