<?php

class user{

    private $info;


    public function __construct(){
        $this->info = array();
    }

    public function getName($id){
        $query = "SELECT first_name, last_name FROM users WHERE user_id=$id";
        $rawinfo = $_SESSION['db']->query($query);
        $this->info = $rawinfo->fetch();
        return;
    }

    public function getUserInfo($id){
        $query = "SELECT * FROM users WHERE user_id=$id";
        $rawinfo = $_SESSION['db']->query($query);
        $this->info = $rawinfo->fetch();
        return;
    }

    public function log_in($log, $passw){

        $query = "SELECT user_id, login, password FROM users";
        $check = $_SESSION['db']->query($query);
        foreach ($check as $item){
            if ($item['login'] === $log){
                $logincheck = true;
                if ($item['password'] === $passw){
                    $passcheck = true;
                    $_SESSION['user_id'] = $item['user_id'];
                }
            }
        }

        if (($logincheck == true) && ($passcheck == true)){
            return 1;
        }
        elseif (($logincheck != true)){
            return 'inclogin';
        }
        elseif (($logincheck == true) && ($passcheck != true)){
            return 'incpass';
        }
    }

    public function register($login, $email, $pass, $passRep, $first, $last){

        if (!$email || !$login || !$first || !$last || !$pass ){
            return 'fields';
        }
        elseif ($pass && ($pass !== $passRep)){
            return 'nomatch';
        }
        else {
            $query = "SELECT email, login FROM users";
            $check = $_SESSION['db']->query($query);

            foreach ($check as $item){
                if($item['email'] === $email){
                    return 'emailexists';
                }
                elseif ($item['login'] === $login){
                    return 'loginexists';
                }
            }

            $query = "INSERT INTO users VALUES (NULL, '$login', '$email', '$pass', '$first', '$last', 'user', FALSE)";
            $catch = $_SESSION['db']->exec($query);

            if ($catch != false){
                return 1;
            }
            else{
                return 'dberrorins';
            }
        }
    }
}