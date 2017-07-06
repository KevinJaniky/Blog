<?php
require_once 'autoload.php';
$display = new Display();
?>
<!DOCTYPE html>
<html>
<?php
$display->head('A propos de moi');
?>
<body>
<?php include_once("analyticstracking.php") ?>
<?php
$display->navTop();
$display->header();
?>

<div class="wrapper">
    <section class="carousel_home">
        <div class="content_col_2">
            <section class="list_article">
                <article class="about_me">
                    <img src="media/about_me.jpg" alt="photo de profil yuna creation" class="img-responsive">
                    Hello ! Bienvenue sur Yuna Création. Moi c’est Audrey , alias Yuna , une petite dame plein de
                    positivité .

                    Après avoir passé mon Bac des métiers de la mode je me suis rendu compte que cela ne me convenait
                    pas. Je me suis réorienté vers un BTS communication. Aujourd’hui j’ai enfin trouvé ma voie.

                    J’ai toujours adoré cette notion de partage . Par exemple sur facebook , je partage bien plus que je
                    ne like. Un jour, j’ai décidé d'arrêter de publier autant sur les réseaux sociaux et j’ai décidé de
                    me créer mon chez moi, ou je pourrais être libre de faire ce qu’il me plait.

                    Au fil du temps j’ai déménagé sur plusieurs plateforme : Skyblog , Wordpress , Wix ou encore Blogger
                    et aujourd’hui je fini sur mon propre blog , avec ma propre interface. Tout ça n'aurait pas été
                    possible sans l’aide de mes proches et de mon expérience.

                    Pour terminer , je vous souhaites la bienvenue chez moi ! J'espère que vous prendrez du plaisir en
                    lisant mes articles, n’hésitez pas à me donner vos avis en commentaire ou même par message.


                </article>
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