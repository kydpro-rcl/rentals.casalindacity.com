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
	<!--//<link rel="STYLESHEET" type="text/css" href="estilo.css">//-->
	<link rel="STYLESHEET" type="text/css" href="consolidated-base.css">
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

<?php

 if (($_GET['v'])||($_POST['v'])){

   // require("../init.php");
 require_once('../files.php');
 require_once('../../rent/reservations/init.php');
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
    $dellates_de_la_villa = $data->show_id('inmueble', $villa_id);

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
		<!--//<table>
			<tr><td bgcolor="#00FFFF" class="messiguiente"><a href="<?=$link_anterior?>" title="Previous month"><span>&lt;&lt;</span></a></td>
				<td colspan="2" bgcolor="#00FFFF" align="center">Availability</td>//-->
				<?
				$mes_siguiente = $mes + 1;
				$ano_siguiente = $ano;
				if ($mes_siguiente==13){
					$ano_siguiente++;
					$mes_siguiente=1;
				}
				$link_siguiente="index.php?v=$villa_id&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente";
				?>
				<!--//<td bgcolor="#00FFFF" align="right" class='mesanterior'><a href="<?=$link_siguiente?>" title="Next month">=><span>&gt;&gt;</span></a></td>
			</tr>//-->
			<div style="width:500px;">
               <?
                $mes_display=$mes;
                $ano_display=$ano;
                for ($c=1;$c<=3; $c++){

                // echo "<tr>";
                  for ($i=1;$i<=4; $i++){

                  		if ($mes_display==13){                  			$mes_display=1;                  			$ano_display++;                  		}
                       // echo "<td>";
                        ?>
                       <div style="float:left; margin:3px; padding:0px; /*width:129px;*/ height:148px; background-color:blue;">   <? mostrar_calendario($mes_display,$ano_display, $villa_id);?> </div>
                       <?
						//echo "</td>";
                        $mes_display++;
                  }
                // echo "</tr>";

               }?>
           <!--// </table>//-->
           </div>
<!--//
            <div class="clear"></div>

        			<div id="calendars">
        				<div class="month" id="3169577_1">
        					<table summary="Calendar: June 2011" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">June 2011</th></tr>
        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>

                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>
                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>

                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="a">1</td>
                    							<td class="a">2</td>

                    							<td class="a">3</td>
                    							<td class="a">4</td>
                    					</tr>
                    					<tr>
                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    							<td class="a">7</td>

                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    							<td class="a">10</td>
                    							<td class="a">11</td>
                    					</tr>
                    					<tr>
                    							<td class="a">12</td>

                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    							<td class="a">18</td>

                    					</tr>
                    					<tr>
                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="available-special">23</td>

                    							<td class="a s">24</td>
                    							<td class="a s">25</td>
                    					</tr>
                    					<tr>
                    							<td class="a s">26</td>
                    							<td class="a s">27</td>
                    							<td class="a s">28</td>

                    							<td class="a s">29</td>
                    							<td class="a s">30</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    					</tr>
                    			</tbody>
                    		</table>
                    	</div>
        				<div class="month" id="3169577_2">
        					<table summary="Calendar: July 2011" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">July 2011</th></tr>

        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>
                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>

                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="special-available">1</td>
                    							<td class="a">2</td>
                    					</tr>

                    					<tr>
                    							<td class="a">3</td>
                    							<td class="a">4</td>
                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    							<td class="a">7</td>

                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    					</tr>
                    					<tr>
                    							<td class="a">10</td>
                    							<td class="a">11</td>
                    							<td class="a">12</td>

                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    					</tr>
                    					<tr>
                    							<td class="a">17</td>

                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="a">23</td>

                    					</tr>
                    					<tr>
                    							<td class="a">24</td>
                    							<td class="a">25</td>
                    							<td class="a">26</td>
                    							<td class="a">27</td>
                    							<td class="a">28</td>

                    							<td class="a">29</td>
                    							<td class="a">30</td>
                    					</tr>
                    					<tr>
                    							<td class="a">31</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    			</tbody>
                    		</table>

                    	</div>
        				<div class="month" id="3169577_3">
        					<table summary="Calendar: August 2011" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">August 2011</th></tr>
        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>

                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>
                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>

                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="a">1</td>
                    							<td class="a">2</td>
                    							<td class="a">3</td>
                    							<td class="a">4</td>

                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    					</tr>
                    					<tr>
                    							<td class="a">7</td>
                    							<td class="a">8</td>
                    							<td class="a">9</td>

                    							<td class="a">10</td>
                    							<td class="a">11</td>
                    							<td class="a">12</td>
                    							<td class="a">13</td>
                    					</tr>
                    					<tr>
                    							<td class="a">14</td>

                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    							<td class="a">20</td>

                    					</tr>
                    					<tr>
                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="available-unavailable">23</td>
                    							<td class="u">24</td>
                    							<td class="u">25</td>

                    							<td class="u">26</td>
                    							<td class="u">27</td>
                    					</tr>
                    					<tr>
                    							<td class="u">28</td>
                    							<td class="u">29</td>
                    							<td class="u">30</td>

                    							<td class="u">31</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    					</tr>
                    			</tbody>
                    		</table>
                    	</div>
        				<div class="month" id="3169577_4">
        					<table summary="Calendar: September 2011" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">September 2011</th></tr>

        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>
                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>

                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="u">1</td>
                    							<td class="u">2</td>
                    							<td class="u">3</td>
                    					</tr>

                    					<tr>
                    							<td class="unavailable-available">4</td>
                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    							<td class="a">7</td>
                    							<td class="a">8</td>

                    							<td class="a">9</td>
                    							<td class="a">10</td>
                    					</tr>
                    					<tr>
                    							<td class="a">11</td>
                    							<td class="a">12</td>
                    							<td class="a">13</td>

                    							<td class="a">14</td>
                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    					</tr>
                    					<tr>
                    							<td class="a">18</td>

                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="a">23</td>
                    							<td class="a">24</td>

                    					</tr>
                    					<tr>
                    							<td class="a">25</td>
                    							<td class="a">26</td>
                    							<td class="a">27</td>
                    							<td class="a">28</td>
                    							<td class="a">29</td>

                    							<td class="a">30</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    			</tbody>
                    		</table>

                    	</div>
        				<div class="month" id="3169577_5">
        					<table summary="Calendar: October 2011" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">October 2011</th></tr>
        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>

                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>
                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>

                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="a">1</td>
                    					</tr>
                    					<tr>
                    							<td class="a">2</td>
                    							<td class="a">3</td>
                    							<td class="a">4</td>

                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    							<td class="a">7</td>
                    							<td class="a">8</td>
                    					</tr>
                    					<tr>
                    							<td class="a">9</td>

                    							<td class="a">10</td>
                    							<td class="a">11</td>
                    							<td class="a">12</td>
                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    							<td class="a">15</td>

                    					</tr>
                    					<tr>
                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    							<td class="a">20</td>

                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    					</tr>
                    					<tr>
                    							<td class="a">23</td>
                    							<td class="a">24</td>
                    							<td class="a">25</td>

                    							<td class="a">26</td>
                    							<td class="a">27</td>
                    							<td class="a">28</td>
                    							<td class="a">29</td>
                    					</tr>
                    					<tr>
                    							<td class="a">30</td>

                    							<td class="a">31</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    					</tr>
                    			</tbody>
                    		</table>
                    	</div>
        				<div class="month" id="3169577_6">
        					<table summary="Calendar: November 2011" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">November 2011</th></tr>

        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>
                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>

                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="a">1</td>
                    							<td class="a">2</td>
                    							<td class="a">3</td>
                    							<td class="a">4</td>
                    							<td class="a">5</td>
                    					</tr>

                    					<tr>
                    							<td class="a">6</td>
                    							<td class="a">7</td>
                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    							<td class="a">10</td>

                    							<td class="a">11</td>
                    							<td class="a">12</td>
                    					</tr>
                    					<tr>
                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    							<td class="a">15</td>

                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    					</tr>
                    					<tr>
                    							<td class="a">20</td>

                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="a">23</td>
                    							<td class="a">24</td>
                    							<td class="a">25</td>
                    							<td class="a">26</td>

                    					</tr>
                    					<tr>
                    							<td class="a">27</td>
                    							<td class="a">28</td>
                    							<td class="a">29</td>
                    							<td class="a">30</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    			</tbody>
                    		</table>

                    	</div>
        				<div class="month" id="3169577_7">
        					<table summary="Calendar: December 2011" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">December 2011</th></tr>
        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>

                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>
                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>

                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="a">1</td>

                    							<td class="a">2</td>
                    							<td class="a">3</td>
                    					</tr>
                    					<tr>
                    							<td class="a">4</td>
                    							<td class="a">5</td>
                    							<td class="a">6</td>

                    							<td class="a">7</td>
                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    							<td class="a">10</td>
                    					</tr>
                    					<tr>
                    							<td class="a">11</td>

                    							<td class="a">12</td>
                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    							<td class="a">17</td>

                    					</tr>
                    					<tr>
                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>
                    							<td class="a">22</td>

                    							<td class="a">23</td>
                    							<td class="a">24</td>
                    					</tr>
                    					<tr>
                    							<td class="a">25</td>
                    							<td class="a">26</td>
                    							<td class="a">27</td>

                    							<td class="a">28</td>
                    							<td class="a">29</td>
                    							<td class="a">30</td>
                    							<td class="a">31</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    					</tr>
                    			</tbody>
                    		</table>
                    	</div>
        				<div class="month" id="3169577_8">
        					<table summary="Calendar: January 2012" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">January 2012</th></tr>

        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>
                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>

                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    					<tr>
                    							<td class="a">1</td>
                    							<td class="a">2</td>

                    							<td class="a">3</td>
                    							<td class="a">4</td>
                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    							<td class="a">7</td>
                    					</tr>

                    					<tr>
                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    							<td class="a">10</td>
                    							<td class="a">11</td>
                    							<td class="a">12</td>

                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    					</tr>
                    					<tr>
                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    							<td class="a">17</td>

                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>
                    					</tr>
                    					<tr>
                    							<td class="a">22</td>

                    							<td class="a">23</td>
                    							<td class="a">24</td>
                    							<td class="a">25</td>
                    							<td class="a">26</td>
                    							<td class="a">27</td>
                    							<td class="a">28</td>

                    					</tr>
                    					<tr>
                    							<td class="a">29</td>
                    							<td class="a">30</td>
                    							<td class="a">31</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    			</tbody>
                    		</table>

                    	</div>
        				<div class="month" id="3169577_9">
        					<table summary="Calendar: February 2012" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">February 2012</th></tr>
        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>

                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>
                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>

                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="a">1</td>
                    							<td class="a">2</td>

                    							<td class="a">3</td>
                    							<td class="a">4</td>
                    					</tr>
                    					<tr>
                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    							<td class="a">7</td>

                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    							<td class="a">10</td>
                    							<td class="a">11</td>
                    					</tr>
                    					<tr>
                    							<td class="a">12</td>

                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    							<td class="a">18</td>

                    					</tr>
                    					<tr>
                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="a">23</td>

                    							<td class="a">24</td>
                    							<td class="a">25</td>
                    					</tr>
                    					<tr>
                    							<td class="a">26</td>
                    							<td class="a">27</td>
                    							<td class="a">28</td>

                    							<td class="a">29</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    					</tr>
                    			</tbody>
                    		</table>
                    	</div>
        				<div class="month" id="3169577_10">
        					<table summary="Calendar: March 2012" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">March 2012</th></tr>

        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>
                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>

                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="a">1</td>
                    							<td class="a">2</td>
                    							<td class="a">3</td>
                    					</tr>

                    					<tr>
                    							<td class="a">4</td>
                    							<td class="a">5</td>
                    							<td class="a">6</td>
                    							<td class="a">7</td>
                    							<td class="a">8</td>

                    							<td class="a">9</td>
                    							<td class="a">10</td>
                    					</tr>
                    					<tr>
                    							<td class="a">11</td>
                    							<td class="a">12</td>
                    							<td class="a">13</td>

                    							<td class="a">14</td>
                    							<td class="a">15</td>
                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    					</tr>
                    					<tr>
                    							<td class="a">18</td>

                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="a">23</td>
                    							<td class="a">24</td>

                    					</tr>
                    					<tr>
                    							<td class="a">25</td>
                    							<td class="a">26</td>
                    							<td class="a">27</td>
                    							<td class="a">28</td>
                    							<td class="a">29</td>

                    							<td class="a">30</td>
                    							<td class="a">31</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    			</tbody>
                    		</table>

                    	</div>
        				<div class="month" id="3169577_11">
        					<table summary="Calendar: April 2012" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">April 2012</th></tr>
        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>

                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>
                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>

                    			<tbody>
                    					<tr>
                    							<td class="a">1</td>
                    							<td class="a">2</td>
                    							<td class="a">3</td>
                    							<td class="a">4</td>
                    							<td class="a">5</td>

                    							<td class="a">6</td>
                    							<td class="a">7</td>
                    					</tr>
                    					<tr>
                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    							<td class="a">10</td>

                    							<td class="a">11</td>
                    							<td class="a">12</td>
                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    					</tr>
                    					<tr>
                    							<td class="a">15</td>

                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    							<td class="a">20</td>
                    							<td class="a">21</td>

                    					</tr>
                    					<tr>
                    							<td class="a">22</td>
                    							<td class="a">23</td>
                    							<td class="a">24</td>
                    							<td class="a">25</td>
                    							<td class="a">26</td>

                    							<td class="a">27</td>
                    							<td class="a">28</td>
                    					</tr>
                    					<tr>
                    							<td class="a">29</td>
                    							<td class="a">30</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    					</tr>
                    			</tbody>
                    		</table>
                    	</div>
        				<div class="month" id="3169577_12">
        					<table summary="Calendar: May 2012" cellspacing="0">
        						<thead>
        							<tr><th colspan="7" class="month-label" nowrap="nowrap">May 2012</th></tr>

        							<tr>
                    					<th class="day-label"><abbr title="Sunday">s</abbr></th>
                    					<th class="day-label"><abbr title="Monday">m</abbr></th>
                    					<th class="day-label"><abbr title="Tuesday">t</abbr></th>
                    					<th class="day-label"><abbr title="Wednesday">w</abbr></th>
                    					<th class="day-label"><abbr title="Thursday">t</abbr></th>

                    					<th class="day-label"><abbr title="Friday">f</abbr></th>
                    					<th class="day-label"><abbr title="Saturday">s</abbr></th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="a">1</td>
                    							<td class="a">2</td>
                    							<td class="a">3</td>
                    							<td class="a">4</td>
                    							<td class="a">5</td>
                    					</tr>

                    					<tr>
                    							<td class="a">6</td>
                    							<td class="a">7</td>
                    							<td class="a">8</td>
                    							<td class="a">9</td>
                    							<td class="a">10</td>

                    							<td class="a">11</td>
                    							<td class="a">12</td>
                    					</tr>
                    					<tr>
                    							<td class="a">13</td>
                    							<td class="a">14</td>
                    							<td class="a">15</td>

                    							<td class="a">16</td>
                    							<td class="a">17</td>
                    							<td class="a">18</td>
                    							<td class="a">19</td>
                    					</tr>
                    					<tr>
                    							<td class="a">20</td>

                    							<td class="a">21</td>
                    							<td class="a">22</td>
                    							<td class="a">23</td>
                    							<td class="a">24</td>
                    							<td class="a">25</td>
                    							<td class="a">26</td>

                    					</tr>
                    					<tr>
                    							<td class="a">27</td>
                    							<td class="a">28</td>
                    							<td class="a">29</td>
                    							<td class="a">30</td>
                    							<td class="a">31</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    					<tr>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>

                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    							<td class="e">-</td>
                    					</tr>
                    			</tbody>
                    		</table>

                    	</div>
					<div class="clear"></div>
					</div>
					<div class="previous"><img src="p379161_files/avail-prev-off.png"></div>
			<div class="next"><a href="javascript:ha.ajax.property.getMonth(379161,'trips',3169577,1);" class="arrowR"><img src="p379161_files/avail-next.png" title="Go to the next month." alt="Go to the next month."></a></div>
	<div class="clear"></div>//-->
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