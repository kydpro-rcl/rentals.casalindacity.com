<?php
  /*#//------------------------------------VILLA-----------------------------------------------------------------------------------------------------------     */
  function Ocupaciones_Villa($villa_id, $fecha_mes_inicia, $fecha_mes_termina){ /* #//function que determina las ocupaciones de una villa en un mes  */
    $fechas_ocupadas=array();
	$db= new getQueries();

	$busy=$db->see_occupancy_no_zero2($villa_id, $fecha_mes_inicia, $fecha_mes_termina);

     foreach ($busy as $v){ /*#//cada ocupacion en esta villa para estas fechas*/
        $inicio_fecha=explode('-',$v['start']);
        $final_fecha=explode('-',$v['end']);

        $ano_inicial=$inicio_fecha[0];        $ano_final=$final_fecha[0];
        $mes_inicial=$inicio_fecha[1];        $mes_final=$final_fecha[1];
        $dia_inicial=$inicio_fecha[2];        $dia_final=$final_fecha[2];

        for ($z=$ano_inicial; $z<=$ano_final; $z++){ /* #//recorren los anos  */
        	if ($z==$ano_inicial){$mes_empezar_conteo=$mes_inicial;}else{$mes_empezar_conteo=1;}
            if ($z==$ano_final){$mes_finalizar_conteo=$mes_final;}else{$mes_finalizar_conteo=12;}
	        for ($m=$mes_empezar_conteo; $m<=$mes_finalizar_conteo; $m++){  /*#//recorren los meses */
	           if (($z==$ano_inicial)&&($m==$mes_inicial)){$dia_inicia_conteo=$dia_inicial;}else{$dia_inicia_conteo=1;}
	           if (($z==$ano_final)&&($m==$mes_final)){$dia_termina_conteo=$dia_final;}else{$ultimo_dia_ahora=ultimoDia($m,$z);$dia_termina_conteo=$ultimo_dia_ahora;}
				for ($x=$dia_inicia_conteo; $x<=$dia_termina_conteo; $x++){ /*# //recorren los dias*/
                     $fecha_generada=$z."-".$m."-".$x;
                     $fecha_generada_formateada=date('Y-m-d',strtotime($fecha_generada));
                     if ($fecha_generada_formateada!=$v['end']){ /*#//no introducir la fecha final   */
                     array_push($fechas_ocupadas,$fecha_generada_formateada);
                     }
				}/*#//fin dias*/
            }/*#//fin meses*/
     	}/*#//fin años  */
     }
	/*#//return $busy; */
	return $fechas_ocupadas;
}

	function status_ocupado($id_villa, $fecha){
		$db= new getQueries();
		$estado=$db->status_ocupa2($id_villa, $fecha);
		
		switch($estado){
			case '1': $stat="short";break;
			case '2': $stat="short";break;
			case '3': $stat="short";break;
			case '4': $stat="short";break;
			case '5': $stat="maint";break;
			case '6': $stat="short";break;
			case '7': $stat="owner";break;
			case '8': $stat="long";break;
			case '9': $stat="long";break;
			case '10': $stat="long";break;
			case '11': $stat="long";break;
			case '12': $stat="short";break;
			case '13': $stat="short";break;
			case '14': $stat="short";break;
			case '15': $stat="long";break;
			case '16': $stat="long";break;
			case '17': $stat="long";break;
			case '18': $stat="long";break;
			case '19': $stat="owner";break;
			case '20': $stat="owner";break;
			case '21': $stat="owner";break;
			case '22': $stat="long";break;
			case '23': $stat="long";break;
			case '24': $stat="long";break;
			case '25': $stat="long";break;
			
			case '26': $stat="long";break;
			case '27': $stat="long";break;
			case '28': $stat="long";break;
			case '29': $stat="long";break;
			case '30': $stat="short";break;
			case '31': $stat="short";break;
			case '32': $stat="short";break;
			case '33': $stat="short";break;
		}
		return $stat;
	}
