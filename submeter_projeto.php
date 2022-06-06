<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="jquery.js"></script>
<script language="javascript">
	function validaForm()
	{
		d = document.add_edital;
	//validar nome
		if (d.titulo.value == "")
		{
			d.sub_projeto=null;
			alert("O campo titulo deve ser preenchido!");
			d.titulo.focus();
			return false;
		}

		if (d.resumo.value == "Resumo do projeto. ")
		{
			d.sub_projeto=null;
			alert("O resumo deve ser preencnhido")
			d.resumo.focus();
			return false;
		}

		if (d.p_chave.value =="")
		{
			d.sub_projeto=null;
			alert("As palavras chaves devem ser especificadas")
			d.p_chave.value.focus();
			return false;
		}
		$.each(d.quant,function(index, item) 
		{
			if ( item == "")
			{
				d.sub_projeto=null;
				alert("Todas as quantidades e valores devem ser preenchidos")
				return false;
			}
		});


		if (d.file.value == "")
		{
			d.sub_projeto=null;
			alert("Selecione o arquivo de formato pdf com o seu projeto");
			return false;
		}

	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Submeter Projeto</title>
</head>
<body>
<?
	include "conecta.php";
	if (!isset($sub_projeto) && (!isset($salvar_projeto)))
	{

?>
<hr />
<div align="center"> <strong>Submeter Projeto</strong>
  <hr />
</div>
<form name="formSubProjeto" method="post"  enctype="multipart/form-data">
  <table name="projeto" width="90%" align="center" cellpadding="0" cellspacing="3">
    <tr>
      <td width="30%">Título: </td>
      <td width="70%"><input type="text" name="titulo" size="50" id="titulo" /></td>
    </tr>
    <tr>
      <td>Resumo:</td>
      <td><textarea name="resumo" cols="50" rows="5"  >Resumo do projeto. </textarea></td>
    </tr>
    <tr>
      <td>Palavras chave: </td>
      <td><input type="text" size="50" name="pchave"></td>
    </tr>
    <tr>
      <td>Participantes do projeto: </td>
      <td>*APARECER O NOME DOS COLSISTAS OU COLABORADORES</td>
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
									$ite_itf_id = mysql_query("SELECT * FROM kxw_itens_financiaveis_edital WHERE ITE_EDI_ID = '$id' "); /*Seleciona os IDS dos itens financiaveis 
ligados ao edital escolhido */
									?>
          <input type="hidden" value="<?=$id?>" name="id_edital" />
          <?
									while ($ite_itf = mysql_fetch_array($ite_itf_id)){ // Organiza esses IDS num array
										?>
          <tr>
            <?
										?>
            <input type="hidden" value="<?=$ite_itf['ITE_ITF_ID'] ?>" name="id[]"  />
            <?
										$itens_financiaveis = mysql_query("SELECT * FROM `kxw_itens_financiaveis` WHERE ITF_ID = '".$ite_itf['ITE_ITF_ID']."' ");
										$itenf = mysql_fetch_array($itens_financiaveis);
										?>
            <td><?
										echo htmlentities($itenf['ITF_DESCRICAO']); ?>
              :
              <?
										?></td>
            <td><input type="text" value="" size="2" name="quant[]"></td>
            <td><input type="text" value="" size="2" name="valor[]"></td>
            <td><input type="text" value="" size="2" name="total[]"></td>
            <td><textarea cols="7" name="desc[]" rows="3">Insira descrição aqui.</textarea></td>
          </tr>
          <?php
									}
						?>
        </table>
        <br /></td>
    </tr>
    <tr>
      <td>Arquivo: </td>
      <td><input type="file" name="file" id="file"> <font color="#FF0000"> Envie o arquivo somente em caso de submissão!</font></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><br />
        <input type="submit" align="center" name="sub_projeto" value="Submeter Projeto"/>
        <input type="submit" align="center" name="salvar_projeto" value="Salvar Projeto"/></td>
    </tr>
  </table>
</form>
<?
	} else {
			$usu_id = $_SESSION['idUsuario'];
			echo $usu_id;
			$dataAtual = date("Y-m-d h-i-s");

		
		if (isset ($sub_projeto)) {
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
		}
		$cadastrar = mysql_query("INSERT INTO kxw_projeto (PRO_TITULO, PRO_RESUMO, PRO_EDITAL, PRO_ARQUIVO, PRO_USU_ID, PRO_PCHAVE) VALUES ('".mysql_real_escape_string(trim($_POST['titulo']))."', '".mysql_real_escape_string(trim($_POST['resumo']))."', '".mysql_real_escape_string(trim($_POST['id_edital']))."', '$arquivo_nome', '$usu_id', '".mysql_real_escape_string(trim($_POST['pchave']))."' )");


		$in_id = mysql_insert_id($con);//Pegando o ultimo id inserido no banco, neste caso o id do projeto a ser submetido ou salvo.
		$sqls = array();


		//INICIO DA INSERÇÃO NA TABLEXA KXW_ITENS FINANCIAVEIS_PROJETO

		foreach( $_POST['id'] as $q=>$w ) //CRIA O INICIO DAS SQLS NO VETOR '$sqls' E ADICIONA OS IDS
		{
			$sqls[$q] = "INSERT INTO `kaxinawa`.`kxw_itens_financiaveis_projeto` (`IFP_PRO_ID` ,`IFP_ITF_ID` ,`IFP_VALOR` ,`IFP_QUANTIDADE`, `IFP_DESCRICAO`)VALUES ('$in_id', '$w', ";
		}

		foreach( $_POST['valor'] as $b=>$a ) //ADICIONA OS VALORES
		{
			$sqls[$b] .= "'$a', ";

		}

		foreach ($_POST['quant'] as $c=>$d  ) //ADICIONA AS QUANTIDADES
		{
			$sqls[$c] .="'$d', ";
		}

		foreach ($_POST['desc'] as $f=>$g  ) // ADICIONA AS DESCRIÇÕES E EXECUTA AS SQLS SALVAS NO VETOR '$sqls'
		{
			$sqls[$f] .="'$g')";
			$comit = mysql_query($sqls[$f]);
		}
		// FIM DA INSERÇÃO NA TABLEXA KXW_ITENS FINANCIAVEIS_PROJETO

		if($cadastrar == 0){
		?>
<script>
				alert("Não foi possível");
			</script>
<? 		} 
		else 
		{ 
			if (!isset($salvar_projeto))
			{
				$defsituacao = mysql_query("UPDATE `kaxinawa`.`kxw_projeto` SET `PRO_SITUACAO` = 'C' WHERE `kxw_projeto`.`PRO_ID` ='$in_id'");
				$defdata = mysql_query("UPDATE `kaxinawa`.`kxw_projeto` SET `PRO_DATA_SUBMISSAO` = '$dataAtual' WHERE `kxw_projeto`.`PRO_ID` ='$in_id'");
			?>
<script>alert("Projeto enviado com sucesso!"); window.close(); </script>
<?php
			}
			else
			{
				$defsituacao = mysql_query("UPDATE `kaxinawa`.`kxw_projeto` SET `PRO_SITUACAO` = 'S' WHERE `kxw_projeto`.`PRO_ID` ='$in_id'");
				$defdata = mysql_query("UPDATE `kaxinawa`.`kxw_projeto` SET `PRO_DATA_CRIACAO` = '$dataAtual' WHERE `kxw_projeto`.`PRO_ID` ='$in_id'");
				?>
<script>alert("Projeto salvo com sucesso!"); window.close(); </script>
<?
			}

		}
	}
	?>
</body>
</html>