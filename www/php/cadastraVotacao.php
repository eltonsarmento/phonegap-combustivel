<?php
$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$codigoPosto  = mysql_real_escape_string($_POST['posto_id']);
$votacao  = mysql_real_escape_string($_POST['votacao']);


$sql = " select * from posto where codigo_posto = ".$codigoPosto;

$result = mysql_query($sql);

if($result){
	$posto = mysql_fetch_object($result);
	
	if($votacao == 1){
		$novoValorVotacao =  $posto->estrela1 + 1;
	}elseif ($votacao == 2) {
		$novoValorVotacao =  $posto->estrela2 + 1;
	}elseif ($votacao == 3) {
		$novoValorVotacao =  $posto->estrela3 + 1;
	}elseif ($votacao == 4) {
		$novoValorVotacao =  $posto->estrela4 + 1;
	}elseif ($votacao == 5) {
		$novoValorVotacao =  $posto->estrela5 + 1;
	}
	
	// ATUALIZA COM A NOVA VOTAÇÃO
	$sql = "update posto set estrela".$votacao." = '".$novoValorVotacao."' where codigo_posto = '".$codigoPosto."'";

	$result = mysql_query($sql);
	if($result){
		// BUSCA MÉDIA DE VOTAÇÃO
		$sql = " 
				SELECT ((1*estrela1)+(2*estrela2)+(3*estrela3)+(4*estrela4)+(5*estrela5)) / (estrela1 + estrela2 + estrela3 + estrela4 + estrela5) as media
				FROM  posto where codigo_posto = ".$codigoPosto;

		$result = mysql_query($sql);
		if($result){
			$posto = mysql_fetch_object($result);
			echo number_format($posto->media, 2, '.', '');
		}	
	}
}else{
	echo "error = ".mysql_error();
}
mysql_close();
?>