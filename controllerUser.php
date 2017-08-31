<?php

class controllerUser {
    public function login() {
        include 'views/login.html';
        if ($_POST) {
            $message = $_SESSION['user']->log_in($_POST['login'], $_POST['password']);
            if ($message == 1){
                $_SESSION['user_auth'] = true;
                echo 'login success';
                print_r($_SESSION['user']);
                header('Location: /main');
            }
            else{
                echo $message;
            }
            return;
        }
    }

    public function register(){
        include 'views/register.html';
        if($_POST) {
            $message = $_SESSION['user']->register($_POST['login'], $_POST['email'], $_POST['pass'], $_POST['passRep'], $_POST['firstN'], $_POST['lastN']);
            if ($message == 1){
                echo 'reg success';
            }
            else{
                echo $message;
            }
            return;
        }
    }
}

?>

