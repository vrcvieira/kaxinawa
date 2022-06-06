 <?
    $host = "127.0.0.1";
	$user = "root";
	$password = "vertrigo";
	$bd = "kaxinawa";
	$con = mysql_connect($host, $user, $password) or die ("Falha na conex&atilde;o com o Banco de Dados");
	$selecionar_bd = mysql_select_db($bd, $con) or die ("Falha ao selecionar o Banco de Dados");
	
?>