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
                        <h4 class="header2">Report de bug</h4>
                        <div class="row">
                            <form class="col s12" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <label for="content">Description</label>
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
                            if (isset($_POST['content'])) {

                                $content = $_POST['content'];

                                $data = new Bug();
                                $data->add($content);

                                ?>
                                <script>
                                    window.location = '/Login/Report-Bug';
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
