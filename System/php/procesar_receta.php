<?
	
	  date_default_timezone_set("Mexico/General");
?>
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
$a = $_POST['medicamento'];
$b = $_POST['observaciones'];

$c = $_POST['id'];
$doc = $_SESSION['u'];
$a = htmlspecialchars($a);
$b = htmlspecialchars($b);

/*$conexion = mysql_connect('localhost', 'root', '');

if (!$conexion){
	die('Error de Conexion: ' .mysql_error());
}

$conexion_base=mysql_select_db('Endoperio', $conexion);

if (!$conexion_base) {
	die('Error de seleccion de base: ' .mysql_error());
	echo "Error en la conexi贸n";
}
*/
include('base.php');
include('base2.php');
include('base3.php');
$insertar = "insert into recetas (id_usuario, id_paciente, medicamento, observaciones,fecha) values ('$doc','$c','$a', '$b', now())";

//echo $insertar;

if(!mysqli_query($conn,))
	die('Error de consulta: '.mysql_error());
mysqli_close($conn);;

echo '<br><br><br><center><img src="../images/endoperio2.png" width="100px" alt=""> <br> ';
echo "Receta Agregada con exito<br><br><br>";
echo '<div style="  padding:9px; border:1px solid #E6E6E6; height:18px; width:120px; margin-top:12px; text-align:center; margin-right:10px ">';

echo "<a href='../pacientes/ficha-paciente.php?id=",$c,"' > <font color='white'>Regresar </a></center></div>";

echo'<META HTTP-EQUIV="Refresh" CONTENT="1; URL=../pacientes/ficha-paciente.php?id=',$c,'">';

?>
  </body>
</html>