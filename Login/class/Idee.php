<?php
class Idee {

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

    public function select()
    {
        $query = $this->_bdd->query('SELECT * FROM box_idee');
        return $query->fetchAll();
    }

    public function delete($id)
    {
        $this->_bdd->query('DELETE FROM box_idee WHERE id = ' . $id);
    }
}