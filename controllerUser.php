<?php

if (isset($uri['2'])) {
    switch ($uri['2']) {
        case 'register':
            include 'views/register.html';
            if($_POST) {
                $message = $user->register($_POST['login'], $_POST['email'], $_POST['pass'], $_POST['passRep'], $_POST['firstN'], $_POST['lastN']);
                switch ($message) {
                    case 'dberrorcon':
                        echo "Can't connect to the db";
                        break;
                    case 'dberrorins':
                        echo "Can't write into the db";
                        break;
                    case 'fields':
                        echo "Please fill all fields";
                        break;
                    case 'nomatch':
                        echo "Passwords must match";
                        break;
                    case 'emailexists':
                        echo "User with that email already exists!";
                        break;
                    case 'loginexists':
                        echo "User with that login already exists!";
                        break;
                    case 1:
                        header('Location: /user/login');
                }
            }
            break;

        case 'login':
            include 'views/login.html';
            if($_POST) {
                $message = $user->log_in($_POST['login'], $_POST['password']);
                switch ($message) {
                    case 1:
                        $_SESSION['user'] = $user;
                        $_SESSION['user_auth'] = true;
                        break;
                    case 'dberrorcon':
                        echo "Can't connect to the db";
                        break;
                    case 'inclogin':
                        echo "Incorrect login";
                        break;
                    case 'incpass':
                        echo "Incorrect password";
                        break;
                }
                break;
            }
    }
}
else{
    include "views/startpage.html";
}
?>

