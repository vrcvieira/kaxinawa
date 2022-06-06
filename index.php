<?php session_start();
 include "conecta.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" type="text/javascript" src="jquery.js"> </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Gestão de Editais - KAXINAWA</title>
<style>
	text{
		font-family:Verdana, Geneva, sans-serif;
	}
	body{
		font-family:Verdana, Geneva, sans-serif;
	}
</style>
</head>

<body>
<div id="topo">
<table width="100%" height="30" border="0" cellPadding="0" cellSpacing="0" bgColor="#ffcc00">
	<tbody>
    	<tr>
        	<td width="11%">
            	<div align="center"><img src="img_ministerio_educacao.gif" width="109" height="20" /></div>
             </td>
             <td width="81%">
             	<table width="91%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td width="51%" bgcolor="#FFCC00" scope="col" align="center"><strong>Sistema de Gestão de Editais<br />KAXINAWA</strong></td>
                    </tr>
                 </table>
              </td>
              <td width="8%">
              		<div align="center"><img src="selo_brasil.gif" width="74" height="21" /></div>
              </td>
          </tr>
	</tbody>
<? 
if ($_SESSION['tipoUsuario'] !=NULL) 
include "modo_logon.php";
else
include "modo_logout.php";
?>

<?php
if($_GET['logout']==1){
	unset($_SESSION['idUsuario']);
	unset($_SESSION['NomeUsuario']);
	unset($_SESSION['senhaUsuario']);
	
}

?>

<div id="rodape">
    <hr />
    <p align="center" class="style8">Contato: Luiz.matos@ufac.br</p>
</div>
</body>
</html>