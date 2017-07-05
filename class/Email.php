<?php

class Email
{

    private $_nom;
    private $_prenom;
    private $_mail;
    private $_obj;
    private $_msg;
    private $_error = false;
    private $_admin = 'kevin.janiky@gmail.com';
    private $_resultat;
    private $_header;

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

    public function setObjet($objet)
    {
        if (strlen($objet) < 2) {
            return $this->_error = true;
        }
        return $this->_obj = htmlentities($objet);
    }

    public function setMessage($msg)
    {
        if (strlen($msg) < 5) {
            return $this->_error = true;
        }
        return $this->_msg = htmlentities($msg);
    }

    public function setMail($mail)
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return $this->_error = true;
        }
        return $this->_mail = htmlentities($mail);
    }

    public function formatMessage(){
        $this->_resultat = '<h2> Objet : '.$this->_obj.'</h2>';
        $this->_resultat .= '<h4> Identité : '.$this->_prenom.' '.$this->_nom.'</h4>';
        $this->_resultat .= '<h6> Mail : '.$this->_mail.'</h6>';
        $this->_resultat .= '<p>'.$this->_msg.'</p>';
        return $this->_resultat;
    }

    public function header(){
        $this->_header  = 'Mime-Version: 1.0'."\r\n";
        $this->_header .= 'Content-type: text/html; charset=utf-8'."\r\n";
        $this->_header .= "\r\n";
        return $this->_header;
    }

    public function sendMail(){
        if($this->_error) {
            return false;
        }else {
            mail($this->_admin,$this->_obj,$this->formatMessage(),$this->header());
            return true;
        }
    }

}