<?php

class Categorie {

    private $_catable = ['Musique','Web','Lifestyle','Culture','Humeur'];
    private $_adaptablecate = ['Musique'=>0,'Web'=>1,'Lifestyle'=>2,'Culture'=>3,'Humeur'=>4];
    private $_cat;
    private $_bdd;
    private $_articleparpage = 5;
    private $_max;
    private $_nbpage;
    private $_premiere_entre;

    public function __construct($cat) {
        try {
           // $this->_bdd = new PDO("mysql:host=yunacreabxkj.mysql.db;dbname=yunacreabxkj", "yunacreabxkj", "J2c7tqX8");
            $this->_bdd = new PDO("mysql:host=localhost;dbname=bonbon", "root", "");

        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }

        $count = count($this->_catable);
        for($i = 0; $i < $count; $i++) {
            if(strtoupper($cat) == strtoupper($this->_catable[$i])) {
                $this->_cat = ucwords(strtolower($cat));
                return true;
            }
        }
        return false;
    }
    public function getCat(){
        return $this->_cat;
    }

    public function getCount() {
        $query = $this->_bdd->query(' SELECT COUNT(*) as nb FROM articles WHERE publication = 1 AND categorie = "'.$this->_cat.'"');
        $max = $query->fetch();
        return $this->_max = $max['nb'];
    }
    public function totalPage(){
        $this->_nbpage = ceil($this->_max/$this->_articleparpage);
        return $this->_nbpage;
    }

    public function premiereEntre($page_actuelle) {
        return $this->_premiere_entre = ($page_actuelle-1)* $this->_articleparpage;
    }

    public function resultatParPage($premiere_entree) {

        $query = $this->_bdd->prepare('SELECT * FROM articles WHERE publication = 1 AND categorie = :cat ORDER BY id DESC LIMIT '.$premiere_entree.','.$this->_articleparpage);
        $query->execute([
            'cat'=>$this->_adaptablecate[$this->_cat]
        ]);

        return $query->fetchAll();
    }
    public function test(){
        echo $this->_adaptablecate[$this->_cat];
    }
}