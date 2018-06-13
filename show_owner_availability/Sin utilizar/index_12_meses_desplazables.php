<?php
///////////////////////////////////////////////////////////////////////////////////////////////
//Libreria para mostrar un calendario y obtener una fecha
//
//La página que llame a esta libreria debe contener un formulario con tres campos donde se introducirá el día el mes y el año que se desee
//Para que este calendario pueda actualizar los campos de formulario correctos debe recibir varios datos (por GET)
//formulario (con el nombre del formulario donde estan los campos
//dia (con el nombre del campo donde se colocará el día)
//mes (con el nombre del campo donde se colocará el mes)
//ano (con el nombre del campo donde se colocará el año)
///////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Calendario PHP</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=ISO-8859-1">
	<link rel="STYLESHEET" type="text/css" href="estilo.css">
	<!--//<link rel="STYLESHEET" type="text/css" href="consolidated-base.css">//-->
	<script type="text/javascript">
		function devuelveFecha(dia,mes,ano){
			//Se encarga de escribir en el formulario adecuado los valores seleccionados
			//también debe cerrar la ventana del calendario
			var formulario_destino = '<?php echo $_GET["formulario"]?>'

			var campo_destino = '<?php echo $_GET["nomcampo"]?>'

			//meto el dia
			eval ("opener.document." + formulario_destino + "." + campo_destino + ".value='" + dia + "/" + mes + "/" + ano + "'")
			window.close()
		}
	</script>
</head>

<body>
<div style="clear:both; width:600px;" >
	<!--//<div id="cal-legend">
		<div class="a key" ></div>
		<div class="label">Available</div>
		<div class="s key"></div>
		<div class="label">Occupied</div>
		<span class="clear"></span>
	</div> //-->
  <div id="cal-legend" style="width:600px;">
   <table style=" background-color: #ECECE5;    border: 1px solid #E7E7E2;  color: #444444;    margin-bottom: 10px;  padding: 10px 18px;" width="100%"><tr>
   <td><div class="a key" style="background-color:#FFFFFF;"></div>
		<div class="label"><b>Available</b></div></td>

		<td><div class="s key"></div>
		<div class="label"><b>Occupied</b></div></td>
        <td>Updated live time</td>
		</tr></table>
   </div>
</div>
<!--//<p style="clear:both;">&nbsp;</p>//-->

<?php

 if (($_GET['v'])||($_POST['v'])){

   // require("../init.php");
 #require_once('../files.php');
 require_once('../booking/init.php');
	//$db= new getQueries();


	?>


	<?php
	require ("calendar_villa.php");
	$tiempo_actual = time();
	$dia_solo_hoy = date("d",$tiempo_actual);
	if (!$_POST && !isset($_GET["nuevo_mes"]) && !isset($_GET["nuevo_ano"])){
		$mes = date("n", $tiempo_actual);
		$ano = date("Y", $tiempo_actual);
		$villa_id = $_GET["v"];

	}elseif ($_POST) {
		$mes = $_POST["nuevo_mes"];
		$ano = $_POST["nuevo_ano"];
		$villa_id = $_POST["v"];
	}else{
		$mes = $_GET["nuevo_mes"];
		$ano = $_GET["nuevo_ano"];
		$villa_id = $_GET["v"];
	}
    $data = new getQueries();
    $dellates_de_la_villa = $data->show_id('villas', $villa_id);

	$casa_detalles=$dellates_de_la_villa[0];


     if ($casa_detalles){

           $mes_anterior = $mes - 1;
			$ano_anterior = $ano;
			if ($mes_anterior==0){
				$ano_anterior--;
				$mes_anterior=12;
			}
          $link_anterior="index.php?v=$villa_id&nuevo_mes=$mes_anterior&nuevo_ano=$ano_anterior";

		?>
		<table>
			<tr><td bgcolor="#00FFFF" class="mesanterior"><a href="<?=$link_anterior?>" title="Previous month"><span>&lt;&lt;</span></a></td>
				<td colspan="2" bgcolor="#FFFFFF" align="center"><!--//Availability//--></td>
				<?
				$mes_siguiente = $mes + 1;
				$ano_siguiente = $ano;
				if ($mes_siguiente==13){
					$ano_siguiente++;
					$mes_siguiente=1;
				}
				$link_siguiente="index.php?v=$villa_id&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente";
				?>
				<td bgcolor="#00FFFF" align="right"  class="messiguiente"><a href="<?=$link_siguiente?>" title="Next month"><span>&gt;&gt;</span></a></td>
			</tr>
			<!--//<div style="width:500px;">class="mesanterior"//-->
               <?
                $mes_display=$mes;
                $ano_display=$ano;
                for ($c=1;$c<=3; $c++){

                 echo "<tr>";
                  for ($i=1;$i<=4; $i++){

                  		if ($mes_display==13){                  			$mes_display=1;                  			$ano_display++;                  		}
                        echo "<td valign=\"top\" style=\" border-color: #64C2FD; border-left: 1px solid #64C2FD; border-right: 1px solid #64C2FD; border-style: solid; border-width: 1px;\">";
                        ?>
                       <!--//<div style="float:left; margin:3px; padding:0px; /*width:129px;*/ height:148px; background-color:blue;"> //-->  <? mostrar_calendario($mes_display,$ano_display, $villa_id);?> <!--//</div>//-->
                       <?
						echo "</td>";
                        $mes_display++;
                  }
                 echo "</tr>";

               }?>
            </table>

	<?

	}else{
		 echo "<p id='error_s'>Error: villa not found</p>";
	}?>

 <?}else{   /*if not villa id*/
   echo "<p id='error_s' style='text-align:center;'>Critical Error: Missing Villa.</p>";
 }
 	 ?>
</body>
</html>