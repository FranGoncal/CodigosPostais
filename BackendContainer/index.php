<?php

header("Access-Control-Allow-Origin: *");


function json_response($message = null, $code = 200)
{
    // clear the old headers
    //header_remove();
	
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is disabled
    header("Cache-Control: no-store");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode($message,JSON_UNESCAPED_SLASHES);
}


// if you are doing ajax with application-json headers
if (empty($_POST)) {
    $_POST = json_decode(file_get_contents("php://input"), true) ? : [];
}

if (isset($_GET['num_cod_postal']))
	$num_cod_postal=strval($_GET['num_cod_postal']);

if (isset($_GET['ext_cod_postal']))
	$ext_cod_postal=strval($_GET['ext_cod_postal']);

//print_r($num_cod_postal);
//print_r($ext_cod_postal);

if (!empty($num_cod_postal)) {
	$db = new SQLite3('/var/www/codigos_postais.sqlite3',SQLITE3_OPEN_READWRITE);

	if (!empty($ext_cod_postal)) {
		$stmt = $db->prepare("select * from codigos WHERE num_cod_postal=? AND ext_cod_postal=?;");
		$stmt->bindValue(1,$num_cod_postal,SQLITE3_TEXT);
		$stmt->bindValue(2,$ext_cod_postal,SQLITE3_TEXT);
	}
	else {
		$stmt = $db->prepare("select * from codigos WHERE num_cod_postal=?;");
		$stmt->bindValue(1,$num_cod_postal,SQLITE3_TEXT);
	}

	$results = $stmt->execute();

	if ($row = $results->fetchArray()) {
		$mess['result']='ok';
		$mess['cod_distrito']=$row['cod_distrito'];
		$mess['cod_concelho']=$row['cod_concelho'];
		if (!empty($ext_cod_postal)) {
			$mess['cod_localidade']=$row['cod_localidade'];
			$mess['nome_localidade']=$row['nome_localidade'];
			$mess['cod_arteria']=$row['cod_arteria'];
			$mess['tipo_arteria']=$row['tipo_arteria'];
			$mess['prep1']=$row['prep1'];
			$mess['titulo_arteria']=$row['titulo_arteria'];
			$mess['prep2']=$row['prep2'];
			$mess['nome_arteria']=$row['nome_arteria'];
			$mess['local_arteria']=$row['local_arteria'];
			$mess['troco']=$row['troco'];
			$mess['porta']=$row['porta'];
			$mess['cliente']=$row['cliente'];
		}
			$mess['num_cod_postal']=$row['num_cod_postal'];
		if (!empty($ext_cod_postal))
			$mess['ext_cod_postal']=$row['ext_cod_postal'];
		$mess['desig_postal']=$row['desig_postal'];
	}
	else
		$mess['result']='not found';
		
	//print_r($res);
	$db->close(); 

	echo json_response($mess);
}

else {
	$res['result']='missing parameters';
	echo json_response($res);
}
 
?>


