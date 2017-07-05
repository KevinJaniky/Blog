<?php

class Reponse {

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

    public function setContent($content)
    {
        if (strlen($content) < 2) {
            return $this->_error = true;
        }
        return $this->_content = ($content);
    }

    public function add($id) {
        if($this->_error){
            return false;
        }
        $query = $this->_bdd->prepare('INSERT INTO reponse(content,id_message) VALUES (:content,:id)');
        $query->execute([
            'content'=>$this->_content,
            'id'=>$id
        ]);
        return true;
    }

    public function selectAll()
    {
        $query = $this->_bdd->query("SELECT * FROM reponse");
        return $query->fetchAll();
    }

    public function delete($id)
    {
        $this->_bdd->query('DELETE FROM reponse WHERE id='. $id);
    }
}