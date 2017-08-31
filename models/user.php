<?php

class user{
    private $id;
    private $login;
    private $email;
    private $pass;
    private $firstN;
    private $lastN;
    private $priv;
    private $active;

    public function __construct(){
        $this->priv = 'anon';
    }

    public function getId(){
        return $this->id;
    }
    public function getLogin(){
        return $this->login;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getFirstN(){
        return $this->firstN;
    }
    public function getLastN(){
        return $this->lastN;
    }
    public function is_active(){
        return $this->active;
    }

    public function log_in($log, $passw){

        $query = "SELECT user_id, login, password FROM users";
        $check = $_SESSION['db']->query($query);

        //$logincheck = false;
        //$passcheck = false;
        foreach ($check as $item){
            if ($item['login'] === $log){
                $logincheck = true;
                if ($item['password'] === $passw){
                    $passcheck = true;
                    $this->id = $item['user_id'];
                }
            }
        }

        if (($logincheck == true) && ($passcheck == true)){
            $query = "SELECT * FROM users WHERE user_id = $this->id";
            $inp = $_SESSION['db']->query($query);
            $info = $inp->fetch();

            $this->login = $info['login'];
            $this->email = $info['email'];
            $this->pass = $info['password'];
            $this->firstN = $info['first_name'];
            $this->lastN = $info['last_name'];
            $this->priv = $info['privileges'];
            $this->active = $info['is_active'];
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
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=linkstor', 'admin', 'pass');
        }
        catch (PDOException $e){
            return "dberrorcon";
        }

        if (!$email || !$login || !$first || !$last || !$pass ){
            return 'fields';
        }
        elseif ($pass && ($pass !== $passRep)){
            return 'nomatch';
        }
        else {
            $query = "SELECT email, login FROM users";
            $check = $pdo->query($query);

            foreach ($check as $item){
                if($item['email'] === $email){
                    return 'emailexists';
                }
                elseif ($item['login'] === $login){
                    return 'loginexists';
                }
            }

            $query = "INSERT INTO users VALUES (NULL, '$login', '$email', '$pass', '$first', '$last', 'user', FALSE)";
            $catch = $pdo->exec($query);

            //$hash = md5(rand(1, 10000));
            //$activation_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?=".$hash;
            //$activation_link = "test";
            //$mailcatch = mail($email, 'Activate your account\r\n', $activation_link, 'From: admin\r\n');
            if (($catch != false)/* && ($mailcatch != false)*/){
                return 1;
            }
            else{
                return 'dberrorins';
            }
        }
    }
}