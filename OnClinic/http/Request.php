<?php

namespace OnClinic\Http;

class Request
{
    private $httpMethod;
    private $uri;
    private $queryParams = [];
    private $postParams = [];
    private $headers = [];

    public function __construct(){
        $this->queryParams = $_GET ?? [];
        $this->postParams = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';

    }

    public function getHttpMethod(){
        return $this->httpMethod;
    }

    public function getUri(){
        return $this->uri;
    }

    public function getQueryParams(){
        return $this->queryParams;
    }

    public function getPostParams(){
        return $this->postParams;
    }

    public function getHeaders(){
        return $this->headers;
    }

}

?>