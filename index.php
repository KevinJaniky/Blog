<?php
require_once 'autoload.php';
$display = new Display();
?>
<!DOCTYPE html>
<html>
<?php
$display->head('Home');
?>
<body>
<?php
$display->navTop();
$display->header();
?>

<div class="wrapper"  role="main">
    <section class="carousel_home ">
        <h1 style="display: none;">Main Content</h1>
        <div class="owl-carousel owl-theme">
            <?php
            $carousel = new Article();
            $data_carousel = $carousel->carouselHome();

            for ($i = 0; $i < count($data_carousel); $i++) {

                $url = str_replace(' ','-',$data_carousel[$i]['titre']);
                ?>
                <div class="item"><img src="media/Articles/<?= $data_carousel[$i]['couverture'] ?>"
                                       alt="<?= $data_carousel[$i]['keywords'] ?>">
                    <div class="article_carousel_content">
                        <div class="tag_carousel"><?= $_CATEGORIE[$data_carousel[$i]['categorie']] ?></div>
                        <div class="titre_carousel"><?= $data_carousel[$i]['titre'] ?></div>
                        <div class="link_carousel"><a href="/Article/<?= $data_carousel[$i]['id'] ?>/<?= $url ?>">Lire plus</a></div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
        <script>
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay:true,
                autoplayTimeout:5000,
                navText: ['<span class="glyphicon glyphicon-chevron-left"></span>', '<span class="glyphicon glyphicon-chevron-right"></span>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        </script>
    </section>
    <section class="tag_mise_en_avant">
        <h1 style="display: none;">Mise en avant des tags</h1>
        <a href="/Categorie/Musique"><span>Musique</span></a>
        <a href="/Categorie/Web"><span>Web</span></a>
        <a href="/Categorie/Culture"><span>Culture</span></a>
    </section>
    <div class="content_col_2">
        <?php
        $liste = $carousel->homeArticle();
        $count = count($liste);
?>
        <section class="list_article">
        <?php
        if(!empty($liste)){
        $com = new Commentaire();
        $com->setArticle($liste[0]['id']);
        $nb_commentaire = $com->countCommentaire();
        $url = str_replace(' ', '-', $liste[0]['titre']);
        ?>

            <section class="article_promo">
                <div class="tag_article"><?= $_CATEGORIE[$liste[0]['categorie']] ?></div>
                <h1><?= $liste[0]['titre'] ?></h1>
                <div class="info">
                    <div class="posted"> Posté le <?= date('M d ,Y', strtotime($liste[0]['post_date'])) ?></div>
                    <div class="com"><a
                                href="/Article/<?= $liste[0]['id'] ?>/<?= $url ?>#comments"><?= $nb_commentaire ?>
                            Commentaire(s)</a></div>
                </div>
                <div class="couverture">
                    <img src="/media/Articles/<?= $liste[0]['couverture'] ?>" alt="<?= $liste[0]['keywords'] ?>">
                </div>
                <div class="content_art">
                    <?= strip_tags(substr($liste[0]['content'], 0, 255)) ?>
                </div>
                <a href="/Article/<?= $liste[0]['id'] ?>/<?= $url ?>">Lire Plus <span class="glyphicon glyphicon-arrow-right"></span> </a>
            </section>

            <?php
            for ($i = 1; $i < $count; $i++) {
                $url = str_replace(' ', '-', $liste[$i]['titre']);
                ?>
                <section class="article_list">
                    <div class="couverture">
                        <a href="/Article/<?= $liste[$i]['id'] ?>/<?= $url ?>"><img
                                    src="/media/Articles/<?= $liste[$i]['couverture'] ?>"
                                    alt="<?= $liste[$i]['keywords'] ?>"></a>
                    </div>
                    <div class="content_art_list">
                        <div class="tag_article"><?= $_CATEGORIE[$liste[$i]['categorie']] ?></div>
                        <h1><a href="/Article/<?= $liste[$i]['id'] ?>/<?= $url ?>"><?= $liste[$i]['titre'] ?></a>
                        </h1>
                        <div class="info">
                            <div class="posted"><?= date('M d ,Y', strtotime($liste[$i]['post_date'])) ?></div>
                        </div>
                        <div class="content_art">
                            <?= strip_tags(substr($liste[$i]['content'], 0, 255)) ?>
                        </div>
                    </div>
                </section>
                <?php
            }
            }
            ?>
        </section>
        <?php
        $display->aside();
        ?>
    </div>
</div>
<?php
$display->instagram();
$display->footer();
?>

</body>


</html>