<div id="html" >
<?php
include "conecta.php"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Itens Financiáveis</title>
<script src="jquery.js"> </script>
<script language="Javascript">

function validaForm(){

d = document.cadastro_itens_financiaveis;
//validar descricao
if (d.descricao.value == ""){
alert("O campo descrição deve ser preenchido!");
d.descricao.focus();
d.cadastraritem=null;
return false;
}

return true;

}

function Excluir(id)
		{
			if(confirm('Deseja excluir esse Item?'))
			{
				$.post("excluir_itens_financiaveis.php", { id:id },
				function(){
					carrega('cadastro_itens_financiaveis.php');
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
if (!isset($cadastraritem))
{
?>

		<div align="center">
        <hr /><strong> Itens Financiáveis </strong> <hr />
        </div>

	<br />
    
	<form name="cadastro_itens_financiaveis" method="post" action="" onSubmit="return validaForm()">
    <table>
        
        <br />
         <tr>
	        <td colspan="3"><strong>Cadastrar um Item: </strong><br /><br /></td>
        </tr>
        <tr>
            <td>Descrição do Item: </td>
            <td><input name="descricao" type="text" size="50"  maxlength="255"/> &nbsp;&nbsp;&nbsp; <input type="submit" name="cadastraritem" value="Cadastrar"/></td>
            
        </tr>
        
        <tr>
        	<td colspan="2">
            	
            		<br />---<br /><br /><strong>Lista de Itens já cadastrados:</strong>
				<table border="1" cellpadding="2" cellspacing="2">
                <tr>
                <td>Descrição</td>
                </tr>
                
                <?
$it = mysql_query("SELECT * FROM kxw_itens_financiaveis");
while ($item = mysql_fetch_array($it)) { 
	?>
    <tr>
    <td>
	<? 
		if($item['ITF_DESCRICAO']==NULL)
			echo "---";
		else
			echo htmlentities($item['ITF_DESCRICAO']); 
	?>
    </td>
    <td>
    	<a href="javascript:;" onclick="Excluir('<?=$item['ITF_ID']?>')">[excluir] </a>
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

$descricao = $_POST['descricao'];

$qr = mysql_query("INSERT INTO kxw_itens_financiaveis(`ITF_DESCRICAO`) VALUES( '$descricao' )") or die(mysql_error());
	if($qr == 1){
	?>
		<script>
			alert("Cadastro realizado com sucesso!");
			window.location.replace("cadastro_itens_financiaveis.php");
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