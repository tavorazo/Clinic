<?php
if (isset($_GET['id']))
	$id = $_GET['id'];

/*$dbh = mysql_connect('localhost','root','') or die('Error de conexion: ' . mysql_error() );
$base = mysql_select_db('Endoperio') or die('Error de seleccion de base: ' . mysql_error() );*/
include('../php/base.php');
$select = 'select * from agenda where id_cita="'.$id.'";';
$resul = $conn->query($select) or die ("problema con la solicitud");
$renglon = mysql_fetch_assoc($resul);


	$eliminar = 'delete from agenda where id_cita="'.$id.'";';
	$eliminar2 = 'delete from agenda where id_cita="'.($id-1).'";';

	if(!$conn->query($eliminar))
		die('Error de consulta: '.mysqli_error($conn));
		
	if(!$conn->query($eliminar2))
		die('Error de consulta: '.mysqli_error($conn));
		
	$conn->close();
	//mysql_close($dbh);

	//header('location: ../pacientes.php');
	echo '<meta http-equiv="Refresh" content="1;url=../pacientes.php">';

?>