<?php
require_once "autoload.php";

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $display = new Display();
    $display->head('Dashboard');
    $display->navTop();
    $display->sideBar();

    $_CATEGORIE = ['Musique', 'Web', 'Lifestyle', 'Culture', 'Humeur'];
    ?>
    <body>
    <script src="../ckeditor/ckeditor.js"></script>
    <div class="container">
        <div id="basic-form" class="section">
            <div class="row">
                <div class="col s12 m12 l10 offset-l1">
                    <div class="card-panel">
                        <h4 class="header2">Ajouter</h4>
                        <div class="row">
                            <form class="col s12" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="titre" type="text" name="titre" required>
                                        <label for="titre">Titre</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="file-field input-field">
                                        <div class="btn cyan lighten-1">
                                            <span>File</span>
                                            <input type="file" name="couverture">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select class="initialized" name="categorie">
                                            <option value="" disabled="" selected="">Choose your option</option>
                                            <?php
                                            for ($i = 0; $i < 5; $i++){
                                                echo '<option value="' . $i . '">' . $_CATEGORIE[$i] . '</option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="key" type="text" name="keywords" >
                                        <label for="key">Keywords</label>
                                    </div>
                                </div>
                                <div class="row my-carousel">
                                    <div class="switch">
                                        <h6>Carousel </h6>
                                        <label>
                                            Off

                                            <input type="checkbox"
                                                   name="carousel">
                                            <span class="lever"></span>
                                            On
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content editor" cols="30" rows="10"
                                              class="ckeditor"></textarea>
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light left" type="submit"
                                            name="action" value="save">Save
                                        <i class="material-icons">save</i>
                                    </button>
                                    &nbsp;
                                    <button class="btn cyan waves-effect waves-light right" type="submit"
                                            name="action" value="submit">Submit
                                        <i class="material-icons">send</i>
                                    </button>
                                </div>
                            </form>

                            <?php
                            if (isset($_POST['titre']) && isset($_POST['content']) && isset($_POST['categorie']) && isset($_POST['keywords']) && isset($_FILES['couverture']) && isset($_POST['action']) && $_POST['action'] == "submit") {
                                $titre = $_POST['titre'];
                                $content = $_POST['content'];
                                $categorie = $_POST['categorie'];
                                $keyword = $_POST['keywords'];
                                $image = $_FILES['couverture'];
                                if (isset($_POST['carousel']))
                                    $carousel = 1;
                                else
                                    $carousel = 0;

                                $data = new Article();
                                $data->setTitre($titre);
                                $data->setContent($content);
                                $data->setCategorie($categorie);
                                $data->setCarousel($carousel);
                                $data->setKeywords($keyword);
                                $data->setCouverture($image);
                                $data->addArticle()  ;

                                ?>
                                <script>
                                   window.location = '/Login/Article';
                                </script>
                                <?php
                            }else if(isset($_POST['action']) && $_POST['action'] == 'save'){
                                $save = new Article();
                                $donnee = 0;
                                if(isset($_POST['titre'])) {
                                    $save->setTitre($_POST['titre']);
                                    $donnee = 1;
                                }else {
                                    $save->setTitre('None');
                                }
                                if(!empty($_POST['content'])) {
                                    $save->setContent($_POST['content']);
                                    $donnee = 1;
                                }else {
                                    $save->setContent('Lorem ipsum dolor sit amet.');
                                }
                                if(isset($_POST['categorie'])) {
                                    $save->setCategorie($_POST['categorie']);
                                    $donnee = 1;
                                }else {
                                    $save->setCategorie(0);
                                }
                                if(!empty($_POST['carousel'])) {
                                    $donnee = 1;
                                    $save->setCarousel(1);
                                }else {
                                    $save->setCarousel(0);
                                }
                                if(!empty($_POST['keywords'])) {
                                    $donnee = 1;
                                    $save->setKeywords($_POST['keywords']);
                                }else {
                                    $save->setKeywords('None');
                                }
                                if($donnee==1){
                                    $save->save();
                                ?>
                                <script>
                                   window.location = '/Login/Article';
                                </script>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script>
        $(".button-collapse").sideNav();
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>

    <?php

} else {
    header('location:Home');
    die();
}
