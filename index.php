<?php
echo "index.php";
$url = explode("/", $_SERVER['REQUEST_URI']);
switch ($url[0]){
    case 'login':
        echo 'login';
        break;
    case 'register':
        echo "register";
        break;
}
?>