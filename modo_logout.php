  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" bgcolor="#FFFF99"><a href="?pagina=listar_edital"><div align="center"><strong>Principal</div></a></td>
        <td width="20%" bgcolor="#CCFF66"><a href="?pagina=suporte"><div align="center"><strong>Suporte</div></a></td>
        <td width="20%" bgcolor="#FFFF99"><a href="?pagina=manuais"><div align="center"><strong>Manuais</div></a></td>
        <td width="20%" bgcolor="#CCFF66"><a href="?pagina=cadastro"><div align="center"><strong>Cadastre-se</div></a></td>
      </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%"><a href="?pagina=oquee"><div align="center">
          <img src="imagens/principal.jpg" width="28" height="28" border="0" /></div></a></td>
        <td width="25%"><a href="?pagina=suporte"><div align="center">
          <img src="imagens/suporte2.jpg" width="30" height="30" border="0" /></div></a></td>
        <td width="25%"><a href="?pagina=manuais"><div align="center">
          <img src="imagens/manuais 3.jpg" width="32" height="32" border="0" /></div></a></td>
        <td width="25%">
          <a href="?pagina=cadastro"><div align="center"><img src="imagens/cadastro-2.jpg" width="30" height="30" border="0"/></div></a>
        </td>
      </tr>
  </table>
  </div>
  <div id="corpo">
  <?php
  
  if($_GET['pagina']=="cadastro" || $_GET['pagina']=="manuais" || $_GET['pagina']=="suporte" || $_GET['pagina']=="login"){
      include $_GET['pagina'].".php";
  }elseif( !isset($_SESSION['idUsuario']) && !isset($_SESSION['NomeUsuario']) && !isset($_SESSION['senhaUsuario']) ){
      ?>
      <br /><br />
      <table align="center" border="0" >
      <tr>
      <td width="75%"><font size="-1">
      <?php include "editais_disponiveis.php"; ?>
      </td>
      <td width="20%" align="center" valign="top"  style="border-left:1px solid">
      <br /><br /><br /><br /><br />
      <div align="center"> 
      <?php include "login.php"; ?>
      </div>
      <br />
      <a href="?pagina=cadastro"><font size="-1">Clique aqui</a> se você ainda não é cadastrado.</font>
      <br />
      <a href=""><font size="-1">Clique aqui</a> se você esqueceu sua senha.</font>
      </td>
      </tr>
      </table>
      <?
  }
  ?>
  <br>