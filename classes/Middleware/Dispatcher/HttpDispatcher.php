<?php

namespace Middleware\Dispatcher;

use Middleware\Dispatcher\DispatcherInterface;
use Middleware\Dispatcher\DispatcherTrait;
use Http\Server\MiddlewareInterface;
use Http\Message\ResponseInterface;
use Http\Message\ServerRequestInterface;
use Http\Message\ServerRequest;
use Http\RequestHandlerInterface;

/**
 * A class used to dispatch HTTP requests
 */
class HttpDispatcher implements DispatcherInterface, MiddlewareInterface {
    use DispatcherTrait;

    private $serverRequest;

    public function __construct() {
        $this->serverRequest = ServerRequest::generateFromGlobals();
    }

    public function dispatch() {
        // Finding out the proper handler to handle the request

        $uri = $this->serverRequest->getUri();
        echo $uri . '<br>';

        foreach ($this->config as $uri_mask) {
            /* if ( preg_match_all($regex, $string, $matches, PREG_SET_ORDER) ) {
                
            } */

            echo $uri_mask . '<br>';
        }

        // No route found

        
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        $response = $handler->handle($request);

        if (true) {
            $response = $response->withHeader(
                'Content-Length',
                (string)$response->getBody()->getSize()
            );
        }

        return $response;
    }

}