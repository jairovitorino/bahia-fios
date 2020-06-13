<?php include "cabecalho/cabecalho.php";?>
<html>
<head>
<title>asapcap</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript">
function caixas(){
	document.getElementById('nm_usuario').focus();
}
function valida_dados(nmform){
	if (nmform.nm_usuario.value == ""){
	alert("Preencher o campo NOME!");
	return false;
	nmform.document.getElementById('nm_usuario').focus();
	}
	}
function sair(detUrl){
document.location = detUrl;
}
/*
window.onload = function()
{
	alert("Wellcome");
}
*/  
</script>
<link rel="stylesheet" href="css/estilo.css" type="text/css">
<link rel="stylesheet" href="css/dataprev.css" type="text/css">
<link rel="SHORTCUT ICON" href="images/din.jpg"/>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="form1" method="post" action="controller.php" onSubmit="valida_dados(this)">
  <table width="49%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="4" class="labelCentro"> USU&Aacute;RIO</td>
    </tr>
    <tr> 
      <td colspan="4" class="labelDireita">&nbsp;</td>
    </tr>
    <?php @$msg = $_GET['msg'];?>
    <tr> 
      <td colspan="4" class="labelEsquerda"> 
        <?php
  if ($msg){
   echo "<div align='left'><img src='img/msg_vermelha.gif' width='20' height='20'><font color='#FF0000' size='2' face='Arial, Helvetica, sans-serif'> $msg </font></div>";
   }
   ?>
      </td>
    </tr>
    <tr> 
      <td colspan="4" class="labelDireita">&nbsp; </td>
    </tr>
    <tr> 
      <td width="21%" class="labelDireita">Nome</td>
      <td colspan="3" class="labelEsquerda"><input name="nm_usuario" type="text" id="nm_usuario" size="50" maxlength="50"> 
      </td>
    </tr>
    <tr> 
      <td class="labelDireita">Login</td>
      <td colspan="3" class="labelEsquerda"><input name="nm_login" type="text" id="nm_login" size="20" maxlength="20"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Senha</td>
      <td width="21%" class="labelEsquerda"><input name="nm_senha" type="password" id="nm_senha" size="30" maxlength="70"></td>
      <td width="21%" class="labelDireita">Repete Senha</td>
      <td width="37%" class="labelEsquerda"><input name="re_senha" type="password" id="re_senha" size="20" maxlength="8"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="3"> <input name="inserirUsuario" type="hidden" id="inserirUsuario"></td>
    </tr>
    <tr> 
      <td colspan="4" class="labelCentro"><input name="grava" type="submit" id="grava" value="Gravar"> 
        <input name="volta" type="button" id="volta" value="&lt;&lt; Voltar" onClick="javascript:history.go(-1)" /> 
      </td>
    </tr>
  </table>
</form>
</body>
<?php include "rodape/rodape.php";?>
</html>
