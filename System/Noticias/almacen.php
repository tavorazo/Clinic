<?php
	@session_start();
	if($_SESSION['u']=='')
		header('location: index.php');
	//if($_SESSION['rol']!='admin' || $_SESSION['rol']!='almacen' )
	//	header('location: panel.php');
	$usuario = $_SESSION['u'];
?>
<!DOCTYPE html>
<html class="html">
 <head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="7.0.314.244"/>
  <title>Almacen</title>
      		<link rel="shortcut icon" type="x-icon" href="images/icon.png" /><!--para logo en barra-->
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/s1.css"/>
  <link rel="stylesheet" type="text/css" href="css/texto.css"/>
  <link rel="stylesheet" type="text/css" href="css/agendatabla.css"/>

  <link rel="stylesheet" type="text/css" href="css/site_global.css?417434784"/>
  <link rel="stylesheet" type="text/css" href="css/master_panel-master.css?3855693814"/>
  <link rel="stylesheet" type="text/css" href="css/almacen.css?3991206480" id="pagesheet"/>
  <!-- Other scripts -->
  <script type="text/javascript">
   document.documentElement.className += ' js';
</script>
   </head>
 <body>

  <div class="clearfix" id="page"><!-- column -->
   <div class="position_content" id="page_position_content">
    <div class="clearfix colelem" id="pu366"><!-- group -->
     <div class="browser_width grpelem" id="u366"><!-- group -->
      <div class="clearfix" id="u366_align_to_page">
       <a class="nonblock nontext clip_frame grpelem" id="u513" ><!-- image --><img class="block" id="u513_img" src="images/logo-endoperio-dental-center.jpg" alt="" width="134" height="38"/></a>
       <div class="grpelem" id="u516"><!-- simple frame --></div>
       <div class="clearfix grpelem" id="u518-5"><!-- content -->
        <p><?php echo $_SESSION['nombres'];?>&nbsp; | <span id="u518-2"> <a href="php/logout.php"><h12> cerrar sesion</h12></a></span></p>

       </div>
      </div>
     </div>
     <a href="panel.php">
      <img class="grpelem" id="u372" alt="servicios" src="images/blank.gif"/><!-- state-based BG images -->
     </a>
    </div>
    <div class="clearfix colelem" id="pu375"><!-- group -->
     <div class="browser_width grpelem" id="u375"><!-- simple frame --></div>
<?php
if($_SESSION['rol']=='admin' || $_SESSION['rol']=='secretaria' || $_SESSION['rol']=='recepcionista')
echo '<a class="nonblock nontext grpelem" id="u376" href="agenda.php"> <img id="u376_states" alt="Registro de consultas" src="images/blank.gif"/></a>';

if($_SESSION['rol']=='admin' || $_SESSION['rol']=='secretaria' || $_SESSION['rol']=='recepcionista' || $_SESSION['rol']=='dentista')
echo '<a class="nonblock nontext grpelem" id="u377" href="buscar-paciente.php"> <img id="u377_states" alt="Buscar paciente" src="images/blank.gif"/></a>';

if($_SESSION['rol']=='admin' || $_SESSION['rol']=='secretaria' || $_SESSION['rol']=='recepcionista')
echo '<a class="nonblock nontext grpelem" id="u378" href="add-paciente.php"> <img id="u378_states" alt="Agregar pacientes" src="images/blank.gif"/></a>';

if($_SESSION['rol']=='admin')
echo '<a class="nonblock nontext grpelem" id="u480" href="add-usuario.php"> <img id="u480_states" alt="Agregar usuarios" src="images/blank.gif"/></a>';

if($_SESSION['rol']=='admin' || $_SESSION['rol']=='almacen' || $_SESSION['rol']=='becario')
echo '<a class="nonblock nontext MuseLinkActive grpelem" id="u550" href="almacen.php"> <img id="u550_states" alt="Almacen" src="images/blank.gif"/></a>';

if($_SESSION['rol']=='admin')
echo '<a class="nonblock nontext grpelem" id="u552" href="contabilidad.php"> <img id="u552_states" alt="Contabilidad" src="images/blank.gif"/></a>';

