<?php
require_once 'autoload.php';
$display = new Display();
?>
<!DOCTYPE html>
<html>
<?php
$display->head('Categorie');
?>
<body>
<?php include_once("analyticstracking.php") ?>
<?php
$display->navTop();
$display->header();
?>
<div class="wrapper">
    <div class="content_col_2">
        <section class="list_article">
            <?php
            if (isset($_GET['cat'])) {

            $cat = $_GET['cat'];
            $data = new Categorie($cat);

            if (empty($data->getCat())) {

                ?>
                <script>
                    window.location = '/Home';
                </script>
                <?php
                die();
            }

            $max = $data->getCount();
            $nombre_de_page = $data->totalPage();


            if (isset($_GET['page'])) {
                $page_actuelle = intval($_GET['page']);
                if ($page_actuelle > $nombre_de_page)
                    $page_actuelle = $nombre_de_page;
                else if ($page_actuelle < 1)
                    $page_actuelle = 1;
            } else
                $page_actuelle = 1;


            $premiere_entree = $data->premiereEntre($page_actuelle);
            $article = $data->resultatParPage($premiere_entree);

            $count = count($article);


            if (!empty($article)) {
            $url_title_first = str_replace(' ', '-', $article[0]['titre']);

            $com = new Commentaire();
            $com->setArticle($article[0]['id']);
            $nb_commentaire = $com->countCommentaire();

            ?>
            <article class="categorie_name">
                <h1>Categorie : <?= $cat ?></h1>
            </article>

            <article class="article_promo" role="article">
                <div class="tag_article"><?= $_CATEGORIE[$article[0]['categorie']] ?></div>
                <h1><?= $article[0]['titre'] ?></h1>
                <div class="info">
                    <div class="posted"> Posté
                        le <?= date('M d ,Y', strtotime($article[0]['post_date'])) ?></div>
                    <div class="com"><a
                                href="/Article/<?= $article[0]['id'] ?>/<?= $url_title_first ?>#comments"><?= $nb_commentaire ?>
                            Commentaire(s)</a></div>
                </div>
                <div class="couverture">
                    <img src="/media/Articles/<?= $article[0]['couverture'] ?>"
                         alt="<?= $article[0]['keywords'] ?>">
                </div>
                <div class="content_art">
                    <?= strip_tags(substr($article[0]['content'], 0, 255)) ?>
                </div>
                <a href="/Article/<?= $article[0]['id'] ?>/<?= $url_title_first ?>">Lire Plus <span
                            class="glyphicon glyphicon-arrow-right"></span> </a>
            </article>

            <script>
                $('.article_promo').click(function () {
                    window.location='/Article/<?= $article[0]['id'] ?>/<?= $url_title_first ?>';
                });
            </script>
            <div class="categorie_flex">
                <?php

                for ($i = 1; $i < $count; $i++) {
                    $url_title = str_replace(' ', '-', $article[$i]['titre']);
                    ?>

                    <article class="article_int" role="article">
                        <div class="article_element">
                            <div class="couverture">
                                <a href="/Article/<?= $article[$i]['id'] ?>/<?= $url_title ?>" id="link_position"></a><img
                                            src="/media/Articles/<?= $article[$i]['couverture'] ?>"
                                            alt="<?= $article[$i]['keywords'] ?>">
                            </div>
                            <div class="tag_article"><?= $_CATEGORIE[$article[$i]['categorie']] ?></div>
                            <h1><?= $article[$i]['titre'] ?></h1>
                            <div class="info">
                                <div class="posted"> Posté
                                    le <?= date('M d ,Y', strtotime($article[$i]['post_date'])) ?></div>
                            </div>
                            <div class="content_art">
                                <?= strip_tags(substr($article[$i]['content'], 0, 255)) ?>
                            </div>
                        </div>
                    </article>


                    <?php
                }

                ?>
            </div>


            <div class="pagination">
                <?php

                if ($max >= 5) {
                    $prev = $page_actuelle - 1;
                    $next = $page_actuelle + 1;


                    echo '<a class="prev" href="/Categorie/' . $cat . '/' . $prev . '"><i class=" glyphicon glyphicon-chevron-left"></i></a>';

                    for ($i = 1; $i <= $nombre_de_page; $i++) {
                        if ($i == $page_actuelle)
                            echo '<span class="active">' . $i . '</span>';
                        else
                            echo ' <a href="/Categorie/' . $cat . '/' . $i . '">' . $i . '</a> ';
                    }

                    echo '<a class="next" href="/Categorie/' . $cat . '/' . $next . '"><i class="glyphicon glyphicon-chevron-right"></i></a>';
                }
                }
                ?>

                <?php
                }
                ?>
        </section>
        <?php
        $display->aside();
        ?>
    </div>
</div>
</div>
<?php
$display->instagram();
$display->footer();
?>

</body>


</html>