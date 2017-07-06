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
    <section class=" flash_result col-md-offset-3 col-md-6">
        <?php
        if (isset($_SESSION['flash_contact'])) {
            ?>
            <div class="success_flash alert alert-info" role="alert">
                <?= $_SESSION['flash_contact'] ?>
            </div>
            <?php
            unset($_SESSION['flash_contact']);
        }
        ?>
    </section>
    <section class="row">
        <article class="contact col-md-offset-3 col-md-6">
            <h1>Me contacter</h1>
            <form method="post" action="/contact_traitement.php" role="form">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" required placeholder="Votre nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" required
                           placeholder="Votre prenom">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="mail" id="email" required placeholder="Votre email">
                </div>
                <div class="form-group">
                    <label for="objet">Objet</label>
                    <input type="text" class="form-control" name="objet" id="objet" required placeholder="Votre Objet">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" placeholder="Votre message" class="form-control" rows="5">Bonjour, </textarea>
                </div>
                <input type="submit" value="Envoyer" class="btn btn-primary pull-right">
            </form>
        </article>
    </section>
    <hr>
    <section class="row">
        <section class=" flash_result col-md-offset-3 col-md-6">
            <?php
            if (isset($_SESSION['flash_idee'])) {
                ?>
                <div class="success_flash alert alert-info" role="alert">
                    <?= $_SESSION['flash_idee'] ?>
                </div>
                <?php
                unset($_SESSION['flash_idee']);
            }
            ?>
        </section>
        <article class="boite_a_idee col-md-offset-3 col-md-6" id="idee">
            <h1>Boite a idée</h1>
            <h5 class="text-muted">N'hésitez pas à proposer vos idées</h5>
            <form method="post" action="/idee_traitement.php">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" required placeholder="Votre nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" required placeholder="Votre prenom">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="mail" id="email" required placeholder="Votre email">
                </div>
                <div class="form-group">
                    <label for="idee">Idée</label>
                    <textarea type="text" class="form-control" name="idee" id="idee" required placeholder="Votre idée"></textarea>
                </div>
                <input type="submit" value="Proposer" class="btn btn-primary pull-right">
            </form>
        </article>
    </section>
</div>
<?php
$display->instagram();
$display->footer();
?>

</body>


</html>