<?php

#$dbname = 'tcc';
#$dbuser = 'root';  
#$dbpass = ''; 
#$dbhost = 'localhost'; 

$dbname = 'tcc';
$dbuser = 'ec2-user';
$dbpass = 't44zg1g1';
$dbhost = '3.21.242.90';

$connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

//echo "Connection Success!<br><br>";


$query = "SELECT medir FROM acoes";

$result = mysqli_query($connect,$query);

$row = mysqli_fetch_assoc($result);
echo $row['medir']; //retorno pro esp


//atualiza o banco como false depois da leitura
//$query = "UPDATE acoes SET medir='FALSE' WHERE id = '1' ";
//mysqli_query($connect,$query);

?>
