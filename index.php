<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

?>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="JCM">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-sortable.css">
<link rel="icon" type="image/jpg" href="mybasket_logo.png"/>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/bootstrap-sortable.js"></script>
<title>MyBasket</title>
</head>
<style>
#fondito {
    background-color: white !important;
    position: fixed;
    width: 100vw;
    top: 0px;
    height: 100vh;
    z-index: 100;
    text-align: center;
    padding-top: 20vh;
    left: 0px;
}
#fondito img{
	max-width:80vw;
}
.messag {
    position: fixed;
    z-index: 10000;
    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px;
    width: 80vw;
    text-align: center;
    margin: auto;
    left: 10vw;
    top: 30vh;
}
.footer {
    text-align: center;
    font-size: 10px;
    padding: 10px;
}
.inicio{
	padding:10px;
}
input,select {
    border: solid 1px #ccc;
    background: none;
    padding: 3px;
	width:100%;
	margin-top: -5px;
	font-size:14px;
}
td,th,input{
	font-size:12px;
}
tr{
	cursor:pointer;
}
button {
    width: 90vw;
    font-size: 20px;
    padding: 10px;
    margin: 5px;
}
.th-sm {
    background: #337fc1 !important;
    color: white;
}
.verde{
	background:#aeebae !important;
}
.rojo{
	background:#e37676 !important;
	color:white;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    font-size: 14px;
}
.rowan {
    margin-right: -15px;
    margin-left: -15px;
    width: 100%;
    height: 40px;
    font-size: 14px;
}
.rowan input {
    font-size: 14px;
}
.popup, .anproducto, .ancategoria {
    position: fixed;
    width: 92%;
    max-width: 500px;
    margin: auto;
    background: white;
    top: 30vh;
    left: calc(50vw - 250px);
    padding: 13px;
    font-size: 16px;
    border: solid 1px #337fc1;
    box-shadow: 0px 0px 10px;
    padding-top: 30px;
}
.tapar{
	position:fixed;
	background:black;
	opacity:.3;
	top:0px;
	left:0px;
	width:100vw;
	height:100vh;
}
.notocar{
	pointer-events: none;
}
button#mas, button#menos,button#pmas, button#pmenos {
    padding: 0px;
    margin-top: -6px;
}
button#para_comprar {
    width: 96%;
    background: #e37676;
    color: white;
    border: none;
    font-size: 14px;
}
button#comprado {
    width: 96%;
    background: #79a479;
    color: white;
    border: none;
    font-size: 14px;
}
button#guardar {
    width: 96%;
    background: #769ce3;
    color: white;
    border: none;
    font-size: 14px;
}
.botonesg {
    display: flex;
    position: fixed;
    top: 0px;
    left: 0px;
    height: 65px;
    width: 100vw;
    background: white;
    padding: 10px;
}
button#add_prod,.gprod {
    background: #e37676;
    color: white;
    border: none;
    font-size: 12px;
    padding: 8px;
}
button#add_cat {
    background: #769ce3;
    color: white;
    border: none;
    font-size: 12px;
    padding: 8px;
}
.gvolv {
    background: #b1b1b1;
    color: white;
    border: none;
    font-size: 12px;
    padding: 8px;
}
.gelim {
    background: #b5b364;
    color: white;
    border: none;
    font-size: 12px;
    padding: 8px;
}
button.gprod,button.gvolv,button.gelim {
    width: 96%;
}
button#ir_compra {
    width: 60px;
    background: none;
    border: none;
}
.compri{
    width: 30px;
    margin-top: -11px;
}
.nover{
	display:none;
}
button#add_cat {
    margin-left: -5px;
}
input#busca_producto {
    margin-top: 6px;
    height: 31px;
    border-radius: 0px;
}
img.borri {
    width: 24px;
    height: 24px;
    margin-left: -28px;
    margin-top: 10px;
}
@media (max-width: 750px) {
.inicio{
	padding:0px;
}
.popup, .anproducto, .ancategoria {
    position: fixed;
    width: 92%;
    max-width: 500px;
    margin: auto;
    background: white;
    top: 30vh;
    left: 4%;
    padding: 13px;
    font-size: 16px;
    border: solid 1px #337fc1;
    box-shadow: 0px 0px 10px;
    padding-top: 30px;
}
button {
    margin: 2vw;
}
button#ir_compra {
    width: 30px;
    background: none;
    border: none;
}
.compri{
    width: 30px;
    margin-top: -11px;
}
}
</style>
<body>
	<div class="inicio">
    <?php $user="";
	if($_SESSION["mb_user"]==""){?>
    	<div class="fondito" id="fondito">
    	<img src="fondo.jpg">
    	</div>
        <?php
		$users=mysqli_query ($link,"select * from my_basket_user where token='".$_GET["user"]."'"); 
		while($useri = mysqli_fetch_array($users)){
			$user=$useri["user"];
			$_SESSION["mb_user"]=$user;
			$_SESSION["mb_token"]=$token;
		}
	} else $user=$_SESSION["mb_user"];
	if($user!=""){?>
    	<div class="messag" id="messag" <?php if($_SESSION["mb_message"]==""){?>style="display:none"<?php } ?>>
        	<?php echo $_SESSION["mb_message"];?>
        </div>
	<?php if($_SESSION["mb_message"]!="") $_SESSION["mb_message"]="";?>
	<input type="hidden" id="nover" name="nover" value="0"/>
	<?php $cat=array();
	$categorias=mysqli_query ($link,"select * from my_basket_cat where 1 and user='".$user."' order by id_cat");
	$i=1;
	while($categoria = mysqli_fetch_array($categorias)){
		$cat[$categoria["id_cat"]]=$categoria["nombre"];?>
        <input type="hidden" id="catg_<?php echo $categoria["id_cat"];?>" value="<?php echo $categoria["nombre"];?>"/>
	<?php }
	$productos=mysqli_query ($link,"select * from my_basket where 1 and user='".$user."' order by nombre");?>
	<div class="tabla" style="margin-top:65px;">
    	<table id="dtOrderExample" class="table table-striped table-bordered table-sm sortable" cellspacing="0">
        	<thead>
    			<tr>
      				<th class="th-sm" style="width:45vw !important">NOMBRE</th>
                	<th class="th-sm" style="width:45vw !important">CATEGORIA</th>
                    <th class="th-sm" style="display:none !important">OCULTO</th>
                    <th class="th-sm" style="width:10vw !important">CANT.</th>
	  			</tr>
            </thead>
            <tbody>
            <?php while($producto = mysqli_fetch_array($productos)){?>
            <tr id="fila_<?php echo $producto["id"];?>" <?php if($producto["estado"]==0) echo ' class="verde" '; else echo ' class="rojo" ';?> onClick="open_pop(<?php echo $producto["id"];?>)">
            	<td style="width:45vw !important" id="td_nombre_<?php echo $producto["id"];?>">
					<?php echo $producto["nombre"];?>
                </td>
                <td style="width:45vw !important" id="td_categoria_<?php echo $producto["id"];?>">
                	<?php echo $cat[$producto["categoria"]];?>
                </td> 
                <td style="display:none !important">
                	<input class="notocar" readonly type="hidden" id="nombre_<?php echo $producto["id"];?>" value="<?php echo $producto["nombre"];?>"/>
                    <input class="notocar" readonly type="hidden" id="cantidad_<?php echo $producto["id"];?>" value="<?php echo $producto["cantidad"];?>"/>
                    <input class="notocar" readonly type="hidden" id="categoria_id_<?php echo $producto["id"];?>" value="<?php echo $producto["categoria"];?>"/>
                    <input class="notocar" readonly type="hidden" id="estado_<?php echo $producto["id"];?>" value="<?php echo $producto["estado"];?>"/>
                </td>
                <td style="width:10vw !important" id="td_cantidad_<?php echo $producto["id"];?>">
                	<?php echo $producto["cantidad"];?>
                </td>
          	</tr>
            <?php } ?>
            </tbody>
        </table>
	</div>
    <div class="tapar" id="tapar" style="display:none"></div>
    <div class="popup" id="popup" style="display:none">	
    <input type="hidden" id="id_edit" name="id_edit" value=""/>
    	<div class="row rowan">
    		<label class="col-xs-4 col-sm-4 col-lg-4">Nombre</label>
            <input class="col-xs-8 col-sm-8 col-lg-8" type="text" name="nom_edit" id="nom_edit" value="" style="text-transform:uppercase"/>
        </div>
        <div class="row rowan">
        	<label class="col-xs-4 col-sm-4 col-lg-4">Categoria</label>
            <select class="col-xs-8 col-sm-8 col-lg-8" name="cat_edit" id="cat_edit">
        		<?php $categorias=mysqli_query ($link,"select * from my_basket_cat where 1 and user='".$user."' order by nombre");
				while($cati = mysqli_fetch_array($categorias)){?>
        		<option value="<?php echo $cati["id_cat"];?>"><?php echo $cati["nombre"];?></option>
            	<?php } ?>
        	</select>
        </div>
        <div class="row rowan">
        	<label class="col-xs-4 col-sm-4 col-lg-4">Cantidad</label>
            <button class="col-xs-1 col-sm-1 col-lg-1" id="menos"  onclick="baja_cantidad()">-</button><input class="col-xs-3 col-sm-3 col-lg-3" type="number" name="cant_edit" id="cant_edit" value="" style="text-align:center"/><button class="col-xs-1 col-sm-1 col-lg-1" id="mas" onClick="sube_cantidad()">+</button>
      	</div>
        <button name="PARA_COMPRAR" value="para_comprar" id="para_comprar" onClick="para_comprar()">PARA COMPRAR</button>
        <button name="COMPRADO" id="comprado" value="comprado" onClick="comprado()">COMPRADO</button>
        <button name="GUARDAR" id="guardar" value="guardar" onClick="guardar()">GUARDAR</button>
      	<button type="button" onClick="volver()" class="gvolv">VOLVER</button>
        <button type="button" onClick="eliminar()" class="gelim">ELIMINAR</button>
    </div>
    <div class="botonesg">
    	<button name="add_prod" id="add_prod" onClick="add_prod()">+ PROD</button>
        <button name="add_cat" id="add_cat" onClick="add_cat()">+ CAT</button>
        <input type="text" name="busca_producto" id="busca_producto" onKeyUp="doSearch('dtOrderExample','busca_producto')" class="form-control" style="max-width:200px;"/>
        <img class="borri" src="borrar.jpg" onClick="borri()">
        <button name="ir_compra" id="ir_compra" onClick="ir_compra()"><img class="compri" src="mybasket_logo.png"></button>
        
        
    </div>
    <div class="anproducto" id="anproducto" style="display:none">
    	<form action="add_product.php" method="post">
        	<div class="row rowan">
                <label class="col-xs-4 col-sm-4 col-lg-4">Nombre</label>
                <input class="col-xs-8 col-sm-8 col-lg-8" type="text" name="nom_p_add" id="nom_p_add" value="" style="text-transform:uppercase"/>
            </div>
            <div class="row rowan">
                <label class="col-xs-4 col-sm-4 col-lg-4">Categoria</label>
                <select class="col-xs-8 col-sm-8 col-lg-8" name="cat_p_add" id="cat_p_add">
                    <?php $categorias=mysqli_query ($link,"select * from my_basket_cat where 1 and user='".$user."' order by nombre");
                    while($cati = mysqli_fetch_array($categorias)){?>
                    <option value="<?php echo $cati["id_cat"];?>"><?php echo $cati["nombre"];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="row rowan">
                <label class="col-xs-4 col-sm-4 col-lg-4">Cantidad</label>
                <button type="button" class="col-xs-1 col-sm-1 col-lg-1" id="pmenos"  onclick="pbaja_cantidad()">-</button><input class="col-xs-3 col-sm-3 col-lg-3" type="number" name="cant_p_add" id="cant_p_add" value="1" style="text-align:center"/><button type="button" class="col-xs-1 col-sm-1 col-lg-1" id="pmas" onClick="psube_cantidad()">+</button>
            </div>
            <button type="submit" name="guarda_producto" value="guarda_producto" class="gprod">GUARDAR PRODUCTO</button>
            <button type="button" onClick="volver()" class="gvolv">VOLVER</button>
        </form>
    </div>
    <div class="ancategoria" id="ancategoria" style="display:none">
    	<form action="add_category.php" method="post">
        	<div class="row rowan">
                <label class="col-xs-4 col-sm-4 col-lg-4">Nombre</label>
                <input class="col-xs-8 col-sm-8 col-lg-8" type="text" name="nom_c_add" id="nom_c_add" value="" style="text-transform:uppercase"/>
            </div>
            <button type="submit" name="guarda_categoria" value="guarda_categoria" class="gprod">GUARDAR CATEGORIA</button>
            <button type="button" onClick="volver()" class="gvolv">VOLVER</button>
        </form>
    </div>
    <div class="footer">
   	  <a href="https://solofaltastu.es">© SFT 2024</a></div> 
    <?php } else { 
	echo "No existe el usuario";
	}?>
    </div>
</body>
</html> 
<script src="/js/jQuery/jquery-1.12.4.min.js" ></script>  
<script>
function open_pop(id){
	document.getElementById("popup").style.display="none";
	document.getElementById("anproducto").style.display="none";
	document.getElementById("ancategoria").style.display="none";
	document.getElementById("tapar").style.display="block";
	document.getElementById("popup").style.display="block";
	document.getElementById("id_edit").value=id;
	document.getElementById("nom_edit").value=document.getElementById("nombre_"+id).value.toUpperCase();
	document.getElementById("cat_edit").value=document.getElementById("categoria_id_"+id).value;
	document.getElementById("cant_edit").value=document.getElementById("cantidad_"+id).value;
	if(document.getElementById("estado_"+id).value==0){
		document.getElementById("para_comprar").style.display="block";
		document.getElementById("comprado").style.display="none";
	} else {
		document.getElementById("para_comprar").style.display="none";
		document.getElementById("comprado").style.display="block";
	}
}
function sube_cantidad(){
	document.getElementById("cant_edit").value=parseInt(document.getElementById("cant_edit").value)+1;
}
function baja_cantidad(){
	if(document.getElementById("cant_edit").value>1)
		document.getElementById("cant_edit").value=parseInt(document.getElementById("cant_edit").value)-1;
}
function psube_cantidad(){
	document.getElementById("cant_p_add").value=parseInt(document.getElementById("cant_p_add").value)+1;
}
function pbaja_cantidad(){
	if(document.getElementById("cant_p_add").value>1)
		document.getElementById("cant_p_add").value=parseInt(document.getElementById("cant_p_add").value)-1;
}
function para_comprar(){
	$.ajax({
        type: "POST",
		url: "guarda_registro.php",
		data: { 
		  id:document.getElementById("id_edit").value,
		  nombre:document.getElementById("nom_edit").value.toUpperCase(),
		  categoria:document.getElementById("cat_edit").value,
		  cantidad:document.getElementById("cant_edit").value,
		  tipo:"para_comprar",
		  estado:"1"
		},
        success: function (data) {
			id=document.getElementById("id_edit").value;
            document.getElementById("tapar").style.display="none";
			document.getElementById("popup").style.display="none";
			document.getElementById("fila_"+id).classList.remove("verde");
			document.getElementById("fila_"+id).classList.add("rojo");
		  	document.getElementById("nombre_"+id).value=document.getElementById("nom_edit").value.toUpperCase();
		  	document.getElementById("categoria_id_"+id).value=document.getElementById("cat_edit").value;
		  	document.getElementById("cantidad_"+id).value=document.getElementById("cant_edit").value;
			document.getElementById("estado_"+id).value=1;
			document.getElementById("td_nombre_"+id).innerHTML=document.getElementById("nom_edit").value.toUpperCase();
		  	document.getElementById("td_categoria_"+id).innerHTML=document.getElementById("catg_"+document.getElementById("cat_edit").value).value;
		  	document.getElementById("td_cantidad_"+id).innerHTML=document.getElementById("cant_edit").value;
			document.getElementById("messag").innerHTML="Producto actualizado";
				document.getElementById("messag").style.display="block";
				$("#messag").fadeOut(1000);
        }          
    })
}
function comprado(){
	$.ajax({
        type: "POST",
		url: "guarda_registro.php",
		data: { 
		  id:document.getElementById("id_edit").value,
		  nombre:document.getElementById("nom_edit").value.toUpperCase(),
		  categoria:document.getElementById("cat_edit").value,
		  cantidad:document.getElementById("cant_edit").value,
		  tipo:"comprado",
		  estado:"0"
		},
        success: function (data) {
			id=document.getElementById("id_edit").value;
            document.getElementById("tapar").style.display="none";
			document.getElementById("popup").style.display="none";
			document.getElementById("fila_"+id).classList.remove("rojo");
			document.getElementById("fila_"+id).classList.add("verde");
			document.getElementById("nombre_"+id).value=document.getElementById("nom_edit").value.toUpperCase();
		  	document.getElementById("categoria_id_"+id).value=document.getElementById("cat_edit").value;
		  	document.getElementById("cantidad_"+id).value=document.getElementById("cant_edit").value;
			document.getElementById("estado_"+id).value=0;
			document.getElementById("td_nombre_"+id).innerHTML=document.getElementById("nom_edit").value.toUpperCase();
		  	document.getElementById("td_categoria_"+id).innerHTML=document.getElementById("catg_"+document.getElementById("cat_edit").value).value;
		  	document.getElementById("td_cantidad_"+id).innerHTML=document.getElementById("cant_edit").value;
			document.getElementById("messag").innerHTML="Producto actualizado";
				document.getElementById("messag").style.display="block";
				$("#messag").fadeOut(1000);
        }          
    })
}
function guardar(){
	$.ajax({
        type: "POST",
		url: "guarda_registro.php",
		data: { 
		  id:document.getElementById("id_edit").value,
		  nombre:document.getElementById("nom_edit").value.toUpperCase(),
		  categoria:document.getElementById("cat_edit").value,
		  cantidad:document.getElementById("cant_edit").value,
		  tipo:"guardar"
		},
        success: function (data) {
			id=document.getElementById("id_edit").value;
            document.getElementById("tapar").style.display="none";
			document.getElementById("popup").style.display="none";
			document.getElementById("nombre_"+id).value=document.getElementById("nom_edit").value.toUpperCase();
		  	document.getElementById("categoria_id_"+id).value=document.getElementById("cat_edit").value;
		  	document.getElementById("cantidad_"+id).value=document.getElementById("cant_edit").value;
			document.getElementById("td_nombre_"+id).innerHTML=document.getElementById("nom_edit").value.toUpperCase();
		  	document.getElementById("td_categoria_"+id).innerHTML=document.getElementById("catg_"+document.getElementById("cat_edit").value).value;
		  	document.getElementById("td_cantidad_"+id).innerHTML=document.getElementById("cant_edit").value;
			document.getElementById("messag").innerHTML="Producto guardado";
				document.getElementById("messag").style.display="block";
				$("#messag").fadeOut(1000);
        }          
    })
}

function eliminar(){
	if(confirm("Quieres eliminar este producto?")){
		$.ajax({
			type: "POST",
			url: "elimina_registro.php",
			data: { 
			  id:document.getElementById("id_edit").value,
			  tipo:"eliminar"
			},
			success: function (data) {
				id=document.getElementById("id_edit").value;
				document.getElementById("tapar").style.display="none";
				document.getElementById("popup").style.display="none";
				document.getElementById("fila_"+id).classList.add("nover");
				document.getElementById("messag").innerHTML="Producto eliminado";
				document.getElementById("messag").style.display="block";
				$("#messag").fadeOut(1000);
			}          
		})
	}
}


function add_prod(){
	document.getElementById("tapar").style.display="none";
	document.getElementById("popup").style.display="none";
	document.getElementById("anproducto").style.display="none";
	document.getElementById("ancategoria").style.display="none";
	document.getElementById("tapar").style.display="block";
	document.getElementById("anproducto").style.display="block";
}
function add_cat(){
	document.getElementById("tapar").style.display="none";
	document.getElementById("popup").style.display="none";
	document.getElementById("anproducto").style.display="none";
	document.getElementById("ancategoria").style.display="none";
	document.getElementById("tapar").style.display="block";
	document.getElementById("ancategoria").style.display="block";
}
function volver(){
	document.getElementById("tapar").style.display="none";
	document.getElementById("popup").style.display="none";
	document.getElementById("anproducto").style.display="none";
	document.getElementById("ancategoria").style.display="none";
	
}
function doSearch(tabla,buscar)
{
	const tableReg = document.getElementById(tabla);
	const searchText = document.getElementById(buscar).value.toLowerCase();
	total = 0;
	if(searchText==""){
		for (i = 1; i < tableReg.rows.length; i++) {
			// Si el td tiene la clase "noSearch" no se busca en su cntenido
			tableReg.rows[i].style.display = '';
		}
		
	} else {
		

		// Recorremos todas las filas con contenido de la tabla
		for (i = 1; i < tableReg.rows.length; i++) {
			// Si el td tiene la clase "noSearch" no se busca en su cntenido
			if (tableReg.rows[i].classList.contains("noSearch")) {
				continue;
			}
	
			found = false;
			const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
			// Recorremos todas las celdas
			for (j = 0; j < cellsOfRow.length && !found; j++) {
				const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
				// Buscamos el texto en el contenido de la celda
				if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
					found = true;
					total++;
				}
			}
			if (found) {
				tableReg.rows[i].style.display = '';
			} else {
				// si no ha encontrado ninguna coincidencia, esconde la
				// fila de la tabla
				tableReg.rows[i].style.display = 'none';
			}
		}
	
		// mostramos las coincidencias
		const lastTR=tableReg.rows[tableReg.rows.length-1];
		const td=lastTR.querySelector("td");
		lastTR.classList.remove("hide", "red");
		if (searchText == "") {
			lastTR.classList.add("hide");
		}
	}
}
function borri(){
	document.getElementById("busca_producto").value="";
	doSearch('dtOrderExample','busca_producto');
}
function ir_compra(){
	if(document.getElementById("nover").value==0){
		var elements = document.getElementsByClassName('verde');
		for(var i = 0; i < elements.length; i++){
			elements[i].classList.add("nover");
		}
		document.getElementById("nover").value=1;
	} else {
		var elements = document.getElementsByClassName('nover');
		for(var i = 0; i < elements.length; i++){
			elements[i].classList.remove("nover");
		}
		document.getElementById("nover").value=0;
	}
}
$("#fondito").fadeOut(1000);
$("#messag").fadeOut(500);
</script>

