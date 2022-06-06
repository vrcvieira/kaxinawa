<em>
<?
include ("conecta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Criar Edital</title>
    <script language="JavaScript">
function validaForm()
{
	d = document.add_edital;
	//validar nome
	if (d.titulo.value == "")
	{
		d.sendedital=null;
		alert("O campo titulo deve ser preenchido!");
		d.titulo.focus();
		return false;
	}
	//validar tipo
	if (d.tipo.value == "")
	{
		alert("Selecione um Tipo de Edital!");
		d.tipo.focus();
		d.sendedital=null;
		return false;
	}
	
	//validar nascimento
	if ((d.dd_inicio.value == 0) || (d.mm_inicio.value == 0) || (d.yy_inicio.value == 0) || (d.dd_fim.value == 0) || (d.mm_fim.value == 0) || (d.yy_fim.value == 0))
	{
		alert("O campo data de inicio e data de fim devem ser preenchido!");
		d.dd_inicio.focus();
		d.sendedital=null;
		return false;
	}
	
	//validar datas
	var inicio = d.yy_inicio.value + "-" + d.mm_inicio.value + "-" + d.dd_inicio.value;
	var fim = d.yy_fim.value + "-" + d.mm_fim.value + "-" + d.dd_fim.value;
		
	if(inicio > fim)
	{
		alert("A Data de Início não pode ser maior que a Data de Término das Submissões!");
		return false;
	}

if (d.file.value == "")
	{
		alert("O campo Arquivo deve ser preenchido!");
		d.file.focus();
		d.sendedital=null;
		return false;
	}

	return true;
}
</script>
  </head>
  <body>
    <?
if (!isset($sendedital) && !isset($salvaredital) )
{
	?>
    <hr />
    <div align="center"> <strong>Criar Edital</strong>
      <hr />
    </div>
    <p>
    <form name="add_edital" method="post" onSubmit="return validaForm()"
		enctype="multipart/form-data">
      <table name="edital" width="90%" align="center" cellpadding="0"
			cellspacing="3">
        <tr>
          <td width="30%">Titulo:</td>
          <td width="70%"><input type="text" name="titulo" size="70" /></td>
        </tr>
        <tr>
          <td>Tipo:</td>
          <td><select name="tipo" id="tipo">
              <option value="" selected="selected">:: Selecione >></option>
              <?  $tipo = mysql_query("SELECT * FROM kxw_tipo_edital");
						while ($tip = mysql_fetch_array($tipo)) {
							?>
              <option value="<?=$tip['TED_ID'] ?>">
              <?=$tip['TED_DESCRICAO']?>
              </option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td>Objetivo:</td>
          <td><textarea name="objetivo" cols="60" rows="5"> </textarea></td>
        </tr>
        <tr>
          <td>Descrição:</td>
          <td><textarea name="descricao" cols="60" rows="5"> </textarea></td>
        </tr>
        <tr>
          <td>Início das Submissões:</td>
          <td><select name="dd_inicio">
              <option value="0" selected="selected">dia</option>
              <?
						for ($dia=1; $dia<=31; $dia++)
						{
							?>
              <option value="<?=(strlen($dia) < 2) ? "0".$dia : $dia ?>">
              <?=$dia?>
              </option>
              <?
						}
						?>
            </select>
            <select name="mm_inicio">
              <option value="0" selected="selected">mês</option>
              <option value="01">Janeiro</option>
              <option value="02">Fevereiro</option>
              <option value="03">Março</option>
              <option value="04">Abril</option>
              <option value="05">Maio</option>
              <option value="06">Junho</option>
              <option value="07">Julho</option>
              <option value="08">Agosto</option>
              <option value="09">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
            </select>
            </select>
            <select name="yy_inicio">
              <option value="0"
							selected="selected">ano</option>
              <?
							for($ano=date("Y"); $ano<=date("Y")+5; $ano++)
							{
								?>
              <option value="<?=$ano ?>">
              <?=$ano ?>
              </option>
              <?
							}
							?>
            </select></td>
        </tr>
        <tr>
          <td height="26">Término das Submissões:</td>
          <td><select name="dd_fim">
              <option value="0" selected="selected">dia</option>
              <? for ($dia=1; $dia<=31; $dia++){?>
              <option value="<?=(strlen($dia) < 2) ? "0".$dia : $dia ?>">
              <?=$dia ?>
              </option>
              <? } ?>
            </select>
            <select name="mm_fim">
              <option value="0" selected="selected">mês</option>
              <option value="01">Janeiro</option>
              <option value="02">Fevereiro</option>
              <option value="03">Março</option>
              <option value="04">Abril</option>
              <option value="05">Maio</option>
              <option value="06">Junho</option>
              <option value="07">Julho</option>
              <option value="08">Agosto</option>
              <option value="09">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
            </select>
            <select name="yy_fim">
              <option value="0"
							selected="selected">ano</option>
              <? for ($ano=date("Y"); $ano<=date("Y")+5; $ano++){?>
              <option value="<?=$ano ?>">
              <?=$ano ?>
              </option>
              <? } ?>
            </select></td>
        </tr>
        <tr>
          <td>Requisitos do proponente:</td>
        </tr>
        <? $reqpro = mysql_query("SELECT * FROM kxw_requisitos_proponente");
			while ($reg = mysql_fetch_array($reqpro)) {

				?>
        <tr>
          <td colspan="2">&nbsp; &nbsp; &nbsp;
            <input type="checkbox"
					name="checkreq[]" value="<?=$reg['RPR_ID'] ?>" />
            <? echo htmlentities($reg['RPR_DESCRICAO']) ?> <br></td>
        </tr>
        <? } ?>
        <tr>
          <td>Itens Financiaveis:</td>
        </tr>
        <? $itenfi = mysql_query("SELECT * FROM kxw_itens_financiaveis");
			while ($iten = mysql_fetch_array($itenfi)) {

				?>
        <tr>
          <td colspan="2">&nbsp; &nbsp; &nbsp;
            <input type="checkbox"
					name="checkitenfi[]" value="<?=$iten['ITF_ID'] ?>" />
            <? echo htmlentities($iten['ITF_DESCRICAO']); ?> <br></td>
        </tr>
        <? } ?>
        <tr>
          <td>Valor total financiável (R$):</td>
          <td><input type="text" name="valortotalfinanciavel" size="10" /></td>
        </tr>
        <tr>
          <td>Valor máximo por projeto (R$):</td>
          <td><input type="text" name="valormaximoporprojeto" size="10" /></td>
        </tr>
        <tr>
          <td>Arquivo:</td>
          <td><input type="file" name="file" id="file"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="font-weight: bold;" colspan="2" align="center">Ao clicar em "Concluir Criação", o Edital será publicado!</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><br />
            <input type="submit" name="salvaredital" value="Salvar" />
            &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="submit" name="sendedital" value="Concluir Criação" /></td>
        </tr>
      </table>
    </form>
    <?
}
else
{
	$dataInicio = $_POST['yy_inicio']."-".$_POST['mm_inicio']."-".$_POST['dd_inicio'];
	$dataFim = $_POST['yy_fim']."-".$_POST['mm_fim']."-".$_POST['dd_fim'];
	$dataPublicacao = $_POST['yy_pub']."-".$_POST['mm_pub']."-".$_POST['dd_pub'];
	$titulo = $_POST['titulo'];
	$objetivo = $_POST['objetivo'];
	$tipo = $_POST['tipo'];
	$descricao = $_POST['descricao'];
	$valortotal = $_POST['valortotalfinanciavel'];
	$valormax = $_POST['valormaximoporprojeto'];

	if(!$_FILES)
	{
		echo 'Nenhum arquivo enviado!<br>';
	}
	else
	{
		$file_name = $_FILES['file']['name'];
		$file_type = $_FILES['file']['type'];
		$file_size = $_FILES['file']['size'];
		$file_tmp_name = $_FILES['file']['tmp_name'];
		$error = $_FILES['file']['error'];
	}

	switch ($error)
	{
		case 0:
			break;
		case 1:
			echo 'O tamanho do arquivo é maior que o definido nas configurações do PHP!';
			break;
		case 2:
			echo 'O tamanho do arquivo é maior do que o permitido!';
			break;
		case 3:
			echo 'O upload não foi concluido!';
			break;
		case 4:
			echo 'O upload não foi feito!';
			break;
	}

	if($error == 0)
	{
		$file_dividida = explode(".", $file_name);
		//file_dividida[0] é o nome do arquivo; file_dividida[1] é a extensão;
		$arquivo_nome = md5(date("d-m-y-m-i")).".".$file_dividida[1];
		if(!is_uploaded_file($file_tmp_name))
		echo 'Erro ao processar arquivo!';
		else
		{
			if(!move_uploaded_file( $file_tmp_name , $arquivo_nome ))
			echo 'Nao foi possivel salvar o arquivo!';
			else
			echo 'Processo concluido com sucesso!<br>';
		}
	}



	$cadastrar = mysql_query ("INSERT INTO `kaxinawa`.`kxw_edital` (`EDI_TITULO` ,`EDI_OBJETIVO` ,`EDI_TED_ID` ,`EDI_DESCRICAO` ,`EDI_DATA_INICIO` ,`EDI_DATA_FIM` ,`EDI_DATA_PUBLICACAO` ,`EDI_USU_ID` ,`EDI_DATA_HORA_CRIACAO` ,`EDI_VALOR_TOTAL_FINANCIAVEL` ,`EDI_VALOR_MAX_PROJETO` ,`EDI_ARQUIVO`)VALUES ('".mysql_real_escape_string(trim($_POST['titulo']))."', '".mysql_real_escape_string(trim($_POST['objetivo']))."', '".mysql_real_escape_string(trim($_POST['tipo']))."', '".mysql_real_escape_string(trim($_POST['descricao']))."', '$dataInicio', '$dataFim', '$dataPublicacao', '".mysql_real_escape_string(trim($_POST['valortotalfinanciavel']))."', '". date("Y-m-d H:i:s") ."', '".mysql_real_escape_string(trim($_POST['valortotalfinanciavel']))."', '".mysql_real_escape_string(trim($_POST['valormaximoporprojeto']))."', '$arquivo_nome')" ) or die(mysql_error());

	$in_id = mysql_insert_id($con);

	if($_POST['checkreq'])
	{
		foreach( $_POST['checkreq'] as $k=>$v )
		{
			$inserircheckreq = mysql_query("INSERT INTO kxw_requisitos_edital (RQE_EDI_ID, RQE_RPR_ID) VALUES ('$in_id', '$v')");
		}
	}
	if($_POST['checkitenfi'])
	{
		foreach( $_POST['checkitenfi'] as $c=>$b )
		{
			$inserircheckreq = mysql_query("INSERT INTO kxw_itens_financiaveis_edital (ITE_EDI_ID, ITE_ITF_ID) VALUES ('$in_id', '$b')");
		}
	}

	//if($_POST['checkitenfi'])
	//{
		//foreach( $_POST['checkitenfi'] as $c=>$b )
		//{
		//	$inserircheckitenfi = mysql_query("INSERT INTO kxw_itens_financiaveis_edital (ITE_EDI_ID ,ITE_ITF_ID)VALUES ('$in_id', '$b')");
		//}
	//}

	if($cadastrar == 0)
	{
		?>
    <script>alert("ERRO!"); reload(); </script>
    <?php
	}
	else
	{
		if (!isset($salvaredital)){
			$defsituacao = mysql_query("UPDATE `kaxinawa`.`kxw_edital` SET `EDI_SITUACAO` = '1' WHERE `kxw_edital`.`EDI_ID` ='$in_id'")
		?>
    <script>alert("Edital cadastrado com sucesso!"); window.close(); </script>
    <?php
		}else{
			$defsituacao = mysql_query("UPDATE `kaxinawa`.`kxw_edital` SET `EDI_SITUACAO` = '0' WHERE `kxw_edital`.`EDI_ID` ='$in_id'")
		?>
    <script>alert("Edital salvo com sucesso!"); window.location.replace("index.php"); </script>
    <?
		}
	}
}
?>
  </body>
</html>
</em>