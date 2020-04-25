<!--<html>
<body>
-->
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

//echo "Connection Success!<br><br>";

$temperatura = $_GET["temperatura"];
$umidade = $_GET["umidade"]; 


$query = "INSERT INTO sensores (temperatura, umidade) VALUES ('$temperatura', '$umidade')";
$result = mysqli_query($connect,$query);

//echo "Insertion Success!<br>";

?>
<!--
</body>
</html>-->