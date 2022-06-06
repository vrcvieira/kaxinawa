<div id="html" >
<?php
include "conecta.php"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituição</title>
<script src="jquery.js"> </script>
<script language="Javascript">

function validaForm(){

d = document.cadastro_instituicao;
//validar nome
if (d.nome.value == ""){
alert("O campo nome deve ser preenchido!");
d.nome.focus();
d.cadastrarinstituicao=null;
return false;
}

return true;

}

function Excluir(id)
		{
			if(confirm('Deseja excluir a Instituição?'))
			{
				$.post("excluir_instituicao.php", { id:id },
				function(){
					carrega('cadastro_instituicao.php');
				}
				);
				
			}
		}


		
</script>
<script>
		function carrega(linque) 
		{
			$('#html').load(linque);
		}
</script>
</head>

<body>

<?
if (!isset($cadastrarinstituicao))
{
?>

		<div align="center">
        <hr /><strong> Instituição </strong> <hr />
        </div>

	<br />
    
	<form name="cadastro_instituicao" method="post" action="" onSubmit="return validaForm()">
    <table>
        
        <br />
         <tr>
	        <td colspan="3"><strong>Cadastrar uma Instituição: </strong><br /><br /></td>
        </tr>
        <tr>
            <td>Nome: </td>
            <td><input name="nome" type="text"  maxlength="255"/></td>
        </tr>
        <tr>
            <td>Sigla: </td>
            <td><input name="sigla" type="text"  maxlength="255"/></td>
        </tr>
        <tr>
            <td>CNPJ: </td>
            <td><input name="cnpj" type="text"  maxlength="255"/></td>
        </tr>
        
        <tr>
            <td>Natureza Jurídica: </td>
            <td><input name="natureza_juridica" type="text"  maxlength="255"/></td>
        </tr>
        <tr>
            <td>Endereço: </td>
            <td><input name="endereco" type="text"  maxlength="255"/></td>
        </tr>
        <tr>
            <td>Representante Institucional: </td>
            <td><input name="representante_institucional" type="text"  maxlength="255"/></td>
        </tr>
        <tr>
        	<td colspan="2" align="center"><br /><input type="submit" name="cadastrarinstituicao" value="Cadastrar"/></td>
        </tr>
        <tr>
        	<td colspan="2">
            	
            		<br />---<br /><br /><strong>Lista de Instituições já cadastradas:</strong>
				<table border="1" cellpadding="2" cellspacing="2">
                <tr>
                <td>Nome</td><td>Sigla</td><td>CNPJ</td><td>Natureza Jurídica</td><td>Endereço</td><td>Representante Institucional</td>
                </tr>
                
                <?
$ins = mysql_query("SELECT * FROM kxw_instituicao");
while ($instituicao = mysql_fetch_array($ins)) { 
	 ?>
    <tr>
    <td>
	<? 
		if($instituicao['INS_DESCRICAO']==NULL)
			echo "---";
		else
			echo htmlentities($instituicao['INS_DESCRICAO']); 
	?>
    </td>
    <td>
	<?
		if($instituicao['INS_SIGLA']==NULL)
			echo "---";
		else
			echo htmlentities($instituicao['INS_SIGLA']); 
	?>
    </td>
    <td>
	<?
		if($instituicao['INS_CNPJ']==NULL)
			echo "---";
		else
			echo htmlentities($instituicao['INS_CNPJ']); 
	?>
    </td>
    <td>
	<?
		if($instituicao['INS_NATUREZA_JURIDICA']==NULL)
			echo "---";
		else
			echo htmlentities($instituicao['INS_NATUREZA_JURIDICA']); ?>
    </td>
    <td>
	<?
		if($instituicao['INS_ENDERECO']==NULL)
			echo "---";
		else
    		echo ($instituicao['INS_ENDERECO']); ?></td>
                	
                    <td>
                   <? if($instituicao['INS_REPRESENTANTE_INSTITUCIONAL']==NULL)
			echo "---";
		else
    		echo ($instituicao['INS_REPRESENTANTE_INSTITUCIONAL']); ?> 
                    </td>
                    <td>
                    	<a href="javascript:;" onclick="Excluir('<?=$instituicao['INS_ID']?>')">[excluir] </a>
                    </td>
                    </tr>
                    <? }?>
            	</table>
            </td>
        </tr>
    </table>
    </form>
	
    <p><a href="index.php">Voltar para a página inicial do <strong>Sistema de Gestão de Editais - KAXINAWA</strong></a></p>
    
	<? } 
else {

$nome = $_POST['nome'];
$sigla = $_POST['sigla'];
$cnpj = $_POST['cnpj'];
$natureza_juridica = $_POST['natureza_juridica']; 
$endereco = $_POST['endereco'];
$representante_institucional = $_POST['representante_institucional'];

$qr = mysql_query("INSERT INTO kxw_instituicao(`INS_DESCRICAO`, `INS_SIGLA`, `INS_CNPJ`, `INS_NATUREZA_JURIDICA`, `INS_ENDERECO`, `INS_REPRESENTANTE_INSTITUCIONAL`) VALUES( '$nome',  '$sigla', '$cnpj', '$natureza_juridica' , '$endereco', '$representante_institucional' )") or die(mysql_error());
	if($qr == 1){
	?>
		<script>
			alert("Cadastro realizado com sucesso!");
			window.location.replace("cadastro_instituicao.php");
		</script>
	<?php
	}else{
		?>
		<script>
			alert("Os dados não puderam ser gravados, por favor, tente novamente!");
			window.location.reload();
		</script>
		<?php
	}
}

?>
    
</body>
</html>
</div>