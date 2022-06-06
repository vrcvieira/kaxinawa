<div id="html" >
<?php
include "conecta.php"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Itens Financiáveis</title>
<script src="jquery.js"> </script>
<script type="text/javascript">
function adicionar(id){
	$.get('teste.php', {
		q:id
	}, function(resultado){
		if(resultado == 'ok'){
			$('#usuario-'+id).text('[adicionado]');
		} else {
			alert('erro');
		}
	});	
}
</script>
</head>
<body>
<?
if (!isset($listarbolsistas))
{
?>
<div align="center">
  <hr />
  <strong> Lista de Bolsistas </strong>
  <hr />
</div>
<br />
<form name="listarbolsistas" method="get" action="">
  <table>
    <br />
    <tr>
    	<td><strong>Buscar bolsista</strong></td>
    </tr>
    <tr>
    	<td>Informe parte do Nome ou CPF: </td>
        <td><input type="text" name="q" /> <input type="submit" value="Buscar"/></td>
    </tr>
    <tr>
    	<td></td>
        <td></td>
    </tr>
    <tr>
      <td colspan="2"><br />
        ---<br />
        <br />
        <strong>Lista de Bolsistas:</strong>
        <table border="1" cellpadding="2" cellspacing="2">
          <tr>
            <td>Nome (CPF) </td>
			<td></td>
          </tr>
          <?
if (isset($_GET['q'])) {
	if(is_numeric($_GET['q'])) {
		$query = "SELECT USU_ID, USU_NOME, USU_CPF FROM kxw_usuario WHERE USU_CPF like '%".$_GET['q']."%' AND USU_TIPO='P' AND USU_TIN_ID='1'";  
	} else {
		$query = "SELECT USU_ID, USU_NOME, USU_CPF FROM kxw_usuario WHERE USU_NOME like '%".$_GET['q']."%' AND USU_TIPO='P' AND USU_TIN_ID='1'";
	}
} else {
	$query = "SELECT USU_ID, USU_NOME, USU_CPF FROM kxw_usuario WHERE USU_TIPO='P' AND USU_TIN_ID='1'";		  
}
		  
$us = mysql_query($query);


while ($usuario = mysql_fetch_array($us)) { 
?>
          <tr>
            <td><? if ($us==0){
				echo "---";
			}else{
				echo htmlentities($usuario['USU_NOME']); }
?></td>
            <td id="usuario-<?=$usuario['USU_ID']?>"><a href="javascript:adicionar(<?=$usuario['USU_ID']?>);">[adicionar]</a></td>
          </tr>
          <? }?>
        </table></td>
    </tr>
  </table>
</form>
<p>Se não apareceu o usuário que você procurou, essa pessoa ainda não é cadastrada!</a></p>
<? } 
?>
</body>
</html>
</div>