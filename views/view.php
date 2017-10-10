<?php
class view{ //frame class

    protected $content;
    private $uri;
    private $menu;
    private $highlight;
    private $currentpage;

    public function __construct($par){
        $this->content = $par['content'];
        $this->highlight = $par['highlight'];
        $this->currentpage = $par['id']['page'];
        $this->uri = $par['uri'];
        $this->menu = [
            '1'=>['1'=>'/main', '2'=>'Main'],
            '2'=>['1'=>'/my_links', '2'=>'My links'],
            '3'=>['1'=>'/add', '2'=>'Add link'],
            '4'=>['1'=>'/account', '2'=>'Account']
            ];
    }

    public function __toString(){
        $html = $this->render();
        return $html;
    }

    public function menuMain(){

        $menu = '';
        for ($i = 1; $i<=4; $i++){
            if ($i == $this->highlight){
                $menu .= $this->menu[$i][2].' | ';
            }
            else {
                $menu .= '<a href="' . $this->menu[$i][1] . '">' . $this->menu[$i][2] . '</a> | ';
            }
        }

        return $menu;
    }

    public function pager(){

        $pager = '<a href="/%1$s/page/'.($this->currentpage-1).'">prev</a>';
        for ($i = $this->currentpage-3; $i <= $this->currentpage+3; $i++){
            if ($i == $this->currentpage){
                $pager .= ' '.$i.' ';
            }
            else{
                $pager .= ' <a href="/%1$s/page/'.$i.'">'.$i.'</a> ';
            }
        }
        $pager .= '<a href="/%1$s/page/'.($this->currentpage+1).'">next</a>';

        $finalpager = sprintf($pager, $this->uri);

        return $finalpager;
    }

    public function render(){
        //ob_start();

        //header
        $frame = '<html>';
        $frame .= '<head><title>%1$s</title></head>';
        $frame .= '<body>%2$s'.'%3$s'.'%4$s';
        //footer
        $frame .= '<hr>';
        $frame .= '<p>blah blah (c) 2017</p>';
        $frame .= '</body></html>';

        return $frame;

    }

}