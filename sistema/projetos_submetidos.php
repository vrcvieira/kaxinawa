<?php session_start();
include "conecta.php"
?>

<div align="center">
  <hr />
  <strong>Projetos Submetidos</strong>
  <hr />
</div>
<br />
<?
if ($_SESSION['tipoUsuario']=="P"){
$projeto = mysql_query("SELECT *
FROM kxw_projeto
WHERE PRO_USU_ID = '".$_SESSION['idUsuario']."' AND PRO_SITUACAO = 'C'");
}else{
$projeto = mysql_query("SELECT * FROM kxw_projeto  WHERE PRO_SITUACAO = 'C' ");
}

$test = mysql_num_rows($projeto);
if ($test !=NULL) {
while ($projetos = mysql_fetch_array($projeto)) {
?>
<table border="1" " name="projeto" width="90%" align="center" cellpadding="3" cellspacing="3" valign="top">
  <tr>
    <td><strong> Titulo: </strong> <? echo htmlentities($projetos['PRO_TITULO']); ?></td>
  </tr>
  <? if($_SESSION['tipoUsuario']=="G" || $_SESSION['tipoUsuario']=="A")  {
$nome = mysql_query("SELECT USU_NOME from kxw_usuario WHERE USU_ID = '".$projetos['PRO_USU_ID']."'");
$nome = mysql_fetch_array($nome);
?>
  <tr>
    <td><strong> Usuário: </strong>
      <?=$nome['USU_NOME'] ?></td>
  </tr>
  <? } ?>
  <tr>
    <td><strong>Resumo: </strong> <? echo ($projetos['PRO_RESUMO']); ?></td>
  </tr>
  <tr>
    <td><strong>Data de Submissão:</strong> <? echo date ("d/m/Y",strtotime($projetos['PRO_DATA_SUBMISSAO'])); ?></td>
  </tr>
  <tr>
    <td><a href="javascript:;" onclick="abrejanela('visualizar_projeto.php?id=<?php echo $projetos['PRO_ID']; ?>')"> <strong> [Visualizar Projeto] </strong> </a></td>
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
<?
}