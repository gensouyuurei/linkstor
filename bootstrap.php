<?php
spl_autoload_register(function ($class){
    include 'models/'.$class.'.php';
});

function userHandler(){

}

$router = new router();
$router->addRoute('login', )

session_start();
$_SESSION['db'] = dbConnect::connect( 'linkstor','admin', 'pass');
$_SESSION['user'] = new user();