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

if($_POST["tipo"]=="para_comprar"){
	$id=$_POST["id"];
	$nombre=reptit($_POST["nombre"]);
	$categoria=$_POST["categoria"];
	$cantidad=$_POST["cantidad"];
	$estado=$_POST["estado"];
	mysqli_query ($link,"UPDATE my_basket SET nombre='".$nombre."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET categoria='".$categoria."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET cantidad='".$cantidad."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET estado='".$estado."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	echo $estado;
}
if($_POST["tipo"]=="comprado"){
	$id=$_POST["id"];
	$nombre=reptit($_POST["nombre"]);
	$categoria=$_POST["categoria"];
	$cantidad=$_POST["cantidad"];
	$estado=$_POST["estado"];
	mysqli_query ($link,"UPDATE my_basket SET nombre='".$nombre."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET categoria='".$categoria."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET cantidad='".$cantidad."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET estado='".$estado."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	echo $estado;
}
if($_POST["tipo"]=="guardar"){
	$id=$_POST["id"];
	$nombre=reptit($_POST["nombre"]);
	$categoria=$_POST["categoria"];
	$cantidad=$_POST["cantidad"];
	mysqli_query ($link,"UPDATE my_basket SET nombre='".$nombre."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET categoria='".$categoria."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
	mysqli_query ($link,"UPDATE my_basket SET cantidad='".$cantidad."' WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
}

function reptit($cadena){
	$cadena = str_replace(
	array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
	array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
	$cadena
	);

	//Reemplazamos la E y e
	$cadena = str_replace(
	array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
	array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
	$cadena );

	//Reemplazamos la I y i
	$cadena = str_replace(
	array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
	array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
	$cadena );

	//Reemplazamos la O y o
	$cadena = str_replace(
	array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
	array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
	$cadena );

	//Reemplazamos la U y u
	$cadena = str_replace(
	array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
	array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
	$cadena );
	
	return $cadena;
}
?>