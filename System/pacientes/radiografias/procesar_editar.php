<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Listo</title>
  <link rel="stylesheet" type="text/css" href="../../css/texto.css"/>
<style type="text/css" media="screen">
 body{
  background: #2d455f;
  color: #1C1C1C;
 }
 a, a:hover{
  color: white;
  text-decoration: none;
 }

  
</style>
</head >
<body>

		<?php
		$a = $_POST['id'];
		$b = $_POST['id_paciente'];
		$c = $_POST['nombre_foto'];

		if($_FILES['imagen']['name']!=""){
			copy($_FILES['imagen']['tmp_name'],$_FILES['imagen']['name']);
			$imagen=$_FILES['imagen']['name'];
		}
		else
			$imagen="";

		include('../../php/base.php');
		include('../../php/base3.php');
		$select = 'select * from radiografias where id_foto="'.$a.'";';


		$resul = $conn->query($select) or die ("problema con la solicitud");
		$renglon = $resul->fetch_assoc();
		$ficha = $renglon['id_paciente'];


		if($imagen!="")
			$ultimo = $renglon['id_foto'];
			unlink('imagenes/'.$c);
			rename($imagen,"imagenes/$c");
			chmod("imagenes/$c", 0777);

			$insertar = "update radiografias set nombre_foto='$c' where id_foto='$a'";

		if(!$conn->query($insertar))
			die('Error de consulta: '.mysqli_error($conn));
		mysqli_close($conn);
		$a = '../ficha-paciente.php?id='.$ficha;
		//header('location: ../ficha-paciente.php?id='.$ficha);
		echo '<br><br><br><center><img src="../../images/endoperio2.png" width="100px" alt=""> <br> ';
		echo "Foto subida con exito<br><br><br>";
		echo '<div style="  padding:9px; border:1px solid #E6E6E6; height:18px; width:120px; margin-top:12px; text-align:center; margin-right:10px ">';

		echo "<a href='",$a,"' > <font color='white'>Regresar </a></center></div>";
	
		
		
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=',$a,'">';
		?>


  </body>
</html>