<?php
include("funciones.php");

if($_POST["guarda_producto"]=="guarda_producto"){

	$nom_p_add=reptit(mb_strtoupper($_POST["nom_p_add"]));
	$cat_p_add=$_POST["cat_p_add"];
	$cant_p_add=$_POST["cant_p_add"];
	$result=mysqli_query ($link,"INSERT INTO my_basket (nombre,categoria,cantidad,user) VALUES  ('".$nom_p_add."','".$cat_p_add."','".$cant_p_add."','".$_SESSION["mb_user"]."')");
	if($result)
	{
		$_SESSION["mb_message"]="El producto se ha creado con exito";
	}
	else
	{
		$_SESSION["mb_message"]="Ocurrió un error al crear el producto";
	}
	header('Location: index.php');
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