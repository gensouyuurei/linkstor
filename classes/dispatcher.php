<?php

class dispatcher{

    private $router;

    public function __construct(router $rtr){
        $this->router = $rtr;
    }

    public function handle(request $req, $parameters){
        $handler = $this->router->match($req);
        if (!$handler){
            echo "404";
        }
        else{
            if (is_callable($handler) == true) {

                $parameters['id'] = $req->getID();
                $parameters['method'] = $req->getMethod();
                $parameters['uri'] = $req->getPath();

                call_user_func($handler, $parameters);

            }
            else{
                echo 'is not callable';
            }
        }
    }
}