//---------------------------------------------------------------------------------------------------------------------------------------------------
function dame_estilo($dia_imprimir){
	global $mes,$ano,$dia_solo_hoy,$tiempo_actual;
	/*#//dependiendo si el día es Hoy, Domigo o Cualquier otro, devuelvo un estilo   */
	if ($dia_solo_hoy == $dia_imprimir && $mes==date("n", $tiempo_actual) && $ano==date("Y", $tiempo_actual)){
		/*#//si es hoy     */
		$estilo = " class='hoy'";
	}else{
		$fecha=mktime(12,0,0,$mes,$dia_imprimir,$ano);
		if (date("w",$fecha)==0){
			/*#//si es domingo  */
			$estilo = " class='domingo'";
		}else{
			/*#//si es cualquier dia */
			$estilo = " class='diario'";
		}
	}
	return $estilo;
}

function mostrar_calendario($mes,$ano,$villa_id){
  /* # //============================================================================================================================================  */
    $fecha_primer_dia=$ano."-".$mes."-01";

    $dia_final_de_mes=ultimoDia($mes,$ano);
    $fecha_ultimo_dia=$ano."-".$mes."-".$dia_final_de_mes;

	$inicia_mes_introducido=date('Y-m-d',strtotime($fecha_primer_dia));
	$termina_mes_introducido=date('Y-m-d',strtotime($fecha_ultimo_dia));

	$fechas_villa_ocupada=Ocupaciones_Villa($villa_id, $inicia_mes_introducido, $termina_mes_introducido); /*//determina las fechas ocupada esta villa  */
	/*#//==================================================================================================================================================
	#global $parametros_formulario;
	#//tomo el nombre del mes que hay que imprimir*/
	$nombre_mes = dame_nombre_mes($mes);

	/*#//construyo la tabla general  */
	echo '<table class="tablacalendario" cellspacing="0" cellpadding="0" border="0" >';
	echo '<tr><td colspan="7" class="tit">';
	/*#//tabla para mostrar el mes el año y los controles para pasar al mes anterior y siguiente*/
	echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td >';

	echo "&nbsp;</td>";
	echo "<td class='titmesano'>$nombre_mes $ano</td>";
	echo "<td >";

	echo "&nbsp;</td></tr></table></td></tr>";
	echo '	<tr>
			    <td width="14%" class="day-label">M</td>
			    <td width="14%" class="day-label">T</td>
			    <td width="14%" class="day-label">W</td>
			    <td width="14%" class="day-label">T</td>
			    <td width="14%" class="day-label">F</td>
			    <td width="14%" class="day-label">S</td>
			    <td width="14%" class="day-label">S</td>
			</tr>';

	/*#//Variable para llevar la cuenta del dia actual */
	$dia_actual = 1;

	/*#//calculo el numero del dia de la semana del primer dia */
	$numero_dia = calcula_numero_dia_semana(1,$mes,$ano);
	/*#//echo "Numero del dia de demana del primer: $numero_dia <br>";*/

	/*#//calculo el último dia del mes */
	$ultimo_dia = ultimoDia($mes,$ano);
   /*#//=====================================================================================================================
	##\//escribo la primera fila de la semana*/
	echo "<tr>";
	for ($i=0;$i<7;$i++){
		if ($i < $numero_dia){
			/*#//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda */
			echo '<td class="diainvalido"><span></span></td>';
		} else {
			/*#//-----------------------------------------------------------------------------------------------   */
			$esta_fecha=$ano."-".$mes."-".$dia_actual;
            $fecha_formato=date('Y-m-d',strtotime($esta_fecha));
            /*if ((strtotime($fecha_formato))<(strtotime(date('Y-m-d')))){
          	 $pintar_con="fecha_pasada";
        	}else{ */
             if (in_array($fecha_formato,$fechas_villa_ocupada)){
				$status=status_ocupado($villa_id, $fecha_formato);
				 switch($status){
					case 'long': $pintar_con="long"; break;
					case 'short': $pintar_con="short"; break;
					case 'maint': $pintar_con="maint"; break;
					case 'owner': $pintar_con="owner"; break;
				 }
				}else{$pintar_con="disponible";}
            /*}*/
            /*#//---------------------------------------------------------------------------------------------- */
			echo "<td " . dame_estilo($dia_actual) . " id=\"$pintar_con\" ><span>$dia_actual</span></td>";
			$dia_actual++;
		}
	}
	echo "</tr>";

	/*#//recorro todos los demás días hasta el final del mes  */
	$numero_dia = 0;
	while ($dia_actual <= $ultimo_dia){
		/*#//si estamos a principio de la semana escribo el <TR>*/
		if ($numero_dia == 0)
			echo "<tr>";
		/*//--------------------------------------------------------------------------------------------------------------*/
		$esta_fecha2=$ano."-".$mes."-".$dia_actual;
        $fecha_formato2=date('Y-m-d',strtotime($esta_fecha2));
        /*if ((strtotime($fecha_formato2))<(strtotime(date('Y-m-d')))){
           $pintar_con2="fecha_pasada";
        }else{ */
        if (in_array($fecha_formato2,$fechas_villa_ocupada)){
		 
		 $status=status_ocupado($villa_id, $fecha_formato2);
		 switch($status){
					case 'long': $pintar_con2="long"; break;
					case 'short': $pintar_con2="short"; break;
					case 'maint': $pintar_con2="maint"; break;
					case 'owner': $pintar_con2="owner"; break;
				 }
		}else{$pintar_con2="disponible";}
        /*}
        #//-----------------------------------------------------------------------------------------------------------------------*/
		echo "<td " . dame_estilo($dia_actual) . " id=\"$pintar_con2\" ><span>$dia_actual</span></td>";
		$dia_actual++;
		$numero_dia++;
		/*#//si es el uñtimo de la semana, me pongo al principio de la semana y escribo el </tr>*/
		if ($numero_dia == 7){
			$numero_dia = 0;
			echo "</tr>";
		}
	}
   /*#//=====================================================================================================================
	#//compruebo que celdas me faltan por escribir vacias de la última semana del mes  */
	if ($numero_dia != 0){
		for ($i=$numero_dia;$i<7;$i++){
			echo '<td class="diainvalido"><span></span></td>';
		}
	}

	echo "</tr>";
	echo "</table>";
}



