<?
include "conecta.php";
$deletar = mysql_query("DELETE FROM kxw_projeto WHERE PRO_ID=".$_POST['id']."");
?>