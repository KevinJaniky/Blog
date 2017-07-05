<?php
session_start();

function __autoload($classname) {
require_once "class/".$classname.'.php';
}

$_CATEGORIE = ['Musique','Web','Lifestyle','Culture','Humeur'];

function redirectionErreur404()
{
    header('Location: page_404.php');
    exit;
}