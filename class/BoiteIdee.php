<?php

class BoiteIdee
{

    private $_bdd;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_idee;

    public function __construct()
    {
        try {
            $this->_bdd = new PDO("mysql:host=localhost;dbname=bonbon", "root", "");
        } catch (Exception $e) {
            die("erreur :" . $e->getMessage());
        }
    }

    public function setNom($nom)
    {
        if (strlen($nom) < 2) {
            return $this->_error = true;
        }
        return $this->_nom = htmlentities($nom);
    }

    public function setPrenom($prenom)
    {
        if (strlen($prenom) < 2) {
            return $this->_error = true;
        }
        return $this->_prenom = htmlentities($prenom);
    }

    public function setMail($mail)
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return $this->_error = true;
        }
        return $this->_mail = htmlentities($mail);
    }

    public function setIdee($idee)
    {
        if (strlen($idee) < 5) {
            return $this->_error = true;
        }
        return $this->_idee = htmlentities($idee);
    }

    public function addIdee()
    {
        $query = $this->_bdd->prepare('INSERT INTO box_idee(nom,prenom,mail,idee) VALUES (:nom,:prenom,:mail,:idee)');
        $query->execute([
            'nom' => $this->_nom,
            'prenom' => $this->_prenom,
            'mail' => $this->_mail,
            'idee' => $this->_idee
        ]);
    }
}