<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Citas para hoy</title>
	</head>
<body>
	
<?php
	@session_start();
	date_default_timezone_set("Mexico/General");

	include('php/base.php');

	$ano = $_GET['ano'];
	$mes = $_GET['mes'];
	$dia = $_GET['dia'];
	$hora = $_GET['hora'];
	$minuto = $_GET['minuto'];


	if($minuto=0)
		$minuto = '00';
	$agenda = $conn->query("SELECT * from agenda where ano='$ano' and mes='$mes' and dia='$dia' and hora='$hora' and minuto like '%$minuto%';");
	echo "<table witdh='100%' style='margin:100px auto; border:1px solid #C3DEEE;; padding:30px'><tr>";
	//while ($fila_agenda = mysql_fetch_array($agenda, MYSQL_NUM)){
	while ($fila_agenda = $agenda->fetch_row()){
		echo "<td style=' background:#C3DEEE;'><center>";
		$id_usuario = $fila_agenda[1];
		$SELECT = 'SELECT * from usuarios where id_usuario="'.$id_usuario.'";';
		$resul = $conn->query($SELECT);
		$renglon = $resul->fetch_assoc();
		echo "Dr. ", $renglon['nombres']," ",$renglon['apellido_paterno']," ",$renglon['apellido_materno'],"<br><br>";

		$id_paciente = $fila_agenda[2];
		$SELECT = 'SELECT * from paciente where id_paciente="'.$id_paciente.'";';
		$resul = $conn->query($SELECT);
		$renglon = $resul->fetch_assoc();
		echo "<img src='http://endoperio.wbx.technology/pacientes/images_pacientes/".$renglon['foto_ingreso']."' style='height:150px; width:130px'><br><br>";
		echo "Paciente: ", $renglon['nombres']," ",$renglon['apellido_paterno']," ",$renglon['apellido_materno'],"<br><br>";

		echo "Observación: ", $fila_agenda[8];
		echo "</center></td>";
	}

	echo "</tr></table>";

?>

</body>
</html>
