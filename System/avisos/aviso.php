<?php
	@session_start();
		if($_SESSION['u']=='')
			header('location: ../index.php');
	//if($_SESSION['rol']!='admin')
	//		header('location: ../panel.php');
	$usuario = $_SESSION['u'];
  $sucursal = $_SESSION['sucursal'];
?>
<!DOCTYPE html>
<html class="html">
 <head>

  <!--meta http-equiv="Content-type" content="text/html;charset=UTF-8"/-->
  <meta name="generator" content="7.0.314.244"/>
  <title>Avisos</title>
      		<link rel="shortcut icon" type="x-icon" href="../images/icon.png" /><!--para logo en barra-->
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/s1.css"/>
  <link rel="stylesheet" type="text/css" href="../css/texto.css"/>
  
  <link rel="stylesheet" type="text/css" href="../css/site_global.css?417434784"/>
  <link rel="stylesheet" type="text/css" href="../css/master_modif-master.css?3789319557"/>
  <link rel="stylesheet" type="text/css" href="../css/agregar_receta.css?4008918636" id="pagesheet"/>
  <!-- Other scripts -->
  <script type="text/javascript">
   document.documentElement.className += ' js';
</script>
   </head>
 <body>

  <div class="clearfix" id="page"><!-- column -->
   <div class="position_content" id="page_position_content">
    <div class="clearfix colelem" id="pu1145"><!-- group -->
     <div class="browser_width grpelem" id="u1145"><!-- group -->
      <div class="clearfix" id="u1145_align_to_page">
       <a class="nonblock nontext clip_frame grpelem" id="u1147" href="../index.php"><!-- image --><img class="block" id="u1147_img" src="../images/logo-endoperio-dental-center.jpg" alt="" width="134" height="38"/></a>
       <div class="grpelem" id="u1149"><!-- simple frame --></div>
       <div class="clearfix grpelem" id="u1150-5"><!-- content -->
         <p><?php echo $_SESSION['nombres'];?>&nbsp; | <span id="u518-2"> <a href="../php/logout.php"><h12> cerrar sesion</h12></a></span></p>
       </div>
      </div>
     </div>
    </div>
    <div class="clearfix colelem" id="pu1132-5"><!-- group -->
     <div class="clearfix grpelem" id="u1132-5"><!-- content -->
     </div>
     <div class="clearfix grpelem" id="u1134-4">

     <a   href="../panel.php" style="float:left; margin-right:10px"> << Regresar </a> <h3  style="margin-right:5px">|</h3>
     <h1>Generar aviso</h1><hr><br>
		<form action="aviso_procesar.php" method="POST">
			<label>Titulo de aviso</label>
				<input type="text" class="campoT" name="titulo"><br>
			<label>Texto</label>
			<textarea  name="texto"></textarea><br><br>
			<select class="campoT" name="usuario">
				<option value="g">General</option>
				<option value="d">Doctores</option>
				<option value="ad">Administrativo</option>
				<option value="a">Almacen</option>
				
			<?php
        include('../php/base.php');
				$result = $conn->query(($sucursal==0) ? "SELECT * FROM usuarios order by apellido_paterno" : "SELECT * FROM usuarios where id_sucursal=$sucursal order by apellido_paterno");
		      while ($row = $result->fetch_assoc()) {
		      	echo "<option value='",$row["id_usuario"],"'>",$row["nombres"],"</option>";
		      }
          echo "</select>";

          $result=$conn->query("SELECT id_sucursal from usuarios where id_usuario = '$usuario' ");
          $usr_sucursal = $result->fetch_assoc();

          if($usr_sucursal['id_sucursal'] != 0){ //Si el usuario es matriz entonces podrá escoger a qué sucursal enviar los datos
            echo "<input type='hidden' value='$sucursal' name='sucursal'>";
          }
          else{
            echo "<label>Enviar a sucursal:</label><select class='campoT' name='sucursal'>"; 
            $result=$conn->query("SELECT * from sucursales");
            while($sucs = $result->fetch_assoc()){
              echo "<option value='".$sucs['id_sucursal']."'>";
              echo ($sucs['id_sucursal']==0) ? "Todas" : $sucs['sucursal'];
              echo " </option> ";
            }
            echo "</select>";
          }
			?>
			
			<input type="submit" value="enviar" style="float:left">
			<br><br>
      <br><br><br>
      <div style=" padding:9px; margin-left:auto;  margin-right:auto; border:1px solid #2d455f; height:16px; width:250px; margin-top:12px; text-align:center ">
        <a href="lista_avisos.php" target='_blank'>Ver Avisos Modo admin</a>
      </div>

		</form>

</div>
    </div>
    <div class="verticalspacer"></div>
   </div>
  </div>
  <div class="preload_images">
   <img class="preload" src="images/u1154-r.png" alt=""/>
  </div>
<!-- JS includes -->
  <script type="text/javascript">
   if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script src="../scripts/museutils.js?3865766194" type="text/javascript"></script>
  <script src="../scripts/jquery.tobrowserwidth.js?3842421675" type="text/javascript"></script>
  <script src="../scripts/jquery.watch.js?4068933136" type="text/javascript"></script>
  <!-- Other scripts -->
  <script type="text/javascript">
   $(document).ready(function() { try {
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
$('.browser_width').toBrowserWidth();/* browser width elements */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
} catch(e) { Muse.Assert.fail('Error calling selector function:' + e); }});
</script>
  
   </body>
</html>