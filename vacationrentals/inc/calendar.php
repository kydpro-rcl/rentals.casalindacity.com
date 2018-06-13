
<?php

 if (($_GET['v'])||($_POST['v'])){

 require_once('../booking/init.php');

	?>


	<?php
	require ("inc/calendar_villa.php");
	$tiempo_actual = time();
	$dia_solo_hoy = date("d",$tiempo_actual);
	if (!$_POST && !isset($_GET["nuevo_mes"]) && !isset($_GET["nuevo_ano"])){
				
		$time_now_is=time();
		//$time_to_start=strtotime('-3 months', $time_now_is);;
		$time_to_start=$time_now_is;
		$mes = date('n', $time_to_start);
		//echo "Mes";
		$ano = date('Y', $time_to_start);
		//echo "year";
		
		/*$mes = date("n", $tiempo_actual);
		$ano = date("Y", $tiempo_actual);*/
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

		?>
		<div class="property-calendar-extreme-outer">
               <?
                $mes_display=$mes;
                $ano_display=$ano;
                for ($c=1;$c<=2; $c++){
                  for ($i=1;$i<=4; $i++){
                  		if ($mes_display==13){
                  			$mes_display=1;
                  			$ano_display++;
                  		}
                        echo "<div class=\"outer-calendar-table col-sm-6 col-md-4 col-lg-3\">";
                        ?>
                       <? mostrar_calendario2($mes_display,$ano_display, $villa_id);?>
                       <?
						echo "</div>";
                        $mes_display++;
                  }
            
               }?>
        </div>

	<?

	}else{
		 echo "<p id='error_s'>Error: villa not found</p>";
	}?>

 <?}else{   /*if not villa id*/
   echo "<p id='error_s' style='text-align:center;'>Critical Error: Missing Villa.</p>";
 }
 	 ?>