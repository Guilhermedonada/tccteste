<html>

<body>

<?php

$dbname = 'tcc';
$dbuser = 'ec2-user';  
$dbpass = 't44zg1g1'; 
$dbhost = '3.21.242.90'; 



$connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";


$json = $_GET["json"];

#$json = '{"0":{"estacao":"AA_01","temperatura":"100"},"1":{"estacao":"AA_01","temperatura":"123"},"2":{"estacao":"AA_01","temperatura":"100"},"3":{"estacao":"AA_01","temperatura":"123"},"4":{"estacao":"AA_01","temperatura":"102"},"5":{"estacao":"AA_01","temperatura":"100"}}';


$lista_registros = (array)json_decode($json);


#print_r($lista_registros);die();
foreach ($lista_registros as $key => $registro) {
	print_r($registro);
	try{
	$query = "INSERT INTO estacoes (estacao,temperatura, umidade) VALUES ('$registro->estacao','$registro->temperatura', '$registro->umidade')";
	}catch(Exception $e){die($e->getMessage());}

	mysqli_query($connect,$query);
}

$query_acoes = "UPDATE acoes SET medir = '0' WHERE id = '1' ";

mysqli_query($connect,$query_acoes);



echo "Insertion Success!<br>";

?>

</body>
</html>
