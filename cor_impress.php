<?php
session_start();
$login = $_SESSION['login'];
$msg_sucesso = @$_SESSION['msg_sucesso'];
$msg_erro = @$_SESSION['msg_erro'];
$nm_cor = $_SESSION['nm_cor'];
$nu_codigo = $_SESSION['nu_codigo'];
 include "cabecalho/cabecalho.php";
 if ($login){
?>
<html>
<head>
<title>Etelnor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function move_i(what) { what.style.background='#CCCCCC'; }
function move_o(what) { what.style.background='#F5F5F5'; }
function del(delUrl) {
  if (confirm("Excluir o registro?")) {
    document.location = delUrl;
  }
}
function alt(delUrl) {
  if (confirm("Alterar o registro?")) {
    document.location = delUrl;
  }
}
</script>
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">

<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<table width="85%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td colspan="4" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="4" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="4" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="4" class="labelCentro">TODAS AS CORES</td>
  </tr>
  <tr> 
    <td colspan="4" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="4" class="labelEsquerda"> 
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
    <td colspan="4" class="labelCentro"><hr></td>
  </tr>
  <tr bgcolor="#FF0000"> 
    <td width="42%" height="19" class="labelEsquerda"><font color="#FFFFFF">Nome</font></td>
    <td width="43%" class="labelEsquerda">&nbsp;</td>
    <td width="7%" class="labelCentro"><font color="#FFFFFF">Excluir</font></td>
    <td width="8%" class="labelCentro"><font color="#FFFFFF">Alterar</font></td>
  </tr>
  <?php
  require_once("conexao.php");
		$mysql = new Mysql();
		$mysql->conectar();
		@$p = $_GET["p"];
		if(isset($p)) {
		$p = $p;
		} else {
		$p = 1;
		}
		$qnt = 30;
		$inicio = ($p*$qnt) - $qnt;
 if ( $nm_cor ) {
  $sql = mysql_query("SELECT * FROM cores WHERE nm_cor LIKE '%$nm_cor%' AND id_status = 3 ORDER BY nm_cor LIMIT $inicio, $qnt");
  $row = mysql_num_rows($sql);
  } else if ( $nu_codigo ) {
   $sql = mysql_query("SELECT * FROM cores WHERE id_status = 3 AND nm_cor1 = '".$nu_codigo."' ORDER BY nm_cor LIMIT $inicio, $qnt");
  $row = mysql_num_rows($sql);
  } else {
  $sql = mysql_query("SELECT * FROM cores WHERE id_status = 3 ORDER BY nm_cor LIMIT $inicio, $qnt");
  }
  $row = mysql_num_rows($sql);
  for ( $i=0; $i < $row; $i++ ){
  $id_cor = mysql_result($sql, $i, "id_cor");
   $nm_cor = mysql_result($sql, $i, "nm_cor");
   $nu_codigo = mysql_result($sql, $i, "nm_cor1");
   
  ?>
  <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)" onDblClick="javascript:alt('controller.php?abrirCorAlt=abrirCorAlt&id_cor=<?php echo $id_cor;?>')"> 
    <td height="19" class="labelEsquerda"><?php echo $nm_cor;?></td>
    <td height="19" class="labelEsquerda">&nbsp;</td>
    <td class="labelCentro"><a href="javascript:del('controller.php?excluirCor=excluirCor&id_cor=<?php echo $id_cor;?>')"> 
      <img src="img/excluir2.gif" width="10" height="10"></a></td>
    <td class="labelCentro"><a href="controller.php?abrirCorAlt=abrirCorAlt&id_cor=<?php echo $id_cor;?>"> 
      <img src="img/insert.gif" width="10" height="10"></a></td>
  </tr>
  <?php }?>
  <tr> 
    <td height="19" colspan="4" class="labelCentro"><hr></td>
  </tr>
  <tr> 
    <td height="19" colspan="2" class="labelEsquerda"><strong>Itens&nbsp;<?php echo $i;?></strong></td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
  </tr>
</table>
<p align="center" class="labelCentro">
<?php include("cor_paginacao.php"); ?>
</p>
</body>
<?php
} else {
 include "rodape/rodape.php";
 }
 ?>
</html>
