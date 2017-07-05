<?php

class Commentaires
{

    private $_bdd;
    private $_error = false;
    private $_content;

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

    public function selectAll()
    {
        $query = $this->_bdd->query("SELECT * FROM commentaire");
        return $query->fetchAll();
    }

    public function delete($id)
    {
        $this->_bdd->query('DELETE FROM commentaire WHERE id = ' . $id);
    }

    public function selectOne($id)
    {
        $query = $this->_bdd->query('SELECT * FROM commentaire WHERE id='.$id);
        return $query->fetch();
    }

    public function setContent($content)
    {
        if (strlen($content) < 2) {
            return $this->_error = true;
        }
        return $this->_content = htmlentities($content);
    }


}