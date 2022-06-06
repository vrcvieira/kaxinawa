<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Submeter Projeto</title>
  </head>
  <body>
    <?
	include "conecta.php";

	$pegproj = mysql_query ("SELECT * FROM `kxw_projeto` WHERE PRO_ID = '$id'  ");
	$kratos = mysql_fetch_array($pegproj);
	if ($_SESSION['tipoUsuario']=="P"){
	if ($kratos['PRO_USU_ID']!=$_SESSION['idUsuario']){
	?>
		<script> 
			alert("Esse projeto não foi cadastrado com o seu usuário!"); 
			window.close();
   		</script> 
	<?
	}
	}
?>


    <hr />
    <div align="center"> <strong>Submeter Projeto</strong>
      <hr />
    </div>
    <form name="formSubProjeto" method="post"  enctype="multipart/form-data">
      <table name="projeto" width="90%" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td width="30%">Título: </td>
          <td width="70%"> <input type="text" readonly="readonly" name="titulo" size="50" id="titulo" value="<?=$kratos['PRO_TITULO'] ?>" /></td>
        </tr>
        <tr>
          <td>Resumo:</td>
          <td><textarea name="resumo" readonly="readonly" cols="50" rows="5"  ><?=$kratos['PRO_RESUMO'] ?> </textarea></td>
        </tr>
        <tr>
          <td>Palavras chave: </td>
          <td><input type="text" size="50" readonly="readonly" name="pchave" value="<?=$kratos['PRO_PCHAVE'] ?>"></td>
        </tr>
        <tr>
          <td colspan="2"> Recursos Solicitados: <br />
            <table border="1">
              <tr>
                <td >Item</td>
                <td >Quant.</td>
                <td >Valor</td>
                <td >Total</td>
                <td >Descrição</td>
              </tr>
              <?php
									$ite_itf_id = mysql_query("SELECT * FROM kxw_itens_financiaveis_projeto WHERE IFP_PRO_ID = '$id' "); /*Seleciona os IDS dos itens financiaveis 
ligados ao projeto escolhido */
									?>
              <?
									while ($ite_itf = mysql_fetch_array($ite_itf_id)){ // Organiza esses IDS num array
										?>
              <tr>
                <?
										?>
                <input type="hidden" value="<?=$ite_itf['IFP_ITF_ID'] ?>" name="id[]"  />
                <?
										$itens_financiaveis = mysql_query("SELECT * FROM `kxw_itens_financiaveis` WHERE ITF_ID = '".$ite_itf['IFP_ITF_ID']."' ");
										$itenf = mysql_fetch_array($itens_financiaveis);
										?>
                <td><?
										echo htmlentities($itenf['ITF_DESCRICAO']); ?>
                  :
                  <?
										?></td>
                <td><input type="text" readonly="readonly" value="<?=$ite_itf['IFP_QUANTIDADE'] ?>" size="2" name="quant[]"></td>
                <td><input type="text" readonly="readonly" value="<?=$ite_itf['IFP_VALOR'] ?>" size="2" name="valor[]"></td>
                <td><input type="text" readonly="readonly" value="" size="2" name="total[]"></td>
                <td><textarea cols="7" readonly="readonly" name="desc[]" rows="3"><?=$ite_itf['IFP_DESCRICAO'] ?></textarea></td>
              </tr>
              <?php
									}
						?>

            </table>
            <br /></td>
        </tr>
        
      </table>
      <br/>
       &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="<?=$kratos['PRO_ARQUIVO'] ?>" > <strong> Clique aqui para visualizar o pdf do projeto.  </strong> </a> 
    </form>
   
  </body>
</html>