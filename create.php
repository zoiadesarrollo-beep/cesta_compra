<?php 
include("funciones.php");

$f = fopen("compra.csv", "r");


while (!feof($f)){
    $cell = fgets($f);
	$cell=mb_convert_encoding($cell, 'UTF-8', 'Windows-1252');
    $partes=explode(";",$cell);
	if($partes[1]!=""){
		mysqli_query ($link,"INSERT INTO my_basket (nombre,categoria) VALUES 
	('".$partes[0]."','".$partes[1]."')");
	
	}
	
}



?>

