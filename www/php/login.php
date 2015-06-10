<?php
$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$login = mysql_real_escape_string($_POST['login']);
$senha = md5(mysql_real_escape_string($_POST['senha']));

$sql = "select * from usuarios where login = '".$login."' and senha = '".$senha."'";

$result = mysql_query($sql);

if($result){
	$usuario = mysql_fetch_object($result);
	if($usuario->codigoUsuario) echo "1";
	else echo "0";
}else{
	echo "error = ".mysql_error();
}
mysql_close();
?>