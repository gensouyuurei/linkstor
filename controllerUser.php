<?php

class controllerUser {
    public static function login($parameters) {
        //include 'views/mainpage.html';
        //include 'views/login.html';
        $parameters['content_type'] = 'login';
        view::render($parameters);
        if ($_POST) {
            $user = new user();
            $message = $user->log_in($_POST['login'], $_POST['password']);
            if ($message == 1){
                print_r($_SESSION);
                echo '<br/><a href = "/main">proceed</a>';
                //header('Location: /main');
            }
            else{
                echo $message;
            }
            return;
        }
    }

    public static function register($parameters){
        //include 'views/mainpage.html';
        //include 'views/register.html';
        $parameters['content_type'] = 'registration';
        view::render($parameters);
         if($_POST) {
            $message = $_SESSION['user']->register($_POST['login'], $_POST['email'], $_POST['pass'], $_POST['passRep'], $_POST['firstN'], $_POST['lastN']);
            if ($message == 1){
                header('Location: /login');
            }
            else{
                echo $message;
            }
            return;
        }
    }

    public static function edit($parameters){
        //include 'views/mainmenu.html';
        $parameters['content_type'] = 'edituser';
        $user = new user();
        $user->getUserInfo($_SESSION['user_id']);
        $parameters['content'] = $user->get();
        //include 'views/edituserform.html';
        view::render($parameters);
        if($_POST){
            $user->edit($_POST);
            $message = $user->update();
            if ($message == 1){
                return;
            }
            else{
                echo $message;
                return;
            }
        }
    }
}


