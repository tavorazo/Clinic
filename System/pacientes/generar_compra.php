<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Listo</title>
	<link rel="stylesheet" type="text/css" href="../css/texto.css"/>
	<style type="text/css" media="screen">
		body{ background: #2d455f; color: #fff; }
		a, a:hover{ color: white !important; text-decoration: none; }
	</style>
</head>
<body>
	<?php
	@session_start();
	date_default_timezone_set("Mexico/General");

	include("../php/base.php");

	$id_usuario = $_SESSION['u'];

	$producto 	= $_POST['producto'];
	$cantidad 	= $_POST['cantidad'];
	$paciente 	= $_POST['id_paciente'];
	$id_tipo = $_POST['id_tipo'];
	$descripcion = $_POST['descripcion'];

			//$id_paciente= $_GET['id_paciente'];

	$select  = "SELECT * from inventario where id_producto='".$producto."';";
	$resul	 = $conn->query($select) or die ("problema con la solicitud");
	$renglon = $resul->fetch_assoc();

	$precio = $renglon['precio_venta'];
	$total  = $precio * $cantidad;
	$cantidad_actual = $renglon['cantidad'];
	$s = date(W);
	$y = date(Y);
	if($cantidad_actual >= $cantidad){

		$insertar = "INSERT INTO historial_compras (id_paciente, id_usuario, id_producto, cantidad, precio_unitario, total, fecha,semana,y,id_tipo, descripcion) values ('$paciente', '$id_usuario', '$producto','$cantidad', '$precio', '$total', now(),'$s','$y','$id_tipo','$descripcion')";
		$cantidad_actual = $cantidad_actual-$cantidad;
		$actualizar = "update inventario set cantidad='$cantidad_actual', ultimo_abastecimiento = now() where id_producto='$producto'";
		$cantidad = $cantidad*(-1);
		$insertar2 = "INSERT INTO inventario_historial (id_usuario, id_producto, cantidad, fecha) values ('$id_usuario', '$producto', '$cantidad', now())";
		if(!$conn->query($actualizar))
			die('Error de consulta: '.mysqli_error($conn));

		if(!$conn->query($insertar2))
			die('Error de consulta: '.mysqli_error($conn));

		if(!$conn->query($insertar))
			die('Error de consulta: '.mysqli_error($conn));
		$select = 'SELECT * from inventario where id_producto="'.$producto.'";';
		$resul = $conn->query($select) or die ("problema con la solicitud");
		$renglon = $resul->fetch_assoc();
		$cantidad = $cantidad * (-1);
		$nombre_producto = $renglon['nombre'];
		$recibo = "INSERT INTO recibos (cantidad, descripcion, total, fecha, comprador, vendedor) values ('$cantidad','$nombre_producto','$total',now(),'$paciente','$id_usuario')";

		if(!$conn->query($recibo))
			die('Error de consulta: '.mysqli_error($conn));
		$id_recibo = $conn->insert_id;
		echo '<br><br><br><center><img src="../images/endoperio2.png" width="100px" alt=""> <br> ';
		echo "Compra &eacute;xitosa<br><br><br>";
		echo '<div style="  padding:9px; border:1px solid #E6E6E6; height:18px; width:120px; margin-top:12px; text-align:center; margin-right:10px ">';
		echo "<a href='compra.php?id_paciente=",$paciente,"'>Regresar </a></div>";
		echo '<div style="  padding:9px; border:1px solid #E6E6E6; height:18px; width:120px; margin-top:12px; text-align:center; margin-right:10px ">';
		echo '<a href="../php/imprimir_recibo.php?id_recibo=',$id_recibo,'" style="color:white">Imprimir Recibo</a></div></center>';

				//echo'<META HTTP-EQUIV="Refresh" CONTENT="1; URL=compra.php?id_paciente=',$paciente,'">';
		mysqli_close($conn);
	}
	else{
		echo '<br><br><br><center><img src="../images/endoperio2.png" width="100px" alt=""> <br> ';
		echo "No se pudo realizar la compra, la cantidad en existencia es de ", ($cantidad_actual), " unidades";	
		echo '<div style="  padding:9px; border:1px solid #E6E6E6; height:18px; width:120px; margin-top:12px; text-align:center; margin-right:10px ">';
		echo "<a href='compra.php?id_paciente=",$paciente,"' style='color=#fff'>Regresar </a></center></div>";
		echo'<META HTTP-EQUIV="Refresh" CONTENT="4; URL=compra.php?id_paciente=',$paciente,'">';
		mysqli_close($conn);
	}
	?>
</body>
</html>