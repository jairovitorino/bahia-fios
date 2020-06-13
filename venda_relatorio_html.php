<?php
session_start();
$login = $_SESSION['login'];
$msg_sucesso = @$_SESSION['msg_sucesso'];
$msg_erro = @$_SESSION['msg_erro'];
$nu_venda = @$_SESSION['nu_venda'];
$nu_ano = $_SESSION['nu_ano'];
$nm_cliente = @$_SESSION['nm_cliente'];
 include "cabecalho/cabecalho.php";
 if ($login){
?>
<html>
<head>
<title>Bahia Fios Ltda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function move_i(what) { what.style.background='#CCCCCC'; }
function move_o(what) { what.style.background='#F5F5F5'; }
function del(delUrl) {
  if (confirm("Excluir o registro?")) {
    document.location = delUrl;
  }
}
</script>
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">

<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<table width="57%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td colspan="7" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="7" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="7" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="7" class="labelCentro">RELAT&Oacute;RIO GERAL DE VENDAS</td>
  </tr>
  <tr> 
    <td colspan="7" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="7" class="labelEsquerda"> 
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
    <td colspan="7" class="labelCentro"><hr></td>
  </tr>
  <tr bgcolor="#FF0000"> 
    <td width="29%" height="19" class="labelEsquerda"><font color="#FFFFFF">Cliente</font></td>
    <td width="15%" class="labelEsquerda"><font color="#FFFFFF">CNPJ/CPF</font></td>
    <td width="9%" class="labelEsquerda"><font color="#FFFFFF">Data</font></td>
    <td width="12%" class="labelEsquerda"><font color="#FFFFFF">Venda /Ano</font></td>
    <td width="11%" class="labelEsquerda"><font color="#FFFFFF">Forma Pagto</font></td>
    <td width="8%" class="labelDireita"><font color="#FFFFFF">Total</font></td>
    <td width="16%" class="labelEsquerda">&nbsp;<font color="#FFFFFF">OBS</font></td>
  </tr>
  <?php
  require_once("conexao.php");
		$mysql = new Mysql();
		$mysql->conectar();

   $sql = mysql_query("SELECT * 
  FROM vendas, clientes
  WHERE vendas.id_cliente = clientes.id_cliente
 
   ORDER BY nu_venda, nu_ano DESC");
 
  $row = mysql_num_rows($sql);
  for ( $i=0; $i < $row; $i++ ){
  $id_venda = mysql_result($sql, $i, "id_venda");
   $nm_cliente = mysql_result($sql, $i, "nm_cliente");
   $nm_razao = mysql_result($sql, $i, "nm_razao");
   $nu_cnpj_cpf = mysql_result($sql, $i, "nu_cnpj_cpf");
   $nu_venda = mysql_result($sql, $i, "nu_venda");
   $nu_ano = mysql_result($sql, $i, "nu_ano");
   $nm_contato = mysql_result($sql, $i, "nm_contato");
   $te_msg = mysql_result($sql, $i, "te_msg");
   $vl_total = mysql_result($sql, $i, "vl_total");
   $total = @$total + $vl_total;
   $dt_venda = mysql_result($sql, $i, "dt_venda");
   $dt_venda = substr($dt_venda,8,2)."/".substr($dt_venda,5,2)."/".substr($dt_venda,0,4);
   $id_pagamento = mysql_result($sql, $i, "id_pagamento");
   switch($id_pagamento){
   case 1;
   $id_pagamento = "A Vista";
   break;
   case 2;
   $id_pagamento = "A Prazo";
   break;
   }
  ?>
  <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)"> 
    <td height="19" class="labelEsquerda"><?php echo $nm_cliente;?></td>
    <td class="labelEsquerda"><?php echo $nu_cnpj_cpf;?></td>
    <td class="labelEsquerda"><?php echo $dt_venda;?></td>
    <td class="labelEsquerda"><?php echo $nu_venda;?>/<?php echo $nu_ano;?></td>
    <td class="labelEsquerda"><?php echo $id_pagamento;?></td>
    <td class="labelDireita"><?php echo $vl_total = number_format($vl_total,3,",","");?></td>
    <td class="labelEsquerda">&nbsp;<?php echo $te_msg;?></td>
  </tr>
  <?php }?>
  <tr> 
    <td height="19" colspan="7" class="labelCentro"><hr></td>
  </tr>
  <tr> 
    <td height="19" class="labelEsquerda"><strong>Itens&nbsp;<?php echo $i;?></strong></td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td colspan="6" class="labelDireita"><strong>Total:&nbsp;<?php echo $total;?></strong></td>
  </tr>
</table>
</body>
<?php
} else {
 include "rodape/rodape.php";
 }
 ?>
</html>
