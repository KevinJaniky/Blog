<?php

class Article
{
    private $_bdd;
    private $_title;
    private $_content;
    private $_couverture;

    public function __construct()
    {
        try {
            //$this->_bdd = new PDO("mysql:host=yunacreabxkj.mysql.db;dbname=yunacreabxkj", "yunacreabxkj", "J2c7tqX8");
            $this->_bdd = new PDO("mysql:host=localhost;dbname=bonbon", "root", "");
        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }
    }

    public function setTitle($titre)
    {
        if (strlen($titre) < 2) {
            return false;
        }
        return $this->_title = $titre;
    }

    public function setContent($content)
    {
        if (strlen($content) < 5) {

            return false;
        }
        return $this->_content = $content;
    }

    public function setCouverture($file)
    {
        $extensions_valides = ['jpg', 'jpeg', 'png', 'gif'];

        $name = $file["name"];
        $poids = $file['size'];
        $code = $file['error'];
        $maxsize = 10485760;
        $upload = "../article_image_couverture/";
        $new_name = bin2hex(rand(0, 15220));

        //On récupère l'extension
        $name_exploded = explode(".", $name);
        $extension = strtolower(end($name_exploded));
        $new_name = $new_name . "." . $extension;

        if ($code > 0) {
            switch ($code) {
                case UPLOAD_ERR_INI_SIZE:
                    $msg_error = "Fichier trop lourd selon php.ini";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $msg_error = "Fichier trop lourd selon MAX_FILE_SIZE";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $msg_error = "Upload partiel";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $msg_error = "Aucun fichier";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $msg_error = "Le dossier temporaire n'existe pas";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $msg_error = "Problème de permission";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $msg_error = "Erreur au niveau de l'extension";
                    break;
                default:
                    $msg_error = "Erreur ???";
                    break;
            }
            return $msg_error;
        } //On vérifie que notre extension se trouve dans notre tableau $extensions_valides
        else if (!in_array($extension, $extensions_valides)) {
            return "Extension invalide : ( 'jpg' , 'jpeg' , 'png', 'gif' )";
        } //Notre extension est donc ok, on vérifie maintenant le poids de l'image
        else if ($poids > $maxsize) {
            return "Fichier trop lourd (" . $poids . "/" . $maxsize . "octets)";
        }
        $resultat = move_uploaded_file($file['tmp_name'], $upload . $new_name);
        if (!$resultat) {

            return false;
        }
        return $this->_couverture = $new_name;
    }

    public function oneArticle($id){
        $query = $this->_bdd->query('SELECT * FROM articles WHERE publication = 1 AND id = '.$id);
        return $query->fetch();
    }

    public function homeArticle() {

        $query = $this->_bdd->prepare("SELECT * FROM articles WHERE publication = 1  ORDER BY id DESC LIMIT 4");
        $query->execute();
        return $query->fetchAll();
    }

    public function carouselHome() {
        $query = $this->_bdd->query('SELECT * FROM articles WHERE carousel = 1 AND publication = 1');
        return $query->fetchAll();
    }

    public function post($id) {
        $query = $this->_bdd->prepare('SELECT * FROM articles WHERE id = :id AND publication = 1 ');
        $query->execute(['id'=>$id]);
        return $query->fetch();
    }
}