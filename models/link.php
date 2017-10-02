<?php

class link{

    private $list;


    public function __construct(){
        $this->list = array();
    }

    /*
    public function get($localID, $field){
        return $this->list[$localID][$field];
    }
    */

    public function get(){
        return $this->list;
    }

    public function edit($text){
        $this->list['link'] = $text;
        return;
    }

    public function add($text){

        $dateadded = date("Y-m-d H:i:s");
        $usrID = $_SESSION['user_id'];
        $query = "INSERT INTO links VALUES (NULL, '$usrID', '$text','$dateadded')";
        $catch = $_SESSION['db']->exec($query);

        if ($catch != false){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function pull($quantity, $offset, $is_all=true){

        $query = "SELECT * FROM links ";
        if ($is_all == false){
            $query = $query."WHERE user_id=".$_SESSION['user_id']." ";
        }
        $query = $query."ORDER BY date_added DESC LIMIT $offset, $quantity";
        $rawdata = $_SESSION['db']->query($query);

        $i = 1;
        foreach ($rawdata as $item){
            $this->list[$i] = $item;
            $i++;
        }
        return;
    }

    public function pullByID($id){

        $query = "SELECT * FROM links WHERE link_id=$id";
        $rawdata = $_SESSION['db']->query($query);

        $this->list = $rawdata->fetch();

        return;
    }

    public function update(){

        $id = $this->list['link_id'];
        $newtext = $this->list['link'];

        $query = "UPDATE links SET link=$newtext WHERE link_id=$id";
        $check = $_SESSION['db']->exec($query);
        if ($check != false){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function delete($id){

        $query = "DELETE FROM links WHERE link_id=$id";
        $check = $_SESSION['db']->exec($query);
        if ($check != false){
            return 1;
        }
        else{
            return 'dberror';
        }
    }
}
