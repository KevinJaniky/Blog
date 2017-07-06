<?php
require_once "autoload.php";

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $display = new Display();
    $display->head('Dashboard');
    $display->navTop();
    $display->sideBar();
    $data = new Article();
    $_CATEGORIE = ['Musique', 'Web', 'Lifestyle', 'Culture', 'Humeur'];

    $com = new Manage();
    ?>
    <body class="grey lighten-2">
    <script src="../ckeditor/ckeditor.js"></script>
    <div class="container">
        <div class="wrapper">
            <div id="basic-form" class="section">
                <div class="row">
                    <div class="col s12 m12 l10 offset-l1">
                        <div class="card-panel">
                            <h4 class="header2">Modifier Player</h4>
                            <div class="row">
                                <form class="col s12" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="file-field input-field">
                                            <div class="btn cyan lighten-1">
                                                <span>File</span>
                                                <input type="file" name="music">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                        <div class=" col s12">
                                            <button type="submit" class="waves-effect waves-light btn cyan lighten-1 right" >Modifer</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if(isset($_FILES['music'])) {
                                    $data = new Manage();
                                    var_dump($data->musicPlayerUpdate($_FILES['music']));
                                } else {
                                    echo 'ici';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script>
        $(".button-collapse").sideNav();
    </script>

    <?php

} else {
    header('location:Home');
    die();
}
