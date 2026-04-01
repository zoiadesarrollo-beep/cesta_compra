<?php
include("funciones.php");

if($_POST["tipo"]=="eliminar"){
	$id=$_POST["id"];
	mysqli_query ($link,"DELETE FROM my_basket WHERE id ='".$id."' and user='".$_SESSION["mb_user"]."'");
}

?>