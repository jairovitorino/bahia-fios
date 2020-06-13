<?php
session_start();
require_once("conexao.php");
$mysql = new Mysql();
$mysql->conectar();

class Persistence {

public function logar($nm_login,$nm_senha){
	
		$sql = mysql_query("SELECT * FROM usuarios 
		WHERE nm_login = '".$nm_login."' AND nm_senha = '".$nm_senha."' AND id_status <> 3  ") or die ("Banco fora do desconectado");
		$row = mysql_num_rows($sql);
		for ( $i=0; $i < $row; $i++ ){
		$id_usuario  = mysql_result($sql, $i, "id_usuario"); 
		$id_status  = mysql_result($sql, $i, "id_status"); 
		}
		if ( $row == 0 ){
		$msg = "Usuário ou Senha inválida";
		$acesso = "2";
		$_SESSION['msg'] = $msg;
		$_SESSION['acesso'] = $acesso;
		unset($_SESSION['msg_usuario']);
		
		header ("location: index.php");
		} else {
		$acesso = "1";
		$_SESSION['acesso'] = $acesso;
		$_SESSION['id_usuario'] = $id_usuario;
		$_SESSION['id_status'] = $id_status;
		$_SESSION['login'] = $nm_login;
		unset($_SESSION['msg_usuario']);
		header ("location: index.php");		
		}	
	}
	public function cancelarOperacao(){
	unset($_SESSION['id_dado']);
	unset($_SESSION['nm_cliente']);
	unset($_SESSION['msg_sistema']);
	header ("location: index.php");
	}
public function abrirCliente(){
	
	unset($_SESSION['id_dado']);
	unset($_SESSION['id_cliente']);
	unset($_SESSION['tipo_pessoa']);
	unset($_SESSION['nm_cliente']);
	unset($_SESSION['msg_sistema']);
	header ("location: cliente.php");
}
public function infoTipoCliente($tipo_pessoa){
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	$_SESSION['tipo_pessoa'] = $tipo_pessoa;
	header ("location: cliente.php");
	}
public function abrirClienteAlt($id_cliente,$tipo_pessoa){
	
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	$_SESSION['id_cliente'] = $id_cliente;
	$_SESSION['tipo_pessoa'] = $tipo_pessoa;
	header ("location: cliente_alt.php");
}
public function abrirClienteImpres(){
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	header ("location: cliente_impress.php");
}
public function abrirClienteParam(){

	unset($_SESSION['nm_cliente']);
	unset($_SESSION['nu_cnpj_cpf']);
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	header ("location: cliente_parametro.php");
}
public function abrirCorParam(){

	unset($_SESSION['nm_cor']);
	unset($_SESSION['nu_cnpj_cpf']);
	unset($_SESSION['nu_codigo']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	header ("location: cor_parametro.php");
}
public function abrirProdutoParam(){

	unset($_SESSION['nm_produto']);
	unset($_SESSION['nu_codigo']);
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	header ("location: produto_parametro.php");
}
public function abrirVendaParam(){

	unset($_SESSION['nm_cliente']);
	unset($_SESSION['nu_cnpj_cpf']);
	unset($_SESSION['nu_venda']);
	//unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	header ("location: venda_parametro.php");
}
public function excluirCliente($id_cliente){
	
	$sql = mysql_query("SELECT * FROM vendas WHERE id_cliente = ".$id_cliente." ");
	$row = mysql_num_rows($sql);
	if ( $row > 0 ){
	$sql = mysql_query("UPDATE clientes SET id_status = 4 WHERE id_cliente = ".$id_cliente." ");
	$msg_sucesso = "Registro cancelado com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cliente_impress.php");
	} else {
	$sql = mysql_query("DELETE FROM clientes WHERE id_cliente = ".$id_cliente." ");
	$msg_sucesso = "Registro excluido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cliente_impress.php");
	}
}
public function excluirVendaDet($id_venda_det,$id_venda){
	$sel_det = mysql_query("SELECT * FROM vendas_detalhes WHERE id_venda_det = ".$id_venda_det." ");
	$row_det = mysql_num_rows($sel_det);
	for ( $i=0; $i < $row_det; $i++ ){
		$vl_venda  = mysql_result($sel_det, $i, "vl_venda"); 
	}
	$sel = mysql_query("SELECT * FROM vendas WHERE id_venda = ".$id_venda." ");
	$row = mysql_num_rows($sel);
	for ( $j=0; $j < $row; $j++ ){
		$vl_total  = mysql_result($sel, $j, "vl_total"); 
		$vl_total = $vl_total - $vl_venda;
	}	
	
	$update = mysql_query("UPDATE vendas SET vl_total = ".$vl_total." WHERE id_venda = ".$id_venda." ");
	
	$sql = mysql_query("DELETE FROM vendas_detalhes WHERE id_venda_det = ".$id_venda_det." ");
	
	$msg_sucesso = "Registro excluido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: venda_detalhes.php");
}
public function alterarCliente($id_cliente,$tipo_pessoa,$nm_cliente,$nm_razao,$nu_cnpj_cpf,$nm_contato,$nm_logradouro,$nu_logra,$dt_nascimento,$nu_inscricao,$nu_telefone,
	$nu_celular,$nu_fax,$te_email,$nm_bairro,$nm_cidade,$nu_cep,$nm_bairro,$nm_uf){
	$dt_nascimento = substr($dt_nascimento,6,4)."-".substr($dt_nascimento,3,2)."-".substr($dt_nascimento,0,2);
	
	$sql = mysql_query("UPDATE clientes SET nm_cliente = '".$nm_cliente."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nm_razao = '".$nm_razao."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nu_cnpj_cpf = '".$nu_cnpj_cpf."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nm_contato = '".$nm_contato."' WHERE id_cliente = ".$id_cliente." ");
	$sql1 = mysql_query("UPDATE clientes SET nm_logradouro = '".$nm_logradouro."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nu_inscricao = '".$nu_inscricao."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nu_logra = '".$nu_logra."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nu_telefone = '".$nu_telefone."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nu_fax = '".$nu_fax."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nu_celular = '".$nu_celular."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET te_email = '".$te_email."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nm_uf = '".$nm_uf."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nm_cidade = '".$nm_cidade."' WHERE id_cliente = ".$id_cliente." ");
	$sql = mysql_query("UPDATE clientes SET nu_cep = '".$nu_cep."' WHERE id_cliente = ".$id_cliente." ");	
	$sql = mysql_query("UPDATE clientes SET nm_bairro = '".$nm_bairro."' WHERE id_cliente = ".$id_cliente." ");
	
	$sql = mysql_query("UPDATE clientes SET dt_nascimento = '".$dt_nascimento."' WHERE id_cliente = ".$id_cliente." ");	
		
	$msg_sucesso = "Registro alterado com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cliente_alt.php");
}
public function inserirCliente($id_cliente,$tipo_pessoa,$nm_cliente,$nm_razao,$nu_cnpj_cpf,$nm_contato,$dt_nascimento,$nu_inscricao,$nu_telefone,$nu_celular,
	$nu_fax,$te_email,$nm_logradouro,$nu_logra,$nm_bairro,$nm_cidade,$nu_cep,$nm_uf){
	$dt_nascimento = substr($dt_nascimento,6,4)."-".substr($dt_nascimento,3,2)."-".substr($dt_nascimento,0,2);
	
	$selecao = mysql_query("SELECT * FROM clientes WHERE nu_cnpj_cpf = '".$nu_cnpj_cpf."' ");
	$row_sel = mysql_num_rows($selecao);
	if ( $row_sel > 0 ){
	$msg_erro = "Cliente já cadastrado.";
		$_SESSION['msg_erro'] = $msg_erro;		
		header ("location: cliente.php");
	} else {
	
	$sql = mysql_query("INSERT INTO clientes (nm_cliente,nm_razao,nu_cnpj_cpf,nm_contato,dt_nascimento,nu_inscricao,nu_telefone,nu_celular,nu_fax,te_email,nm_logradouro,
	nu_logra,nm_bairro,nm_cidade,nu_cep,nm_uf) 
	VALUES('".$nm_cliente."','".$nm_razao."','".$nu_cnpj_cpf."','".$nm_contato."','".$dt_nascimento."','".$nu_inscricao."','".$nu_telefone."','".$nu_celular."',
	'".$nu_fax."','".$te_email."','".$nm_logradouro."','".$nu_logra."','".$nm_bairro."','".$nm_cidade."','".$nu_cep."','".$nm_uf."')");
	
	$msg_sucesso = "Registro inserido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cliente.php");
}
}
public function alterarCor($id_cor,$nm_cor){

	$sql = mysql_query("UPDATE cores SET nm_cor = '".$nm_cor."' WHERE id_cor = ".$id_cor." ");
		
	$msg_sucesso = "Registro alterado com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cor_alt.php");
}
public function excluirCor($id_cor){
	
	$sql = mysql_query("SELECT * FROM vendas_detalhes WHERE id_cor = ".$id_cor." ");
	$row = mysql_num_rows($sql);
	if ( $row > 0 ){
	$sql = mysql_query("UPDATE cores SET id_status = 4 WHERE id_cor = ".$id_cor." ");
	$msg_sucesso = "Registro cancelado com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cor_impress.php");
	} else {
	$sql = mysql_query("DELETE FROM cores WHERE id_cor = ".$id_cor." ");
	$msg_sucesso = "Registro excluido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cor_impress.php");
	}
}
public function inserirCor($nm_cor){
	
	$sql = mysql_query("INSERT INTO cores (nm_cor,nm_cor1) VALUES('".$nm_cor."')");
	
	$msg_sucesso = "Registro inserido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: cor.php");
}
public function excluirProduto($id_produto){
	$sql = mysql_query("SELECT * FROM vendas_detalhes WHERE id_produto = ".$id_produto." ");
	$row = mysql_num_rows($sql);
	if ( $row > 0 ){
	$sql = mysql_query("UPDATE produtos SET id_status = 4 WHERE id_produto = ".$id_produto." ");
	$msg_sucesso = "Registro cancelado com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: produto_impress.php");
	} else {
	$sql = mysql_query("DELETE FROM produtos WHERE id_produto = ".$id_produto." ");
	$msg_sucesso = "Registro excluido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: produto_impress.php");
	}
}
public function excluirVenda($id_venda){

	//$sql = mysql_query("DELETE FROM vendas WHERE vl_total = '' ");
	$sql = mysql_query("DELETE FROM vendas WHERE st_controle = '1' ");
	$sql = mysql_query("UPDATE vendas SET vl_total = '' WHERE id_venda = ".$id_venda." ");
	$sql = mysql_query("UPDATE vendas SET id_status = 4 WHERE id_venda = ".$id_venda." ");
	$sql = mysql_query("UPDATE vendas SET te_msg = 'Canc.' WHERE id_venda = ".$id_venda." ");
	$sql = mysql_query("UPDATE vendas SET id_status = 4 WHERE id_venda = ".$id_venda." ");
	$sql = mysql_query("UPDATE vendas_detalhes  SET id_status = 4 WHERE id_venda = ".$id_venda." ");
	
	$msg_sucesso = "Registro cancelado com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: venda_impress.php");
}

