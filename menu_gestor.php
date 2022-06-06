<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
function menuint(botao, div)
{
$('#'+div).toggle();
if($('#'+div).is(':visible'))
{
$('#'+botao).val('-');
}else
{
$('#'+botao).val('+');
}
}
/*
*/								
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Gestão de Editais - KAXINAWA</title>
</head>
<body>
<div align="left" width="450">
  <hr />
  &nbsp;Opções do Sistema <br />
  <hr />
  &nbsp;&nbsp;&nbsp;
  <input type="button" id="botaomenu1"  value="+"  style="border:hidden; background:#FFC" onclick="menuint('botaomenu1', 'f_editais')" />
  Editais <br />
  <div id="f_editais" style="display:none"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="javascript:;" onclick="abrejanela('criar_edital.php')" >Criar Edital</a> <br />
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="javascript:;" onclick="carrega('editais_disponiveis.php')" >Editais Disponíveis</a><br />
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="javascript:;" onclick="carrega('editais_encerrados.php')" >Editais Encerrados</a><br />
  </div>
  &nbsp;&nbsp;&nbsp;
  <input type="button" id="botaomenu2"  value="+"  style="border:hidden; background:#FFC"/ onclick="menuint('botaomenu2','f_projetos')">
  Projetos <br />
  <div id="f_projetos" style="display:none" > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="javascript:;" onclick="carrega('projetos_submetidos.php')" >Projetos Submetidos</a> <br />
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="javascript:;"  >Projetos em Avaliação</a> <br />
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="javascript:;"  >Projetos Encerrados</a><br />
  </div>
</div>
</body>
</html>