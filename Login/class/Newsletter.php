<?php

class Newsletter
{
    private $_bdd;
    private $_mail;
    private $_url;

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
        $query = $this->_bdd->query('SELECT * FROM newsletter');
        return $query->fetchAll();
    }

    public function delete($id)
    {
        $this->_bdd->query('DELETE FROM newsletter WHERE id = ' . $id);
    }
}