<?php
require_once 'autoload.php';
$display = new Display();
if (isset($_GET['article'])) {
    $art = htmlentities($_GET['article']);
    if (!is_numeric($art)) {
        header('location:/YunaCreation/Home');
        die();
    }
    $data = new Article();
    $article = $data->post($art);
}
?>
<!DOCTYPE html>
<html>
<?php
$display->head($article['titre']);
?>
<body>
<?php
$display->navTop();
$display->header();
$com = new Commentaire();
$com->setArticle($article['id']);
$nb_commentaire = $com->countCommentaire();
$url = str_replace(' ', '-', $article['titre']);
?>
<div class="wrapper">
    <div class="content_col_2">
        <section class="list_article">
            <article class="article_preview ">
                <div class="tag_article"><?= $_CATEGORIE[$article['categorie']] ?></div>
                <h1><?= $article['titre'] ?></h1>
                <div class="info">
                    <div class="posted"> Posté
                        le <?= date('M d ,Y', strtotime($article['post_date'])) ?></div>
                    <div class="com"><a href="#comments"><?= $nb_commentaire ?> Commentaire(s)</a></a></div>
                </div>
                <div class="couverture">
                    <img src="/YunaCreation/media/Articles/<?= $article['couverture'] ?>"
                         alt="<?= $article['keywords'] ?>">
                </div>
                <div class="content_art">
                    <?= $article['content'] ?>
                </div>
            </article>
            <div id="comments">
                <div class="title_comment">Commentaire(s)</div>
                <div class="comment_content">
                    <?php
                    $data_commentaire = $com->readCommentaire();
                    $count = count($data_commentaire);


                    if ($nb_commentaire != 0) {


                        for ($i = 0; $i < $count; $i++) {
                            $reponse = $com->reponseCommentaire($data_commentaire[$i]['id']);
                            ?>
                            <div class="element_comment">
                                <div class="identity">
                                    <?= $data_commentaire[$i]['pseudo'] ?>
                                </div>
                                <div class="date_commentaire">
                                    <?= date('M d ,Y', strtotime($data_commentaire[$i]['date'])) ?>
                                </div>
                                <div class="data_commentaire">
                                    <?= $data_commentaire[$i]['content'] ?>
                                </div>
                            </div>
                            <?php
                            if (!empty($reponse)) {
                                ?>
                                <div class="element_reponse">
                                    <div class="identity">
                                        Yuna création
                                    </div>
                                    <div class="date_commentaire">
                                        <?= date('M d ,Y', strtotime($reponse['date'])) ?>
                                    </div>
                                    <div class="data_commentaire">
                                        <?= $reponse['content'] ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="form_message">
                    <form method="post">
                        <div class="form-group">
                            <label for="pseudo">Nom</label>
                            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo">
                        </div>
                        <div class="form-group">
                            <label for="msg">Message</label>
                            <textarea name="msg" id="msg" class="form-control" placeholder="Commentaire"></textarea>
                        </div>
                        <input type="submit" value="Commenter" class="btn btn-primary">
                    </form>
                    <?php
                    if (!empty($_POST['msg']) && isset($_POST['pseudo'])) {
                        $msg = $_POST['msg'];
                        $pseudo = $_POST['pseudo'];
                        $come = new Commentaire();
                        $come->setMessage($msg);
                        $come->setPseudo($pseudo);
                        $come->setArticle($article['id']);
                        $come->addCommentaire();
                        ?>
                        <script>
                            window.location = '/YunaCreation/Article/<?= $article['id'] ?>/<?= $url ?>'
                        </script>
                        <?php
                    }
                    ?>
                </div>
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