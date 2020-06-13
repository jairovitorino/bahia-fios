<?php
session_start();
 include "cabecalho/cabecalho.php";
 $msg_erro = @$_SESSION['msg_erro'];
 $msg_sucesso = @$_SESSION['msg_sucesso'];
 $dt_entrega = date("d/m/Y");
 $nu_venda = $_SESSION['nu_venda'];
 $id_venda = @$_SESSION['id_venda'];
$nu_ano =$_SESSION['nu_ano'] ;

?>
<html>
<head>
<title>Bahia Fios Ltda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<script language="JavaScript">
function cancelar(delUrl) { 
    document.location = delUrl; 
}
function imprimir(delUrl) { 
    document.location = delUrl; 
}
function del(delUrl) {
  if (confirm("Excluir o registro?")) {
    document.location = delUrl;
  }
}
function ativa(){
	document.getElementById('nu_prazo').value="";
	document.getElementById('nu_prazo').disabled=true;
	document.getElementById('nu_prazo').focus();
}
function desativa(){
	document.getElementById('nu_prazo').disabled=false;
	document.getElementById('nu_prazo').value=1;
	
}
</script>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="form1" method="post" action="controller.php">
  <table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><strong>VENDA</strong></td>
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
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><input type="hidden" name="inserirVenda"> 
        <input type="hidden" name="nu_venda" value="<?php echo $nu_venda;?>"> 
		<input type="hidden" name="id_venda" value="<?php echo $id_venda;?>"> 
        <input type="hidden" name="nu_ano" value="<?php echo $nu_ano;?>"> </td>
    </tr>
    <tr> 
      <td class="labelDireita">Pedido:</td>
      <td class="labelEsquerda">&nbsp;<?php echo $nu_venda;?>/<?php echo $nu_ano;?></td>
    </tr>
    <?php
	require_once("conexao.php");
		$mysql = new Mysql();
		$mysql->conectar();
	$sql_cli = mysql_query("SELECT * FROM clientes WHERE id_status = 3 ORDER BY nm_cliente"); 
	$row_cli = mysql_num_rows($sql_cli);
	?>
    <tr> 
      <td class="labelDireita">Cliente:</td>
      <td class="labelEsquerda"><select name="id_cliente" id="id_cliente">
          <option value="0">-- Selecione >></option>
          <?php for($p=0; $p<$row_cli; $p++) { ?>
          <option value="<?php echo mysql_result($sql_cli, $p, "id_cliente"); ?>"> 
          <?php echo mysql_result($sql_cli, $p, "nm_cliente"); ?></option>
          <?php } ?>
        </select> </td>
    </tr>
    <tr> 
      <td class="labelDireita">Data da Entrega:</td>
      <td class="labelEsquerda"> 
        <?php
		require 'classes/calendario.php';	
		$calendario_campo = new calendario;
		$calendario_campo->nome_campo="dt_entrega";
		$calendario_campo->value_campo=$dt_entrega;		
		$calendario_campo->criar_campo();
		 ?>
      </td>
    </tr>
    <tr> 
      <td class="labelDireita">Nota Fiscal:</td>
      <td class="labelEsquerda"><input name="nu_nota" type="text" size="10" maxlength="10"></td>
    </tr>
    <tr> 
      <td class="labelDireita">&nbsp;</td>
      <td class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td class="labelDireita">Forma de Pagamento:</td>
      <td class="labelEsquerda">&nbsp;A vista 
        <input type="radio" name="id_pagamento" value="1" onClick="javascript: ativa()"> &nbsp;&nbsp;Prazo&nbsp;&nbsp; 
        <input type="radio" name="id_pagamento" value="2" checked  onClick="javascript: desativa()"></td>
    </tr>
    <tr> 
      <td class="labelDireita">&nbsp;</td>
      <td class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td class="labelDireita">Prazo:</td>
      <td class="labelEsquerda"><input name="nu_prazo" id="nu_prazo" type="text" value="1" size="10" maxlength="3" ></td>
    </tr>
    <tr> 
      <td class="labelDireita">Aplica&ccedil;&atilde;o:</td>
      <td class="labelEsquerda"><input name="nm_aplicacao" type="text" value="" size="20" maxlength="30"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Contato Transporte:</td>
      <td class="labelEsquerda"><input name="nm_contato_venda" type="text" value="" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Frete:</td>
      <td class="labelEsquerda">&nbsp;CIF 
        <input type="radio" name="id_frete" value="2" checked>
        &nbsp;&nbsp;&nbsp;&nbsp;FOB 
        <input type="radio" name="id_frete" value="1"></td>
    </tr>
    <tr>
      <td class="labelDireita">Transportadora:</td>
      <td class="labelEsquerda"><input name="nm_transp" type="text" value="" size="50" maxlength="50"></td>
    </tr>
	<tr>
      <td class="labelDireita">Telefone Transporte:</td>
      <td class="labelEsquerda"><input name="nu_tel_transp" type="text" value="" size="20" maxlength="20"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Obs:</td>
      <td class="labelEsquerda"><input name="te_obs" type="text" value="" size="70" maxlength="80"></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelDireita"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><input type="submit" name="grava" value="Pr&oacute;ximo"> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:cancelar('controller.php?cancelarOperacao=cancelarOperacao')" /></td>
    </tr>
  </table>
</form>
</body>
<?php
 $calendario_campo->criar_java_campo();
?>
</html>
