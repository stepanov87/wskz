<?php

namespace Http;

use Http\Message\ResponseInterface;

class Output {
    private $response;

    public function __construct(ResponseInterface $response) {
        $this->response = $response;
    }

    public function send() {
        $headers = $this->response->getHeaders();

        print_r($headers);
    }

}
