<?php

class Rss {

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

    public function select() {
        $query = $this->_bdd->query('SELECT * FROM yv_rss');
        return $query->fetchAll();
    }

    public function delete($id) {
        $this->_bdd->query('DELETE FROM yv_rss WHERE id = '.$id);
    }

    public function add($titre,$link,$desc) {
        $query = $this->_bdd->prepare("INSERT INTO yv_rss(title,link,description) VALUES (:titre,:link,:desc)");
        $query->execute([
           'titre'=>$titre,
            'link'=>$link,
            'desc'=>$desc
        ]);

    }

    public function takePic($id){
        $query = $this->_bdd->query('SELECT couverture FROM articles WHERE id ='.$id);
        return $query->fetch();
    }
    public function updateFlux() {


        $data = $this->select();


        $xml = '<?xml version="1.0" encoding="iso-8859-1" ?>
<rss version="2.0">
    <channel>
        <title>Yuna Création</title>
        <link>http://www.yuna-creation.fr</link>
        <description>Blog de Lifestyle</description>
        <language>fr</language>
        <copyright>Copyright 2017, Yuna Création</copyright>';

        for($i = 0;$i<count($data);$i++) {
            $art = $this->takePic($data[$i]['link']);
/*
            $str = strtr($data[$i]['link'], 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
            $str = strtr($str, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy');*/

            /*$strd = strtr($data[$i]['description'], 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
            $strd = strtr($strd, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy');*/


            $xml .= '<item>';
            $xml .= '<title>'.stripcslashes($data[$i]['title']).'</title>';
            $xml .= '<link>/Article'.rawurldecode($data[$i]['link']).'</link>';
            $xml .= '<guid isPermaLink="true">/Article'.rawurldecode($data[$i]['link']).'</guid>';
            $xml .= '<pubDate>'.(date("D, d M Y H:i:s O", strtotime($data[$i]['pubDate']))).'</pubDate>';
            $xml .= '<enclosure url="http://www.yuna-creation.fr/media/Articles/'.$art['couverture'].'" length="122163200" type="image/jpeg" />';
            $xml .= '<description>'.stripcslashes($data[$i]['description']).'</description>';
            $xml .= '</item>';

        }

        $xml .= '
    </channel>
</rss>';

        $fp = fopen('flux.xml',"w+");
        fputs($fp,$xml);
        fclose($fp);
    }
}