<?php
	@session_start();
		if($_SESSION['u']=='')
			header('location: ../../index.php');
	//if($_SESSION['rol']!='admin')
	//		header('location: ../../panel.php');
	$usuario = $_SESSION['u'];
?>
<!DOCTYPE html>
<html class="html">
 <head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="7.0.314.244"/>

  <title>Endoperio | <?php echo $titulo; ?></title>
  <link rel="shortcut icon" type="x-icon" href="../../images/icon.png" /><!--para logo en barra-->
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../../css/s1.css"/>
  <link rel="stylesheet" type="text/css" href="../../css/texto.css"/>
  
  <link rel="stylesheet" type="text/css" href="../../css/site_global.css?417434784"/>
  <link rel="stylesheet" type="text/css" href="../../css/master_modif-master.css?3789319557"/>
  <link rel="stylesheet" type="text/css" href="../../css/agregar_receta.css?4008918636" id="pagesheet"/>
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
       <a class="nonblock nontext clip_frame grpelem" id="u1147" href="../../panel.php"><!-- image --><img class="block" id="u1147_img" src="../../images/logo-endoperio-dental-center.jpg" alt="" width="134" height="38"/></a>
       <div class="grpelem" id="u1149"><!-- simple frame --></div>
       <div class="clearfix grpelem" id="u1150-5"><!-- content -->
         <p><?php echo $_SESSION['nombres'];?>&nbsp; | <span id="u518-2"> <a href="../../php/logout.php"><h12> cerrar sesion</h12></a></span></p>
       </div>
      </div>
     </div>
    </div>
    <div class="clearfix colelem" id="pu1132-5"><!-- group -->
     <div class="clearfix grpelem" id="u1132-5"><!-- content -->
     </div>
     <div class="clearfix grpelem" id="u1134-4">

     <a   href="<?php echo $enlace; ?>" style="float:left; margin-right:10px"> << Regresar </a> <h3  style="margin-right:5px">|</h3>