function formularioCalendario($mes,$ano,$villa_id){
	/*#global $parametros_formulario;
	#//index.php?' . $parametros_formulario . '" */
echo '
	<br><form action="index.php" method="POST">
	<table align="center" cellspacing="2" cellpadding="2" border="0" class=tform>
	<tr>';
echo '
    <td align="center" valign="top">
		Month:
		<select name=nuevo_mes>
		<option value="1"';
if ($mes==1)
 echo "selected";
echo'>January
		<option value="2" ';
if ($mes==2)
	echo "selected";
echo'>February
		<option value="3" ';
if ($mes==3)
	echo "selected";
echo'>March
		<option value="4" ';
if ($mes==4)
	echo "selected";
echo '>April
		<option value="5" ';
if ($mes==5)
		echo "selected";
echo '>May
		<option value="6" ';
if ($mes==6)
	echo "selected";
echo '>June
		<option value="7" ';
if ($mes==7)
	echo "selected";
echo '>July
		<option value="8" ';
if ($mes==8)
	echo "selected";
echo '>August
		<option value="9" ';
if ($mes==9)
	echo "selected";
echo '>September
		<option value="10" ';
if ($mes==10)
	echo "selected";
echo '>October
		<option value="11" ';
if ($mes==11)
	echo "selected";
echo '>November
		<option value="12" ';
if ($mes==12)
    echo "selected";
echo '>December
		</select>
		';
echo '

		Year:
		<select name=nuevo_ano>';

/*/este bucle se podría hacer dependiendo del número de año que se quiera mostrar  */
/*//yo voy a mostar 10 años atrás y 10 adelante de la fecha mostrada en el calendario */
for ($anoactual=$ano; $anoactual<=$ano+2; $anoactual++){
	echo '<option value="' . $anoactual . '" ';
	if ($ano==$anoactual) {
		echo "selected";
	}
	echo '>' . $anoactual . '</option>';
}
echo '
	</select>
		';
echo '<input type="hidden" name="v" value="'.$villa_id.'"/><input type="Submit" id="boton" value="&nbsp;GO !"></td>
	</tr>
	</table>
	</form>';
}

?>