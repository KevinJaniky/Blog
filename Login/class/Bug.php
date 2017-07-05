<?php
class Bug{
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

    public function add($content){
        $query = $this->_bdd->prepare('INSERT INTO bug(content) VALUES (:content)');
        $query->execute(['content'=>$content]);
    }

    public function select(){
        $query = $this->_bdd->query('SELECT * FROM bug');
        return $query->fetchAll();
    }

    public function delete($id)
    {
        $this->_bdd->query('DELETE FROM bug WHERE id = ' . $id);
    }

}