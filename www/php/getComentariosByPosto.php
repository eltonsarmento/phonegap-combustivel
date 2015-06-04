<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


$con = mysql_connect('localhost:8889','root','root');
if(!$con) die('Não foi possivel conectar: '.mysql_error());
mysql_select_db("combustivel");

$id_posto  = mysql_real_escape_string($_GET['id_posto']);

$sql = " select u.nome, pc.comentario, pc.dataCadastro 
		from posto p 
		inner join posto_comentario pc on (p.codigo_posto = pc.codigo_posto)
		inner join usuarios u  on (pc.codigo_usuario = u.codigoUsuario)
		where p.codigo_posto = '".$id_posto . "' order by pc.dataCadastro desc";

$result = mysql_query($sql);

if($result){
	
	while($posto = mysql_fetch_array($result)) {
		$dados['nome_usuario']  = utf8_encode($posto['nome']);
		$dados['comentario']    = utf8_encode($posto['comentario']);
		$dados['data_cadastro'] = $posto['dataCadastro'];
		
		if($dados['data_cadastro'] == ''){
			$data = '2014-01-01';
		}else{
			$data = $dados['data_cadastro'];
		}

		$dados['hora'] = date('g:i', strtotime($data));
		$dados['sinal'] = strtoupper(date('a', strtotime($data)));
		if(strtotime($data) >= strtotime(date('Y-m-d'))){
			$dados['data_cadastro'] = "Hoje";
		}else{
			$dados['data_cadastro'] 	= strftime('%A, %d de %B de %Y', strtotime($data));
		}

		$comentariosPosto['comentarios'][] = $dados;

	}
	
	echo json_encode($comentariosPosto);//('teste');
	die();
}else{
	echo json_encode("error = ".mysql_error());
	//echo "error = ".mysql_error();
}
mysql_close();
?>.