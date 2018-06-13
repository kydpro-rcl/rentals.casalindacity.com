<?php
session_start();
///////////////////////////////////////////////////////////////////////////////////////////////
//Libreria para mostrar un calendario y obtener una fecha
//
//La p�gina que llame a esta libreria debe contener un formulario con tres campos donde se introducir� el d�a el mes y el a�o que se desee
//Para que este calendario pueda actualizar los campos de formulario correctos debe recibir varios datos (por GET)
//formulario (con el nombre del formulario donde estan los campos
//dia (con el nombre del campo donde se colocar� el d�a)
//mes (con el nombre del campo donde se colocar� el mes)
//ano (con el nombre del campo donde se colocar� el a�o)
///////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Calendario PHP</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=ISO-8859-1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="STYLESHEET" type="text/css" href="estilo.css">
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<script type="text/javascript">
		function devuelveFecha(dia,mes,ano){
			//Se encarga de escribir en el formulario adecuado los valores seleccionados
			//tambi�n debe cerrar la ventana del calendario
			var formulario_destino = '<?php echo $_GET["formulario"]?>'

			var campo_destino = '<?php echo $_GET["nomcampo"]?>'

			//meto el dia
			eval ("opener.document." + formulario_destino + "." + campo_destino + ".value='" + dia + "/" + mes + "/" + ano + "'")
			window.close()
		}
	</script>
</head>

<body>

<?php
//TOMO LOS DATOS QUE RECIBO POR LA url Y LOS COMPONGO PARA PASARLOS EN SUCESIVAS EJECUCIONES DEL CALENDARIO
#$parametros_formulario = "formulario=" . $_GET["formulario"] . "&nomcampo=" . $_GET["nomcampo"];
 if (($_GET['v'])||($_POST['v'])){
    require("../init.php");



	?>

<section> 
	<div class="container">
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

	if (($mes<date("n", $tiempo_actual))&&($ano<=date("Y", $tiempo_actual))){
		$mes = date("n", $tiempo_actual);
		$ano = date("Y", $tiempo_actual);
	}

     if ($casa_detalles){
		//mostrar_calendario($mes,$ano, $villa_id);
		?>
		<!--
		<?if(!$_SESSION['REFERRALLOGO']){?>
		<a href="http://casalindacity.com/" alt="Go to our home page" title="Go to our home page" target="_blank"> <img class="img-responsive"  src="../images/logo.gif" alt="Residencial Casa Linda" border="0" /></a>
		<?}else{?>
		 <img src="../../for_rent1/<?=$_SESSION['REFERRALLOGO']?>" alt="Residencial Casa Linda" height="52px" border="0" />
		<?}?>-->
   
		<!--//<a href="../../for_rent/book_search.php" alt="" style="margin-bottom:3px; font-size:12px; color:blue; text-decoration:none; font-weight:bold;"target="_blank" >Click here to change Arrival/Departure date</a>//-->
		 <!--<table class="table">
		 	<tr>
		 		<td colspan="2"><?/* mostrar_calendario($mes,$ano, $villa_id);*/?> </td>
		 	</tr>
			<tr>
		 		<td>
					<div style="padding-bottom:3px; margin-bottom:3px; padding-top:3px; margin-top:3px;">
						<div style=" width:20px; height:20px; display:inline;border-left:black 1px solid; border-right:black 1px solid; border-top:black 1px solid; border-bottom:black 1px solid;" id="disponible">&nbsp;&nbsp;&nbsp;
						</div>&nbsp;<span style="font-size:10px; font-weight:bold;">Available</span>
					</div>
				</td>
		 		<td>
					<div style="padding-bottom:3px; margin-bottom:3px; padding-top:3px; margin-top:3px;">
						<div style=" width:20px; height:20px; display:inline;border-left:black 1px solid; border-right:black 1px solid; border-top:black 1px solid; border-bottom:black 1px solid;" id="ocupado">&nbsp;&nbsp;&nbsp;
						</div>&nbsp;<span style="font-size:10px; font-weight:bold;">Occupied</span>
					</div>
				</td>
		 	</tr>
		 	<tr>
		 		<td colspan="2">

		 		   <?/* formularioCalendario($mes,$ano, $villa_id); */?>
				</td>
		 	</tr>
		</table>-->
		<div class="row">
			 <div class="col-md-12"><? mostrar_calendario($mes,$ano, $villa_id);?> </div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div style="padding-bottom:3px; margin-bottom:3px; padding-top:3px; margin-top:3px;">
						<div class="text-center" style=" height:20px; display:block;border-left:black 1px solid; border-right:black 1px solid; border-top:black 1px solid; border-bottom:black 1px solid;" id="disponible">
						<span  style="font-size:10px; font-weight:bold;">Available</span></div>&nbsp;
				</div>
			</div>
			<div class="col-md-2">
				<div style="padding-bottom:3px; margin-bottom:3px; padding-top:3px; margin-top:3px;">
					<div class="text-center" style=" height:20px; display:block;border-left:black 1px solid; border-right:black 1px solid; border-top:black 1px solid; border-bottom:black 1px solid;" id="ocupado">
					<span style="font-size:10px; font-weight:bold;">Occupied</span></div>&nbsp;
				</div>
			</div>
			<div class="col-md-8"><? formularioCalendario($mes,$ano, $villa_id); ?></div>
		</div>
	<?

	}else{
		 echo "<p id='error_s'>Error: villa not found</p>";
	}?>
   
 <?}else{   /*if not villa id*/
   echo "<p id='error_s' style='text-align:center;'>Critical Error: Missing Villa.</p>";
 }
 	 ?>
	 </div>
</section> 
</body>
</html>