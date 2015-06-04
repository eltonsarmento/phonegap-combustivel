<?php
$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$codigoPosto  = mysql_real_escape_string($_POST['codigoPosto']);
$gasolina  = mysql_real_escape_string($_POST['gasolina']);
$alcool    = mysql_real_escape_string($_POST['alcool']);
$diesel	   = mysql_real_escape_string($_POST['diesel']);
$gnv	   = mysql_real_escape_string($_POST['gnv']);


$sql = " update  posto 
		 set gasolina = '".$gasolina ."',
		     alcool   = '".$alcool ."',
			 diesel   = '".$diesel ."',
			 gnv 	  = '".$gnv."' 
		where codigo_posto = '".$codigoPosto."'";
					

$result = mysql_query($sql);

if($result){
	echo "1";
}else{
	echo "error = ".mysql_error();
}
mysql_close();
?>