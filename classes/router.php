<?php
class router{

    private $routes = array();

    public function addRoute($pattern, callable $handler){
        $this->routes[$pattern] = $handler;
        return $this;
    }

    public function match(request $req){

        $path = $req->getPath();

        foreach ($this->routes as $pattern => $handler) {
            if ($pattern === $path) {
                return $handler;
            }
        }
        return false;
    }

}