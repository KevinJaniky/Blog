<?php

class Commentaire
{
    private $_message;
    private $_article;
    private $_pseudo;
    private $_bdd;
    private $error = false;

    public function __construct()
    {
        try {
            $this->_bdd = new PDO("mysql:host=localhost;dbname=bonbon", "root", "");
        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }
    }

    public function setMessage($message)
    {
        if (strlen($message) < 5) {
            $this->error = true;
            return false;
        }
        return $this->_message = htmlentities($message);
    }

    public function setPseudo($pseudo)
    {
        if (empty($pseudo)) {
            return $this->_pseudo = 'Anonyme';
        } else {
            if (strlen($pseudo) > 255) {
                $this->error = true;
                return false;
            } else {
                return $this->_pseudo = htmlentities($pseudo);
            }
        }
    }

    public function setArticle($id)
    {
        if (is_numeric($id)) {
            return $this->_article = $id;
        }
        $this->error = true;
        return false;
    }

    public function addCommentaire()
    {
        if ($this->error) {
            return false;
        }
        $query = $this->_bdd->prepare('INSERT INTO commentaire(content,pseudo,id_article) VALUES (:content,:pseudo,:id)');
        $query->execute([
            'content' => $this->_message,
            'pseudo' => $this->_pseudo,
            'id' => $this->_article
        ]);
        return true;
    }

    public function readCommentaire()
    {
        $query = $this->_bdd->prepare('SELECT * FROM commentaire WHERE id_article = :id');
        $query->execute([
            'id' => $this->_article
        ]);

        $data = $query->fetchAll();
        if (empty($data)) {
            return 'Aucun commentaire';
        } else {
            return $data;
        }
    }

    public function countCommentaire()
    {
        $query = $this->_bdd->prepare('SELECT COUNT(*) as nb FROM commentaire WHERE id_article = :id');
        $query->execute([
            'id' => $this->_article
        ]);
        $data = $query->fetch();
        return $data['nb'];
    }

    public function reponseCommentaire($id){
        $query = $this->_bdd->query('SELECT * FROM reponse WHERE id_message = '.$id);
        return $query->fetch();
    }
}