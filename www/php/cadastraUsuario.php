<?php
$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$nome	   = mysql_real_escape_string($_POST['Nome']);
$login	   = mysql_real_escape_string($_POST['Login']);
$email	   = mysql_real_escape_string($_POST['Email']);
$senha 	   = md5(mysql_real_escape_string($_POST['inputSenha']));
$data_cadastro = date("Y-m-d H:m:i");
$nivel  = 'N';
$ativo = 1;

$sql = " insert into usuarios (nome,
							  login,
							  email,
							  senha,
							  dataCadastro,
							  nivel,
							  ativo,
							  excluido)
					VALUES
					('".$nome."',
					'".$login."',
					'".$email."',
					'".$senha."',
					'".$data_cadastro."',
					'".$nivel."',
					'".$ativo."',
					 ".0.")";

$result = mysql_query($sql);

if($result){
	echo "1";
}else{
	echo "error = ".mysql_error();
}
mysql_close();
?>