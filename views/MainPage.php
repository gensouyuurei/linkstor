<?php
class MainPage extends view{

    public function __construct($par){
        parent::__construct($par);
    }

    public function render(){

        $frame = parent::render();
        $menu = parent::menuMain();
        $pager = parent::pager();

        $i = 1;
        $html = '';
        foreach ($this->content as $item){
            $html .= '<p>'.$item['link_id'].' '.$item['link'].'</p>';
            $html .= '<hr>';
            $i++;
        }

        $page = sprintf($frame, 'Main page', $menu, $html, $pager);

        return $page;
    }
}