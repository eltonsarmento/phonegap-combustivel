<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$id_posto    = mysql_real_escape_string($_GET['codigoPosto']);
$id_usuario  = mysql_real_escape_string($_GET['codigoUsuario']);

$sql = " select count(*)
		from posto_favorito p 
		inner join posto_favorito pf on (p.codigo_posto = pf.codigo_posto)
		inner join usuarios u  on (pf.codigo_usuario = u.codigoUsuario)
		where p.codigo_posto = ".$id_posto . " and u.codigoUsuario = ".$id_usuario;

$result = mysql_query($sql);

if($result){
	$posto = mysql_fetch_array($result);
	if($posto[0] > 0 ){
		echo "1";
	}else{
		echo "0";
	}

	die();
}else{
	echo json_encode("error = ".mysql_error());
	//echo "error = ".mysql_error();
}
mysql_close();
?>.