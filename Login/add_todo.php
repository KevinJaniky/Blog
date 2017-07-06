<?php
require 'autoload.php';
if(isset($_POST['tache'])) {
    $data = new Manage();
    $data->addToDoList($_POST['tache']);
}