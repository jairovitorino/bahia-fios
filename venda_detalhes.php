<?php
session_start();
 include "cabecalho/cabecalho.php";
 $msg_erro = @$_SESSION['msg_erro'];
 $msg_sucesso = @$_SESSION['msg_sucesso'];
 $id_cliente = @$_SESSION['id_cliente'];
 $nm_cliente = $_SESSION['nm_cliente'];
 $nu_venda = $_SESSION['nu_venda'];
 $nu_ano = $_SESSION['nu_ano'];
 $id_venda = $_SESSION['id_venda']; 
 $id_venda_det = @$_SESSION['id_venda_det'];
 
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
      <td colspan="2" class="labelEsquerda"><strong>Dados da Venda</strong></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><input type="hidden" name="inserirVendaDet"> 
        <input type="hidden" name="id_venda" value="<?php echo $id_venda;?>"> 
      </td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td class="labelDireita">Pedido:</td>
      <td class="labelEsquerda"><?php echo $nu_venda;?>/<?php echo $nu_ano;?></td>
    </tr>
    <tr> 
      <td class="labelDireita">Cliente:</td>
      <td class="labelEsquerda"><?php echo $nm_cliente;?></td>
    </tr>
	   <?php 
	   require_once("conexao.php");
		$mysql = new Mysql();
		$mysql->conectar();
		$sql_prod = mysql_query("SELECT * FROM produtos WHERE id_status = 3 ORDER BY nm_produto"); 
		$row_prod = mysql_num_rows($sql_prod);
		?>
    <tr> 
      <td class="labelDireita">Produto:</td>
      <td class="labelEsquerda"><select name="id_produto" id="id_produto">
          <option value="0">-- Selecione -- >></option>
          <?php for($o=0; $o<$row_prod; $o++) { ?>
          <option value="<?php echo mysql_result($sql_prod, $o, "id_produto"); ?>"> 
          <?php echo mysql_result($sql_prod, $o, "nm_produto"); ?></option>
          <?php } ?>
        </select></td>
    </tr>
	<tr> 
      <td class="labelDireita">Quantidade :</td>
      <td class="labelEsquerda"><input name="qt_venda" type="text" value="1" size="8" maxlength="8"></td>
    </tr>
	 <?php
	$sql_gra = mysql_query("SELECT * FROM grandezas ORDER BY nm_grandeza"); 
	$row_gra = mysql_num_rows($sql_gra);
	?>
    <tr> 
      <td class="labelDireita">Grandeza:</td>
      <td class="labelEsquerda"><select name="id_grandeza" id="id_grandeza">
          <option value="0">-- Selecione -- >></option>
          <?php for($r=0; $r<$row_gra; $r++) { ?>
          <option value="<?php echo mysql_result($sql_gra, $r, "id_grandeza"); ?>"> 
          <?php echo mysql_result($sql_gra, $r, "nm_grandeza"); ?></option>
          <?php } ?>
        </select></td>
    </tr>   
   <?php
	$sql_cor = mysql_query("SELECT * FROM cores WHERE id_status = 3 ORDER BY nm_cor"); 
	$row_cor = mysql_num_rows($sql_cor);
	?>
    <tr> 
      <td class="labelDireita">Cor:</td>
      <td class="labelEsquerda"><select name="id_cor" id="id_cor">
          <option value="0">-- Selecione -- >></option>
          <?php for($q=0; $q<$row_cor; $q++) { ?>
          <option value="<?php echo mysql_result($sql_cor, $q, "id_cor"); ?>"> 
          <?php echo mysql_result($sql_cor, $q, "nm_cor"); ?></option>
          <?php } ?>
        </select></td>
    </tr>
	
	 <?php
	$sql_emb = mysql_query("SELECT * FROM embalagens ORDER BY nm_emb"); 
	$row_emb = mysql_num_rows($sql_emb);
	?>
    <tr> 
      <td class="labelDireita">Embalagem:</td>
      <td class="labelEsquerda"><select name="id_emb" id="id_emb">
          <option value="0">-- Selecione -- >></option>
          <?php for($s=0; $s<$row_emb; $s++) { ?>
          <option value="<?php echo mysql_result($sql_emb, $s, "id_emb"); ?>"> 
          <?php echo mysql_result($sql_emb, $s, "nm_emb"); ?></option>
          <?php } ?>
        </select></td>
    </tr>
	  <tr> 
      <td class="labelDireita">Quantidade :</td>
      <td class="labelEsquerda"><input name="qt_emb" type="text" value="1" size="8" maxlength="8"></td>
    </tr>  
    <tr> 
      <td class="labelDireita">Valor Unit&aacute;rio:</td>
      <td class="labelEsquerda"><input name="vl_venda" type="text" size="8" maxlength="8"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Desconto:</td>
      <td class="labelEsquerda"><input name="nu_desc" type="text" value="0" size="8" maxlength="3"></td>
    </tr>
    <tr> 
      <td width="41%" class="labelDireita">&nbsp;</td>
      <td width="59%" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><input type="submit" name="grava" value="Gravar Venda"> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:cancelar('controller.php?cancelarOperacao=cancelarOperacao')" /></td>
    </tr>
  </table>