public function alterarProduto($id_produto,$nm_produto,$nm_produto1,$pc_produto){

	$sql = mysql_query("UPDATE produtos SET nm_produto = '".$nm_produto."' WHERE id_produto = ".$id_produto." ");
	$sql = mysql_query("UPDATE produtos SET nm_produto1 = '".$nm_produto1."' WHERE id_produto = ".$id_produto." ");
	$sql = mysql_query("UPDATE produtos SET pc_produto = ".$pc_produto." WHERE id_produto = ".$id_produto." ");
	
	$msg_sucesso = "Registro alterado com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: produto_alt.php");
}
public function inserirProduto($nm_produto,$nm_produto1,$pc_produto){

	$sel = mysql_query("SELECT * FROM produtos WHERE nm_produto1 = '".$nm_produto1."' ");
	$row = mysql_num_rows($sel);
	for ( $j=0; $j < $row; $j++ ){
	$id_produto  = mysql_result($sel, $j, "id_produto"); 
	}
	if ($row>0){
	$msg_erro = "Código já cadastrado";
	$_SESSION['msg_erro'] = $msg_erro;
	header ("location: produto.php");
	} else {
	$sql = mysql_query("INSERT INTO produtos (nm_produto,nm_produto1,pc_produto) VALUES('".$nm_produto."','".$nm_produto1."','".$pc_produto."')");

	$msg_sucesso = "Registro inserido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: produto.php");
	}
	
}
public function pesquisarCliente($nm_cliente,$nu_cnpj_cpf){
	
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	
	$_SESSION['nm_cliente'] = $nm_cliente;
	$_SESSION['nu_cnpj_cpf'] = $nu_cnpj_cpf;
	header ("location: cliente_impress.php");
}
public function pesquisarCor($nm_cor,$nu_codigo){

	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_produto']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	
	$_SESSION['nm_cor'] = $nm_cor;
	$_SESSION['nu_codigo'] = $nu_codigo;
	header ("location: cor_impress.php");
}
public function pesquisarProduto($nm_produto,$nu_codigo){

	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_produto']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	
	$_SESSION['nm_produto'] = $nm_produto;
	$_SESSION['nu_codigo'] = $nu_codigo;
	header ("location: produto_impress.php");
}
public function pesquisarVenda($nu_venda,$nu_cnpj_cpf){
	
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	
	$_SESSION['nu_cnpj_cpf'] = $nu_cnpj_cpf;	
	$_SESSION['nm_cliente'] = $nm_cliente;
	header ("location: venda_impress.php");
}
public function abrirProduto(){
	
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	
	
	header ("location: produto.php");
}
public function abrirProdutoAlt($id_produto){
	
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	
	$_SESSION['id_produto'] = $id_produto;
	header ("location: produto_alt.php");
}
public function abrirProdutoImpres(){
	
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	
	
	header ("location: produto_impress.php");
}
public function abrirCor(){

	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_cor']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	
	header ("location: cor.php");
}
public function abrirCorAlt($id_cor){

	unset($_SESSION['nu_venda']);	
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	
	$_SESSION['id_cor'] = $id_cor;
	header ("location: cor_alt.php");
}
public function abrirCorImpres(){
	
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	
	
	header ("location: cor_impress.php");
}
public function abrirVenda(){
	unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	
	$sql = mysql_query("DELETE FROM vendas WHERE st_controle = '1' ");
	unset($_SESSION['id_venda']);
	$nu_ano = date("Y");
	$sql = mysql_query("SELECT max(nu_venda) AS nu_venda FROM vendas WHERE nu_ano = ".$nu_ano." ");
	$row = mysql_num_rows($sql);
	for ($a=0;$a<$row;$a++){	
	$nu_venda = mysql_result($sql, $a, "nu_venda");
	$nu_venda = $nu_venda + 1;
	}	
	$_SESSION['nu_venda'] = $nu_venda;
	$_SESSION['nu_ano'] = $nu_ano;
		
	header ("location: venda.php");
}
public function abrirVendaRelPdf(){
	
	//unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	
	
	header ("location: venda_relatorio_pdf.php");
}
public function abrirVendaRelHtml(){
	
	//unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	
	
	header ("location: venda_relatorio_html.php");
}
public function abrirVendaImpres(){	
	
	//unset($_SESSION['nu_venda']);
	unset($_SESSION['id_venda_det']);
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_erro']);
	header ("location: venda_impress.php");
}
public function inserirVenda($dt_entrega,$id_cliente,$nu_nota,$nu_prazo,$te_obs,$nm_contato_venda,$nm_aplicacao,$id_frete,$nm_transp,$nu_tel_transp,$nu_venda,$nu_ano,
$id_pagamento){
	
	$sql_sel = mysql_query("SELECT * FROM vendas WHERE nu_nota = '".$nu_nota."'  ");
	$row_sel = mysql_num_rows($sql_sel);
	for ($b=0;$b<$row_sel;$b++){	
	$nu_nota = mysql_result($sql_sel, $b, "nu_nota");
	}	
	
	if ( $row_sel > 0 ){
	$msg_erro = "Nota Fiscal já cadastrada";
	$_SESSION['msg_erro'] = $msg_erro;
	header ("location: venda.php");
	
	} else {
	unset($_SESSION['msg_erro']);
	$del = mysql_query("DELETE FROM vendas WHERE st_controle = '1' ");
	$dt_venda = date("Y-m-d");
	$dt_vencimento = date('d-m-Y', strtotime(" + $nu_prazo days"));
	$dt_entrega = substr($dt_entrega,6,4)."-".substr($dt_entrega,3,2)."-".substr($dt_entrega,0,2);
	$dt_vencimento = substr($dt_vencimento,6,4)."-".substr($dt_vencimento,3,2)."-".substr($dt_vencimento,0,2);
	$hora = date("H:i:s", mktime(gmdate("H")-3, gmdate("i"), gmdate("s")));  
	$hr_venda = $hora;
	if ( $id_pagamento == 1 )
	$nu_prazo = 0;
	$sql = mysql_query("INSERT INTO vendas (dt_entrega,dt_venda,hr_venda,nu_nota,nu_prazo,dt_vencimento,id_cliente,nu_venda,nu_ano,id_pagamento,te_obs,nm_contato_venda,
	nm_aplicacao,id_frete,nm_transp,nu_tel_transp,id_usuario) 
	VALUES('".$dt_entrega."','".$dt_venda."','".$hr_venda."','".$nu_nota."',".$nu_prazo.",'".$dt_vencimento."',".$id_cliente.",".$nu_venda.",".$nu_ano.",
	".$id_pagamento.",'".$te_obs."','".$nm_contato_venda."','".$nm_aplicacao."',".$id_frete.",'".$nm_transp."','".$nu_tel_transp."',".$_SESSION['id_usuario'].")");
	
	$selecao = mysql_query("SELECT max(id_venda) AS id_venda FROM vendas");
	$linhas = mysql_num_rows($selecao);
	for ($a=0;$a<$linhas;$a++){	
	$id_venda = mysql_result($selecao, $a, "id_venda");
	}	

	$sql = mysql_query("SELECT * FROM clientes WHERE id_cliente = ".$id_cliente." ");
	$row = mysql_num_rows($sql);
	for ($b=0;$b<$row;$b++){	
	$nm_cliente = mysql_result($sql, $b, "nm_cliente");
	}	
	
	$_SESSION['id_venda'] = $id_venda;
	$_SESSION['nu_venda'] = $nu_venda;
	$_SESSION['nu_ano'] = $nu_ano;
	$_SESSION['nm_cliente'] = $nm_cliente;
	
	header ("location: venda_detalhes.php");
	}
	
}
public function inserirVendaDet($id_venda,$qt_venda,$qt_emb,$vl_venda,$nu_desc,$id_produto,$id_grandeza,$id_cor,$id_emb){
	unset($_SESSION['id_venda']);
	
	if ( $id_produto == 0 ){
		$msg_erro = "Campo Produto: Preenchimento obrigatório";
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
		} else if ( $id_grandeza == 0 ){
		$msg_erro = "Campo Grandeza: Preenchimento obrigatório";
		$_SESSION['msg_erro'] = $msg_erro;
		header ("location: venda_detalhes.php");
		} else if ( ($vl_venda == 0) || ($vl_venda == "") ){
		$msg_erro = "Campo Valor Unitário: Preenchimento obrigatório";
		$_SESSION['msg_erro'] = $msg_erro;
		header ("location: venda_detalhes.php");
		} else {
	
	$sql = mysql_query("INSERT INTO vendas_detalhes (id_venda,qt_venda,qt_emb,vl_venda,nu_desc,id_produto,id_grandeza,id_cor,id_emb) 
	VALUES(".$id_venda.",".$qt_venda.",".$qt_emb.",".$vl_venda.",".$nu_desc.",".$id_produto.",".$id_grandeza.",".$id_cor.",".$id_emb.")");
	
	$up = mysql_query("UPDATE vendas SET st_controle = '2' WHERE id_venda = ".$id_venda." ");
	
	$sql = mysql_query("SELECT * FROM vendas_detalhes, produtos WHERE vendas_detalhes.id_produto = produtos.id_produto AND id_venda = ".$id_venda." ");
	$row = mysql_num_rows($sql);
	for ($b=0;$b<$row;$b++){	
	$id_venda_det = mysql_result($sql, $b, "id_venda_det");
	$nu_desc = mysql_result($sql, $b, "nu_desc");
    $vl_venda = mysql_result($sql, $b, "vl_venda");
    $qt_venda = mysql_result($sql, $b, "qt_venda");
    $pc_produto = mysql_result($sql, $b, "pc_produto");
    $vl_percentual = ($vl_venda*$pc_produto)/100;  
    $vl_final = ($qt_venda*$vl_venda)-($qt_venda*$nu_desc*$vl_venda)/100;
    $total = $total + $vl_final ; 
	$id_venda = mysql_result($sql, $b, "id_venda");
	}	
	
	$up = mysql_query("UPDATE vendas SET vl_total = ".$total." WHERE id_venda = ".$id_venda." ");
		
	$selecao = mysql_query("SELECT max(id_venda) AS id_venda FROM vendas");
	$linhas = mysql_num_rows($selecao);
	for ($c=0;$c<$linhas;$c++){	
	$id_venda = mysql_result($selecao, $c, "id_venda");
	}
	if ($b > 13){
	$_SESSION['id_venda'] = $id_venda;
	$_SESSION['b'] = $b;	
	$_SESSION['id_venda_det'] = $id_venda_det;
    $msg_sucesso = "Registro";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: venda_comprovante.php");
	} else {
	$_SESSION['id_venda'] = $id_venda;
	$_SESSION['b'] = $b;	
	$_SESSION['id_venda_det'] = $id_venda_det;
    $msg_sucesso = "Registro inserido com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: venda_detalhes.php");
	}
}
}
public function imprimirComprovante($id_venda){

	$_SESSION['id_venda'] = $id_venda;
	header ("location: venda_comprovante.php");

}
}
?>