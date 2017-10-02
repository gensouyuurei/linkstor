<?php

class dbConnect{

    public static function connect($dbname, $login, $pass){
        $dsn = 'mysql:host=localhost;dbname='.$dbname;
        $pdo = new PDO($dsn, $login, $pass);
        return $pdo;
    }
}