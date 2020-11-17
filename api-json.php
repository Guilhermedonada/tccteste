<html>

<body>

<?php

$dbname = 'tcc';
$dbuser = 'ec2-user';  
$dbpass = 't44zg1g1'; 
$dbhost = '52.14.178.251'; 



$connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";


$json = $_POST["json"];

#$json = '{"0":{"estacao":"AA_01","temperatura":"100"},"1":{"estacao":"AA_01","temperatura":"123"},"2":{"estacao":"AA_01","temperatura":"100"},"3":{"estacao":"AA_01","temperatura":"123"},"4":{"estacao":"AA_01","temperatura":"102"},"5":{"estacao":"AA_01","temperatura":"100"}}';


$lista_registros = (array)json_decode($json);

date_default_timezone_set('America/Sao_Paulo');
$data_horario = date('Y-m-d H:i:s');


#print_r($lista_registros);die();
foreach ($lista_registros as $key => $registro) {
	print_r($registro);
	try{
	$query = "INSERT INTO estacoes (estacao,temperatura, umidade,data_upload,bateria) VALUES ('$registro->estacao','$registro->temperatura', '$registro->umidade', '$data_horario' , '$registro->bateria')";
	}catch(Exception $e){die($e->getMessage());}

	mysqli_query($connect,$query);
}

$query_acoes = "UPDATE acoes SET medir = '0' WHERE id = '1' ";

mysqli_query($connect,$query_acoes);



echo "Insertion Success!<br>";

?>

</body>
</html>
