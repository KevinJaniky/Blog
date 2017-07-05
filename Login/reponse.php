<?php
require_once "autoload.php";

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $display = new Display();
    $display->head('Commentaire');
    $display->navTop();
    $display->sideBar();
    $data = new Article();
    $com = new Commentaires();
    $tab = $com->selectAll();

        $id = $_GET['id'];

    ?>
    <body class="blue-grey lighten-5">
    <script src="/YunaCreation/ckeditor/ckeditor.js"></script>
    <script src="/YunaCreation/Login/sweetAlert/sweetalert.min.js"></script>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 m12 l10 offset-l1">
                <div class="card-panel">
                    <h4 class="header2">Réponse</h4>
                    <div class="row">
                        <p>
                            <?php
                               $commentaire = $com->selectOne($id);
                               echo $commentaire['content'];
                            ?>
                        </p>
                        <form class="col s12" method="post">
                            <div class="row">
                                <label for="content">Content</label>
                                <textarea name="content" id="content editor" cols="30" rows="10"
                                          class="ckeditor"></textarea>
                            </div>
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit"
                                        name="action">Submit
                                    <i class="material-icons">send</i>
                                </button>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST['content'])) {
                            $reponse = new Reponse();
                            $reponse->setContent($_POST['content']);
                            $reponse->add($id);

                            ?>
                        <script>
                            window.location = '/YunaCreation/Login/Reponse';
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

    </body>
    <script>
        $(".button-collapse").sideNav();
    </script>

    <?php

} else {
    header('location:Home');
    die();
}
