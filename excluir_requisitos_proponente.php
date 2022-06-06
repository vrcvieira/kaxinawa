<?
include "conecta.php";
$deletar = mysql_query("DELETE FROM kxw_requisitos_proponente WHERE RPR_ID=".$_POST['id']."");
?>