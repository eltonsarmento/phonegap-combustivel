<?php

$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$id  = mysql_real_escape_string($_GET['id']);
$login  = mysql_real_escape_string($_GET['login']);

if($login != ""){
	$sqlExtra = " login = '".$login."'";
}else{
	$sqlExtra = " codigoUsuario = ".$id;
}

$sql = " select * from usuarios where ".$sqlExtra;

$result = mysql_query($sql);

if($result){
	$posto = mysql_fetch_object($result);
	

	$teste['codigo'] = $posto->codigoUsuario;
	$teste['nome']   = utf8_encode($posto->nome);
	$teste['login']  = utf8_encode($posto->login);
	$teste['email']  = utf8_encode($posto->email);

	
	echo json_encode($teste);//('teste');
	die();
}else{
	echo json_encode("error = ".mysql_error());
	//echo "error = ".mysql_error();
}
mysql_close();
?>.