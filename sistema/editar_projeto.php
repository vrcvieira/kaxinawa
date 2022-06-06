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

$pegproj = mysql_query ("SELECT * FROM `kxw_projeto` WHERE PRO_ID = '$id'  ");
$kratos = mysql_fetch_array($pegproj);

if ($kratos['PRO_USU_ID']!=$_SESSION['idUsuario']){
?>
<script> 
alert("Esse projeto não foi cadastrado com o seu usuário!"); 
window.close();
</script>
<?
}
?>
<hr />
<div align="center"> <strong>Submeter Projeto</strong>
  <hr />
</div>
<form name="formSubProjeto" method="post"  enctype="multipart/form-data">
  <input type="hidden" value="<?=$id ?>" name="id_projeto"  />
  <table name="projeto" width="90%" align="center" cellpadding="0" cellspacing="3">
    <tr>
      <td width="30%">Título: </td>
      <td width="70%"><input type="text" name="titulo" size="50" id="titulo" value="<?=$kratos['PRO_TITULO'] ?>" /></td>
    </tr>
    <tr>
      <td>Resumo:</td>
      <td><textarea name="resumo" cols="50" rows="5"  ><?=$kratos['PRO_RESUMO'] ?> 
</textarea></td>
    </tr>
    <tr>
      <td>Palavras chave: </td>
      <td><input type="text" size="50" name="pchave" value="<?=$kratos['PRO_PCHAVE'] ?>"></td>
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
          <input type="hidden" value="<?=$id ?>" name="id_projeto" />
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
            <td><input type="text" value="<?=$ite_itf['IFP_QUANTIDADE'] ?>" size="2" name="quant[]"></td>
            <td><input type="text" value="<?=$ite_itf['IFP_VALOR'] ?>" size="2" name="valor[]"></td>
            <td><input type="text" value="" size="2" name="total[]"></td>
            <td><textarea cols="7" name="desc[]" rows="3"><?=$ite_itf['IFP_DESCRICAO'] ?>
</textarea></td>
          </tr>
          <?php
}
?>
        </table>
        <br /></td>
    </tr>
    <tr>
      <td>Arquivo:</td>
      <td><input type="file" name="file" id="file"></td>
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
if (isset ($sub_projeto)){
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
$dataAtual = date("Y-m-d h-i-s");
$usu_id = $_SESSION['idUsuario'];
echo $usu_id;
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
$update = "UPDATE kxw_projeto SET PRO_TITULO='".mysql_real_escape_string(trim($_POST['titulo']))."', PRO_RESUMO='".mysql_real_escape_string(trim($_POST['resumo']))."', PRO_ARQUIVO='$arquivo_nome', PRO_PCHAVE='".mysql_real_escape_string(trim($_POST['pchave']))."'  WHERE PRO_ID='".$_POST['id_projeto']."' ";
$cadastrar = mysql_query($update)  or die(mysql_error());

$sqls = array();


//INICIO DA INSERÇÃO NA TABLEXA KXW_ITENS FINANCIAVEIS_PROJETO

foreach( $_POST['valor'] as $q=>$w ) //CRIA O INICIO DAS SQLS E ADICIONA OS VALORES
{
$sqls[$q] = "UPDATE `kxw_itens_financiaveis_projeto` SET `IFP_VALOR`= '$w', ";
}

foreach( $_POST['quant'] as $b=>$a ) //ADICIONA AS QUANTIDADES
{
$sqls[$b] .= "IFP_QUANTIDADE='$a', ";

}

foreach ($_POST['desc'] as $c=>$d  ) //ADICIONA AS DESCRIÇÕES
{
$sqls[$c] .="IFP_DESCRICAO='$d' ";
}

foreach ($_POST['id'] as $f=>$g  ) // ESPECIFICA QUAL ID DO ITEM FINANCIAVEL
{
$sqls[$f] .="WHERE IFP_ITF_ID='$g'";
$comit = mysql_query($sqls[$f]) or die(mysql_error());
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
$defsituacao = mysql_query("UPDATE `kaxinawa`.`kxw_projeto` SET `PRO_SITUACAO` = 'C' WHERE `kxw_projeto`.`PRO_ID` ='". $_POST['id_projeto'] ."'");
$defdata = mysql_query("UPDATE `kaxinawa`.`kxw_projeto` SET `PRO_DATA_SUBMISSAO` = '$dataAtual' WHERE `kxw_projeto`.`PRO_ID` ='". $_POST['id_projeto'] ."'");
?>
<script>alert("Projeto enviado com sucesso!"); window.close(); </script>
<?php
}
else
{
$defsituacao = mysql_query("UPDATE `kaxinawa`.`kxw_projeto` SET `PRO_SITUACAO` = 'S' WHERE `kxw_projeto`.`PRO_ID` ='".$_POST['id_projeto']."'");
?>
<script>alert("Projeto salvo com sucesso!"); window.close(); </script>
<?
}

}
}
?>
</body>
</html>