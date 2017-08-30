<?php
class request {

    private $path;
    private $method;

    function __construct($path, $method){
        $this->method = $method;
        $this->path = $path;
    }

    public function getPath(){
        return $this->path;
    }

    public function getMethod(){
        return $this->method;
    }
}