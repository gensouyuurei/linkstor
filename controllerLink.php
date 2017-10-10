<?php

class controllerLink{
    public static function mainpage($parameters){
        $links = new link();
        $links->pull(5,($parameters['id']['page']-1)*5);
        $parameters['content'] = $links->get();
        $parameters['highlight'] = 1;
        $view = new MainPage($parameters);
        echo $view;
    }

    public static function userlinks($parameters){
        $links = new link();
        $links->pull(5, 0, false);
        $parameters['content'] = $links->get();
        $parameters['highlight'] = 2;
        $view = new MainPage($parameters);
        echo $view;
    }

    public static function singlelink($parameters){
        $links = new link();
        $links->pullByID($parameters['id']['link']);
        $parameters['content'] = $links->get();
        $parameters['highlight'] = 0;
        $view = new MainPage($parameters);
        echo $view;
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
        //$parameters['cont_type'] = 'TestPage';
        $view = new TestPage($parameters);
        echo $view;
    }


}

