<?php
$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$bandeira  = mysql_real_escape_string($_POST['inputBandeira']);
$nome 	   = utf8_decode(mysql_real_escape_string($_POST['inputNome']));
$latitude  = mysql_real_escape_string($_POST['inputLocalizacaoLat']);
$longitude = mysql_real_escape_string($_POST['inputLocalizacaoLon']);
$gasolina  = mysql_real_escape_string($_POST['gasolina']);
$alcool    = mysql_real_escape_string($_POST['alcool']);
$diesel	   = mysql_real_escape_string($_POST['diesel']);
$gnv	   = mysql_real_escape_string($_POST['gnv']);

$jsonGoogle = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude);
$data = json_decode($jsonGoogle, TRUE);

$itensEndereco = $data['results'][0]['address_components'];
$numero = $itensEndereco[0]['short_name'];
$rua 	= $itensEndereco[1]['short_name'];
$bairro = $itensEndereco[2]['long_name'];
$cidade = $itensEndereco[3]['long_name'];
$estado = $itensEndereco[5]['short_name'];

$endereco 	=  $rua.", ".$bairro.", ".$cidade."-".$estado;

$sql = " insert into posto (nome,
							bandeira,
							endereco,
							longitude,
							latitude,
							gasolina,
							alcool,
							diesel,
							gnv,
							data_cadastro,
							data_atualizacao)
					VALUES
					('".$nome."',
					'".$bandeira."',
					'".$endereco."',
					'".$longitude ."',
					'".$latitude ."',
					'".$gasolina ."',
					'".$alcool ."',
					'".$diesel ."',
					'".$gnv."',
					'".date('Y-m-d H:i:s')."',
					'".date('Y-m-d H:i:s')."')";

$result = mysql_query($sql);

if($result){
	echo "1";
}else{
	echo "error = ".mysql_error();
}
mysql_close();
?>