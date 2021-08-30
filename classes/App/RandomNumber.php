<?php

namespace App;

use Http\RequestHandlerInterface;
use Http\Message\ServerRequestInterface;
use Http\Message\ResponseInterface;
use MVC\View\JsonView;

class RandomNumber implements RequestHandlerInterface {
    private $view;

    public function handle(ServerRequestInterface $request) : ResponseInterface {
        $this->view = new JsonView();

        $random_number = random_int(1, 100);

        $output = json_encode( ['random_number' => $random_number] );

        return $this->view->output($output);
    }

}
