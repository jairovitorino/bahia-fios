<?php
session_start();
$login = $_SESSION['login'];
 include "cabecalho/cabecalho.php";

 if ($login){
?>
<html>
<head>
<title>Bahia Fios Ltda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function caixas(){
	//document.getElementById('dt_ini').focus();
	document.formulario.nm_cor.focus();
}

</script>
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">

<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="formulario" method="post" action="controller.php">
  <table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">PARAMETROS</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><hr> </td>
    </tr>
    <tr> 
      <td width="38%" class="labelDireita">Nome da Cor:</td>
      <td class="labelEsquerda"><input name="nm_cor" id="nm_cor" type="text" size="50" maxlength="50"> </td>
    </tr>
   <tr> 
      <td width="38%" class="labelDireita">&nbsp;</td>
      <td class="labelEsquerda">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><input type="hidden" name="pesquisarCor"></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><input type="submit" name="pesquisa" value="Pesquisar"> 
      </td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
  </table>
</form>
</body>

<?php
} else {
 include "rodape/rodape.php";
 }
 ?>
</html>
