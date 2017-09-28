<?php

class controllerUser {
    public function login() {
        include 'views/mainpage.html';
        //include 'views/login.html';
        $_POST['login'] = 'user';
        $_POST['password'] = 'pass';
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

    public function register(){
        include 'views/mainpage.html';
        //include 'views/register.html';
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

    public function edit(){
        //include 'views/mainmenu.html';
        $user = new user();
        echo 'new user ';
        echo $_SESSION['user_id'];
        $user->getUserInfo($_SESSION['user_id']);
        echo 'get info ';
        include 'views/edituserform.html';
        echo 'view loaded ';
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

?>

