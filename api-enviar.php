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


$query = "SELECT medir FROM acoes WHERE id = '1'";

$result = mysqli_query($connect,$query);

$row = mysqli_fetch_assoc($result);
echo $row['medir'];


$query_on_off = "SELECT medir,canal,limite_inferior,limite_superior FROM acoes WHERE id = '2'";

$result_on_off = mysqli_query($connect,$query_on_off);

$row_on_off = mysqli_fetch_assoc($result_on_off);
echo "".$row_on_off['medir']."-".$row_on_off['canal']."-".$row_on_off['limite_inferior']."-".$row_on_off['limite_superior']."";
//atualiza o banco como false depois da leitura
//$query = "UPDATE acoes SET medir='FALSE' WHERE id = '1' ";
//mysqli_query($connect,$query);

?>