</form>

<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td colspan="8" class="labelCentro">ITENS DA VENDA</td>
  </tr>
  <tr> 
    <td colspan="8" class="labelCentro">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="9" class="labelDireita"><hr></td>
  </tr>
  <tr bgcolor="#FF0000"> 
    <td width="31%" class="labelEsquerda"><font color="#FFFFFF">Produto</font></td>
    <td width="18%" class="labelEsquerda"><font color="#FFFFFF">Cor</font></td>
    <td width="8%" class="labelEsquerda"><font color="#FFFFFF">UF</font></td>
    <td width="10%" class="labelEsquerda"><font color="#FFFFFF">Desconto %</font></td>
    <td width="9%" class="labelEsquerda"><font color="#FFFFFF">Quantidade</font></td>
    <td width="8%" class="labelDireita"><font color="#FFFFFF">Unit R$</font></td>
    <td width="9%" class="labelDireita"><font color="#FFFFFF">Total R$</font></td>
    <td width="7%" class="labelCentro"><font color="#FFFFFF">Excluir</font></td>
  </tr>
  <?php
  $sql_venda = mysql_query("SELECT * 
  FROM vendas_detalhes, produtos, cores  
  WHERE id_venda = ".$id_venda."
  AND vendas_detalhes.id_produto = produtos.id_produto
  AND vendas_detalhes.id_cor = cores.id_cor
  ORDER BY nm_cor
  "); 
  $row_venda = mysql_num_rows($sql_venda);
  for($s=0; $s<$row_venda; $s++) {
  $id_venda_det = mysql_result($sql_venda, $s, "id_venda_det");
  $nm_produto = mysql_result($sql_venda, $s, "nm_produto");
  $nm_cor = mysql_result($sql_venda, $s, "nm_cor");
  $id_grandeza = mysql_result($sql_venda, $s, "id_grandeza");
  $nu_desc = mysql_result($sql_venda, $s, "nu_desc");
  $vl_venda = mysql_result($sql_venda, $s, "vl_venda");
  //$vl_venda = (double)$vl_venda;
  $qt_venda = mysql_result($sql_venda, $s, "qt_venda");
  $pc_produto = mysql_result($sql_venda, $s, "pc_produto");
  $vl_percentual = ($vl_venda*$pc_produto)/100;  
  $vl_final = ($qt_venda*$vl_venda)-($qt_venda*$nu_desc*$vl_venda)/100;
  $total = @$total + $vl_final ;
  switch($id_grandeza){
  case 1;
  $id_grandeza = "Kg";
  break;
   case 2;
  $id_grandeza = "M";
  break;
   case 6;
  $id_grandeza = "Un";
  break;
  }
  ?>
  <tr> 
    <td class="labelEsquerda"><?php echo $nm_produto;?></td>
    <td class="labelEsquerda"><?php echo $nm_cor;?></td>
    <td class="labelEsquerda"><?php echo $id_grandeza;?></td>
    <td class="labelEsquerda"><?php echo $nu_desc;?></td>
    <td class="labelEsquerda"><?php echo $qt_venda;?></td>
    <td class="labelDireita"><?php echo $vl_venda = number_format($vl_venda,3,",","");?></td>
    <td class="labelDireita"><?php echo $vl_final = number_format($vl_final,3,",","");?></td>
    <td class="labelCentro"><a href="javascript:del('controller.php?excluirVendaDet=excluirVendaDet&id_venda_det=<?php echo $id_venda_det;?>&
	id_venda=<?php echo $id_venda;?>')"> 
      <img src="img/excluir2.gif" width="10" height="10"></a></td>
  </tr>
  <?php }?>
  <tr> 
    <td colspan="8" class="labelEsquerda"><hr></td>
  </tr>
  <tr> 
    <td class="labelEsquerda"><strong>Itens:&nbsp;<?php echo $s;?></strong></td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelEsquerda">&nbsp;</td>
    <td class="labelDireita">&nbsp;</td>
    <td colspan="2" class="labelDireita"><strong>Total R$&nbsp;<?php echo @$total = number_format($total,3,",","")?></strong></td>
  </tr>
  <?php  if ( $id_venda_det ) {?>
  <tr> 
    <td colspan="8" class="labelCentro"><a href="controller.php?imprimirComprovante=imprimirComprovante&id_venda=<?php echo $id_venda;?>">IMPRIMIR</a></td>
  </tr>
  <?php }?>
  
</table>
<p>&nbsp;</p></body>

</html>
