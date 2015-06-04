<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$id_posto    = mysql_real_escape_string($_POST['codigoPosto']);
$id_usuario  = mysql_real_escape_string($_POST['codigoUsuario']);

$sql = " delete from posto_favorito where codigo_posto = ".$id_posto . " and codigo_usuario = ".$id_usuario;

$result = mysql_query($sql);

if($result){
	echo "1";
	die();
}else{
	echo json_encode("error = ".mysql_error());
	//echo "error = ".mysql_error();
}
mysql_close();
?>.