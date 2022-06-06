<?php
	header("Content-type: text/xml; charset=ISO-8859-1");
    print '<?xml version="1.0" encoding="ISO-8859-1"?>';
  ?>

 <cidades>
 <?php
     
 $link = mysql_pconnect("localhost", "root", "vertrigo")
 	or die("Não pude conectar: " . mysql_error());
 mysql_select_db('kaxinawa', $link) or die ('Não foi possível usar db: ' . mysql_error());

    $result = mysql_query("SELECT CID_ID,CID_NOME FROM kxw_cidade WHERE CID_UF = '{$_GET['uf']}' ORDER BY CID_NOME") or die("Query invalida: " . mysql_error());

    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        printf("<nome id=\"%d\">%s</nome>\n", $row[0],$row[1]);
    }

    mysql_close($link);
 ?>
 </cidades>