<?php

class controllerLink{
    public function mainpage(){
        include 'views/mainmenu.html';
        print_r($_SESSION);
        $links = new link();
        $links->pull(5, 0);
        print_r($links);
        return;
    }

    public function userlinks(){
        include 'views/mainmenu.html';
        $links = new link();
        $links->pull(5, 0, false);
        print_r($links);
        return;
    }

    public function singlelink($id){
        include 'views/mainmenu.html';
        $link = new link();
        $link->pullByID($id);
        print_r($link);
        return;
    }

    public function add(){
        include 'views/mainmenu.html';
        //include 'views/addform.html';
        $link = new link();
        if ($_POST){
            $message = $link->add($_POST['text']);
            if ($message == 1){
                header('Location: /main');
            }
            else{
                echo $message;
            }
            return;
        }
    }

    public function edit($id){
        include "views/mainmenu.html";
        $link = new link();
        $link->pullByID($id);
        //include 'views/editform.html';
        if ($_POST){
            $link->edit($_POST['text']);
            $link->update();
        }
    }

    public function delete($id){
        include 'views/mainmenu.html';
        $link = new link();
        $message = $link->delete($id);
        if($message == 1){
            header('Location: /main');
        }
        else{
            echo $message;
        }
    }


}

?>