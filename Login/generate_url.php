<?php
    require_once 'autoload.php';

    if(isset($_POST['url'])){
        $url = $_POST['url'];
        $manage = new Manage();
        $tab = $manage->createUrlYoutube($url);
        echo $tab;
    }


