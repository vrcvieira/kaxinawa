  <?php
  include "conecta.php"
  ?>
  <div align="center">
  <hr />
  <strong>Editais Disponíveis</strong>
  <hr />
  <p align="left">Selecione o Edital desejado:</p></div>
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
  <table name="edital" width="90%" align="center" cellpadding="0" cellspacing="3" valign="top">
            
  <tr>
  <td><a href="javascript:;" onclick="abrejanela('submeter_projeto.php?id=<?php echo $editais['EDI_ID']; ?>')"> <? echo htmlentities($editais['EDI_TITULO']); ?> </a> </td> 
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
	 <?
  } else { ?>
    <table name="edital" width="90%" align="left" cellpadding="0"
			cellspacing="3">
            <tr> <td> <strong>Não há editais disponíveis.</strong> </td> </tr>
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