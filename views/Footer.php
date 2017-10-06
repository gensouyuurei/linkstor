<?php

class Footer extends view{

    public function __construct(){
        return;
    }

    public function render(){
        //ob_start();
        $foot = '<hr>';
        $foot .= '<p>blah blah (c) 2017</p>';
        $foot .= '</body></html>';
        return $foot;
    }
}