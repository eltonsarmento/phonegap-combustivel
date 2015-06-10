<?php

$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$sql = " select * from ajuda";

$result = mysql_query($sql);

if($result){
	
	while($ajuda = mysql_fetch_array($result)) {

		$dados_ajuda['nome'] = $ajuda['nome'];
		$dados_ajuda['descricao'] = $ajuda['descricao'];
		$dados_ajuda['imagem'] = $ajuda['imagem'];
		

		$listaAjuda['ajudas'][] = $dados_ajuda;
	}
	echo json_encode($listaAjuda);//('dados_posto');
	die();
}else{
	echo json_encode("error = ".mysql_error());
	//echo "error = ".mysql_error();
}
mysql_close();
?>.