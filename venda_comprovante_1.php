<?php
session_start();
define("FPDF_FONTPATH","fpdf/font/");
require_once("fpdf/fpdf.php");
$pdf = new FPDF('P'); 
$pdf->Open(); 

$pdf->AddPage(); 


$pdf->Image('img/b_fios.jpg',17,6,50,30);
//LABEL EMPRESA

require_once("conexao.php");
$mysql = new Mysql();
$mysql->conectar();
$id_venda = $_SESSION['id_venda'];

$sql = mysql_query("SELECT * FROM vendas, clientes, usuarios
WHERE id_venda = ".$id_venda." 
AND vendas.id_cliente = clientes.id_cliente
AND vendas.id_usuario = usuarios.id_usuario ");
$row = mysql_num_rows($sql);
	for($i=0; $i<$row; $i++) {
	
	$nm_cliente = mysql_result($sql, $i, "nm_cliente");
	$nm_razao = mysql_result($sql, $i, "nm_razao");
	$nm_contato = mysql_result($sql, $i, "nm_contato");
	$nu_venda = mysql_result($sql, $i, "nu_venda");
	$nu_nota = mysql_result($sql, $i, "nu_nota");
	$nu_ano = mysql_result($sql, $i, "nu_ano");
	$nu_cnpj_cpf = mysql_result($sql, $i, "nu_cnpj_cpf");
	$nu_inscricao = mysql_result($sql, $i, "nu_inscricao");
	$nm_usuario = mysql_result($sql, $i, "nm_usuario");
	$te_email = mysql_result($sql, $i, "te_email");
	$nm_logradouro = mysql_result($sql, $i, "nm_logradouro");
	$nu_logra = mysql_result($sql, $i, "nu_logra");
	$nm_bairro = mysql_result($sql, $i, "nm_bairro");
	$te_obs = mysql_result($sql, $i, "te_obs");
	$nu_cep = mysql_result($sql, $i, "nu_cep");
	$nu_telefone = mysql_result($sql, $i, "nu_telefone");
	$nu_fax = mysql_result($sql, $i, "nu_fax");
	$nm_cidade = mysql_result($sql, $i, "nm_cidade");
	$nu_celular = mysql_result($sql, $i, "nu_celular");
	$nu_tel_transp = mysql_result($sql, $i, "nu_tel_transp");
	$nm_uf = mysql_result($sql, $i, "nm_uf");
	$id_pagamento = mysql_result($sql, $i, "id_pagamento");
	$id_frete = mysql_result($sql, $i, "id_frete");
	$nm_contato_venda = mysql_result($sql, $i, "nm_contato_venda");
	$nm_transp = mysql_result($sql, $i, "nm_transp");
	$nm_aplicacao = mysql_result($sql, $i, "nm_aplicacao");	
	$dt_venda = mysql_result($sql, $i, "dt_venda");
	$dt_venda = substr($dt_venda,8,2)."/".substr($dt_venda,5,2)."/".substr($dt_venda,0,4);
	$dt_entrega = mysql_result($sql, $i, "dt_entrega");
	$dt_entrega = substr($dt_entrega,8,2)."/".substr($dt_entrega,5,2)."/".substr($dt_entrega,0,4);
	$dt_vencimento = mysql_result($sql, $i, "dt_vencimento");
	$dt_vencimento = substr($dt_vencimento,8,2)."/".substr($dt_vencimento,5,2)."/".substr($dt_vencimento,0,4);
	switch($id_pagamento){
	case 1;
	$id_pagamento = "A Vista";
	break;
	case 2;
	$id_pagamento = "A Prazo";
	break;
	}
	switch($id_frete){
	case 1;
	$id_frete = "FOB";
	break;
	case 2;
	$id_frete = "CIF";
	break;
	}
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(20, 38);
$texto = "LADEIRA DA ORDEM TERCEIRA DE SÃO FRANCISCO,  6c, CENTRO";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 43);
$texto = "PELOURINHO - CEP 40.025-276, SALVADOR-BA ";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 48);
$texto = "TELS.: 71 3321-8856 / 3506-4960";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$numero = str_pad($nu_venda, 5, "0", STR_PAD_LEFT);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(60, 60);
$texto = "COMPROVANTE DE ENTREGA:"." ".$numero."/".$nu_ano;
$pdf->Cell(0,0.5,$texto, 4, 'J');

// 1. Retangulo
$pdf->Rect(20, 65, 90, 41 , "D");

