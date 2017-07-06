<?php


class Like {
    private $_bdd;
    private $_article;
    private $error = false;
    private $_like;


    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'].'/Login/conf.php';
        try {

            $this->_bdd = new PDO("mysql:host=".HOST.";dbname=".DBNAME, USER, MDP);
            return $this->_bdd;
        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }
    }

    public function setArticle($id)
    {
        if (is_numeric($id)) {
            return $this->_article = $id;
        }
        return $this->error = true;
    }

    public function recupLike() {
        $query = $this->_bdd->query('SELECT * FROM yv_like WHERE id_article = '.$this->_article);
        return $query->fetch();
    }
    public function createLike() {
        $this->_bdd->query('INSERT INTO yv_like (id_article,nb_like) VALUES('.$this->_article.',1)');
    }
    public function updateLike(){
        $this->_like = $this->_like+1;
        $this->_bdd->query('UPDATE yv_like SET nb_like = '.$this->_like.' WHERE id_article='.$this->_article);
    }
    public function BddLike() {
        $data = $this->recupLike();
        if(empty($data)) {
            $this->createLike();
        }else {
            $this->_like = $data['nb_like'];
            $this->updateLike();
        }
    }

    public function cookieLike() {
        $cookie = 'LIKE_ARTICLE_'.$this->_article;
        if(isset($_COOKIE[$cookie])) {
           $this->error = true;
        }else {
            setcookie("LIKE_ARTICLE_".$this->_article, "like",time()+15778800);
        }
    }

    public function Like($id) {
        $this->setArticle($id);
        $this->cookieLike();
        if($this->error) {
            return false;
        }else {
            $this->BddLike();
            return true;
        }
    }

    public function recupCookie($id) {
        $cookie = 'LIKE_ARTICLE_'.$id;
        if(isset($_COOKIE[$cookie])) {
            return 'like';
        }
        return 'notlike';
    }
}