<?php
@session_start();
if($_SESSION['u']=='')
 header('location: ../index.php');
$usuario = $_SESSION['u'];
$id_producto = $_GET['id'];
include('../php/base.php');
$sql = 'SELECT * from inventario where id_producto="'.$id_producto.'";';

$result = $conn->query($sql);
$renglon = $result->fetch_assoc();
//$resul = $conn->query($select) or die ("problema con la solicitud");
//$renglon = mysql_fetch_assoc($resul)

$result_suc=$conn->query("SELECT id_sucursal from usuarios where id_usuario = '$usuario' ");
if(!$result_suc)
  die('Error de consulta 2: '.mysqli_error($conn));

$usr_sucursal = $result_suc->fetch_assoc();
?>
<!DOCTYPE html>
<html class="html">
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <link rel="shortcut icon" type="x-icon" href="../images/icon.png" /><!--para logo en barra-->
  <meta name="generator" content="7.0.314.244"/>
  <title>insertar_en_almacen</title>
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
  <script type="text/javascript">
  function optionCheck(){
    var option = document.getElementById("options").value;
    if(option == "1"){
      document.getElementById("precio").style.visibility = "visible";
    }
    if(option == "0"){
      document.getElementById("precio").style.visibility = "hidden";
    }
  }
  </script>
</head>
<body>
  <div class="clearfix" id="page"><!-- column -->
   <div class="position_content" id="page_position_content">
    <div class="clearfix colelem" id="pu1145"><!-- group -->
     <div class="browser_width grpelem" id="u1145"><!-- group -->
      <div class="clearfix" id="u1145_align_to_page">
       <a class="nonblock nontext clip_frame grpelem" id="u1147" href="../panel.php"><!-- image --><img class="block" id="u1147_img" src="../images/logo-endoperio-dental-center.jpg" alt="" width="134" height="38"/></a>
       <div class="grpelem" id="u1149"><!-- simple frame --></div>
       <div class="clearfix grpelem" id="u1150-5"><!-- content --> 
         <p><?php echo $_SESSION['nombres'];?>&nbsp; | <span id="u518-2"> <a href="../php/logout.php"><h12> cerrar sesion</h12></a></span></p>
       </div>
     </div>
   </div>
 </div>
 <div class="clearfix colelem" id="pu1132-5"><!-- group -->
   <div class="clearfix grpelem" id="u1132-5" ><!-- content -->
   </div>
   <div class="clearfix grpelem" id="u1134-4" >
     <!-- formulario insertar almacen -->
     <a   href="../panel.php" style="float:left; margin-right:10px"> << Regresar </a> <h3  style="margin-right:5px">|</h3>
     <h1>Editar Producto</h1><hr><br><br>
     <form action="inventario_editar_informacion_procesar.php" method="POST" >
      <label>Sucursal: <b><?php echo $renglon['id_sucursal']?> </b> </label> 
    <?php 
    if($usr_sucursal['id_sucursal']==0){
      //echo 'Cambiar - ';
      echo '<select name="sucursal" class="campoT" required>';
      $result_suc = $conn->query("select * from sucursales where id_sucursal!=0");
      while($sucs = $result_suc->fetch_assoc()){
              echo "<option value='".$sucs['id_sucursal']."'> ".$sucs['id_sucursal'].".- ".$sucs['sucursal']."  </option> ";
            }
      echo '</select>';
    }
    else{
      echo '<input type=hidden name="sucursal" value="'.$sucursal.'">';
    }
    ?>
    <br>
      <label >Nombre de Producto</label>
      <input class="campoT" type="text" name="nombre" value="<?php echo $renglon['nombre'];?>"><br>
      <label >Número de Serial</label>
      <input class="campoT" type="text" name="serial"  value="<?php echo $renglon['numero_serial'];?>"><br>
      <label>Descripción</label><textarea name="descripcion"><?php echo $renglon['descripcion'];?></textarea><br>
      
      <label style="float:left; margin-right:102px;width:150px">Es Reabastecible</label>
      <select class="campoT" style="width:90px" name="abastecer">
        <option value="1">Si</option>
        <option value="0">No</option>
      </select><br>
      <label style="float:left; margin-right:108px; ">Precio de compra</label>
      <input class="campoT" type="number" style="width:150px" name="pcompra" value="<?php echo $renglon['precio_compra'];?>"><br>
      
      <label style="float:left; margin-right:141px">Es para venta</label>
      <select class="campoT" id="options"  onchange="optionCheck()" style="width:90px" name="venta"   >
        <option value="0"  >No</option>
        <option value="1"  >Si</option>
      </select><br>
      <label style="float:left; margin-right:141px">Tipo: </label>
      <select class="campoT" id="options"  onchange="optionCheck()" style="width:90px" name="tipo_definicion"   >
        <option value="Material">Material</option>
        <option value="Equipo">Equipo</option>
        <option value="Instrumental">Instrumental</option>
      </select>
      <div id="precio" style="visibility:hidden">
        <label style="float:left; margin-right:126px">Precio de venta</label>
        <input class="campoT" type="number" style="width:150px; " name="pventa"  value="<?php echo $renglon['precio_venta'];?>"><br>
      </div>
      
      <label style="float:left; margin-right:15px">Cantidad Mínima que debe existir</label>
      <input class="campoT" type="number" style="width:50px" name="minima"  value="<?php echo $renglon['cantidad_minima'];?>"><br>
      <input type="hidden" name="id_producto" value="<?php echo $renglon['id_producto'];?>">
      <input type="submit" value="Enviar" style="float:left;">
    </form>
  </div>
</div>
<div class="verticalspacer"></div>
</div>
</div>
<div class="preload_images">
 <img class="preload" src="../images/u1154-r.png" alt=""/>
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