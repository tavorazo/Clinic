<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Listo</title>
  <link rel="stylesheet" type="text/css" href="../css/texto.css"/>
<style type="text/css" media="screen">
 body{
  background: steelblue;
  color: #1C1C1C;
 }
 a, a:hover{
  color: white;
  text-decoration: none;
 }

  
</style>
</head>
		<body>	

		<?php
		@session_start();
			//header( 'Content-Type: text/html;charset=utf-8' );

			$var1=$_POST['titulo'];

			$var3 = $_POST['contenido'];

			
			$var1 = addslashes($var1);
			$var3 = addslashes($var3);


			if($_FILES['imagen']['name']!=""){ 
				copy($_FILES['imagen']['tmp_name'],$_FILES['imagen']['name']); 
				$var4=$_FILES['imagen']['name'];
				$var4=htmlspecialchars($var4);
			}else
				$var4='default.png';
			

			include('../php/base.php');


			$instruccion = "insert into noticias (imagen,texto,Titulo,fecha) values ('$var4', '$var3','$var1',now());";

			if(!$conn->query($instruccion))
				die('Error de consulta: '.mysql_error());
			$conn=null;

		echo '<br><br><br><center><img src="../images/endoperio2.png" width="100px" alt=""> <br> ';
		echo "Noticia creada con exito<br><br><br>";
		echo '<div style="  padding:9px; border:1px solid #E6E6E6; height:18px; width:120px; margin-top:12px; text-align:center; margin-right:10px ">';
		echo "<a href='../panel.php'>Regresar</a></div>";
		echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=../panel.php">';
		?>

</body>
</html>
