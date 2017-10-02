<?php
class app{
    private $parameters;

    public function __construct($params){
        $this->parameters = $params;
    }

    public function boot(){
        session_start();

        spl_autoload_register(function ($class){
            include $class.'.php';
            include 'models/'.$class.'.php';
            include 'classes/'.$class.'.php';
        });

        $_SESSION['db'] = dbConnect::connect( 'linkstor','admin', 'pass');
    }

    public function run(){
        $router = new router();
        $router->addRoute('', function (){ include 'views/startpage.html'; });
        $router->addRoute('login', 'controllerUser::login');
        $router->addRoute('register', 'controllerUser::register');
        $router->addRoute('account', 'controllerUser::edit');
        $router->addRoute('main', 'controllerLink::mainpage');
        $router->addRoute('my_links', 'controllerLink::userLinks');
        $router->addRoute('link', 'controllerLink::singlelink');
        $router->addRoute('add', 'controllerLink::add');

        $uri = array();
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $req = new request($uri['1'], $uri['2'], 'get');

        $disp = new dispatcher($router);
        $disp->handle($req, $this->parameters);
    }

}