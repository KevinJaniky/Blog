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

    ?>
    <body class="blue-grey lighten-5">
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="sweetAlert/sweetalert.min.js"></script>
    <div class="container">
        <table class="responsive-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Content</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            $count = count($tab);
            for ($i = 0; $i < $count; $i++) {
                echo '<tr>';
                echo '<td>' . $tab[$i]['id'] . '</td>';
                echo '<td>' . strip_tags(substr($tab[$i]['content'], 0, 100)) . '...</td>';
                echo '<td>' . $tab[$i]['pseudo'] . '</td>';
                echo '<td><a href="/YunaCreation/Login/Reponse/'.$tab[$i]['id'].'"><i class="material-icons blue-text text-darken-4">question_answer</i></a></td>';
                echo '<td><a href="#" data-id="' . $tab[$i]['id'] . '" class="delete"><i class="material-icons red-text text-darken-2">delete</i></a></td>';
                echo '</tr>';

            }
            ?>
            <tr>
                <td></td>
            </tr>
            </tbody>
        </table>

    </div>
    </body>
    <script>
        $(".button-collapse").sideNav();

        $('.delete').click(function () {
            var id = $(this).data('id');
            var element = ($(this).parent().parent());
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

                        $.post("delete_com.php",
                            {id: id},
                            function (data) {
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
