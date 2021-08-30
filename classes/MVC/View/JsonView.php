<?php

namespace MVC\View;

use MVC\ViewInterface;
use Http\Message\RequestBody;
use Http\Message\Response;

/**
 * A class to represent a json output
 */
class JsonView implements ViewInterface {
    private $response;

    public function __construct() {
        $this->response = Response::generateDefault();
    }

    public function output($output) {
        $request_body = new RequestBody();
        $request_body->write($output);

        return $this->response
            ->withStatus(200)
            ->withBody($request_body)
            ->withAddedHeader('Content-Type', 'application/json');
    }

}