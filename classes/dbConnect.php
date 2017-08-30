<?php

class dbConnect{

    public function connect($dbname, $login, $pass){
        $dsn = 'mysql:host=localhost;dbname='.$dbname;
        $pdo = new PDO($dsn, $login, $pass);
        return $pdo;
    }
}