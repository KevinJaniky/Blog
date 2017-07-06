<?php

class Manage
{

    private $_bdd;

    public function __construct()
    {
        require_once 'conf.php';
        try {

            $this->_bdd = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, MDP);
            return $this->_bdd;
        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }
    }

    public function countCommentaireTotal()
    {
        $query = $this->_bdd->query('SELECT COUNT(*) as nb FROM commentaire');
        $data = $query->fetch();
        return $data['nb'];
    }

    public function countNewsTotal()
    {
        $query = $this->_bdd->query('SELECT COUNT(*) as nb FROM newsletter');
        $data = $query->fetch();
        return $data['nb'];
    }

    public function countIdeeTotal()
    {
        $query = $this->_bdd->query('SELECT COUNT(*) as nb FROM box_idee');
        $data = $query->fetch();
        return $data['nb'];
    }

    public function createUrlYoutube($chaine)
    {
        $regex = '#^(https:\/\/)(www\.youtube\.com\/watch\?v=)([a-zA-Z0-9_-]+)$#';
        $data = preg_match($regex, $chaine);

        if ($data) {
            $data_explode = explode('v=', $chaine);
            $tab = $data_explode[1];
            return 'https://www.youtube.com/embed/' . $tab;
        } else {
            echo 'Url error';
            return false;
        }
    }

    public function addTitlePlayer($title) {
        $query = $this->_bdd->prepare('INSERT INTO data (cle , valeur) VALUES( :cle, :valeur)');
        $query->execute([
            'cle'=>'player',
            'valeur'=>$title
            ]);
    }

    public function musicPlayerUpdate($file)
    {
        $extensions_valides = ['mp3'];

        $name = $file["name"];
        $poids = $file['size'];
        $code = $file['error'];
        $maxsize = 10485760;
        $upload = $_SERVER['DOCUMENT_ROOT']."/media/Music/";

        //On récupère l'extension
        $name_exploded = explode(".", $name);
        $extension = strtolower(end($name_exploded));

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
            return "Extension invalide : ( 'mp3' )";
        } //Notre extension est donc ok, on vérifie maintenant le poids de l'image
        else if ($poids > $maxsize) {
            return "Fichier trop lourd (" . $poids . "/" . $maxsize . "octets)";
        }
        $resultat = move_uploaded_file($file['tmp_name'], $upload . 'music.mp3');
        if (!$resultat) {

            return 'Error';
        }
        $this->addTitlePlayer($name);
        return 'ok';
    }

}