<?php
require_once "models/link.php";
require_once "models/linklist.php";
session_start();

switch ($_GET['action']){
    case 'main':
        $offset = ($_GET['page']-1)*5;
        $contentList = new linklist(5,$offset);
        for ($i = 1; $i < 6; $i++){
            echo "page included $i times";
            $content = new link(1);
            $content = $content->get_by_id();
            include "views/mainpage.html";
        }
        break;
    case 'my':

        break;
    case 'show':

        break;
    case 'edit':

        break;
    case 'delete':

        break;
}
?>