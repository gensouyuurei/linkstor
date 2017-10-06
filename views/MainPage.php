<?php
class MainPage extends view{
    public function __construct($par){
        $this->content = $par;
    }

    public static function make($par){
        return new MainPage($par);
    }

    public function render(){

        /*
        $html = 'Main | ';
        $html .= '<a href="/my_links">My links</a> | ';
        $html .= '<a href="/account">Account</a> | ';
        $html .= '<a href="/add">Add link</a></br></br>';
/*
        $i = 1;
        foreach ($this->content as $item){
            //$part = $item['$i'];
            //$html .= '<p>'.$part['link_id'].' '.$part['link'].'</p>';
            $html .= '<hr>';
            $i++;
        }

        $html .= '%s';
        $foot = new Footer();
        $final = sprintf($html, $foot);

        return $final;
        */

        $html = '<a href="/main">Main</a> | ';
        $html .= 'Testpage</br>';
        //$html .= '<p>'.$this->content.'</p></br>%s';

        $foot = new Footer();

        $final = sprintf($html, $foot);

        return $final;
    }
}