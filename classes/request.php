<?php
class request {

    private $path;
    private $id;
    private $method;

    function __construct($uri, $method){
        $this->method = $method;
        $this->path = $uri['1'];
        $this->id = [$uri['2'] => $uri['3']];
    }

    public function getPath(){
        return $this->path;
    }

    public function getID(){
        return $this->id;
    }

    public function getMethod(){
        return $this->method;
    }
}