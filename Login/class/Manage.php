<?php

class Manage
{

    private $_bdd;

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

    public function countCommentaireTotal(){
        $query = $this->_bdd->query('SELECT COUNT(*) as nb FROM commentaire');
        $data = $query->fetch();
        return $data['nb'];
    }
    public function countNewsTotal(){
        $query = $this->_bdd->query('SELECT COUNT(*) as nb FROM newsletter');
        $data = $query->fetch();
        return $data['nb'];
    }
    public function countIdeeTotal(){
        $query = $this->_bdd->query('SELECT COUNT(*) as nb FROM box_idee');
        $data = $query->fetch();
        return $data['nb'];
    }

    public function createUrlYoutube($chaine){
        $regex = '#^(https:\/\/)(www\.youtube\.com\/watch\?v=)([a-zA-Z0-9_-]+)$#';
        $data = preg_match($regex,$chaine);

        if($data){
            $data_explode = explode('v=',$chaine);
            $tab = $data_explode[1];
            return 'https://www.youtube.com/embed/'.$tab;
        } else {
            echo 'Url error';
            return false;
        }
    }
}