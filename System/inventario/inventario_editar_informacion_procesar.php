<?php
date_default_timezone_set("Mexico/General");

	session_start();

$a = $_POST['nombre'];
$b = $_POST['serial'];
$c = $_POST['descripcion'];
//$d = $_POST['cantidad'];
$e = $_POST['abastecer'];
$f = $_POST['minima'];
$venta = $_POST['venta'];
$pcompra = $_POST['pcompra'];
$pventa = $_POST['pventa'];
$tipo = $_POST['tipo_definicion'];
$id_producto=$_POST['id_producto'];
$usuario = $_SESSION['u'];

$a = htmlspecialchars($a);
$c = htmlspecialchars($c);

include('../php/base.php');
include('../php/base3.php');
//print "Producto:$a<br>Serial: $b<br>Descripcion: $c<br>Cantidad: $d<br>Reabastecible: $e<br>Cantidad Mínima: $f<br>Agregado con éxito";
$instruccion = "update inventario set nombre='$a', numero_serial='$b', descripcion='$c', reabastesible='$e', cantidad_minima='$f', venta='$venta', precio_compra='$pcompra', precio_venta='$pventa',tipo_definicion='$tipo' where id_producto='$id_producto'";
	//$instruccion = "insert into inventario (nombre,numero_serial,descripcion,cantidad,reabastesible,cantidad_minima,ultimo_abastecimiento, venta, precio_compra, precio_venta,tipo_definicion) values ('$a','$b','$c','$d','$e','$f',now(), '$venta', '$pcompra', '$pventa','$tipo');";


		//$select = 'select * from inventario where numero_serial="'.$b.'";';
		//echo $select;
		if(!mysql_query($instruccion, $conexion))
			die('Error de consulta: '.mysql_error());
		//$resul = mysql_query($select, $dbh) or die ("problema con la solicitud");
		//$renglon = mysql_fetch_assoc($resul);

//$producto = $renglon['id_producto'];

//$total = $d * $pcompra;
//$instruccion2 = "insert into inventario_historial_entradas (id_producto,cantidad,total_compra,id_usuario,fecha ) values ('$producto', '$d', '$total', '$usuario', now());";


//	if(!mysql_query($instruccion2, $conexion))
//		die('Error de consulta: '.mysql_error());

	mysql_close($conexion);
	echo '<meta http-equiv="refresh" content="0; url=../almacen.php" />';
//header ("location: ../almacen.php");

?>