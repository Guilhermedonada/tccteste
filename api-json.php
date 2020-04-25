<html>

<body>

<?php

$dbname = 'tcc';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";


$json = $_GET["json"];

//$json = '{"0":{"estacao":"AA_01","temperatura":"100"},"1":{"estacao":"AA_01","temperatura":"123"},"2":{"estacao":"AA_01","temperatura":"100"},"3":{"estacao":"AA_01","temperatura":"123"},"4":{"estacao":"AA_01","temperatura":"102"},"5":{"estacao":"AA_01","temperatura":"100"}}';


$lista_registros = json_decode($json);



foreach ($lista_registros as $key => $registro) {
	$query = "INSERT INTO estacoes (estacao,temperatura, umidade) VALUES ('$registro->estacao','$registro->temperatura', '$registro->umidade')";
}

$result = mysqli_query($connect,$query);

echo "Insertion Success!<br>";

?>

</body>
</html>