<?
	unset($_SESSION['idUsuario']);
	unset($_SESSION['NomeUsuario']);
	unset($_SESSION['senhaUsuario']);
	unset($_SESSION['tipoUsuario'])
?>
    <script>
		alert("Você foi desconectado com segurança!");
		window.location.replace("index.php");
	</script>
