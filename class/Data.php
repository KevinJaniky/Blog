<?php

class Data {
    private $_bdd;
    private $_error = false;

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

    public function titlePlayer() {
        $query = $this->_bdd->query('SELECT * FROM data WHERE cle = "player" ORDER BY date DESC LIMIT 1');
        return $query->fetch();
    }
}