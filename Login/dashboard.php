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
    <script src="sweetAlert/sweetalert.min.js"></script>
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
                                <p class="card-stats-title"><i class="mdi-editor-insert-drive-file"></i> Commentaires
                                </p>
                                <h4 class="card-stats-number"><?= $com->countCommentaireTotal() ?></h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-down"></i> <span
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
                            <li class="collection-header cyan white-text" id="todo_title">
                                <h4 class="task-card-title ">My Todo</h4>
                                <button class=" btn-floating btn-large waves-effect waves-light red"><i
                                            class="material-icons">playlist_add</i></button>
                            </li>

                            <?php
                            $list = new Manage();
                            $todo = $list->readToDoList();
                            $count_list = count($todo);

                            for ($i = 0; $i < $count_list; $i++) {
                                ?>
                                <li class="collection-item dismissable"
                                    style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    <input type="checkbox" id="task<?= $todo[$i]['id'] ?>" class="task" data-id="<?= $todo[$i]['id'] ?>">
                                    <label for="task<?= $todo[$i]['id'] ?>" style="text-decoration: none;"><?= $todo[$i]['valeur'] ?></label>
                                </li>

                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </body>
    <script>
        $(".button-collapse").sideNav();

        $('#todo_title button').click(function () {
            swal({
                    title: "Todo List",
                    text: "Ajout d'un element",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Ma tâche"
                },
                function (inputValue) {
                    if (inputValue === false) return false;

                    if (inputValue === "") {
                        swal.showInputError("Renseigner le champs");
                        return false
                    } else {
                        $.post("add_todo.php",
                            {tache: inputValue},
                            function (data) {
                                $("#task-card").append('<li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><input type="checkbox" id="task4"><label for="task4" style="text-decoration: none;">' + inputValue + ' <a href="#" class="secondary-content"></li>');
                            });

                        swal("Nice!", "You wrote: " + inputValue, "success");

                    }

                });
        });
        $('.task').click(function () {
            var id = $(this).data('id');
            var element = ($(this).parent());
            swal({
                    title: "Etes vous sur ?",
                    text: "La suppression sera definitive",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#dd5044",
                    confirmButtonText: "Oui, je confirme",
                    cancelButtonText: "Non, surtout pas ",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.post("delete_todo.php",
                            {id: id},
                            function () {
                                element.remove();
                            });


                        swal("Supprimé!", "Suppression reussie", "success");
                    } else {
                        swal("Annuler", "Aucune suppression n'a été éffectué", "error");
                    }
                });
        })

    </script>

    <?php

} else {
    header('location:Home');
    die();
}
