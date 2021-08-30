<?php

namespace Http;

use Http\Message\ResponseInterface;

class Output {
    private $response;

    public function __construct(ResponseInterface $response) {
        $this->response = $response;
    }

    public function send() {
        foreach ($this->response->getHeaders() as $header_name => $header_value) {
            header("$header_name: $header_value");
        }

        header( 'HTTP/' . $this->response->getProtocolVersion() . ' ' . $this->response->getStatusCode() );

        echo $this->response->getBody();
    }

}