?>
    </div>
    <div class="clearfix colelem" id="pu1084-4"><!-- group -->
     <a href="almacen.php"><img class="grpelem" id="u1084-4" src="images/u1084-4.png" alt="Agregar usuario" width="210" height="24"/></a><!-- rasterized frame -->
     <div class="clearfix grpelem"  style="min-height:300px" ><!-- content -->
      <!--p>*Esto es un ejemplo</p-->
     </div>
    </div>
    <div class="colelem">
    </div>
   </div>
<div style="position:relative; top:220px">

    <!-- codigo para almacen -->
    <?php
      include('php/base3.php');
      $result = $conn->query("SHOW COLUMNS FROM inventario");
      
      if($_SESSION['rol']=='admin')
      	
      
    ?>

  <div style="background:#FFFFFF; padding:30px; width:85%; margin-left:50px">
    <form action="almacen.php" method="POST" >
   
    <br><label style="float:left; ">Buscar producto</label>
    <input type="text" class="campoT" name="buscar" style="float:left; margin-left:10px; ">
    <input type="Submit" value="buscar" style="margin-top:-10px; margin-left:10px"><br><br>
    </form>
    <div style="  width:90%; margin-left:auto; margin-right:auto"><br><br>
      
      <?php
      if($_SESSION['rol']=='admin' || $_SESSION['rol']=='almacen'){
          echo '<div id="botn3" ><a href="inventario/inventario_insertar.php" target="_blank">';
          echo 'Agregar nuevo producto';
          echo '</a> </div>';
 	  echo "<div id='botn3' style='border:green 1px solid; '>
 	  	<a href='inventario/historial_admin.php' style='color:green'>Historial de inventario</a></div>";
         //if($_SESSION['rol']=='admin' || $_SESSION['rol']=='almacen')
}
         ?>
      
    </div>
  </div>

    <hr width="90%">
    <table border=1>
    <tr>
    <?php
    $i=0;
   /* if (mysql_num_rows($result)> 0) {
       while ($row = mysql_fetch_assoc($result)) {
           /*echo "<td>",$row['Field'],"</td>";
           if($i==0)
          echo "<td>Id_Producto</td>";
        if($i==1)
          echo "<td>Nombre del Producto</td>";
        if($i==2)
          echo "<td>N&uacute;mero Serial</td>";
        if($i==3)
          echo "<td>Descripci&oacute;n</td>";
        if($i==4)
          echo "<td>Cantidad en Inventario</td>";
        if($i==5)
          echo "<td>Reabastecible</td>";
        if($i==6)
          echo "<td>Cantidad M&iacute;nima Obligatoria</td>";
        $i++;
       }
    }*/
    ?>
    </tr>
          <?php
          //ahora consultamos a la base de datos para sacar los registros contenidos
          $result2 = $conn->query("SELECT * FROM inventario");
          /*while ($row2 = mysql_fetch_array($result2, MYSQL_NUM)) {
            echo "<tr>";
            for($i=0; $i<count($row2); $i++){
              echo "<td>",$row2[$i],"</td>";
            }
            echo "<td><a href='inventario/inventario_editar.php?id=",$row2[0],"'>Abastecer</a></td><td><a href='inventario/inventario_eliminar.php?id=",$row2[0],"'>Eliminar</a></td>";
            echo "</tr>";
          }*/
          ?>
          </table>

    <!-- codigo para BUSCAR en almacen -->
    <?php
  
    include("php/base.php");

   /* $link = mysql_connect('localhost', 'root', '')
        or die('No se pudo conectar: ' . mysql_error());
    mysql_select_db('Endoperio') or die('No se pudo seleccionar la base de datos');*/
	include('php/base3.php');
    ?>

    <?php

    $buscar = $_POST['buscar'];
    $result2 = $conn->query("select * from inventario where nombre like '%$buscar%' or numero_serial like '%$buscar%' or descripcion like '%$buscar%' ;");
