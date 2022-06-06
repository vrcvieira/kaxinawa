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

d = document.cadastro_requisitos_proponente;
//validar descricao
if (d.descricao.value == ""){
alert("O campo descrição deve ser preenchido!");
d.descricao.focus();
d.cadastrarrequisito=null;
return false;
}

return true;

}

function Excluir(id)
		{
			if(confirm('Deseja excluir esse Requisito?'))
			{
				$.post("excluir_requisitos_proponente.php", { id:id },
				function(){
					carrega('cadastro_requisitos_proponente.php');
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
if (!isset($cadastrarrequisito))
{
?>

		<div align="center">
        <hr /><strong> Requisitos do Proponente </strong> <hr />
        </div>

	<br />
    
	<form name="cadastro_requisitos_proponente" method="post" action="" onSubmit="return validaForm()">
    <table>
        
        <br />
         <tr>
	        <td colspan="3"><strong>Cadastrar um Requisito: </strong><br /><br /></td>
        </tr>
        <tr>
            <td>Descrição do Requisito: </td>
            <td><input name="descricao" type="text" size="50"  maxlength="255"/> &nbsp;&nbsp;&nbsp; <input type="submit" name="cadastrarrequisito" value="Cadastrar"/></td>
            
        </tr>
        
        <tr>
        	<td colspan="2">
            	
            		<br />---<br /><br /><strong>Lista de Requisitos já cadastrados:</strong>
				<table border="1" cellpadding="2" cellspacing="2">
                <tr>
                <td>Descrição</td>
                </tr>
                
                <?
$rq = mysql_query("SELECT * FROM kxw_requisitos_proponente");
while ($requisito = mysql_fetch_array($rq)) { 
	?>
    <tr>
    <td>
	<? 
		if($requisito['RPR_DESCRICAO']==NULL)
			echo "---";
		else
			echo htmlentities($requisito['RPR_DESCRICAO']); 
	?>
    </td>
    <td>
    	<a href="javascript:;" onclick="Excluir('<?=$requisito['RPR_ID']?>')">[excluir] </a>
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

$qr = mysql_query("INSERT INTO kxw_requisitos_proponente(`RPR_DESCRICAO`) VALUES( '$descricao' )") or die(mysql_error());
	if($qr == 1){
	?>
		<script>
			alert("Cadastro realizado com sucesso!");
			window.location.replace("cadastro_requisitos_proponente.php");
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