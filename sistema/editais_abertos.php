<?php
include "conecta.php"
?>
<div align="center">
<hr />
<strong>Editais Disponíveis</strong>
<hr />
</div>
<table border="0">
<td>
<table align="center">
<tr>
<td>
</td>
</tr>

</table>
<br />
<?
$edital = mysql_query("SELECT *
					   FROM kxw_edital
					   WHERE EDI_SITUACAO = 1
					   ORDER BY EDI_DATA_INICIO DESC");
while ($editais = mysql_fetch_array($edital)) {
?>
<table>
<tr>
<td><strong> <? echo htmlentities($editais['EDI_TITULO']); ?> </strong> </td> 
</tr>
<tr>
<td><strong>Objetivo</strong>: <? echo htmlentities($editais['EDI_OBJETIVO']); ?> </td> 
</tr>
<tr>
<td><strong>In&iacute;cio das submisses</strong>:
  <? echo date ("d/m/Y",strtotime($editais['EDI_DATA_INICIO'])) ?> 
  <br />
  <strong>T&eacute;rmino das submiss&otilde;es:</strong> <? echo date ("d/m/Y",strtotime($editais['EDI_DATA_FIM'])) ?></td> 
</tr>
<tr>
<td> <a href="<?=$editais['EDI_ARQUIVO'] ?>" target="_new">Clique aqui para ver o edital completo. </a> </td> 
</tr>
</table>
<br />
<?
}
?>
</table>