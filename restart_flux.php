<?php

require 'autoload.php';

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $data = new FluxRss();
    $data->updateFlux();
    header('location:/Login');

}else{
    redirectionErreur404();
}

