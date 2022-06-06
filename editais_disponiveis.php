<?php 
include "conecta.php"
?>
<div align="center">
  <hr />
  <strong>Editais Disponíveis</strong>
  <hr />
</div>
<br />
<?
$edital = mysql_query("SELECT *
FROM kxw_edital
WHERE EDI_SITUACAO = 1
ORDER BY EDI_DATA_INICIO DESC");
$test = mysql_num_rows($edital);
if ($test !=NULL) {
while ($editais = mysql_fetch_array($edital)) {
?>
<table border="1" name="projeto" width="90%" align="center" cellpadding="3" cellspacing="1" valign="top">
  <tr>
    <td bgcolor="#FFFFCC"><strong> <? echo htmlentities($editais['EDI_TITULO']); ?> </strong></td>
  </tr>
  <tr>
    <td><strong>Objetivo</strong>: <? echo htmlentities($editais['EDI_OBJETIVO']); ?></td>
  </tr>
  <tr>
    <td><strong>In&iacute;cio das submisses</strong>: <? echo date ("d/m/Y",strtotime($editais['EDI_DATA_INICIO'])) ?> <br />
      <strong>T&eacute;rmino das submiss&otilde;es:</strong> <? echo date ("d/m/Y",strtotime($editais['EDI_DATA_FIM'])) ?></td>
  </tr>
  <tr>
    <td><a href="<?=$editais['EDI_ARQUIVO'] ?>" target="_new">Clique aqui para ver o edital completo</a></td>
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
<?
} else { ?>
<table name="edital" width="90%" align="left" cellpadding="0"
cellspacing="3">
  <tr>
    <td><strong>Não há editais disponíveis.</strong></td>
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
?>