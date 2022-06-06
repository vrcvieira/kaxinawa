<?
include "conecta.php";
$deletar = mysql_query("DELETE FROM kxw_instituicao WHERE INS_ID=".$_POST['id']."");
?>