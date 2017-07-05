<?php
require_once 'autoload.php';
if(isset($_POST['newsletter']) && isset($_POST['url'])) {
    $newsletter = $_POST['newsletter'];
    $url = $_POST['url'];
    $abonne = new Newsletter();
    $abonne->setMail($newsletter);
    $abonne->setUrl($url);
    if($abonne->verifExist()){
        $abonne->addEmail();
    }else {
        header('location:/Home');
    }
}else {
    header('location:/Home');
    die();
}