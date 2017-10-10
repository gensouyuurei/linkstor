<?php

class TestPage extends view{

    public function __construct($par){
        parent::__construct($par);
    }

    public function render(){
        //ob_start();

        $head = parent::render();

        $html = '<a href="/main">Main</a> | ';
        $html .= 'Testpage</br>';
        $html .= '<p>'.$this->content.'</p></br>';

        $page = sprintf($head, 'Test page', $html);

        return $page;

    }
}