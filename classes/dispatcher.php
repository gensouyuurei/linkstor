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
            if (is_callable($handler) == true) {
                call_user_func($handler);
                return;
            }
            else{
                echo 'is not callable';
                return;
            }
        }
    }
}