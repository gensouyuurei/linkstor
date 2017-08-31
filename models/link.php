<?php
class link{
    private $list;

    public function __construct(){
        $this->list = array();
    }

    public function get($locID, $field){
        return $this->list[$locID][$field];
    }

    public function add($text){

        $dateadded = date("Y-m-d H:i:s");
        $usrID = $_SESSION['user']->usrID;
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
            $query = $query."WHERE user_id=".$_SESSION['user']->getId()." ";
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
}
?>