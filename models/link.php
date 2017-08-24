<?php
class link{
    private $id;
    private $usrID;
    private $text;
    private $date;

    public function __construct($usrID, $id=0, $text=0, $date=0){
        if($id == 0) {
            $this->usrID = $usrID;
        }
        else{
            $this->id = $id;
            $this->usrID = $usrID;
            $this->text = $text;
            $this->date = $date;
        }
    }

    public function id(){
        return $this->id;
    }
    public function usrID(){
        return $this->usrID;
    }
    public function text(){
        return $this->text;
    }
    public function date(){
        return $this->date;
    }

    public function add($text){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=linkstor', 'admin', 'pass');
        }
        catch (PDOException $e){
            return "dberrorcon";
        }

        $dateadded = date("Y-m-d H:i:s");
        $query = "INSERT INTO links VALUES (NULL, '$this->usrID', '$text','$dateadded')";
        $catch = $pdo->exec($query);

        if ($catch != false){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function get_by_id($id){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=linkstor', 'admin', 'pass');
        }
        catch (PDOException $e){
            return "dberrorcon";
        }

        $query = "SELECT * FROM links WHERE link_id=$id";
        $get = $pdo->query($query);
        $info = $get->fetch();

        $this->id = $info['link_id'];
        $this->usrID = $info['user_id'];
        $this->text = $info['link'];
        $this->date = $info['date_added'];

        return ;
    }
}
?>