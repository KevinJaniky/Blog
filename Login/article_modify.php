<?php
require_once "autoload.php";

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $display = new Display();
        $display->head('Dashboard');
        $display->navTop();
        $display->sideBar();
        $data = new Article();
        $_CATEGORIE = ['Musique', 'Web', 'Lifestyle', 'Culture', 'Humeur'];

        $article = $data->selectOne($id);
        ?>
        <body class="grey lighten-2">
        <script src="../ckeditor/ckeditor.js"></script>
        <div class="container">
            <div id="basic-form" class="section">
                <div class="row">
                    <div class="col s12 m12 l10 offset-l1">
                        <div class="card-panel">
                            <h4 class="header2">Modification</h4>
                            <div class="row">
                                <form class="col s12" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="titre" type="text" name="titre" required
                                                   value="<?= $article['titre'] ?>">
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
                                                for ($i = 0; $i < 5; $i++) {
                                                    if ($i == $article['categorie']) {
                                                        echo '<option value="' . $i . '" selected>' . $_CATEGORIE[$i] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $i . '">' . $_CATEGORIE[$i] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="key" type="text" name="keywords" required
                                                   value="<?= $article['keywords'] ?>">
                                            <label for="key">Keywords</label>
                                        </div>
                                    </div>
                                    <div class="row my-carousel">
                                        <div class="switch">
                                            <h6>Carousel </h6>
                                            <label>
                                                Off

                                                <input type="checkbox" <?php echo $article['carousel'] == 1 ? 'checked' : '' ?>
                                                       name="carousel">
                                                <span class="lever"></span>
                                                On
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="content">Content</label>
                                        <textarea name="content" id="content editor" cols="30" rows="10"
                                                  class="ckeditor"><?= $article['content'] ?></textarea>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="submit"
                                                name="action">Submit
                                            <i class="material-icons">send</i>
                                        </button>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['titre']) && isset($_POST['content']) && isset($_POST['categorie']) && isset($_POST['keywords'])) {
                                    $titre = $_POST['titre'];
                                    $content = $_POST['content'];
                                    $categorie = $_POST['categorie'];
                                    $keyword = $_POST['keywords'];
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

                                    if (!empty($_FILES['couverture']['name'])) {
                                        $image = $_FILES['couverture'];
                                        $data->setCouverture($image);
                                        $data->updateCouverture($id);
                                    }

                                    $data->update($id);
                                    ?>
                                    <script>
                                        window.location = '/bonbon/Login/Article';
                                    </script>
                                    <?php
                                    die();
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

    }
} else {
    header('location:Home');
    die();
}
