<?php
session_start();
$login = $_SESSION['login'];
$msg_sucesso = $_SESSION['msg_sucesso'];
$msg_erro = $_SESSION['msg_erro'];
$id_cor = $_SESSION['id_cor'];

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
	document.formulario.nm_produto.focus();
}
function cancelar(delUrl) { 
    document.location = delUrl; 
}
</script>
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">

<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="formulario" action="controller.php" method="post">
  <table width="85%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">COR</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
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
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td width="39%" class="labelEsquerda">&nbsp;</td>
      <td width="61%" class="labelEsquerda">&nbsp;</td>
    </tr>
    <?php
   require_once("conexao.php");
   $mysql = new Mysql();
   $mysql->conectar();
  $sql = mysql_query("SELECT * FROM cores WHERE id_cor = ".$id_cor." ");
  $row = mysql_num_rows($sql);
  for ( $i=0; $i < $row; $i++ ){
  $id_cor = mysql_result($sql, $i, "id_cor");
   $nm_cor = mysql_result($sql, $i, "nm_cor");
  $nm_cor1 = mysql_result($sql, $i, "nm_cor1");
   }
  ?>
    <tr> 
      <td class="labelDireita">Nome:</td>
      <td class="labelEsquerda"><input name="nm_cor" id="nm_cor" value="<?php echo $nm_cor;?>" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">&nbsp;</td>
      <td class="labelEsquerda"><input type="hidden" name="alterarCor"> <input type="hidden" name="id_cor" value="<?php echo $id_cor;?>"></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><input type="submit" name="grava" value="Alterar Cor"> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:cancelar('controller.php?cancelarOperacao=cancelarOperacao')" /></td>
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