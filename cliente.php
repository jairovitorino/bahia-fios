<?php
session_start();
$login = $_SESSION['login'];
$tipo_pessoa = @$_SESSION['tipo_pessoa'];
 $msg_sucesso = @$_SESSION['msg_sucesso'];
$msg_erro = @$_SESSION['msg_erro'];
 include "cabecalho/cabecalho.php";
 if ($login){
?>
<html>
<head>
<title>Etelnor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/MascaraValidacao.js"></script> 
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
</script>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<?php if (empty($tipo_pessoa)) {?>
<form name="form1" method="post" action="controller.php">
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
<form name="form1" method="post" action="controller.php">
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
     } else if ($msg_erro){
	   echo "<div align='left'>
   <img src='img/msg_vermelha.gif' width='20' height='20'><font color='#FF0000' size='2' face='Arial, Helvetica, sans-serif'> $msg_erro </font></div>";
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
    <tr> 
      <td width="22%" class="labelDireita">Nome:</td>
      <td width="78%" class="labelEsquerda"><input name="nm_cliente" id="nm_cliente" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita"> Raz&atilde;o Social:</td>
      <td class="labelEsquerda"><input name="nm_razao" type="text" size="50" maxlength="50"></td>
    </tr>
    <?php if ($tipo_pessoa == 1) {?>
    <tr> 
      <td class="labelDireita">CNPJ:</td>
      <td class="labelEsquerda"><input name="nu_cnpj_cpf" type="text" size="30" maxlength="14"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Nome do Contato:</td>
      <td class="labelEsquerda"><input name="nm_contato" type="text" size="50" maxlength="50"></td>
    </tr>
    <?php } else {?>
    <tr> 
      <td class="labelDireita">CPF:</td>
      <td class="labelEsquerda"><input name="nu_cnpj_cpf" type="text" onBlur="ValidarCPF(form1.nu_cnpj_cpf);" onKeyPress="MascaraCPF(form1.nu_cnpj_cpf);" size="30" maxlength="11"> 
      </td>
    </tr>
    <tr> 
      <td class="labelDireita">Data de Nascimento:</td>
      <td class="labelEsquerda"> 
        <?php
		require 'classes/calendario.php';	
		$calendario_campo = new calendario;
		$calendario_campo->nome_campo="dt_nascimento";
		$calendario_campo->value_campo=@$dt_nascimento;		
		$calendario_campo->criar_campo();
		$calendario_campo->criar_java_campo();
		 ?>
      </td>
    </tr>
    <?php } ?>
    <tr> 
      <td class="labelDireita">Inscri&ccedil;&atilde;o Estadual:</td>
      <td class="labelEsquerda"><input name="nu_inscricao" type="text" size="20" maxlength="20"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Telefone:</td>
      <td class="labelEsquerda"><input name="nu_tel" type="text" size="20" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Fax:</td>
      <td class="labelEsquerda"><input name="nu_fax" type="text" size="20" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Celular:</td>
      <td class="labelEsquerda"><input name="nu_celular" type="text" size="20" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">E-mail:</td>
      <td class="labelEsquerda"><input name="te_email" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Logradouro Ex. rua, av, etc:.</td>
      <td class="labelEsquerda"><input name="nm_logradouro" type="text" size="70" maxlength="100"></td>
    </tr>
    <tr>
      <td class="labelDireita">N&uacute;mero:</td>
      <td class="labelEsquerda"><input name="nu_logra" type="text" size="5" maxlength="5"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Bairro:</td>
      <td class="labelEsquerda"><input name="nm_bairro" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Cidade:</td>
      <td class="labelEsquerda"><input name="nm_cidade" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">CEP:</td>
      <td class="labelEsquerda"><input name="nu_cep" type="text" size="20" maxlength="8"></td>
    </tr>
    <tr> 
      <td class="labelDireita">UF:</td>
      <td class="labelEsquerda"><select name="nm_uf" id="nm_uf">
          <option value="0">-- Selecione -- >></option>
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
    <tr> 
      <td colspan="4" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><input type="hidden" name="inserirCliente"></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><input type="submit" name="grava" value="Gravar Cliente"> 
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
