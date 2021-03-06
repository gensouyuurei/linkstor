<?php
include 'bootstrap.php';

$router = new router();
$router->addRoute('', function (){ include 'views/startpage.html'; });
$router->addRoute('login', 'controllerUser::login');
$router->addRoute('register', 'controllerUser::register');
$router->addRoute('account', 'controllerUser::edit');
$router->addRoute('main', 'controllerLink::mainpage');
$router->addRoute('my_links', 'controllerLink::userLinks');
$router->addRoute('link', 'controllerLink::singlelink');
$router->addRoute('add', 'controllerLink::add');
$router->addRoute('test','ControllerLink::fortesting');

$uri = array();
$uri = explode("/", $_SERVER['REQUEST_URI']);
$req = new request($uri, 'get');

$disp = new dispatcher($router);
$parameters = array();
$disp->handle($req, $parameters);

