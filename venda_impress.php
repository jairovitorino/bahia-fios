<?php
session_start();
$login = $_SESSION['login'];
$msg_sucesso = @$_SESSION['msg_sucesso'];
$msg_erro = @$_SESSION['msg_erro'];
$nu_cnpj_cpf = $_SESSION['nu_cnpj_cpf'];
$nm_cliente = $_SESSION['nm_cliente'];
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
<table width="85%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td colspan="10" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="10" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="10" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="10" class="labelCentro">TODAS AS VENDAS</td>
  </tr>
  <tr>
    <td colspan="10" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="10" class="labelEsquerda">
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
    <td colspan="10" class="labelCentro"><hr></td>
  </tr>
  <tr bgcolor="#FF0000"> 
    <td width="23%" height="19" class="labelEsquerda"><font color="#FFFFFF">Cliente</font></td>
    <td width="9%" class="labelEsquerda"><font color="#FFFFFF">CNPJ/CPF</font></td>
    <td width="7%" class="labelEsquerda"><font color="#FFFFFF">Data</font></td>
    <td width="14%" class="labelEsquerda"><font color="#FFFFFF">N. Pedido</font></td>
    <td width="11%" class="labelEsquerda"><font color="#FFFFFF">Telefone</font></td>
    <td width="4%" class="labelDireita"><font color="#FFFFFF">Total</font></td>
    <td width="13%" class="labelEsquerda">&nbsp;</td>
    <td width="7%" class="labelCentro"><font color="#FFFFFF">Imprimir</font></td>
    <td width="6%" class="labelCentro"><font color="#FFFFFF">Cancelar</font></td>
    <td width="6%" class="labelCentro">&nbsp;</td>
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
 if ( $nu_cnpj_cpf ) {
  $sql = mysql_query("SELECT * 
  FROM vendas, clientes
  WHERE vendas.id_cliente = clientes.id_cliente
  AND vendas.id_status = 3
  AND nu_cnpj_cpf = '".$nu_cnpj_cpf."' 
  
   ORDER BY nu_venda DESC LIMIT $inicio, $qnt");
  }  else if ( $nm_cliente ) {
     $sql = mysql_query("SELECT * 
  FROM vendas, clientes
  WHERE vendas.id_cliente = clientes.id_cliente
  AND vendas.id_status = 3
  AND nm_cliente LIKE '%$nm_cliente%'
   ORDER BY nu_venda DESC LIMIT $inicio, $qnt");
   } else {
   $sql = mysql_query("SELECT * 
  FROM vendas, clientes
  WHERE vendas.id_cliente = clientes.id_cliente
  AND vendas.id_status = 3
   ORDER BY nu_venda DESC LIMIT $inicio, $qnt");
   }
  $row = mysql_num_rows($sql);
  for ( $i=0; $i < $row; $i++ ){
  $id_venda = mysql_result($sql, $i, "id_venda");
   $nm_cliente = mysql_result($sql, $i, "nm_cliente");
   $nm_razao = mysql_result($sql, $i, "nm_razao");
   $nu_cnpj_cpf = mysql_result($sql, $i, "nu_cnpj_cpf");
   $nu_venda = mysql_result($sql, $i, "nu_venda");
   $nu_ano = mysql_result($sql, $i, "nu_ano");
   $nm_contato = mysql_result($sql, $i, "nm_contato");
   $nu_telefone = mysql_result($sql, $i, "nu_telefone");
   $vl_total = mysql_result($sql, $i, "vl_total");
   $dt_venda = mysql_result($sql, $i, "dt_venda");
   $dt_venda = substr($dt_venda,8,2)."/".substr($dt_venda,5,2)."/".substr($dt_venda,0,4);
  ?>
  <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)"> 
    <td height="19" class="labelEsquerda"><?php echo $nm_cliente;?></td>
    <td class="labelEsquerda"><?php echo $nu_cnpj_cpf;?></td>
    <td class="labelEsquerda"><?php echo $dt_venda;?></td>
    <td class="labelEsquerda"><?php echo $nu_venda;?>/<?php echo $nu_ano;?></td>
    <td class="labelEsquerda"><?php echo $nu_telefone;?></td>
    <td class="labelDireita"><?php echo $vl_total = number_format($vl_total,3,",","");?></td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelCentro"><a href="controller.php?imprimirComprovante=imprimirComprovante&id_venda=<?php echo $id_venda;?>"> 
      <img src="img/lupa.gif" width="10" height="10"></a></td>
    <td class="labelCentro"><a href="javascript:del('controller.php?excluirVenda=excluirVenda&id_venda=<?php echo $id_venda;?>')">
	<img src="img/excluir2.gif" width="10" height="10"></a></td>
    <td class="labelCentro">&nbsp;</td>
  </tr>
  <?php }?>
  <tr> 
    <td height="19" colspan="10" class="labelCentro"><hr></td>
  </tr>
  <tr> 
    <td height="19" class="labelEsquerda"><strong>Itens&nbsp;<?php echo $i;?></strong></td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td colspan="4" class="labelEsquerda">&nbsp;</td>
    <td class="labelCentro">&nbsp;</td>
  </tr>
</table>
<p align="center" class="labelCentro">
<?php include("venda_paginacao.php"); ?>
</p>
</body>
<?php
} else {
 include "rodape/rodape.php";
 }
 ?>
</html>
