<?php

class user{

    private $info;


    public function __construct(){
        $this->info = array();
    }

    public function get(){
        return $this->info;
    }

    public function showField($field, $item=0){
        if (isset($this->info[$field])) {
            return $this->info[$field];
        }
        else{
            return 'error';
        }
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

    public function getUserList($quantity, $offset){

        $query = "SELECT * FROM users LIMIT $offset, $quantity";
        $rawdata = $_SESSION['db']->query($query);

        $i = 1;
        foreach ($rawdata as $item){
            $this->info[$i] = $item;
            $i++;
        }
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
                    $_SESSION['user_auth'] = true;
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

    public function edit($new){

        if (isset($new['login'])){
            $this->info['login'] = $new['login'];
        }
        if (isset($new['first_name'])){
            $this->info['first_name'] = $new['first_name'];
        }
        if (isset($new['last_name'])){
            $this->info['last_name'] = $new['last_name'];
        }
        if (isset($new['email'])){
            $this->info['email'] = $new['email'];
        }
        if (isset($new['password']) && ($new['password'] === $new['repeat_pass'])){
            $this->info['password'] = $new['password'];
        }
    }

    public function update(){
        $query = "UPDATE users SET login=".$this->info['login'].
            ", email=".$this->info['email'].
            ", password=".$this->info['password'].
            ", first_name=".$this->info['first_name'].
            ", last_name=".$this->info['last_name'].
            " WHERE user_id=".$this->info['user_id'];

        $check = $_SESSION['db']->exec($query);
        if ($check != false){
            return 1;
        }
        else{
            return 'error';
        }
    }
}