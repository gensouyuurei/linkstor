<?php
session_start();

spl_autoload_register(function ($class){
    include $class.'.php';
    include 'models/'.$class.'.php';
    include 'classes/'.$class.'.php';
    include 'views/'.$class.'.php';
});

$_SESSION['db'] = dbConnect::connect( 'linkstor','admin', 'pass');