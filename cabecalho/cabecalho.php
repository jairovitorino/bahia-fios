<?php
@session_start();
$login = @$_SESSION['login'];
$acesso = @$_SESSION['acesso'];
$msg = @$_SESSION['msg'];
?>
<html>
<head>
<title>Bahia Fios Ltda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function imprimir(detUrl){
document.location = detUrl;
}
</script>
</head>

<link rel="stylesheet" href="css/estilo.css" type="text/css">
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<link rel="SHORTCUT ICON" href="images/din.jpg"/>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="form1" action="controller.php" method="post">
<?php if ( $acesso == 1 ){?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
      <td colspan="5" bgcolor="#FF0000" class="labelCentro"><font color="#FFFFFF">&nbsp;</font><font color="#FFFFFF" size="4" face="Arial, Helvetica, sans-serif">BAHIA 
        FIOS LTDA</font></td>
  </tr>
  <tr> 
    <td colspan="5" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
  </tr>
  <script type="text/javascript" src="js/menu.js"></script>
  <tr> 
      <td width="18%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"><font color="#FF0000" size="2" face="Courier New, Courier, mono">&nbsp; 
        </font>vers&atilde;o 1.2</td>
      <td><ul class="udm" id="udm" name="udm">
	  <li><a href="#">Cadastros</a> 
            <ul>
                <li><a href="controller.php?abrirCliente=abrirCliente">Cliente</a></li>
			    <li><a href="controller.php?abrirProduto=abrirProduto">Produto</a> </li>              
			    <li><a href="controller.php?abrirVenda=abrirVenda">Venda</a> </li>
                 <li><a href="controller.php?abrirCor=abrirCor">Cores</a> </li>
         	 </ul>		
          
        <li><a href="#">Consultas</a> 
		<ul> 
		<li><a href="controller.php?abrirVendaParam=abrirVendaParam">Vendas</a></li> 
            
				
         <li><a href="controller.php?abrirClienteParam=abrirClienteParam">Clientes</a> </li>
           
		 <li><a href="controller.php?abrirProdutoParam=abrirProdutoParam">Produtos</a> 
           
		 <li><a href="controller.php?abrirCorParam=abrirCorParam">Cores</a> 
             
			</ul>
		 
        <li><a href="#">Relat&oacute;rios</a> 
		<ul> 
          <li><a href="#">Vendas</a> 
              <ul>
                  <li><a href="controller.php?abrirVendaRelPdf=abrirVendaRelPdf">PDF</a></li>
                  <li><a href="controller.php?abrirVendaRelHtml=abrirVendaRelHtml">HTML</a></li>                
				</ul> 	 
       
	  </td>
      <td width="31%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"> 
        Usu&aacute;rio logado:&nbsp;<font color="#ff0000"><?php echo $login;?></font>&nbsp;&nbsp;(<a href="controller.php?logout=logout">Sair</a>)</td>
      <td width="13%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
    
  </tr>
</table>
<?php } else {?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td colspan="5" bgcolor="#FF0000" class="labelCentro"><font color="#FFFFFF">&nbsp;</font><font color="#FFFFFF" size="4" face="Arial, Helvetica, sans-serif">BAHIA 
        FIOS LTDA</font></td>
    </tr>
    <tr> 
      <td colspan="5" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td width="18%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
      <td width="38%" bordercolor="#FFFFFF" background="../calendario.php" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
      <td width="32%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"> 
        Login 
        <input name="login" type="text" size="10" maxlength="50">
        Senha
        <input name="senha" type="password" size="8" maxlength="50">
        <input type="submit" value="Ok">
        &nbsp;<font color="#ff0000"><?php echo $msg;?></font>
        <input type="hidden" name="logar"></td>
      <td width="12%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"><a href="usuario.php">Novo 
        Usu&aacute;rio</a></td>
    </tr>
  </table>
<?php }?>
</form>
</body>

</html>
