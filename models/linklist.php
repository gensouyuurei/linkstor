<?php
class linklist{
    private $linklist;
    private $quantity;

    public function __construct($quantity, $offset, $userID=0){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=linkstor', 'admin', 'pass');
        }
        catch (PDOException $e){
            return "dberrorcon";
        }

        if ($userID == 0) {
            $query = "SELECT * FROM links ORDER BY date_added DESC LIMIT $offset, $quantity";
        }
        else{
            $query = "SELECT * FROM links WHERE user_id=$userID ORDER BY date_added DESC LIMIT $offset, $quantity";
        }

        $this->quantity = $quantity;

        $get = $pdo->query($query);
        $i = 0;
        foreach ($get as $item){
            $this->linklist[$i] = new link($item['user_id'], $item['link_id'],$item['link'], $item['date_added']);
            $i++;
        }

    }

    public function get($num){
        if ($num <= $this->quantity){
            return $this->linklist['$num'];
        }
        else{
            return NULL;
        }
    }
}

?>