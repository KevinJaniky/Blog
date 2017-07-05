<?php

class Article
{

    private $_bdd;
    private $_titre;
    private $_content;
    private $_categorie;
    private $_couverture;
    private $_keywords;
    private $_carousel;
    private $_error = false;

    public function __construct()
    {
        require_once 'conf.php';
        try {

            $this->_bdd = new PDO("mysql:host=".HOST.";dbname=".DBNAME, USER, MDP);
            return $this->_bdd;
        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }
    }

    public function setTitre($titre)
    {
        if (strlen($titre) < 5) {
            return $this->_error = true;
        }
        return $this->_titre = htmlentities($titre);
    }

    public function setContent($content)
    {
        if (strlen($content) < 15) {
            return $this->_error = true;
        }
        return $this->_content = $content;
    }

    public function setCategorie($categorie)
    {
        if ($categorie < 0 || $categorie > 5) {
            return $this->_error = true;
        }
        return $this->_categorie = $categorie;
    }

    public function setCouverture($file)
    {
        $extensions_valides = ['jpg', 'jpeg', 'png', 'gif'];

        $name = $file["name"];
        $poids = $file['size'];
        $code = $file['error'];
        $maxsize = 10485760;
        $upload = "/media/Articles/";
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

            return $this->_error = true;
        }
        return $this->_couverture = $new_name;
    }

    public function setKeywords($string) {
        if(strlen($string) < 2) {
            return $this->_error = true;
        }
        return $this->_keywords = $string;
    }
    public function setCarousel($value)  {
        if($value == 0 || $value == 1){
            return $this->_carousel = $value;
        }
        return $this->_error = true;
    }

    public function addArticle(){
        if($this->_error) {
            echo "Error";
            return false;
        }
        $query = $this->_bdd->prepare('INSERT INTO articles(titre,content,categorie,couverture,keywords,carousel) VALUES (:titre,:content,:cat,:couverture,:keywords,:carousel)');
        $query->execute([
            'titre'=>$this->_titre,
            'content'=>$this->_content,
            'cat'=>$this->_categorie,
            'couverture'=>$this->_couverture,
            'keywords'=>$this->_keywords,
            'carousel'=>$this->_carousel
        ]);
        return true;
    }

    public function all(){
        $query = $this->_bdd->query('SELECT * FROM articles');
        return $query->fetchAll();
    }
    public function recent(){
        $query = $this->_bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 1');
        return $query->fetchAll();
    }
    public function countArticleTotal(){
        $query = $this->_bdd->query('SELECT COUNT(*) as nb FROM articles');
        $data = $query->fetch();
        return $data['nb'];
    }
    public function delete($id){
        $this->_bdd->query('DELETE FROM articles WHERE id = '.$id);
    }
    public function selectOne($id){
        $query = $this->_bdd->query('SELECT * FROM articles WHERE id='.$id);
        return $query->fetch();
    }

    public function update($id){
        if($this->_error){
            $_SESSION['flash_error'] = "Une erreur est survenue";
        }else{
            $query = $this->_bdd->prepare('UPDATE articles SET titre = :titre, content = :content, categorie = :cat, keywords = :keywords,carousel = :carousel WHERE id = :id');
            $query->execute([
                'titre'=>$this->_titre,
                'content'=>$this->_content,
                'cat'=>$this->_categorie,
                'keywords'=>$this->_keywords,
                'carousel'=>$this->_carousel,
                'id'=>$id
            ]);
        }
    }
    public function updateCouverture($id){
        if($this->_error)
            $_SESSION['flash_error'] = "Une erreur est survenue";
        else {
            $query = $this->_bdd->prepare('UPDATE articles SET couverture = :couverture WHERE id = :id');
            $query->execute([
                'couverture'=>$this->_couverture,
                'id'=>$id
            ]);
        }
    }

    public function published($id){
        $query = $this->_bdd->prepare('UPDATE articles SET publication = 1 WHERE id = :id');
        $query->execute(['id'=>$id]);
    }

    public function save() {
        $query = $this->_bdd->prepare('INSERT INTO articles(titre,content,categorie,keywords,carousel) VALUES (:titre,:content,:cat,:keywords,:carousel)');
        $query->execute([
            'titre'=>$this->_titre,
            'content'=>$this->_content,
            'cat'=>$this->_categorie,
            'keywords'=>$this->_keywords,
            'carousel'=>$this->_carousel
        ]);
    }
}