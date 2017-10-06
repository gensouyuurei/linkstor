<?php

class TestPage extends view{

    public function __construct($par){
        $this->content = $par;
    }

    public static function make($par){
        return new TestPage($par);
    }

    public function render(){
        //ob_start();
        //super::render

        $html = '<a href="/main">Main</a> | ';
        $html .= 'Testpage</br>';
        $html .= '<p>'.$this->content.'</p></br>%s';

        $foot = new Footer();

        $final = sprintf($html, $foot);

        return $final;

    }
}