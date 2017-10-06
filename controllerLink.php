<?php

class controllerLink{
    public static function mainpage($parameters){
        //include 'views/mainmenu.html';
        $parameters['content_type'] = 'MainPage';
        $links = new link();
        $links->pull(5,0);
        $parameters['content'] = $links->get();
        $view = new view($parameters);
        echo $view;
    }

    public static function userlinks($parameters){
        //include 'views/mainmenu.html';
        $parameters['content_type'] = 'userlinks';
        $links = new link();
        $links->pull(5, 0, false);
        $parameters['content'] = $links->get();
        view::render($parameters);
        return;
    }

    public static function singlelink($parameters){
        //include 'views/mainmenu.html';
        $parameters['content_type'] = 'singlelink';
        $links = new link();
        $links->pullByID($parameters['id']);
        $parameters['content'] = $links->get();
        view::render($parameters);
        return;
    }

    public static function add($parameters){
        //include 'views/mainmenu.html';
        //include 'views/addform.html';
        $parameters['content_type'] =
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

    public static function edit($parameters){
        //include "views/mainmenu.html";
        $link = new link();
        $link->pullByID($parameters['id']);
        //include 'views/editform.html';
        if ($_POST){
            $link->edit($_POST['text']);
            $link->update();
        }
    }

    public static function delete($parameters){
        //include 'views/mainmenu.html';
        $link = new link();
        $message = $link->delete($parameters['id']);
        if($message == 1){
            header('Location: /main');
        }
        else{
            echo $message;
        }
    }

    public static function fortesting($parameters){
        $parameters['cont_type'] = 'TestPage';
        $view = new view($parameters);
        echo $view;
    }


}

