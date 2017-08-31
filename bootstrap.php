<?php
spl_autoload_register(function ($class){
    include $class.'.php';
    include 'models/'.$class.'.php';
    include 'classes/'.$class.'.php';
});

session_start();
$_SESSION['db'] = dbConnect::connect( 'linkstor','admin', 'pass');
$_SESSION['user'] = new user();