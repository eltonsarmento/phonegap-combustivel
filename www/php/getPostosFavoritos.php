<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$usuario  = mysql_real_escape_string($_GET['usuario']);

$sql = " select p.* 
		from posto p 
		inner join posto_favorito pf on (p.codigo_posto = pf.codigo_posto)
		inner join usuarios u  on (pf.codigo_usuario = u.codigoUsuario)
		where u.codigoUsuario = ".$usuario;

$result = mysql_query($sql);

if($result){
	
	while($posto = mysql_fetch_array($result)) {
		$posto_add['codigo'] 	= $posto['codigo_posto'];
		$posto_add['nome'] 	 	= utf8_encode($posto['nome']);
		$posto_add['bandeira']  = $posto['bandeira'];
		$posto_add['longitude'] = $posto['longitude'];
		$posto_add['latitude']  = $posto['latitude'];
		$posto_add['gasolina']  = $posto['gasolina'];
		$posto_add['alcool'] 	= $posto['alcool'];
		$posto_add['diesel'] 	= $posto['diesel'];
		$posto_add['gnv'] 		= $posto['gnv'];
		if($posto['data_atualizacao'] == ''){
			$data = '2014-01-01';
		}else{
			$data = $posto['data_atualizacao'];
		}

		$posto_add['data_atualizacao'] 	= strftime('%A, %d de %B de %Y', strtotime($data));

		$postos[] = $posto_add;

	}
	
	echo json_encode($postos);//('teste');
	die();
}else{
	echo json_encode("error = ".mysql_error());
	//echo "error = ".mysql_error();
}
mysql_close();
?>.