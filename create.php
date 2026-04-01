<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function Conectarse() 
{
   if (!($link=mysqli_connect("tb-be04-linweb087.srv.teamblue-ops.net:3306","solofa_javiercm","kojikabuto2014"))) 
   { 
      echo "Error conectando a la base de datos."; 
	  exit(); 
   } 
   if (!mysqli_select_db($link,"solofa_solofaltastu2014")) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
} 

$link=Conectarse(); 
mysqli_query ($link,"SET NAMES 'utf8'");


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

