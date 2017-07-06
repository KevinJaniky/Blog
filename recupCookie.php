<?php
require_once "autoload.php";
if(isset($_GET['id'])) {
    $data = new Like();
    echo json_encode($data->recupCookie($_GET['id']));
}
