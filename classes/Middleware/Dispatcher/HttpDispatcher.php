<?php

namespace Middleware\Dispatcher;

use Middleware\Dispatcher\DispatcherInterface;
use Middleware\Dispatcher\DispatcherTrait;
use Http\Server\MiddlewareInterface;
use Http\Message\ResponseInterface;
use Http\Message\ServerRequestInterface;
use Http\Message\ServerRequest;
use Http\Message\Response;
use Http\RequestHandlerInterface;

/**
 * A class used to dispatch HTTP requests
 */
class HttpDispatcher implements DispatcherInterface, MiddlewareInterface {
    use DispatcherTrait;

    private $serverRequest;
    private $response;

    public function __construct() {
        $this->serverRequest = ServerRequest::generateFromGlobals();
        $this->response = Response::generateDefault();
    }

    public function dispatch() {
        // Finding out the proper handler to handle the request

        $uri = $this->serverRequest->getUri();

        foreach ($this->config as $uri_mask) {
            if ( preg_match_all($uri_mask, $uri, $matches, PREG_SET_ORDER) ) {
                // Route foun

                $controller_class = $this->config->getItem($uri_mask);

                $controller = new $controller_class();

                if ( !($controller instanceof RequestHandlerInterface) ) {
                    throw new \Exception('Controller is invalid');
                }

                // TODO: To implement
                // $controller->setParams($matches);

                return $controller->handle($this->serverRequest);
            }
        }

        // No route found

        return $this->response
            ->withStatus(404)
            ->withAddedHeader('Content-Type', 'text/html');
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