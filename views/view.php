<?php
class view{ //carcass class

    protected $content;
    private $content_type;

    public function __construct($par){
        $this->content = $par['content'];
        $this->content_type = $par['cont_type'];
    }

    public function __toString(){
        $html = $this->render();
        return $html;
    }

    public function render(){
        //ob_start();
        $head = '<html>';
        $head .= '<head><title>Testpage</title></head>';
        $head .= '<body>%s';


        $tocall = $this->content_type.'::make';
        $content_space = call_user_func($tocall, $this->content);
        $html = sprintf($head, $content_space);


        return $html;

    }

}