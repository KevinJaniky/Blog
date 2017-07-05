<?php

class Display
{
    public function head($titre)
    {

        echo "<head>
    <title>$titre | Yuna Création</title>

    <meta charset=\"utf-8\">
    <meta name=\"description\" content=\"\">
    <meta property=\"og:title\" content=\"Titre\"/>
    <meta property=\"og:description\" content=\"Description\"/>
    <meta property=\"og:image\" content=\"URL_image\"/>
    <meta property=\"og:url\" content=\"\">
    <link rel='icon' href='/bonbon/media/favicon.png'>

    <link rel=\"stylesheet\" href=\"/yunacreation/Login/materialize/css/materialize.min.css\">
    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"/yunacreation/Login/css/style.css\">
    <link rel=\"stylesheet\" href=\"sweetAlert/sweetalert.css\">

    <script src=\"/yunacreation/Login/materialize/js/jquery.js\"></script>
    <script src=\"/yunacreation/Login/materialize/js/materialize.min.js\"></script>
</head>";
    }

    public function navTop()
    {
        echo "
       <nav class='cyan lighten-1'>
    <div class=\"nav-wrapper\">
    <a href=\"#\" data-activates=\"slide-out\" class=\"button-collapse left \" style='display: block;'><i class=\"material-icons\">menu</i></a>
      <ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">
        <li><a href=\"/yunacreation/Login/deconnexion.php\">Déconnexion</a></li>
      </ul>
    </div>
  </nav>";
    }

    public function sideBar()
    {
        echo "
        <ul id=\"slide-out\" class=\"side-nav \">
    <li><div class=\"user-view\">
      <div class=\"background\">
        <img src=\"/yunacreation/Login/media/background.jpg\" id='sidebarimg'>
      </div>
      <a href=\"#!user\"><img class=\"circle\" src=\"/yunacreation/Login/media/images.jpg\"></a>
      <a href=\"#!name\"><span class=\"white-text name\">Admin</span></a>
      <a href=\"#!email\"><span class=\"white-text email\">contact@yuna-creation.fr</span></a>
    </div></li>
    <li><a href=\"/yunacreation/Login/Dashboard\"><i class=\"material-icons\"></i></a></li>
        <ul class=\"collapsible collapsible-accordion\">
          <li>
            <a class=\"collapsible-header\"  href=\"/yunacreation/\" target='_blank'>Blog<i class=\"material-icons\">loyalty</i></a>
          </li>
          <li>
            <a class=\"collapsible-header\"  href=\"/yunacreation/Login/Dashboard\">Accueil<i class=\"material-icons\">home</i></a>
          </li>
        </ul>
        <ul class=\"collapsible collapsible-accordion\">
          <li>
            <a class=\"collapsible-header\">Articles<i class=\"material-icons\">art_track</i></a>
            <div class=\"collapsible-body\">
              <ul>
                <li><a href=\"/yunacreation/Login/Article\">Général</a></li>
                <li><a href=\"/yunacreation/Login/Ajouter\">Ajouter</a></li>
              </ul>
            </div>
          </li>
        </ul>
         <ul class=\"collapsible collapsible-accordion\">
          <li>
            <a class=\"collapsible-header\">Commentaires<i class=\"material-icons\">comment</i></a>
            <div class=\"collapsible-body\">
              <ul>
                <li><a href=\"/yunacreation/Login/Commentaires\">Général</a></li>
                <li><a href=\"/yunacreation/Login/Reponse\">Reponse</a></li>
              </ul>
            </div>
          </li>
        </ul>
         <ul class=\"collapsible collapsible-accordion\">
          <li>
            <a class=\"collapsible-header\">Newsletter<i class=\"material-icons\">mail</i></a>
            <div class=\"collapsible-body\">
              <ul>
                <li><a href=\"/yunacreation/Login/Newsletter\">Général</a></li>
              </ul>
            </div>
          </li>
        </ul>
         <ul class=\"collapsible collapsible-accordion\">
          <li>
            <a class=\"collapsible-header\">Boite a idée<i class=\"material-icons\">lightbulb_outline</i></a>
            <div class=\"collapsible-body\">
              <ul>
                <li><a href=\"/yunacreation/Login/Boite-A-Idee\">Général</a></li>
              </ul>
            </div>
          </li>
        </ul>
         <ul class=\"collapsible collapsible-accordion\">
          <li>
            <a class=\"collapsible-header\">Report de bug<i class=\"material-icons\">bug_report</i></a>
            <div class=\"collapsible-body\">
              <ul>
                <li><a href=\"/yunacreation/Login/Report-Bug\">Général</a></li>
                <li><a href=\"/yunacreation/Login/Bug\">Liste</a></li>
              </ul>
            </div>
          </li>
        </ul>
         <ul class=\"collapsible collapsible-accordion\">
          <li>
            <a class=\"collapsible-header\">Outils<i class=\"material-icons\">build</i></a>
            <div class=\"collapsible-body\">
              <ul>
                <li><a href=\"/yunacreation/Login/Youtube-Url\">Youtube Url</a></li>
              </ul>
            </div>
          </li>
        </ul>

  </ul>
        ";
    }

    public function resume($text)
    {
        return strip_tags($text);
    }
}