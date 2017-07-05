<?php

class Newsletter {
    private $_bdd;
    private $_mail;
    private $_url;

    public function __construct()
    {
        try {
            $this->_bdd = new PDO("mysql:host=localhost;dbname=bonbon", "root", "");
        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }
    }

    public function setMail($mail) {
        if(filter_var($mail,FILTER_VALIDATE_EMAIL)) {
            return $this->_mail = $mail;
        }
        return false;
    }
    public function setUrl($url) {
        return $this->_url = htmlentities($url);
    }

    public function verifExist() {
        $query = $this->_bdd->query('SELECT * FROM newsletter WHERE mail = "'.$this->_mail.'"');
        $data = $query->fetch();

        if(empty($data)){
            return true;
        }
        return false;
    }

    public function addEmail(){
        $query = $this->_bdd->prepare('INSERT INTO newsletter(mail) VALUES (:email) ');
        $query->execute([
            'email'=>$this->_mail
        ]);
        header('location:'.$this->_url);
        return true;
    }

}