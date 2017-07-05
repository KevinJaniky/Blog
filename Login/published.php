<?php
require_once 'autoload.php';

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = new Article();
        $data->published($id);
        header('location:/Login/Article');
        die();
    }
}
