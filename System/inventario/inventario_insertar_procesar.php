<?php
date_default_timezone_set("Mexico/General");
session_start();
$a = $_POST['nombre'];
$b = $_POST['serial'];
$c = $_POST['descripcion'];
$d = $_POST['cantidad'];
$e = $_POST['abastecer'];
$f = $_POST['minima'];
$venta = $_POST['venta'];
if ($venta == 0) 
	$pventa = 0;
else
	$pventa = $_POST['pventa'];

$pcompra = $_POST['pcompra'];

 
$tipo = $_POST['tipo_definicion'];
$usuario = $_SESSION['u'];
$a = htmlspecialchars($a);
$c = htmlspecialchars($c);
include('../php/base.php');
	
	$instruccion = "INSERT into inventario (nombre,numero_serial,descripcion,cantidad,reabastesible,cantidad_minima,ultimo_abastecimiento, venta, precio_compra, precio_venta,tipo_definicion) values ('$a','$b','$c','$d','$e','$f',now(), '$venta', '$pcompra', '$pventa','$tipo');";
	$sql = 'SELECT * from inventario where numero_serial="'.$b.'";';
	//echo $select;
	//if(!$conn->query($instruccion))
	if(!$conn->query($instruccion))
		die('Error de consulta: '.mysqli_error($conn));
	
	//$resul = $conn->query($sql, $dbh) or die ("problema con la solicitud");
	//$renglon = mysql_fetch_assoc($resul);
	$result = $conn->query($sql);
	$renglon = $result->fetch_assoc(); 
	$producto = $renglon['id_producto'];

$total = $d * $pcompra;
$instruccion2 = "INSERT into inventario_historial_entradas (id_producto,cantidad,total_compra,id_usuario,fecha ) values ('$producto', '$d', '$total', '$usuario', now());";
//if(!$conn->query($instruccion2))
if(!$conn->query($instruccion2))
	die('Error de consulta: '.mysqli_error($conn));

mysqli_close($conn);
echo '<meta http-equiv="refresh" content="0; url=../almacen.php" />';
?>