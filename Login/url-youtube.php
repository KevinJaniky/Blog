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
                            <h4 class="header2">Ajouter</h4>
                            <div class="row">
                                <form class="col s12" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="titre" type="text" name="titre" required >
                                            <label for="titre">Url</label>
                                        </div>
                                        <div class=" col s6">
                                            <p type="button" class="waves-effect waves-light btn generation" >Générer</p>
                                        </div>
                                    </div>
                                </form>
                                <div id="res"></div>
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

        $('.generation').click(function () {
            var url = $('#titre').val();
            $.post("generate_url.php",
                {url:url},
                function (data) {
                    $('#res').text(data);
                });
        });


    </script>

    <?php

} else {
    header('location:Home');
    die();
}
