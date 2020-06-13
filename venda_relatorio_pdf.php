<?php

define("FPDF_FONTPATH","fpdf/font/");
//include ('fpdf/fpdf.php');
require('fpdf.php');
class PDF extends FPDF {
   //Método Header que estiliza o cabeçalho da página
   function Header() {
      //insere e posiciona a imagem/logomarca
      //$this->Image('img/b_fios.jpg',17,6,50,30);

      //Informa a fonte, seu estilo e seu tamanho     
      $this->SetFont('Arial','B',12);

   }

   //Método Footer que estiliza o rodapé da página
   function Footer() {

      //posicionamos o rodapé a 1cm do fim da página
      $this->SetY(-10);
      
      //Informamos a fonte, seu estilo e seu tamanho
      $this->SetFont('Arial','I',8);

      //Informamos o tamanho do box que vai receber o conteúdo do rodapé
      //e inserimos o número da página através da função PageNo()
      //além de informar se terá borda e o alinhamento do texto
	 
      $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
   }
}
require_once("conexao.php");
$mysql = new Mysql();
$mysql->conectar();
//$pdf = new FPDF('P','cm','A4');
$pdf=new PDF('P');
$pdf->AddPage();
//$pdf->Image("img/arvore.jpg",9,1,3,3);
$pdf->SetFont('Arial', 'B', 16);


//$numero = str_pad($nu_venda, 5, "0", STR_PAD_LEFT);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(20, 20);
$texto = "BAHIA FIOS LTDA";
$pdf->Cell(0,0.5,$texto, 4, 'J');
$pdf->SetXY(70, 35);
$texto = "RELATÓRIO GERAL DE VENDAS";
$pdf->Cell(0,0.5,$texto, 4, 'J');

// 1. Linha
$pdf->Rect(20, 40, 170, 0 , "D");
// inicia 2. pagina
//$pdf->AddPage('','');
$pdf->SetFont('Arial', 'B', 8);

 $sql = mysql_query("SELECT * 
  FROM vendas, clientes
  WHERE vendas.id_cliente = clientes.id_cliente
  ORDER BY nu_venda, nu_ano DESC");

// 5. Retangulo
//$pdf->Rect(20, 138, 93, 5 , "D");

// 6. Retangulo
//$pdf->Rect(113, 138, 42, 5 , "D");

// 7. Retangulo
//$pdf->Rect(155, 138, 45, 5 , "D");



$pdf->SetFont('Arial', 'B', 9);

$pdf->SetXY(20, 40);
$pdf->Cell(40,5,'CLIENTE');
$pdf->SetXY(82, 40);
$pdf->Cell(40,5,'CNPJ/CPF');
$pdf->SetXY(111, 40);
$pdf->Cell(40,5,'DATA');
$pdf->SetXY(130, 40);
$pdf->Cell(40,5,'F. PAGTO');
$pdf->SetXY(150, 40);
$pdf->Cell(40,5,'N./ANO');
$pdf->SetXY(165, 40);
$pdf->Cell(40,5,'TOTAL');
$pdf->SetXY(180, 40);
$pdf->Cell(40,5,'OBS');
$i = 0;
while ( $vetor = mysql_fetch_array($sql) ){
$total = $total + $vetor['vl_total'];
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
$pdf->Cell(0,5,$vetor['vl_total'] = number_format($vetor['vl_total'],3,",",""));
$pdf->SetX(180);
$pdf->Cell(0,5,$vetor['te_msg']);
$i = $i + 1;
}
$hora = date("H:i:s", mktime(gmdate("H")-3, gmdate("i"), gmdate("s")));  

$pdf->SetFont('Arial', 'B', 8);
$pdf->Rect(20, 274, 174, 0 , "D");
$pdf->SetXY(20, 276);
$texto = "ITENS: ".$i;
$pdf->Cell(0,0.5,$texto, 4, 'L');
$pdf->SetXY(75, 276);
$texto = "DATA EMISSÃO: ".date("d/m/Y")." ".$hora;
$pdf->Cell(0,0.5,$texto, 4, 'L');
$pdf->SetXY(155, 276);
$texto = "TOTAL: R$ ".$total = number_format($total,3,",","");
$pdf->Cell(0,0.5,$texto, 4, 'L');
/*$pdf->SetFont('Arial', 'B', 10);
$pdf->Rect(20, 273, 174, 0 , "D");
$pdf->SetXY(20, 276);
$texto = "ITENS: ".$i;
$pdf->Cell(0,0.5,$texto, 4, 'R');
$pdf->SetXY(155, 276);
$texto = "TOTAL: R$ ".$total = number_format($total,3,",","");
$pdf->Cell(0,0.5,$texto, 4, 'L');*/
//$pdf->Rect(20, 250, 174, 0 , "D");

// 8. Retangulo
//$pdf->Rect(72, 243, 70, 17 , "D");




$pdf->Output();

?>