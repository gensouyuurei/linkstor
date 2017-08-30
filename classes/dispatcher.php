<?php

class dispatcher{

    private $router;

    public function __construct(router $rtr){
        $this->router = $rtr;
    }

    public function handle(request $req){
        $handler = $this->router->match($req);
        if (!$handler){
            echo "404";
            return;
        }
        else{
            $handler();
        }
    }
}