//ocultar esto mientra no busque
      echo '<h1>En almacen: ',$buscar,'</h1>';

        $a = 0;
        echo "<table style='border:none; min-width:90%; color:#A0ABAB'>";
         echo "<tr style=' background:#585A5A'>
                <td>Nombre</td><td>Serial</td><td>Descripcion</td><td>Existencia</td><td></td><td>Cantidad minima</td><td>Ajustar</td><td></td><td></td></tr>
                <td></td><td></td><td></td><td></td><td></td><td> </td><td></td><td></td><td></td></tr>";
         
        while ($row2 = mysql_fetch_array($result2, MYSQL_NUM)) {
            $a = 1;

          echo "<tr style='background:#FFFFFF'><td>",$row2[1],"</td><td>", $row2[2],"</td><td>", $row2[3],"</td><td>", $row2[4],"</td>";
          if($row2[5]=='1'){
          echo "<td> Si</td><td>",$row2[6],"</td>";
          
          echo '<td>
                  <form action="inventario/inventario_procesar_editar.php" method="POST">
                    <input type="hidden" name="id" value="',$row2[0],'">
                    <input type="hidden" name="cantidad" value="',$row2[4],'">
                    <input class="campoT" type="number" style="width:50px; margin-left:10px" name="nueva_cantidad"> 
                  </td><td>
                    <input type="submit" value="Ajustar" style="width:80px;">
                  </td>
                  </form>';
          echo "<td style='padding:3px'>";
          if($_SESSION['rol']=='admin' || $_SESSION['rol']=='almacen'){
          	echo "<div id='botn2' style='margin-left:2px; height:15px;  width:80px'>";
          
                      echo "<a href='inventario/inventario_eliminar.php?id=",$row2[0],"'>Eliminar
                      </a>";
                    echo" </div>";}
                echo "</td></tr>";
          }else{
            echo "<td> No </td>";
            echo "<td><div id='botn2' style='margin-left:-9px; height:15px; margin-bottom:4px; width:10px'>";
            if($_SESSION['rol']=='admin')
            	echo "<a href='inventario/inventario_eliminar.php?id=",$row2[0],"'>Eliminar</a>";
            echo "</div></td>
                    <td>...</td></tr>";
          }
          //echo "<hr style='margin-bottom:20px;'>";
        }
        echo "</table>";
        if($a==0)
          print "no hay resultados<br><br>";
    ?>

    <a class="nonblock nontext clip_frame colelem" id="u405" href="http://tavorazo.github.io"><!-- image --><img class="block" id="u405_img" src="https://cdn4.iconfinder.com/data/icons/iconsimple-logotypes/512/github-32.png"alt="Octavio Razo" /></a>
</div>
  </div>
  <div class="preload_images">
   <img class="preload" src="images/u372-r.png" alt=""/>
   <img class="preload" src="images/u376_states-r.png" alt=""/>
   <img class="preload" src="images/u376_states-a.png" alt=""/>
   <img class="preload" src="images/u377_states-r.png" alt=""/>
   <img class="preload" src="images/u377_states-a.png" alt=""/>
   <img class="preload" src="images/u378_states-r.png" alt=""/>
   <img class="preload" src="images/u378_states-a.png" alt=""/>
   <img class="preload" src="images/u480_states-r.png" alt=""/>
   <img class="preload" src="images/u480_states-a.png" alt=""/>
   <img class="preload" src="images/u550_states-r.png" alt=""/>
   <img class="preload" src="images/u550_states-a.png" alt=""/>
   <img class="preload" src="images/u552_states-r.png" alt=""/>
   <img class="preload" src="images/u552_states-a.png" alt=""/>
  </div>
  <!-- JS includes -->
  <script type="text/javascript">
   if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script src="scripts/museutils.js?3865766194" type="text/javascript"></script>
  <script src="scripts/jquery.tobrowserwidth.js?3842421675" type="text/javascript"></script>
  <script src="scripts/jquery.watch.js?4068933136" type="text/javascript"></script>
  <!-- Other scripts -->
  <script type="text/javascript">
   $(document).ready(function() { try {
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
$('.browser_width').toBrowserWidth();/* browser width elements */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.fullPage('#page');/* 90% height page */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
} catch(e) { Muse.Assert.fail('Error calling selector function:' + e); }});
</script>
   </body>
</html>