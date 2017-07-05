<?php

class User {

    private $_bdd;
    private $_mail;
    private $_mdp;
    private $_error = false;
    private $_data;

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

    public function setMail($mail){
        if(filter_var($mail,FILTER_VALIDATE_EMAIL))
            return $this->_mail = $mail;
        return $this->_error = true;
    }

    public function setMdp($mdp){
        if(strlen($mdp) <6 ){
            return $this->_error = true;
        }
        return $this->_mdp = $mdp;
    }

    public function verifUser() {
        $query = $this->_bdd->prepare('SELECT * FROM yv_user WHERE mail = :mail AND mdp = :mdp');
        $query->execute(['mail'=>$this->_mail,'mdp'=>$this->_mdp]);
        $data = $query->fetch();

        if(empty($data)){
            return $this->_error = true;
        }else {
           return $this->_data = $data;
        }
    }

    public function createSession(){
        if($this->_error){
            return false;
        }else{
            $_SESSION['mail'] = $this->_data['mail'];
            $_SESSION['mdp'] = $this->_data['mdp'];
            $_SESSION['role'] = $this->_data['role'];
            $_SESSION['admin'] = true;
            return true;
        }
    }

}