<?php
	$sql_select_all = "SELECT * FROM cores ";
	$sql_query_all = mysql_query($sql_select_all);
	$total_registros = mysql_num_rows($sql_query_all);
	$pags = ceil($total_registros/$qnt);
	$max_links = 3;
	echo "<a href='cor_impress.php?p=1' target='_self'><font size='2' face='Arial, Helvetica, sans-serif'>Início</font></a> ";
	for($i = $p-$max_links; $i <= $p-1; $i++) {
	// Se o número da página for menor ou igual a zero, não faz nada
	// (afinal, não existe página 0, -1, -2..)
	if($i <=0) {
	//faz nada
	// Se estiver tudo OK, cria o link para outra página
	} else {
	echo "<a href='cor_impress.php?p=".$i."' target='_self'>".$i."</a> ";
	}
	}
	// Exibe a página atual, sem link, apenas o número
	echo $p." ";
	// Cria outro for(), desta vez para exibir 3 links após a página atual
	for($i = $p+1; $i <= $p+$max_links; $i++) {
	// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
	if($i > $pags)
	{
	//faz nada
	}
	// Se tiver tudo Ok gera os links.
	else
	{
	echo "<a href='cor_impress.php?p=".$i."' target='_self'>".$i."</a> ";
	}
	}
	// Exibe o link "última página"
	echo "<a href='cor_impress.php?p=".$pags."' target='_self'><font size='2' face='Arial, Helvetica, sans-serif'>Fim</font></a> ";
	
	?>