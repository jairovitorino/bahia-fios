<?php
session_start();
$login = $_SESSION['login'];
$tipo_pessoa = $_SESSION['tipo_pessoa'];
$id_cliente = $_SESSION['id_cliente'];
$msg_sucesso = @$_SESSION['msg_sucesso'];
$teste = @$_SESSION['teste'];
 include "cabecalho/cabecalho.php";
 if ($login){
?>
<html>
<head>
<title>Bahia Fios Ltda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<script language="JavaScript">
function caixas(){
	document.getElementById('nm_cliente').focus();
}

function del(delUrl) {
  if (confirm("Excluir o registro?")) {
    document.location = delUrl;
  }
}
function cancelar(delUrl) { 
    document.location = delUrl; 
}
/*
window.onload = function()
{
	alert("Wellcome");
}
*/  
function up(lstr){ // converte minusculas em maiusculas
var str=lstr.value; //obtem o valor
lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
}
</script>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<?php if (empty($tipo_pessoa)) {?>
<form name="formulario" method="post" action="controller.php">
  <table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="4" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro">CLIENTE</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelEsquerda">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelEsquerda">Informe o tipo:</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td width="22%" class="labelDireita">&nbsp;</td>
      <td width="13%" class="labelDireita">Pessoa Jur&iacute;dica</td>
      <td width="4%" class="labelEsquerda"><input type="radio" name="tipo_pessoa" value="1" checked></td>
      <td width="61%" class="labelEsquerda">Pessoa F&iacute;sica 
        <input type="radio" name="tipo_pessoa" value="2"></td>
    </tr>
    <tr>
      <td colspan="4" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><input type="hidden" name="infoTipoCliente"></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><input type="submit" name="confirma" value="Confirmar"></td>
    </tr>
  </table>

</form>
<?php } else { ?>
<form name="formulario" method="post" action="controller.php">
  <table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">CLIENTE</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"> 
        <?php
  if ($msg_sucesso){
   echo "<div align='left'>
   <img src='img/msg_verde.gif' width='20' height='20'><font color='#003300' size='2' face='Arial, Helvetica, sans-serif'> $msg_sucesso </font></div>";
   }
   ?>
      </td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><strong>Dados do Cliente</strong></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <?php
	require_once("conexao.php");
	$mysql = new Mysql();
	$mysql->conectar();
	$sql = mysql_query("SELECT * FROM clientes WHERE id_cliente = ".$id_cliente." ");
	$row = mysql_num_rows($sql);
	for ( $i=0; $i < $row; $i++ ){
	$nm_cliente  = mysql_result($sql, $i, "nm_cliente");
	$nm_razao  = mysql_result($sql, $i, "nm_razao");
	$nu_cnpj_cpf  = mysql_result($sql, $i, "nu_cnpj_cpf");
	$nm_contato  = mysql_result($sql, $i, "nm_contato");
	$nu_inscricao  = mysql_result($sql, $i, "nu_inscricao");
	$nu_telefone  = mysql_result($sql, $i, "nu_telefone");
	$nu_celular  = mysql_result($sql, $i, "nu_celular");
	$nu_fax  = mysql_result($sql, $i, "nu_fax");
	$te_email  = mysql_result($sql, $i, "te_email");
	$nm_logradouro  = mysql_result($sql, $i, "nm_logradouro");
	$nu_logra  = mysql_result($sql, $i, "nu_logra");
	$nm_bairro  = mysql_result($sql, $i, "nm_bairro");
	$nm_cidade  = mysql_result($sql, $i, "nm_cidade");
	$nu_cep  = mysql_result($sql, $i, "nu_cep");
	$nm_uf  = mysql_result($sql, $i, "nm_uf");
	$dt_nascimento  = mysql_result($sql, $i, "dt_nascimento");
	$dt_nascimento = substr($dt_nascimento,8,2)."/".substr($dt_nascimento,5,2)."/".substr($dt_nascimento,0,4);
	?>
    <tr> 
      <td width="22%" class="labelDireita">Nome:</td>
      <td width="78%" class="labelEsquerda"><input name="nm_cliente" value="<?php echo $nm_cliente;?>" onkeyup="up(this)" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Raz&atilde;o Social:</td>
      <td class="labelEsquerda"><input name="nm_razao" value="<?php echo $nm_razao;?>" type="text" size="50" maxlength="50"></td>
    </tr>
    <?php if ($tipo_pessoa == 1) {?>
    <tr> 
      <td class="labelDireita">CPF/CNPJ:</td>
      <td class="labelEsquerda"><input name="nu_cnpj_cpf" value="<?php echo $nu_cnpj_cpf;?>" type="text" size="30" maxlength="14"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Nome do Contato:</td>
      <td class="labelEsquerda"><input name="nm_contato" value="<?php echo $nm_contato;?>" type="text" size="50" maxlength="50"></td>
    </tr>
    <?php } else {?>
    <tr> 
      <td class="labelDireita">CPF</td>
      <td class="labelEsquerda"><input name="nu_cnpj_cpf" value="<?php echo $nu_cnpj_cpf;?>" type="text" size="30" maxlength="14"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Data de Nascimento</td>
      <td class="labelEsquerda">
        <?php
		require 'classes/calendario.php';	
		$calendario_campo = new calendario;
		$calendario_campo->nome_campo="dt_nascimento";
		$calendario_campo->value_campo=$dt_nascimento;		
		$calendario_campo->criar_campo();
		
	 $calendario_campo->criar_java_campo();
?>
		
      </td>
    </tr>
    <?php } ?>
    <tr> 
      <td class="labelDireita">Inscri&ccedil;&atilde;o Estadual</td>
      <td class="labelEsquerda"><input name="nu_inscricao" value="<?php echo $nu_inscricao;?>" type="text" size="20" maxlength="20"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Telefone</td>
      <td class="labelEsquerda"><input name="nu_telefone" value="<?php echo $nu_telefone;?>" type="text" size="15" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Fax</td>
      <td class="labelEsquerda"><input name="nu_fax" value="<?php echo $nu_fax;?>" type="text" size="15" maxlength="50"></td>
    </tr>
    <tr>
      <td class="labelDireita">Celular:</td>
      <td class="labelEsquerda"><input name="nu_celular" value="<?php echo $nu_celular;?>" type="text" size="30" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">E-mail</td>
      <td class="labelEsquerda"><input name="te_email" value="<?php echo $te_email;?>" type="text" size="70" maxlength="70"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Logradouro Ex. rua, av, etc.</td>
      <td class="labelEsquerda"><input name="nm_logradouro" value="<?php echo $nm_logradouro;?>" type="text" size="70" maxlength="100"></td>
    </tr>
	 <tr>
      <td class="labelDireita">N&uacute;mero:</td>
      <td class="labelEsquerda"><input name="nu_logra" value="<?php echo $nu_logra;?>" type="text" size="5" maxlength="5"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Bairro</td>
      <td class="labelEsquerda"><input name="nm_bairro" value="<?php echo $nm_bairro;?>" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Cidade</td>
      <td class="labelEsquerda"><input name="nm_cidade" value="<?php echo $nm_cidade;?>" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">CEP</td>
      <td class="labelEsquerda"><input name="nu_cep" value="<?php echo $nu_cep;?>" type="text" size="20" maxlength="8"></td>
    </tr>
    <tr> 
      <td class="labelDireita">UF</td>
      <td class="labelEsquerda"><select name="nm_uf" id="nm_uf">
          <option value="<?php echo $nm_uf;?>"><?php echo $nm_uf;?></option>
          <option value="AC">AC</option>
          <option value="AL">AL</option>
          <option value="AM">AM</option>
          <option value="AP">AP</option>
          <option value="BA">BA</option>
          <option value="CE">CE</option>
          <option value="DF">DF</option>
          <option value="ES">ES</option>
          <option value="GO">GO</option>
          <option value="MA">MA</option>
          <option value="MG">MG</option>
          <option value="MS">MS</option>
          <option value="MT">MT</option>
          <option value="PA">PA</option>
          <option value="PB">PB</option>
          <option value="PE">PE</option>
          <option value="PI">PI</option>
          <option value="PR">PR</option>
          <option value="RJ">RJ</option>
          <option value="RN">RN</option>
          <option value="RO">RO</option>
          <option value="RR">RR</option>
          <option value="RS">RS</option>
          <option value="SC">SC</option>
          <option value="SE">SE</option>
          <option value="SP">SP</option>
          <option value="TO">TO</option>
        </select></td>
    </tr>
    <?php }?>
    <tr> 
      <td colspan="4" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><input type="hidden" name="alterarCliente"> 
        <input type="hidden" name="tipo_pessoa" value="<?php echo $tipo_pessoa;?>"> 
        <input type="hidden" name="id_cliente" value="<?php echo $id_cliente;?>"></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><input type="submit" name="grava" value="Alterar Cliente"> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:cancelar('controller.php?cancelarOperacao=cancelarOperacao')" /></td>
    </tr>
  </table>
</form>
<?php }?>
</body>

<?php
} else {


 include "rodape/rodape.php";
 }
 ?>
</html>
