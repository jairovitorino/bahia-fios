<?php
session_start();
$login = $_SESSION['login'];
$msg_sucesso = @$_SESSION['msg_sucesso'];
$msg_erro = @$_SESSION['msg_erro'];
$nm_cliente = $_SESSION['nm_cliente'];
$nu_cnpj_cpf = $_SESSION['nu_cnpj_cpf'];
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
    <td colspan="8" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="8" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="8" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="8" class="labelCentro">TODOS OS CLIENTES</td>
  </tr>
  <tr>
    <td colspan="8" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="8" class="labelEsquerda">
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
    <td colspan="8" class="labelCentro"><hr></td>
  </tr>
  <tr bgcolor="#FF0000"> 
    <td height="19" colspan="2" class="labelEsquerda"><font color="#FFFFFF">Nome</font></td>
    <td width="13%" class="labelEsquerda"><font color="#FFFFFF">CNPJ/CPF</font></td>
    <td width="24%" class="labelEsquerda"><font color="#FFFFFF">Contato</font></td>
    <td width="11%" class="labelEsquerda"><font color="#FFFFFF">Telefone</font></td>
    <td width="10%" class="labelEsquerda"><font color="#FFFFFF">Fax</font></td>
    <td width="5%" class="labelCentro"><font color="#FFFFFF">Excluir</font></td>
    <td width="5%" class="labelCentro"><font color="#FFFFFF">Alterar</font></td>
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
  if ( $nm_cliente ){
  $sql = mysql_query("SELECT * FROM clientes WHERE nm_cliente LIKE '%$nm_cliente%' AND id_status = 3 ORDER BY nm_cliente LIMIT $inicio, $qnt");
  $row = mysql_num_rows($sql);  
  } else if ( $nm_cliente ) {
   $sql = mysql_query("SELECT * FROM clientes WHERE nm_razao LIKE '%$nm_cliente%' AND id_status = 3 ORDER BY nm_cliente LIMIT $inicio, $qnt");
  $row = mysql_num_rows($sql);
   } else if ( $nu_cnpj_cpf ) {
   $sql = mysql_query("SELECT * FROM clientes WHERE nu_cnpj_cpf LIKE '".$nu_cnpj_cpf."' AND id_status = 3 ORDER BY nm_cliente LIMIT $inicio, $qnt");
  $row = mysql_num_rows($sql);
  } else {
  $sql = mysql_query("SELECT * FROM clientes WHERE id_status = 3 ORDER BY nm_cliente LIMIT $inicio, $qnt");
  $row = mysql_num_rows($sql);
  }
  for ( $i=0; $i < $row; $i++ ){
  $id_cliente = mysql_result($sql, $i, "id_cliente");
   $nm_cliente = mysql_result($sql, $i, "nm_cliente");
   $nm_razao = mysql_result($sql, $i, "nm_razao");
   $nu_cnpj_cpf = mysql_result($sql, $i, "nu_cnpj_cpf");
   $nm_contato = mysql_result($sql, $i, "nm_contato");
   $nu_telefone = mysql_result($sql, $i, "nu_telefone");
   $nu_fax = mysql_result($sql, $i, "nu_fax");
   if ( strlen($nu_cnpj_cpf) == 11 )
   $tipo_pessoa = 2;
   else 
   $tipo_pessoa = 1;
  ?>
  <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)" onDblClick="javascript:alt('controller.php?abrirClienteAlt=abrirClienteAlt&id_cliente=<?php echo $id_cliente;?>&tipo_pessoa=<?php echo $tipo_pessoa;?>')"> 
    <td height="19" colspan="2" class="labelEsquerda"><?php echo $nm_cliente;?></td>
    <td class="labelEsquerda"><?php echo $nu_cnpj_cpf;?></td>
    <td class="labelEsquerda"><?php echo $nm_contato;?></td>
    <td class="labelEsquerda"><?php echo $nu_telefone;?></td>
    <td class="labelEsquerda"><?php echo $nu_fax;?></td>
    <td class="labelCentro"><a href="javascript:del('controller.php?excluirCliente=excluirCliente&id_cliente=<?php echo $id_cliente;?>')"> 
      <img src="img/excluir2.gif" width="10" height="10"></a></td>
    <td class="labelCentro"><a href="controller.php?abrirClienteAlt=abrirClienteAlt&id_cliente=<?php echo $id_cliente;?>&tipo_pessoa=<?php echo $tipo_pessoa;?>"> 
      <img src="img/insert.gif" width="10" height="10"></a></td>
  </tr>
  <?php }?>
  <tr> 
    <td height="19" colspan="8" class="labelCentro"><hr></td>
  </tr>
  <tr> 
    <td width="23%" height="19" class="labelEsquerda"><strong>Itens&nbsp;<?php echo $i;?></strong></td>
    <td width="9%" class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td colspan="2" class="labelEsquerda">&nbsp;</td>
    <td class="labelCentro">&nbsp;</td>
  </tr>
</table>
<p align="center" class="labelCentro">
<?php include("cliente_paginacao.php"); ?>
</p>
</body>
<?php
} else {
 include "rodape/rodape.php";
 }
 ?>
</html>
