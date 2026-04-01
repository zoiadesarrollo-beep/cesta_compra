<?php
session_start();
function Conectarse() 
{
   if (!($link=mysqli_connect("zoia-n8n_gestion_cesta","my_user_basket","uzVz7VXy2W-4GK*"))) 
   { 
      echo "Error conectando a la base de datos."; 
	  exit(); 
   } 
   if (!mysqli_select_db($link,"zoia-n8n")) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
} 

$link=Conectarse(); 
mysqli_query ($link,"SET NAMES 'utf8'");

?>