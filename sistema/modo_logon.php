<html>
<head>
<script>
	

		function abrejanela(linq)
		{
			window.open(linq, "cadastro_pesquisador", "height=1200, width = 1200, status=no, menubar=no, scrollbars=yes,location=no");
		}

		function carrega(linque) 
		{
			$('#ajax_div').load(linque);
		}
							  
</script>
<title>Sistema de Gestão de Editais - KAXINAWA</title>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="25%" bgcolor="#FFFF99"><a href="?pagina=home" >
      <div align="center">Principal</div></a></td>
      <td width="25%" bgcolor="#CCFF66"><a href="?pagina=suporte"><div align="center">Suporte</div></a></td>
      <td width="25%" bgcolor="#FFFF99"><a href="?pagina=manuais"><div align="center">Manuais</div></a></td>
      <td width="25%" bgcolor="#CCFF66"><a href="?pagina=logout"><div align="center">Sair</div></a></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="25%"><a href="?pagina=home" id=""><div align="center">
        <img src="imagens/principal.jpg" width="28" height="28" border="0" /></div></a></td>
      <td width="25%"><a href="?pagina=suporte"  ><div align="center">
        <img src="imagens/suporte2.jpg" width="30" height="30" border="0" /></div></a></td>
      <td width="25%"><a href="?pagina=manuais"><div align="center">
        <img src="imagens/manuais 3.jpg" width="32" height="32" border="0" /></div></a></td>
      <td width="25%">
        <a href="?pagina=logout"><div align="center"><img src="imagens/X.jpg" width="30" height="30" border="0"/></div></a>
      </td>
    </tr>
    <tr>
    <td align="right" colspan="4" >
    <?php 
		echo  htmlentities($_SESSION['NomeUsuario']); 
		echo " (" .$_SESSION['tipoUsuario']. ")" ;
	?>
      
    </td> 
    </tr>
</table>
</div>
<?php
if($_GET['logout']==1){
	unset($_SESSION['idUsuario']);
	unset($_SESSION['NomeUsuario']);
	unset($_SESSION['senhaUsuario']);
    unset($_SESSION['tipoUsuario']);
}

if($_GET['pagina']=="manuais" || $_GET['pagina']=="editais_disponiveis" || $_GET['pagina']=="logout"){
	include $_GET['pagina'].".php";
}elseif( !isset($_SESSION['idUsuario']) && !isset($_SESSION['NomeUsuario']) && !isset($_SESSION['senhaUsuario']) ){
	include "login.php";
}else{
	if(!$_GET['pagina']){
		$_GET['pagina'] = "editais_disponiveis";
		
		?>
        <br /><br />
    <table width="100%" align="center" border="0" >
    <tr>
    <td width="75%" id="ajax_div">
    <?php include "editais_disponiveis".".php"; ?>
    </td>
    <td width="25%" align="center" valign="top"  style="border-left:1px solid">
	
	<?php
	if ($_SESSION['tipoUsuario'] == "P")
		include "menu_pesquisador.php";
	else if ($_SESSION['tipoUsuario'] == "G")
	    include "menu_gestor.php";
	else if ($_SESSION['tipoUsuario'] == "A")
	    include "menu_admin.php";
	 ?>
    <br />
	
    </td>
    </tr>
    </table> 
		<?
		}
}
?>
</html>
</body>