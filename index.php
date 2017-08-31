<?php
include_once 'bootstrap.php';

$uri = array();
$uri = explode("/", $_SERVER['REQUEST_URI']);
$req = new request($uri['1'], 'get');

$router = new router();
$router->addRoute('', function (){ include 'views/startpage.html'; });
$router->addRoute('login', 'controllerUser::login');
$router->addRoute('register', 'controllerUser::register');
$router->addRoute('main', 'controllerLink::mainpage');
$router->addRoute('my_links', 'controllerLink::userLinks');


$disp = new dispatcher($router);
$disp->handle($req);


?>