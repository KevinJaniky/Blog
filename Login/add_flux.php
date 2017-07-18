<?php
require_once "autoload.php";

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $display = new Display();
    $display->head('Dashboard');
    $display->navTop();
    $display->sideBar();
    $data = new Article();
    $data = $data->all();
    $count = count($data);
    $com = new Rss();
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
                                <form class="col s12" method="post">
                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="titre" type="text" name="titre" required >
                                            <label for="titre">Titre</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <select name="link">
                                                <option value="" disabled selected>Choisir l'article a remonter</option>

                                                <?php
                                                    for($i=0;$i<$count;$i++) {
                                                        echo ' <option value="/'.$data[$i]['id'].'/'.str_replace(' ','-',$data[$i]['titre']).'">'.$data[$i]['titre'].'</option>';

                                                    }

                                                ?>
                                            </select>
                                            <label>Materialize Select</label>
                                        </div>

                                        <div class="input-field col s12 ">
                                            <input id="desc" type="text" name="desc" required >
                                            <label for="desc">Description</label>
                                        </div>
                                        <div class=" col s12">
                                            <button  type="submit" class="waves-effect waves-light btn generation" >Ajouter</button>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                    if(isset($_POST['titre']) && isset($_POST['link']) && isset($_POST['desc'])) {
                                        $titre = $_POST['titre'];
                                        $link = $_POST['link'];
                                        $desc = $_POST['desc'];

                                        $data = new Rss();
                                        $data->add($titre,$link,$desc);
                                        $data->updateFlux();
                                        ?>
                                        <script>
                                           // window.location = '/Login/Flux-rss';
                                        </script>
                                        <?php
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

        $(document).ready(function() {
            $('select').material_select();
        });

    </script>

    <?php

} else {
    header('location:Home');
    die();
}
