<?php
$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$codigoPosto  = mysql_real_escape_string($_POST['codigoPosto']);
$codigoUsuario  = mysql_real_escape_string($_POST['codigoUsuario']);

$sql = " insert into posto_favorito (codigo_posto,
							codigo_usuario)
					VALUES
					('".$codigoPosto."',
					'".$codigoUsuario."')";

$result = mysql_query($sql);

if($result){
	echo "1";
}else{
	echo "error = ".mysql_error();
}
mysql_close();
?>