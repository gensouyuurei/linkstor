<?php
class request {

    private $path;
    private $id;
    private $method;

    function __construct($path, $id=0, $method){
        $this->method = $method;
        $this->id = $id;
        $this->path = $path;
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