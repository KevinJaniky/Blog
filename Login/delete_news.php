<?php
require 'autoload.php';
if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if (is_numeric($id)) {
            $data = new Newsletter();
            $data->delete($id);
        }
    }else{
        redirectionErreur404();
    }
}else{
    redirectionErreur404();
}