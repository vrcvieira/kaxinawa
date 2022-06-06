<?php session_start();
include "conecta.php"
?>
<html>
<head>
<script src="jquery.js"> </script>
<script>
function Excluir(id)
{
if(confirm('Deseja excluir o projeto?'))
{
$.post("excluir_projeto.php", { id:id },
function(){
carrega('modificar_projeto.php');
}
);
}
}
</script>
</head>
<body>
<div align="center">
  <hr />
  <strong>Projetos Salvos</strong>
  <hr />
</div>
<br />
<?
$projeto = mysql_query("SELECT *
FROM kxw_projeto
WHERE PRO_USU_ID = '".$_SESSION['idUsuario']."' AND PRO_SITUACAO = 'S'");
$test = mysql_num_rows($projeto);
if ($test !=NULL) {
while ($projetos = mysql_fetch_array($projeto)) {
?>
<table border="1" name="projeto" width="90%" align="center" cellpadding="3" cellspacing="3" valign="top">
  <tr>
    <td><strong>Título:</strong> <? echo ($projetos['PRO_TITULO']); ?></td>
  </tr>
  <tr>
    <td><strong>Resumo: </strong>
      <?=$projetos['PRO_RESUMO'] ?></td>
  </tr>
  <tr>
    <td><strong>Data de Criação:</strong><? echo date ("d/m/Y",strtotime($projetos['PRO_DATA_CRIACAO'])); ?></td>
  </tr>
  <tr>
    <td><a href="javascript:;" onClick="abrejanela('editar_projeto.php?id=<?=$projetos['PRO_ID'] ?>')"> <strong> [Editar] </strong> </a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:;" style="color:#F00" onClick="Excluir('<?=$projetos['PRO_ID']?>')"> <strong> [Excluir] </strong> </a></td>
  </tr>
</table>
<br />
<?
}
?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?
} else { ?>
<table name="projeto" width="90%" align="left" cellpadding="0"
cellspacing="3">
  <tr>
    <td><strong>Não há projetos disponíveis.</strong></td>
  </tr>
</table>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
</body>
</html>
<?
}