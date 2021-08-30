<?php

namespace MVC\View;

use MVC\ViewInterface;

/**
 * A class to represent an output to the command line
 */
class CommandLineView implements ViewInterface {

    public function output($output) {}

}