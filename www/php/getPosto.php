<?php

$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$id_posto  = mysql_real_escape_string($_GET['posto_id']);

$sql = " select * from posto where codigo_posto = ".$id_posto;

$result = mysql_query($sql);

if($result){
	$posto = mysql_fetch_object($result);
	

	$dados_posto['codigo'] = $posto->codigo_posto;
	$dados_posto['nome'] = utf8_encode($posto->nome);
	$dados_posto['bandeira'] = $posto->bandeira;
	$dados_posto['longitude'] = $posto->longitude;
	$dados_posto['latitude'] = $posto->latitude;
	$dados_posto['gasolina'] = $posto->gasolina;
	$dados_posto['alcool'] = $posto->alcool;
	$dados_posto['diesel'] = $posto->diesel;
	$dados_posto['gnv'] = $posto->gnv;
	$dados_posto['endereco'] = utf8_encode($posto->endereco);

	$somaN = ((1*$posto->estrela1) + (2*$posto->estrela2) + (3*$posto->estrela3) + (4*$posto->estrela4) + (5*$posto->estrela5));
	$somaVotos = ($posto->estrela1 + $posto->estrela2 + $posto->estrela3 + $posto->estrela4 + $posto->estrela5);
	$media = $somaN / $somaVotos;
	$dados_posto['mediaVotacao'] = number_format($media, 2, '.', '');
	
	echo json_encode($dados_posto);//('dados_posto');
	die();
}else{
	echo json_encode("error = ".mysql_error());
	//echo "error = ".mysql_error();
}
mysql_close();
?>.