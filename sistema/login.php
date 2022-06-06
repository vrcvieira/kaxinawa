<?
session_start();
include "conecta.php";
if ($_POST['usuario'] && $_POST['senha']){
	$verificar = mysql_query("SELECT COUNT(USU_ID) FROM kxw_usuario WHERE USU_CPF='".mysql_real_escape_string($_POST['usuario'])."' AND USU_SENHA='".hash("md5", $_POST['senha'])."'") or die(mysql_error());
	$verificar = mysql_fetch_array($verificar);
	if($verificar[0]==0){
			?>
            <script>
				alert("Login ou senha inválidos, por favor, tente novamente!");
				window.location.replace("?");
			</script>
            <?php
	}else{
		$verificar = mysql_query("SELECT USU_ID, USU_NOME, USU_TIPO FROM kxw_usuario WHERE USU_CPF='".mysql_real_escape_string($_POST['usuario'])."' AND USU_SENHA='".hash("md5", $_POST['senha'])."'") or die(mysql_error());
		$verificar = mysql_fetch_array($verificar);
		$_SESSION['idUsuario'] = $verificar['USU_ID'];
		$_SESSION['NomeUsuario'] = $verificar['USU_NOME'];
		$_SESSION['senhaUsuario'] = hash("md5", $_POST['senha']);
		$_SESSION['tipoUsuario'] = $verificar['USU_TIPO'];
		
		?> <script> window.location.replace("?"); </script> <?
	}
}
?> 
<form name="formLogin" id="formLogin" method="post" action="">
  <table width="306" border="0" align="center">
      <tr align="center" bgcolor="#FFFF99">
        <td colspan="2" bgcolor="#FFFFFF">LOGIN</td>
      </tr>
      <tr bgcolor="#CCFF66">
        <td width="80" align="right" bgcolor="#FFFF99">CPF:</td>
        <td width="216" bgcolor="#FFFF99"><label>
          <input type="text" name="usuario" id="usuario" />
        </label></td>
      </tr>
      <tr bgcolor="#CCFF66">
        <td align="right" bgcolor="#CCFF66">Senha:</td>
        <td><label>
          <input type="password" name="senha" id="senha" />
        </label></td>
      </tr>
      <tr bgcolor="#FFFF99">
        
        <td colspan="2" align="center" bgcolor="#FFFFFF"><label> 
          <input type="submit" name="login" id="enviar" value="ENTRAR" />
        </label></td>
        </tr>      
    </table>
</form>
        