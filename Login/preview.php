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
                        <div class="card-panel" id="preview">
                            <article class="article_preview ">
                                <div class="tag_article"><?= $_CATEGORIE[$article['categorie']] ?></div>
                                <h1><?= $article['titre'] ?></h1>
                                <div class="info">
                                    <div class="posted"> Posté
                                        le <?= date('M d ,Y', strtotime($article['post_date'])) ?></div>
                                </div>
                                <div class="couverture">
                                    <img src="/media/Articles/<?= $article['couverture'] ?>"
                                         alt="<?= $article['keywords'] ?>">
                                </div>
                                <div class="content_art">
                                    <?= $article['content'] ?>
                                </div>
                            </article>
                            <a class="btn cyan waves-effect waves-light right" type="submit"
                                    href="/Login/published.php?id=<?= $article['id'] ?>">Publier
                                <i class="material-icons">publish</i>
                            </a>
                            <p>&nbsp</p>
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

    }
} else {
    header('location:Home');
    die();
}
