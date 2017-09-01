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

                if($req->getID() == 0) {
                    call_user_func($handler);
                    return;
                }
                else{
                    call_user_func($handler, $req->getID());
                }
            }
            else{
                echo 'is not callable';
                return;
            }
        }
    }
}