// 2. Retangulo
$pdf->Rect(110, 65, 90, 41 , "D");

// 3. Retangulo
$pdf->Rect(20, 108, 90, 11 , "D");

// 4. Retangulo
$pdf->Rect(110, 108, 90, 11 , "D");

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(20, 68);
$texto = "RAZÃO SOCIAL/NOME: ".$nm_razao;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$cnpj_cpf = substr($nu_cnpj_cpf,0,8)."/".substr($nu_cnpj_cpf,8,4)."-".substr($nu_cnpj_cpf,12,2);
$pdf->SetXY(20, 73);
$texto = "CNPJ/CPF: ".$cnpj_cpf;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 78);
$texto = "ENDEREÇO: ".$nm_logra;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 83);
$texto = "BAIRRO: ".$nm_bairro;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 88);
$texto = "CIDADE: ".$nm_cidade;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 93);
$texto = "CONTATO: ".$nm_contato;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 98);
$texto = "APLICAÇÃO: ".$nm_aplicacao;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 103);
$texto = "EMAIL: ".$te_email;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 111);
$texto = "TRANSPORTADORA:  ".$nm_transp;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 116);
$texto = "TEL/CEL: ".$nu_tel_transp;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 68);
$texto = "PEDIDO Nr: ".$nu_nota;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 73);
$texto = "INSCRIÇÃO ESTADUAL: ".$nu_inscricao;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 78);
$texto = "Nr: ".$nu_logra;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$cep = substr($nu_cep,0,5)."-".substr($nu_cep,5,4);     // 57020050
$pdf->SetXY(110, 83);
$texto = "CEP: ".$cep;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 88);
$texto = "ESTADO: ".$nm_uf;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 93);
$texto = "TEL/CEL: ".$nu_telefone." ".$nu_celular;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 103);
$texto = "OBS: ".$te_obs;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 111);
$texto = "CONTATO TRANSPORTE: ".$nm_contato_venda;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 116);
$texto = "FRETE: ".$id_frete;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(110, 98);
$texto = "COND. PAGTO: ".$id_pagamento;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(20, 130);
$texto = "EMISSÃO: ".$dt_venda;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(80, 130);
$texto = "DATA ENTREGA: ".$dt_entrega;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(140, 130);
$texto = "DATA VENCIMENTO: ".$dt_vencimento;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetFont('Arial', 'B', 8);
$id_os = $_SESSION['id_os'];
$sql_for = mysql_query("SELECT * 
FROM vendas_detalhes, produtos, grandezas, cores, embalagens
	WHERE vendas_detalhes.id_produto = produtos.id_produto
	AND vendas_detalhes.id_grandeza = grandezas.id_grandeza
	AND vendas_detalhes.id_emb = embalagens.id_emb
	AND vendas_detalhes.id_cor = cores.id_cor
AND id_venda = ".$id_venda." 
ORDER BY nm_produto");

// 5. Retangulo
$pdf->Rect(20, 138, 93, 5 , "D");

// 6. Retangulo
$pdf->Rect(113, 138, 42, 5 , "D");

// 7. Retangulo
$pdf->Rect(155, 138, 45, 5 , "D");

$pdf->SetXY(55, 140);
$texto = "PRODUTO";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(125, 140);
$texto = "EMBALAGEM";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(170, 140);
$texto = "VALOR";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetFont('Arial', 'B', 9);

$pdf->SetXY(20, 145);
$pdf->Cell(40,5,'CÓD');
$pdf->SetXY(30, 145);
$pdf->Cell(40,5,'ESPECIFICAÇÃO');
$pdf->SetXY(64, 145);
$pdf->Cell(40,5,'QTD');
$pdf->SetXY(75, 145);
$pdf->Cell(40,5,'UF');
$pdf->SetXY(82, 145);
$pdf->Cell(40,5,'COR');
$pdf->SetXY(122, 145);
$pdf->Cell(40,5,'EMB');
$pdf->SetXY(140, 145);
$pdf->Cell(40,5,'QTD');
$pdf->SetXY(158, 145);
$pdf->Cell(40,5,'DESC');
$pdf->SetXY(175, 145);
$pdf->Cell(40,5,'Vl.UNI');
$pdf->SetXY(188, 145);
$pdf->Cell(40,5,'Vl R$');
$i = 0;
$j = 1;
while ( $vetor = mysql_fetch_array($sql_for) ){
$vl_percentual = ($vetor['vl_venda']*$vetor['pc_produto'])/100;
$vl_produto = $vetor['vl_venda'] + $vl_percentual;
$vl_final = ($vetor['qt_venda']*$vl_produto)-($vetor['qt_venda']*$vetor['nu_desc']*$vl_produto)/100;
$vl_fim = ($vetor['qt_venda']*$vl_produto)-($vetor['qt_venda']*$vetor['nu_desc']*$vl_produto)/100;
$codigo = $vetor['nm_produto1'];
$codigo = substr($codigo,0,4);
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(0,5,$codigo);
$pdf->SetX(30);
$pdf->Cell(0,5,$vetor['nm_produto']);
$pdf->SetX(66);
$pdf->Cell(0,5,$vetor['qt_venda']);
$pdf->SetX(75);
$pdf->Cell(0,5,$vetor['nm_grandeza']);
$pdf->SetX(82);
$pdf->Cell(0,5,$vetor['nm_cor']);
$pdf->SetX(122);
$pdf->Cell(0,5,$vetor['nm_emb']);
$pdf->SetX(142);
$pdf->Cell(0,5,$vetor['qt_emb']);
$pdf->SetX(163);
$pdf->Cell(0,5,$vetor['nu_desc']);
$pdf->SetX(175);
$pdf->Cell(0,5,$vl_produto = number_format($vl_produto,2,",",""), 4, "R");
$pdf->SetX(189);
$pdf->Cell(0,5,$vl_final = number_format($vl_final,2,",",""), 4, "R");
$total = $total + $vl_fim ;
$j = $j + 1;
$i = $i + 1;
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Rect(20, 238, 174, 0 , "D");
$pdf->SetXY(20, 240);
$texto = "ITENS: ".$i;
$pdf->Cell(0,0.5,$texto, 4, 'R');
$pdf->SetXY(160, 240);
$texto = "TOTAL: R$ ".$total = number_format($total,2,",","");
$pdf->Cell(0,0.5,$texto, 4, 'L');
//$pdf->Rect(20, 250, 174, 0 , "D");

// 8. Retangulo
$pdf->Rect(72, 243, 70, 17 , "D");

$pdf->SetXY(100, 240);
$texto = "RESUMO";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$m = mysql_query("SELECT * FROM vendas_detalhes, grandezas 
WHERE vendas_detalhes.id_grandeza = grandezas.id_grandeza 
AND vendas_detalhes.id_grandeza = 2
AND id_venda = ".$id_venda." ");
$r_m = mysql_num_rows($m);
 for($a=0; $a<$r_m; $a++) {	
 $id_grandeza = mysql_result($m, $a, "id_grandeza");
 $qt_venda = mysql_result($m, $a, "qt_venda");
 $qt_m = $qt_m + $qt_venda;
}
$pdf->SetXY(73, 246);
$texto = "QTDE/M:................".$qt_m;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$kg = mysql_query("SELECT * FROM vendas_detalhes, grandezas 
WHERE vendas_detalhes.id_grandeza = grandezas.id_grandeza 
AND vendas_detalhes.id_grandeza = 1
AND id_venda = ".$id_venda." ");
$r_kg = mysql_num_rows($kg);
 for($b=0; $b<$r_kg; $b++) {	
 $id_grandeza = mysql_result($kg, $b, "id_grandeza");
 $qt_venda = mysql_result($kg, $b, "qt_venda");
 $qt_kg = $qt_kg + $qt_venda;
}

$pdf->SetXY(73, 251);
$texto = "QTDE/KM:................".$qt_kg;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$emb = mysql_query("SELECT * FROM vendas_detalhes, grandezas 
WHERE vendas_detalhes.id_grandeza = grandezas.id_grandeza
AND id_venda = ".$id_venda." ");
$r_emb = mysql_num_rows($emb);
 for($c=0; $c<$r_emb; $c++) {	
 $id_grandeza = mysql_result($emb, $b, "id_grandeza");
 $qt_emb = mysql_result($emb, $c, "qt_emb");
 $qt_em = $qt_em + $qt_emb;
}

$pdf->SetXY(73, 256);
$texto = "QTDE/EMB:................".$qt_em;
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 270);
$texto = "_____________________";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(24, 275);
$texto = "DATA ENTREGA";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(125, 270);
$texto = "__________________________________";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(133, 275);
$texto = "ASSINATURA RECEBEDOR";
$pdf->Cell(0,0.5,$texto, 4, 'J');




$pdf->Output();
?>
