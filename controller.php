<?php
session_start();
require_once("persistence.php");
$persistence = new Persistence();

if ( isset($_POST['logar']) ) {
	
		$nm_login = addslashes($_POST['login']);
		$nm_senha = addslashes($_POST['senha']);
	
		$persistence->logar($nm_login,$nm_senha);
	}
if ( isset($_GET['logout']) ) {
	session_destroy();
	
	header ("location: index.php");
	}
if ( isset($_GET['cancelarOperacao']) ) {		
	
		$persistence->cancelarOperacao();
	}
if ( isset($_GET['abrirClienteAlt']) ) {
unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$id_cliente = addslashes($_GET['id_cliente']);
	$tipo_pessoa = addslashes($_GET['tipo_pessoa']);
		$persistence->abrirClienteAlt($id_cliente,$tipo_pessoa);
	}
if ( isset($_GET['abrirCliente']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirCliente();
	}
if ( isset($_POST['infoTipoCliente']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$tipo_pessoa = addslashes($_POST['tipo_pessoa']);
		$persistence->infoTipoCliente($tipo_pessoa);
	}
if ( isset($_GET['abrirClienteImpres']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	
		$persistence->abrirClienteImpres();
	}
if ( isset($_GET['abrirClienteParam']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	
		$persistence->abrirClienteParam();
	}
if ( isset($_GET['abrirCorParam']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	
		$persistence->abrirCorParam();
	}
if ( isset($_GET['abrirProdutoParam']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirProdutoParam();
	}
if ( isset($_GET['abrirVendaParam']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirVendaParam();
	}
if ( isset($_POST['pesquisarCliente']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$nm_cliente = addslashes($_POST['nm_cliente']);
	$nu_cnpj_cpf = addslashes($_POST['nu_cnpj_cpf']);
	
	$persistence->pesquisarCliente($nm_cliente,$nu_cnpj_cpf);
	}
if ( isset($_POST['pesquisarCor']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$nm_cor = addslashes($_POST['nm_cor']);
	$nu_codigo = addslashes($_POST['nu_codigo']);
	
	$persistence->pesquisarCor($nm_cor,$nu_codigo);
	}
if ( isset($_POST['pesquisarProduto']) ) {
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);		
	$nm_produto = addslashes($_POST['nm_produto']);
	$nu_codigo = addslashes($_POST['nu_codigo']);
	
	$persistence->pesquisarProduto($nm_produto,$nu_codigo);
	}
if ( isset($_POST['pesquisarVenda']) ) {
	unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$nu_cnpj_cpf = addslashes($_POST['nu_cnpj_cpf']);	
	$nm_cliente = addslashes($_POST['nm_cliente']);
	
	$persistence->pesquisarVenda($nu_venda,$nu_cnpj_cpf);
	}
if ( isset($_GET['abrirProduto']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirProduto();
	}
if ( isset($_GET['abrirProdutoAlt']) ) {		
	$id_produto = addslashes($_GET['id_produto']);
		$persistence->abrirProdutoAlt($id_produto);
	}
if ( isset($_GET['abrirProdutoImpres']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirProdutoImpres();
	}
if ( isset($_GET['abrirCor']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirCor();
	}
if ( isset($_GET['abrirCorAlt']) ) {
	unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$id_cor = addslashes($_GET['id_cor']);
		$persistence->abrirCorAlt($id_cor);
	}
if ( isset($_GET['abrirCorImpres']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirCorImpres();
	}
if ( isset($_GET['abrirVenda']) ) {
	unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	unset($_SESSION['id_venda']);
		$persistence->abrirVenda();
	}
if ( isset($_GET['abrirVendaRelPdf']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirVendaRelPdf();
	}
if ( isset($_GET['abrirVendaRelHtml']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirVendaRelHtml();
	}
if ( isset($_GET['abrirVendaImpres']) ) {		
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$persistence->abrirVendaImpres();
	}
if ( isset($_GET['excluirCliente']) ) {
	unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$id_cliente = addslashes($_GET['id_cliente']);
		$persistence->excluirCliente($id_cliente);
	}
if ( isset($_GET['excluirVendaDet']) ) {
	unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);		
	$id_venda_det = addslashes($_GET['id_venda_det']);
	$id_venda = addslashes($_GET['id_venda']);
		$persistence->excluirVendaDet($id_venda_det,$id_venda);
	}
if ( isset($_POST['alterarCliente']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_cliente = addslashes($_POST['id_cliente']);
		$tipo_pessoa = addslashes($_POST['tipo_pessoa']);
		$nm_cliente = addslashes($_POST['nm_cliente']);
		$nm_razao = addslashes($_POST['nm_razao']);
		$nu_cnpj_cpf = addslashes($_POST['nu_cnpj_cpf']);
		$nm_contato = addslashes($_POST['nm_contato']);
		$nm_logradouro = addslashes($_POST['nm_logradouro']);
		$dt_nascimento = addslashes($_POST['dt_nascimento']);
		$id_pagamento = addslashes($_POST['id_pagamento']);
		$nu_inscricao = addslashes($_POST['nu_inscricao']);		
		$nu_telefone = addslashes($_POST['nu_telefone']);
		$nu_celular = addslashes($_POST['nu_celular']);
		$nu_fax = addslashes($_POST['nu_fax']);
		$te_email = addslashes($_POST['te_email']);
		$nu_logra = addslashes($_POST['nu_logra']);
		$nm_bairro = addslashes($_POST['nm_bairro']);		
		$nm_cidade = addslashes($_POST['nm_cidade']);
		$nu_cep = addslashes($_POST['nu_cep']);
		$nm_bairro = addslashes($_POST['nm_bairro']);
		$nm_uf = addslashes($_POST['nm_uf']);
		$persistence->alterarCliente($id_cliente,$tipo_pessoa,$nm_cliente,$nm_razao,$nu_cnpj_cpf,$nm_contato,$nm_logradouro,$nu_logra,$dt_nascimento,$nu_inscricao,
		$nu_telefone,$nu_celular,$nu_fax,$te_email,$$nm_bairro,$nm_cidade,$nu_cep,$nm_bairro,$nm_uf);
		
	}
if ( isset($_POST['inserirCliente']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_cliente = addslashes($_POST['id_cliente']);
		$tipo_pessoa = addslashes($_POST['tipo_pessoa']);
		$nm_cliente = addslashes($_POST['nm_cliente']);
		$nm_razao = addslashes($_POST['nm_razao']);
		$nu_cnpj_cpf = addslashes($_POST['nu_cnpj_cpf']);
		$nm_contato = addslashes($_POST['nm_contato']);
		$dt_nascimento = addslashes($_POST['dt_nascimento']);
		$id_pagamento = addslashes($_POST['id_pagamento']);
		$nu_inscricao = addslashes($_POST['nu_inscricao']);		
		$nu_telefone = addslashes($_POST['nu_cnpj_cpf']);
		$nu_celular = addslashes($_POST['nu_celular']);
		$nu_fax = addslashes($_POST['nu_fax']);
		$te_email = addslashes($_POST['te_email']);
		$nm_logradouro = addslashes($_POST['nm_logradouro']);
		$nu_logra = addslashes($_POST['nu_logra']);
		$nm_bairro = addslashes($_POST['nm_bairro']);		
		$nm_cidade = addslashes($_POST['te_email']);
		$nu_cep = addslashes($_POST['nu_cep']);
		$nm_bairro = addslashes($_POST['nm_bairro']);
		$nm_uf = addslashes($_POST['nm_uf']);
		$persistence->inserirCliente($id_cliente,$tipo_pessoa,$nm_cliente,$nm_razao,$nu_cnpj_cpf,$nm_contato,$dt_nascimento,$nu_inscricao,$nu_telefone,$nu_celular,
		$nu_fax,$te_email,$nm_logradouro,$nu_logra,$nm_bairro,$nm_cidade,$nu_cep,$nm_bairro,$nm_uf);
		
	}
if ( isset($_POST['alterarCor']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_cor = addslashes($_POST['id_cor']);
		$nm_cor = addslashes($_POST['nm_cor']);
				
		$persistence->alterarCor($id_cor,$nm_cor);
		
	}
if ( isset($_GET['excluirCor']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_cor = addslashes($_GET['id_cor']);
				
		$persistence->excluirCor($id_cor);
		
	}
if ( isset($_POST['inserirCor']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$nm_cor = addslashes($_POST['nm_cor']);
		$nm_cor1 = addslashes($_POST['nm_cor1']);
		
		if ( $nm_cor == "" ){
		$msg_erro = "Campo Nome: Preenchimento obrigatório";
		$_SESSION['msg_erro'] = $msg_erro;
		header ("location: cor.php");
		} else {
		
		$persistence->inserirCor($nm_cor,$nm_cor1);
	}	
	}
if ( isset($_GET['excluirProduto']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_produto = addslashes($_GET['id_produto']);
				
		$persistence->excluirProduto($id_produto);
		
	}
if ( isset($_GET['excluirVenda']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_venda = addslashes($_GET['id_venda']);
				
		$persistence->excluirVenda($id_venda);
		
	}

if ( isset($_POST['alterarProduto']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_produto = addslashes($_POST['id_produto']);
		$nm_produto = addslashes($_POST['nm_produto']);
		$nm_produto1 = addslashes($_POST['nm_produto1']);
		$pc_produto = addslashes($_POST['pc_produto']);
		
		$persistence->alterarProduto($id_produto,$nm_produto,$nm_produto1,$pc_produto);
		
	}
if ( isset($_POST['inserirProduto']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$nm_produto = addslashes($_POST['nm_produto']);
		$nm_produto1 = addslashes($_POST['nm_produto1']);
		$pc_produto = addslashes($_POST['pc_produto']);
		
		if ( $nm_produto == "" ){
		$msg_erro = "Campo Nome: Preenchimento obrigatório";
		$_SESSION['msg_erro'] = $msg_erro;
		header ("location: produto.php");
		} else {
		
		$persistence->inserirProduto($nm_produto,$nm_produto1,$pc_produto);
		}
	}
if ( isset($_POST['inserirVenda']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$nu_venda = addslashes($_POST['nu_venda']);
		$nu_ano = addslashes($_POST['nu_ano']);
		$id_cliente = addslashes($_POST['id_cliente']);
		$dt_entrega = addslashes($_POST['dt_entrega']);
		$nu_nota = addslashes($_POST['nu_nota']);
		$id_pagamento = addslashes($_POST['id_pagamento']);
		$nu_prazo = addslashes($_POST['nu_prazo']);
		$te_obs = addslashes($_POST['te_obs']);
		$nm_contato_venda = addslashes($_POST['nm_contato_venda']);
		$nm_aplicacao = addslashes($_POST['nm_aplicacao']);
		$id_frete = addslashes($_POST['id_frete']);
		$nm_transp = addslashes($_POST['nm_transp']);
		$nu_tel_transp = addslashes($_POST['nu_tel_transp']);
		
		if ( $id_cliente == 0 ){
		$msg_erro = "Campo Cliente: Preenchimento obrigatório";
		$_SESSION['msg_erro'] = $msg_erro;
		header ("location: venda.php");
		} else if ( $nu_nota == "" ){
		$msg_erro = "Campo Nota Fiscal: Preenchimento obrigatório";
		$_SESSION['msg_erro'] = $msg_erro;
		header ("location: venda.php");
		} else {
		
		$persistence->inserirVenda($dt_entrega,$id_cliente,$nu_nota,$nu_prazo,$te_obs,$nm_contato_venda,$nm_aplicacao,$id_frete,$nm_transp,$nu_tel_transp,$nu_venda,$nu_ano,
		$id_pagamento);
		}
	}
if ( isset($_POST['inserirVendaDet']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_venda = addslashes($_POST['id_venda']);
		$qt_venda = addslashes($_POST['qt_venda']);
		$qt_emb = addslashes($_POST['qt_emb']);
		$vl_venda = addslashes($_POST['vl_venda']);
		$vl_venda = str_replace(",",".",$vl_venda );
		$nu_desc = addslashes($_POST['nu_desc']);
		$id_produto = addslashes($_POST['id_produto']);
		$id_grandeza = addslashes($_POST['id_grandeza']);
		$id_cor = addslashes($_POST['id_cor']);
		$id_emb = addslashes($_POST['id_emb']);
	if ( $id_produto == 0 ){
	   $msg_erro = "Campo Produto: Preenchimento obrigatório";
	   $_SESSION['msg_erro'] = $msg_erro;
	   header ("location: venda_detalhes.php");
	   } else if ( $id_grandeza == 0 ){
	    $msg_erro = "Campo Grandeza: Preenchimento obrigatório";
	   $_SESSION['msg_erro'] = $msg_erro;
	   header ("location: venda_detalhes.php");
	     } else if ( $id_cor == 0 ){
	    $msg_erro = "Campo Cor: Preenchimento obrigatório";
	   $_SESSION['msg_erro'] = $msg_erro;
	   header ("location: venda_detalhes.php");
	     } else if ( $id_emb == 0 ){
	    $msg_erro = "Campo Embalagem: Preenchimento obrigatório";
	   $_SESSION['msg_erro'] = $msg_erro;
	   header ("location: venda_detalhes.php");	
		} else {
		$persistence->inserirVendaDet($id_venda,$qt_venda,$qt_emb,$vl_venda,$nu_desc,$id_produto,$id_grandeza,$id_cor,$id_emb);
	}
	}
if ( isset($_GET['imprimirComprovante']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		$id_venda = addslashes($_GET['id_venda']);
		
		$persistence->imprimirComprovante($id_venda);
	}
?>