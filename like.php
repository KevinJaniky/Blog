<?php
require_once 'autoload.php';
if(isset($_GET['id']) && isset($_GET['title'])) {
    $data = new Like();
    $data->Like($_GET['id']);
    header('location:/Article/'.$_GET['id'].'/'.$_GET['title']);
    die();
}
