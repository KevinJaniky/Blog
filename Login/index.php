<?php
require_once 'autoload.php';

$display = new Display();
$display->head('Connexion ');
$user = new User();

if(isset($_SESSION['admin']) && $_SESSION['admin'] == true  ){
    header('location:Dashboard');
    die();
}

?>

    <head>
        <link rel="stylesheet" href="materialize/css/materialize.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="materialize/js/jquery.js"></script>
        <script src="materialize/js/materialize.js"></script>
    </head>
    <style>
        html,
        body {
            height: 100%;
        }
        html {
            display: table;
            margin: auto;
        }
        body {
            display: table-cell;
            vertical-align: middle;
        }
        #login-page>div {
            min-width: 395px;
        }
    </style>

    <body class="cyan loaded">


    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->



    <div id="login-page" class="row">
        <div class="col s12 z-depth-4 card-panel">
            <form class="login-form" method="post">
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="/bonbon/media/logo.png" style="width: 200px;" alt="" class="circle responsive-img valign profile-image-login">
                        <p class="center login-form-text">Backoffice</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <input id="mail" type="email" name="mail">
                        <label for="mail" class="center-align" >Mail</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="mdp">
                        <label for="password">Mot de passe</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button href="index.html" class="btn waves-effect waves-light col s12">Login</button>
                    </div>
                </div>

                <?php

                if(isset($_POST['mail']) && isset($_POST['mdp']))
                {
                    $mail = $_POST['mail'];
                    $mdp = $_POST['mdp'];

                    $user->setMail($mail);
                    $user->setMdp($mdp);
                    $user->verifUser();
                    $res = $user->createSession();


                    if($res) {
                        header('location:Dashboard');
                        die();
                    }else {
                        echo "Error ";
                    }

                }


                ?>
            </form>
        </div>
    </div>
    </body>