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

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(20, 38);
$texto = "LADEIRA DA ORDEM TERCEIRA DE S�O FRANCISCO,  6c, CENTRO";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 43);
$texto = "PELOURINHO - CEP 40.025-276, SALVADOR-BA ";
$pdf->Cell(0,0.5,$texto, 4, 'J');

$pdf->SetXY(20, 48);
$texto = "TELS.: 71 3321-8856 / 3506-4960";
$pdf->Cell(0,0.5,$texto, 4, 'J');

//$numero = str_pad($nu_venda, 5, "0", STR_PAD_LEFT);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(70, 60);
$texto = "RELAT�RIO GERAL DE VENDAS";
$pdf->Cell(0,0.5,$texto, 4, 'J');

// 1. Linha
$pdf->Rect(20, 65, 170, 0 , "D");

// 1. Retangulo
//$pdf->Rect(20, 65, 90, 41 , "D");

// 2. Retangulo
//$pdf->Rect(110, 65, 90, 41 , "D");

// 3. Retangulo
//$pdf->Rect(20, 108, 90, 11 , "D");

// 4. Retangulo
//$pdf->Rect(110, 108, 90, 11 , "D");

$pdf->SetFont('Arial', 'B', 8);

 $sql = mysql_query("SELECT * 
  FROM vendas, clientes
  WHERE vendas.id_cliente = clientes.id_cliente
  ORDER BY nu_venda DESC");

// 5. Retangulo
//$pdf->Rect(20, 138, 93, 5 , "D");

// 6. Retangulo
//$pdf->Rect(113, 138, 42, 5 , "D");

// 7. Retangulo
//$pdf->Rect(155, 138, 45, 5 , "D");



$pdf->SetFont('Arial', 'B', 9);

$pdf->SetXY(20, 65);
$pdf->Cell(40,5,'CLIENTE');
$pdf->SetXY(82, 65);
$pdf->Cell(40,5,'CNPJ/CPF');
$pdf->SetXY(111, 65);
$pdf->Cell(40,5,'DATA');
$pdf->SetXY(130, 65);
$pdf->Cell(40,5,'F. PAGTO');
$pdf->SetXY(150, 65);
$pdf->Cell(40,5,'N./ANO');
$pdf->SetXY(165, 65);
$pdf->Cell(40,5,'TOTAL');
$pdf->SetXY(180, 65);
$pdf->Cell(40,5,'OBS');
$i = 0;
while ( $vetor = mysql_fetch_array($sql) ){
if ( $vetor['id_pagamento'] == 1 )
$nm_pagto = "A Vista";
else 
$nm_pagto = "A Prazo";
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(0,5,$vetor['nm_cliente']);
$pdf->SetX(82);
$pdf->Cell(0,5,$vetor['nu_cnpj_cpf']);
$pdf->SetX(111);
$dt_venda = substr($vetor['dt_venda'],8,2)."/".substr($vetor['dt_venda'],5,2)."/".substr($vetor['dt_venda'],0,4);
$pdf->Cell(0,5,$dt_venda);
$pdf->SetX(130);
$pdf->Cell(0,5,$nm_pagto);
$pdf->SetX(150);
$pdf->Cell(0,5,$vetor['nu_venda']."/".$vetor['nu_ano']);
$pdf->SetX(165);
$total = $total + $vetor['vl_total'];
$pdf->Cell(0,5,$vetor['vl_total'] = number_format($vetor['vl_total'],3,",",""));
$pdf->SetX(180);
$pdf->Cell(0,5,$vetor['te_msg']);
$i = $i + 1;
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Rect(20, 273, 174, 0 , "D");
$pdf->SetXY(20, 276);
$texto = "ITENS: ".$i;
$pdf->Cell(0,0.5,$texto, 4, 'R');
$pdf->SetXY(155, 276);
$texto = "TOTAL: R$ ".$total = number_format($total,3,",","");
$pdf->Cell(0,0.5,$texto, 4, 'L');
//$pdf->Rect(20, 250, 174, 0 , "D");

// 8. Retangulo
//$pdf->Rect(72, 243, 70, 17 , "D");






$pdf->Output();
?>
