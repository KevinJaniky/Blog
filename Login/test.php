
<?php

$xml = '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
    <channel>
        <title>Yuna Création</title>
        <link>http://www.yuna-creation.fr</link>
        <description>Blog de Lifestyle</description>
        <language>fr</language>
        <copyright>Copyright 2017, Yuna Création</copyright>';

        for($i = 0;$i<count($data);$i++) {

        $xml .= '<item>';
            $xml .= '<title>'.stripcslashes($data[$i]['titre']).'</title>';
            $xml .= '<link>'.$data[$i]['link'].'</link>';
            $xml .= '<guid isPermaLink="true">'.$data[$i]['link'].'</guid>';
            $xml .= '<pubDate>'.(date("D, d M Y H:i:s O", strtotime($data[$i]['pubDate']))).'</pubDate>';
            $xml .= '<description>'.stripcslashes($data[$i]['description']).'</description>';
            $xml .= '</item>';

        }

        $xml .= '
    </channel>
</rss>';


        echo $xml;