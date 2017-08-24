<?php
require_once "models/user.php";
session_start();
$uri = array();
$uri = explode("/", $_SERVER['REQUEST_URI']);
$user = new user();
if (isset($uri['1'])) {
    switch ($uri['1']) {
        case 'user':
            include 'controllerUser.php';
            break;
        case 'links':
            if (isset($_SESSION['user']) && (
                    ($_SESSION['user']->priv() === 'user') ||
                    ($_SESSION['user']->priv() === 'editor') ||
                    ($_SESSION['user']->priv() === 'admin')
                )
            )
                include 'controllerLink.php';
            break;
        case 'admin':
            if (isset($_SESSION['user']) && ($_SESSION['user']->priv() === 'admin')) {
                include 'controllerAdmin.php';
            } else {
                echo 'Forbidden!';
            }
            break;
        default:
            echo '404';
            break;
    }
}
else{
    include "views/startpage.html";
}
?>