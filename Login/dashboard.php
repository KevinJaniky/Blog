<?php
require_once "autoload.php";

if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
    $display = new Display();
    $display->head('Dashboard');
    $display->navTop();
    $display->sideBar();
    $data = new Article();
    $_CATEGORIE = ['Musique', 'Web', 'Lifestyle', 'Culture', 'Humeur'];

    $com = new Manage();
    ?>
    <body class="grey lighten-2">
    <script src="../ckeditor/ckeditor.js"></script>
    <div class="container">
        <div class="wrapper">


            <div id="card-stats">
                <div class="row">
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content  green white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i> Articles </p>
                                <h4 class="card-stats-number"><?= $data->countArticleTotal() ?></h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> <span
                                            class="green-text text-lighten-5"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content pink lighten-1 white-text">
                                <p class="card-stats-title"><i class="mdi-editor-insert-drive-file"></i> Commentaires </p>
                                <h4 class="card-stats-number"><?= $com->countCommentaireTotal() ?></h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-down"></i>  <span
                                            class="deep-purple-text text-lighten-5"></span>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content blue-grey white-text">
                                <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Abonnés </p>
                                <h4 class="card-stats-number"><?= $com->countNewsTotal() ?></h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> <span
                                            class="blue-grey-text text-lighten-5"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content purple white-text">
                                <p class="card-stats-title"><i class="mdi-editor-attach-money"></i>Boite à idée</p>
                                <h4 class="card-stats-number"><?= $com->countIdeeTotal() ?></h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i><span
                                            class="purple-text text-lighten-5"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4 l4">
                        <ul id="task-card" class="collection with-header">
                            <li class="collection-header cyan white-text">
                                <h4 class="task-card-title">My Todo</h4>
                                <p class="task-card-date"></p>
                            </li>
                            <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <input type="checkbox" id="task1">
                                <label for="task1" style="text-decoration: none;">Create Mobile App UI. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                                </label>
                                <span class="task-cat teal">Mobile App</span>
                            </li>
                            <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <input type="checkbox" id="task2">
                                <label for="task2" style="text-decoration: none;">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                                </label>
                                <span class="task-cat purple">Web API</span>
                            </li>
                            <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <input type="checkbox" id="task3">
                                <label for="task3" style="text-decoration: none;">Create Mobile App UI. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                                </label>
                                <span class="task-cat teal">Mobile App</span>
                            </li>
                            <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <input type="checkbox" id="task4">
                                <label for="task4" style="text-decoration: none;">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                                </label>
                                <span class="task-cat purple">Web API</span>
                            </li>
                        </ul>
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
