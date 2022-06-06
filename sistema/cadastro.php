<?php
session_start();
include ("conecta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cadastro de Pesquisador</title>
    <script language="JavaScript">


function chkMail(varMail){
		
var t = varMail;

var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
var Digit = '1234567890';
var Symbol='_-';
var check = '@.' + Alpha + Digit + Symbol;

for (i=0; i < t.length; i++)
if(check.indexOf(t.substring(i,i+1)) < 0) 	{
return false;
}

var check = '@';
var a = 0;
for (i=0; i < t.length; i++)
if(check.indexOf(t.substring(i,i+1)) >= 0) 	a = i;

var check = '.';
var b = 0;	
for (i=a+1; i < t.length; i++)
if(check.indexOf(t.substring(i,i+1)) >= 0) 	b = i;

if (a != 0 && b != 0 && b != t.length-1 ) {
return true;
} else {
return false;
}
}


function validaForm(){

d = document.cadastro;
//validar nome
if (d.nome.value == ""){
alert("O campo nome deve ser preenchido!");
d.nome.focus();
d.enviarcadastro=null;
return false;
}

//validar nascimento
if ((d.dia.value == 0) || (d.mes.value == 0) || (d.ano.value == 0)){
alert("O campo data de nascimento deve ser preenchido!");
d.nome.focus();
d.enviarcadastro=null;
return false;
}

//validar cpf
if (d.cpf.value == ""){
alert("O campo CPF deve ser preenchido!");
d.cpf.focus();
d.enviarcadastro=null;
return false;
}

//verificar se só existem números no cpf
if (isNaN(d.cpf.value)){
alert("O campo CPF deve conter apenas numeros!");
d.cpf.focus();
d.enviarcadastro=null;
return false;
}


//validar sexo
if (!d.sexo[0].checked && !d.sexo[1].checked) {
alert("Escolha o sexo!");
d.enviarcadastro=null;
return false;
}

//validar instituição
if (d.instituicao.value == ""){
alert("O campo Instutuição deve ser preenchido!");
d.instituicao.focus();
d.enviarcadastro=null;
return false;
}

//validar tipo institucional
if (d.tipo_institucional.value == ""){
alert("O campo Tipo Institucional deve ser preenchido!");
d.tipo_institucional.focus();
d.enviarcadastro=null;
return false;
}
			
//validar email
if (d.email.value == ""){
alert("O campo E-mail deve ser preenchido!");
d.email.focus();
d.enviarcadastro=null;
return false;
}

//vendo se o e-mail é válido
if(!chkMail(d.email.value)){
alert('email invalido');
d.enviarcadastro=null;
return false;
}

//validar telefone
if (d.celular.value == ""){
alert("O campo Telefone Celular deve ser preenchido!");
d.celular.focus();
d.enviarcadastro=null;
return false;
}

//validar CEP
if (d.cep.value == ""){
alert("O campo CEP deve ser preenchido!");
d.cep.focus();
d.enviarcadastro=null;
return false;
}

//validar logradouro
if (d.logradouro.value == ""){
	alert("O campo logradouro deve ser preenchido!");
	d.logradouro.focus();
	d.enviarcadastro=null;
	return false;
}

//validar numero do endereço
if(d.endereco_numero.value == ""){
	alert("O campo número do endereço deve ser preenchido!");
	d.endereco_numero.focus();
	d.enviarcadastro=null;
	return false;
}

//verificar se o número do endereço só contém números
if (isNaN(d.endereco_numero.value)){
alert("O campo número do endereço deve conter apenas números!");
d.endereco_numero.focus();
d.enviarcadastro=null;
return false;
}

//validar bairro
if(d.bairro.value == ""){
	alert("O campo bairro deve ser preenchido!");
	d.bairro.focus();
	d.enviarcadastro=null;
	return false;
}

//validar estado
if(d.estado.value == 0){
	alert("Selecione um Estado!");
	d.estado.focus();
	d.enviarcadastro=null;
	return false;
}

//validar cidade
if(d.cidade.value == 0){
	alert("Selecione um Cidade!");
	d.cidade.focus();
	d.enviarcadastro=null;
	return false;
}

//validar senha
if (d.senha.value == ""){
alert("O campo " + d.senha.name + " deve ser preenchido!");
d.senha.focus();
d.enviarcadastro=null;
return false;
}

//validar senha
if (d.senha.value != d.confirmarsenha.value) {
alert("Senhas não conferem!")
d.senha.value=null;
d.confirmarsenha.value=null;
d.senha.focus();
d.enviarcadastro=null;
return false;
}

return true;
}








function create_opcao(cidade) { 
	var new_opcao = document.createElement("option"); 
	var texto = document.createTextNode(cidade.childNodes[0].data); 
	new_opcao.setAttribute("value",cidade.getAttribute("id")); 
	new_opcao.appendChild(texto); //Adiciona o texto a OPTION.
	return new_opcao; // Retorna a nova OPTION.
}
window.onload = function(){
	document.cadastro.estado.onchange = function(){
		document.cadastro.cidade.innerHTML = '';
		HttpReq = new XMLHttpRequest();
		HttpReq.onreadystatechange = function(){
			var result = HttpReq.responseXML;
			var cidades = result.getElementsByTagName("nome");
			for (var i = 0; i < cidades.length; i++) {
				new_opcao = create_opcao(cidades[i]);
				document.getElementById('cidade').appendChild(new_opcao);
			}
		}
		HttpReq.open("GET", 'cidades.php?uf='+document.cadastro.estado.value, true);
		HttpReq.send(null);
	}	
}
</script>
    <script type="text/javascript" src="01.js"></script>
  </head>
  <body>
    <?
if (!isset($enviarcadastro))
{
?>
    <TD width="100%"><form name="cadastro" method="post" action="" onSubmit="return validaForm()">
        <table width="100%" height="796" border="0" cellpadding="2" cellspacing="2" rules="cols">
          <tr>
            <td width="70%" height="792" valign="top"><br />
              <br />
              <p align="center"><b><font size="+3">Cadastro de Pesquisador</font></b></p>
              </font></b>
              </p>
              <table width="90%" align="center" cellpadding="0" cellspacing="3">
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><b>Dados de Identifica&ccedil;&atilde;o</b></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="23%">Nome Completo *</td>
                  <td width="75%">&nbsp;&nbsp;
                    <input name="nome" size="70" maxlength="140" type="text" <?php if($_POST['nome']): ?> value="<?php echo $_POST['nome']; ?>" <?php endif; ?> /></td>
                </tr>
                <tr>
                  <td>Data de Nascimento *</td>
                  <td>&nbsp;&nbsp;
                    <select name="dia">
                      <option value="0" selected="selected">dia</option>
                      <option  value="01">01</option>
                      <option  value="02">02</option>
                      <option  value="03">03</option>
                      <option  value="04">04</option>
                      <option  value="05">05</option>
                      <option  value="06">06</option>
                      <option  value="07">07</option>
                      <option  value="08">08</option>
                      <option  value="09">09</option>
                      <option  value="10">10</option>
                      <option  value="11">11</option>
                      <option  value="12">12</option>
                      <option  value="13">13</option>
                      <option  value="14">14</option>
                      <option  value="15">15</option>
                      <option  value="16">16</option>
                      <option  value="17">17</option>
                      <option  value="18">18</option>
                      <option  value="19">19</option>
                      <option  value="20">20</option>
                      <option  value="21">21</option>
                      <option  value="22">22</option>
                      <option  value="23">23</option>
                      <option  value="24">24</option>
                      <option  value="25">25</option>
                      <option  value="26">26</option>
                      <option  value="27">27</option>
                      <option  value="28">28</option>
                      <option  value="29">29</option>
                      <option  value="30">30</option>
                      <option  value="31">31</option>
                    </select>
                    &nbsp;
                    <select name="mes">
                      <option  value="0" selected="selected">mês</option>
                      <option  value="01">Janeiro</option>
                      <option  value="02">Fevereiro</option>
                      <option  value="03">Março</option>
                      <option  value="04">Abril</option>
                      <option  value="05">Maio</option>
                      <option  value="06">Junho</option>
                      <option  value="07">Julho</option>
                      <option  value="08">Agosto</option>
                      <option  value="09">Setembro</option>
                      <option  value="10">Outubro</option>
                      <option  value="11">Novembro</option>
                      <option  value="12">Dezembro</option>
                    </select>
                    &nbsp;
                    <select name="ano">
                      <option  value="0">ano</option>
                      <option  value="2002">2002</option>
                      <option  value="2001">2001</option>
                      <option  value="2000">2000</option>
                      <option  value="1999">1999</option>
                      <option  value="1998">1998</option>
                      <option  value="1997">1997</option>
                      <option  value="1996">1996</option>
                      <option  value="1995">1995</option>
                      <option  value="1994">1994</option>
                      <option  value="1993">1993</option>
                      <option  value="1992">1992</option>
                      <option  value="1991">1991</option>
                      <option  value="1990">1990</option>
                      <option  value="1989">1989</option>
                      <option  value="1988">1988</option>
                      <option  value="1987">1987</option>
                      <option  value="1986">1986</option>
                      <option  value="1985">1985</option>
                      <option  value="1984">1984</option>
                      <option  value="1983">1983</option>
                      <option  value="1982">1982</option>
                      <option  value="1981">1981</option>
                      <option  value="1980">1980</option>
                      <option  value="1979">1979</option>
                      <option  value="1978">1978</option>
                      <option  value="1977">1977</option>
                      <option  value="1976">1976</option>
                      <option  value="1975">1975</option>
                      <option  value="1974">1974</option>
                      <option  value="1973">1973</option>
                      <option  value="1972">1972</option>
                      <option  value="1971">1971</option>
                      <option  value="1970">1970</option>
                      <option  value="1969">1969</option>
                      <option  value="1968">1968</option>
                      <option  value="1967">1967</option>
                      <option  value="1966">1966</option>
                      <option  value="1965">1965</option>
                      <option  value="1964">1964</option>
                      <option  value="1963">1963</option>
                      <option  value="1962">1962</option>
                      <option  value="1961">1961</option>
                      <option  value="1960">1960</option>
                      <option  value="1959">1959</option>
                      <option  value="1958">1958</option>
                      <option  value="1957">1957</option>
                      <option  value="1956">1956</option>
                      <option  value="1955">1955</option>
                      <option  value="1954">1954</option>
                      <option  value="1953">1953</option>
                      <option  value="1952">1952</option>
                      <option  value="1951">1951</option>
                      <option  value="1950">1950</option>
                      <option  value="1949">1949</option>
                      <option  value="1948">1948</option>
                      <option  value="1947">1947</option>
                      <option  value="1946">1946</option>
                      <option  value="1945">1945</option>
                      <option  value="1944">1944</option>
                      <option  value="1943">1943</option>
                      <option  value="1942">1942</option>
                      <option  value="1941">1941</option>
                      <option  value="1940">1940</option>
                      <option  value="1939">1939</option>
                      <option  value="1938">1938</option>
                      <option  value="1937">1937</option>
                      <option  value="1936">1936</option>
                      <option  value="1935">1935</option>
                      <option  value="1934">1934</option>
                      <option  value="1933">1933</option>
                      <option  value="1932">1932</option>
                      <option  value="1931">1931</option>
                      <option  value="1930">1930</option>
                      <option  value="1929">1929</option>
                      <option  value="1928">1928</option>
                      <option  value="1927">1927</option>
                      <option  value="1926">1926</option>
                      <option  value="1925">1925</option>
                      <option  value="1924">1924</option>
                      <option  value="1923">1923</option>
                      <option  value="1922">1922</option>
                      <option  value="1921">1921</option>
                      <option  value="1920">1920</option>
                      <option  value="1919">1919</option>
                      <option  value="1918">1918</option>
                      <option  value="1917">1917</option>
                      <option  value="1916">1916</option>
                      <option  value="1915">1915</option>
                      <option  value="1914">1914</option>
                      <option  value="1913">1913</option>
                      <option  value="1912">1912</option>
                    </select></td>
                </tr>
                <tr>
                  <td> RG </td>
                  <td>&nbsp;&nbsp;
                    <input name="rg" type="text"  maxlength="10"/></td>
                </tr>
                <tr>
                  <td nowrap="nowrap"> Órgão Emissor/UF </td>
                  <td>&nbsp;&nbsp;
                    <input name="rg_orgao_emissor" type="text" maxlength="10"/></td>
                </tr>
                <tr>
                  <td> CPF *<br />
                    <font size="2">(Somente números) </font></td>
                  <td>&nbsp;&nbsp;
                    <input name="cpf" type="text" maxlength="11" /></td>
                </tr>
                <tr>
                  <td> Sexo *</td>
                  <td>&nbsp;&nbsp;
                    <input type="radio"  value="M" name="sexo"/>
                    Masculino&nbsp;&nbsp;
                    <input type="radio" value="F" name="sexo" />
                    Feminino </td>
                </tr>
                <tr>
                  <td > Institui&ccedil;&atilde;o *</td>
                  <td>&nbsp;&nbsp;
                    <select name="instituicao">
                      <option value="" selected="selected">:: Selecione >></option>
                      <?  $instituicao = mysql_query("SELECT * FROM kxw_instituicao"); 
	while ($ins = mysql_fetch_array($instituicao)) {
?>
                      <option value="<?=$ins['INS_ID'] ?>" >
                      <?=$ins['INS_SIGLA']?>
                      -
                      <?=$ins['INS_DESCRICAO']?>
                      </option>
                      <? } ?>
                    </select></td>
                </tr>
                <tr>
                  <td nowrap="nowrap"> Tipo Institucional * </td>
                  <td>&nbsp;&nbsp;
                    <select name="tipo_institucional">
                      <option value="" selected="selected">:: Selecione >></option>
                      <option value="1" >Discente</option>
                      <option value="2" >Docente</option>
                      <option value="3" >Servidor</option>
                      <option value="4" >Outro</option>
                    </select></td>
                </tr>
                <tr>
                  <td> Titula&ccedil;&atilde;o </td>
                  <td>&nbsp;&nbsp;
                    <select name="titulacao">
                      <option value="" selected="selected">:: Selecione >></option>
                      <option value="1">Graduando</option>
                      <option value="2">Graduado</option>
                      <option value="3">Especialista</option>
                      <option value="4">Mestre</option>
                      <option value="5">Doutor</option>
                      <option value="6">Outro</option>
                    </select></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><b> Informações para Contato</b></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td> E-mail *</td>
                  <td>&nbsp;&nbsp;
                    <input name="email" size="50" maxlength="100" type="text"/></td>
                </tr>
                <tr>
                  <td> Telefone Celular *</td>
                  <td>&nbsp;&nbsp;
                    <input name="celular" type="text" maxlength="13"/>
                    &nbsp;&nbsp;Ex: (68) 12345678</td>
                </tr>
                <tr>
                  <td> Telefone Comercial </td>
                  <td>&nbsp;&nbsp;
                    <input name="tel_comercial" type="text" maxlength="13"/></td>
                </tr>
                <tr>
                  <td > Telefone Residencial </td>
                  <td nowrap="nowrap">&nbsp;&nbsp;
                    <input name="tel_residencial" type="text" maxlength="13"/>
                    &nbsp;&nbsp;</td>
                </tr>
                <tr>
                  <td >CEP *</td>
                  <td>&nbsp;&nbsp;
                    <input name="cep" type="text" maxlength="9" />
                    &nbsp;&nbsp; Ex: 69900-000 </td>
                </tr>
                <tr>
                  <td > Logradouro * &nbsp;<br />
                    <font size="2">(Rua/Av./Trav./Conj./Res./Est.) </font></td>
                  <td>&nbsp;&nbsp;
                    <input size="70" name="logradouro" type="text" maxlength="140"/></td>
                </tr>
                <tr>
                  <td > Número *</td>
                  <td>&nbsp;&nbsp;
                    <input name="endereco_numero" type="text" maxlength="6"/></td>
                </tr>
                <tr>
                  <td >Complemento</td>
                  <td>&nbsp;&nbsp;
                    <input name="endereco_complemento" size="50" type="text" maxlength="140"/></td>
                </tr>
                <tr>
                  <td >Bairro *</td>
                  <td>&nbsp;&nbsp;
                    <input size="50" name="bairro" type="text" maxlength="140"/></td>
                </tr>
                <tr>
                  <td> Estado *</td>
                  <td>&nbsp;&nbsp;
                    <select name="estado">
                      <option value="0" selected="selected">:: Selecione >></option>
                      <?  $estadophp = mysql_query("SELECT * FROM kxw_estado"); 
	while ($est = mysql_fetch_array($estadophp)) {
?>
                      <option value="<?=$est['EST_UF'] ?>" >
                      <?=$est['EST_UF']?>
                      </option>
                      <? } ?>
                    </select></td>
                </tr>
                <tr>
                  <td> Cidade *</td>
                  <td>&nbsp;&nbsp;
                    <select name="cidade" id="cidade">
                      <option value="0" selected="selected">:: Selecione Um Estado >></option>
                    </select></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><b> Acesso KAXINAWA</b></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td> Senha *</td>
                  <td>&nbsp;&nbsp;
                    <input type="password" name="senha" maxlength="8" /></td>
                </tr>
                <tr>
                  <td> Confirmar senha *</td>
                  <td>&nbsp;&nbsp;
                    <input type="password" name="confirmarsenha" maxlength="8" /></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><font size="3">Os campos <b>CPF</b> e <b>Senha</b> ser&atilde;o utilizados no acesso &agrave; &aacute;rea restrita do sistema.</font></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;" colspan="2" align="center"> Os campos marcados com * s&atilde;o obrigat&oacute;rios. </td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align: center">&nbsp;&nbsp;
                    <input type="submit" name="enviarcadastro" value="Enviar Cadastro"/>
                    &nbsp;&nbsp; </td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form>
      <?
}
else {
$nome = htmlentities($_POST['nome']);
$cep = $_POST['cep'];
$_SESSION['cep'] = $cep;
$dia = $_POST['dia']; 
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$nascimento = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
$rg = $_POST['rg'];
$rg_orgao_emissor = $_POST['rg_orgao_emissor'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$tipo_institucional = $_POST['tipo_institucional'];
$titutalacao = $_POST['titulacao'];
$email = $_POST['email'];
$tel_residencial = $_POST['tel_residencial'];
$celular = $_POST['celular'];
$tel_comercial = $_POST['tel_comercial'];
$logradouro = htmlentities($_POST['logradouro']);
$endereco_numero = $_POST['endereco_numero'];
$endereco_complemento = htmlentities($_POST['endereco_complemento']);
$bairro = htmlentities($_POST['bairro']);
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$instituicao = $_POST['instituicao'];
$centro = $_POST['centro'];
$curso = $_POST['curso'];
$banco = $_POST['banco'];
$agencia = $_POST['agencia'];
$conta = $_POST['conta'];
$senha = htmlentities($_POST['senha']);
$confirmarsenha = htmlentities($_POST['confirmarsenha']);

$qr = mysql_query("INSERT INTO kxw_usuario(`USU_CPF`, `USU_RG`, `USU_RG_ORGAO_EMISSOR`, `USU_SENHA`, `USU_NOME`, `USU_NASCIMENTO`, `USU_INS_ID`, `USU_TIN_ID`, `USU_EMAIL`, `USU_SEXO`, `USU_TITULACAO`, `USU_LOGRADOURO`, `USU_NUMERO`, `USU_COMPLEMENTO`, `USU_BAIRRO`, `USU_ESTADO`, `USU_CIDADE`, `USU_CEP`, `USU_TELEFONE_RESIDENCIAL`, `USU_TELEFONE_CELULAR`, `USU_TELEFONE_COMERCIAL`, `USU_TIPO`) VALUES( ('".mysql_real_escape_string($cpf)."'),  ('$rg'), ('$rg_orgao_emissor'), '".hash("md5", $senha)."', ('$nome'), ('$nascimento'), ('$instituicao'), ('$tipo_institucional'), ('$email'), ('$sexo'), ('$titulacao'), ('$logradouro'), ('$endereco_numero'), ('$endereco_complemento'), ('$bairro'), ('$estado'), ('$cidade'), ('$cep'), ('$tel_residencial'), ('$celular'), ('$tel_comercial'), ('P')) ") or die(mysql_error());
	if($qr == 1){
	?>
      <script>
			alert("Cadastro realizado com sucesso!");
			window.location.replace("index.php");
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
