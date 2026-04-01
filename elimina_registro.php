<?php
session_start();
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

if($_POST["tipo"]=="eliminar"){
	$id=$_POST["id"];
	mysqli_query ($link,"DELETE FROM my_basket WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
}

?>