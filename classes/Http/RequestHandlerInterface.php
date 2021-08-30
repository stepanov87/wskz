<?php

namespace Http;

use Http\Message\ResponseInterface;
use Http\Message\ServerRequestInterface;

interface RequestHandlerInterface {

    public function handle(ServerRequestInterface $request) : ResponseInterface;

}
