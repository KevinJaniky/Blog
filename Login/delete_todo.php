<?php
require_once 'autoload.php';

if(isset($_POST['id'])) {
    $data = new Manage();
    $data->deleteToDo($_POST['id']);
}