<?

 function mostrar_meses($dia,$mes,$ano){
	$mes_hoy=date("m");
	$ano_hoy=date("Y");
	if (($mes_hoy <> $mes) || ($ano_hoy <> $ano))
	{
		$hoy=0;
	}
	else
	{
		$hoy=date("d");
	}
	//tomo el nombre del mes que hay que imprimir
	$nombre_mes = dame_nombre_mes($mes);
	$dia_actual = 1;
	//calculo el numero del dia de la semana del primer dia
	$numero_dia = calcula_numero_dia_semana(1,$mes,$ano);
	//echo "Numero del dia de demana del primer: $numero_dia <br>";
	//calculo el �ltimo dia del mes
	$ultimo_dia = ultimoDia($mes,$ano);
	?>

	  <table border="0" align="center" ><tr><td valign="top">
	<?
	$db = new getQueries;    //connect to query database
	$data= new subDB();
	switch($_SESSION['toshow']){
		case '1': $cond="able_r=1 AND bed=1"; break;
		case '2': $cond="able_r=1 AND bed=2"; break;
		case '3': $cond="able_r=1 AND bed=3"; break;
		case '4': $cond="able_r=1 AND bed=4"; break;
		case '5': $cond="able_r=1 AND bed=5"; break;
		case '6': $cond="able_r=1 AND bed=6"; break;
		case '10': $cond="able_r=1"; break;
		default: $cond="able_r=1 AND bed=2"; 
	}
	$v="villas"; $order="no";
	$result=$db->showTable_restrinted($v,$cond,$order);  //SHOW ONLY VILLAS AVAILABLE FOR RENT
	  echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" id=\"villas_head_table\" style=\"border: thin solid rgb(255, 127, 80);\">
	    <tr ><td colspan=\"4\" align=center class=\"tit\">
	    <table cellspacing=\"2\" cellpadding=\"2\" border=\"0\" width=\"100%\"><tr><td style=\"color:black; font-weight:bold; background-color:yellow;\"><span style='font-size:100%'>Total:&nbsp;".count($result)."&nbsp;units</span></td></tr></table>
	    </td></tr>
	 <tr><td colspan=\"4\"  align=center class='fuentes'>VILLAS</td></tr>
	<tr style=\"background-color:#004879; \"><td class='fuentes' style=\"color:#FFFFFF; \">No.</td><td align=center class='fuentes' style=\"color:#FFFFFF; \">Type</td><td class='fuentes'>&nbsp;</td><td align=center class='fuentes' style=\"color:#FFFFFF; \">BDR</td></tr>"; //start showing villas  //class='fuentes_bold'
	$count=0;
	$row=$db->getAffectedRows();
	//echo "$row";
	 foreach($result as $k){
		 $count++;/*cantidad de villas encontradas para mostrar*/

		 //--------------------------------
		 $clean=$db->clean($k['id']);

		 switch($clean['status']){
		 	   case 1:          //ready cleaned
	  				  $color_de_fondo="#1818f6";
		  			  $color_de_letra="white";
		 	   		  break;
		 	   case 2:           //dirty
		 	   		  $color_de_fondo="#0f0f0f";
		  			  $color_de_letra="white";
		 	   		  break;
		       case 3:           //in process - cleaning
		       		  $color_de_fondo="#f9a334";
		  			  $color_de_letra="blue";
		 	   		  break;
		 	   default:			//unknown
					  $color_de_fondo="white";
		  			  $color_de_letra="black";
		 }

        /*
		  if ($k['bed']==2){
		  $color_de_fondo="white";
		  $color_de_letra="blue";
		 }elseif($k['bed']==3){
		  $color_de_fondo="#b5e5fd";
		  $color_de_letra="green";
         }elseif($k['bed']==4){
          $color_de_fondo="#dee3e6";
          $color_de_letra="red";
         }else{
          $color_de_fondo="#92d050";
          $color_de_letra="blue";
         } */

		 echo "<tr onclick=\"window.open('view-villas-details.php?id=".$k['id']."','mywindow','width=930,height=600')\"  style=\"background-color:$color_de_fondo; \" onmouseover=\"this.style.backgroundColor='#468bf6'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor='$color_de_fondo'\" >";
		 
		 echo "<td class='fuentes_left11'><span style='color:$color_de_letra'>".$k['no']."</span></td>";
		 
		 echo "<td class='fuentes_left11' nowrap><span style='color:$color_de_letra' >";
		 echo $k['type'];
		 
		 echo "</span></td>";
		
		echo "<td class='fuentes_left11'><span style='color:$color_de_letra' >";
		 switch($k['classification']){
			 case 1: echo "p"; break;
			 case 2: echo "d"; break;
			 default: echo "u";
		 }
		 echo "</span></td>";
		 
		 echo "<td class='fuentes_left11' align='center' ><span style='color:$color_de_letra'>".$k['bed']."</span></td></tr>";
		}

	echo "</table>";   //end showing villas

	?>
	</td><td valign="top">
	<?

	//Start showing months
/*id=\"villas_head_table\"*/

       echo "<table width=100% cellspacing='2' cellpadding='2' border='0' style=\"background-color:#004879; border-top:1px solid gray;\"><tr class=\"tit\"><td align='left' style=font-size:9pt;font-weight:bold;color:white>";
            $mes_anterior = $mes - 1;
			$ano_anterior = $ano;
			if ($mes_anterior==0){
				$ano_anterior--;
				$mes_anterior=12;
			}

	echo "<a title='Last Month' style=color:white;text-decoration:none href=\"booking-calendar.php?dia=1&nuevo_mes=$mes_anterior&nuevo_ano=$ano_anterior\">&lt;&lt;</a></td>";
	//--------------name of months -----------///
	   echo "<td align=center class=tit><div style='padding:0px; margin:0px; margin-right:0px; padding-right:0px;'>";
	   $mes_short_letter=month_letters_2();

	   $cm2=0;//-----------------HACIA LA IZQUIERDA---------------------------------------
		  for ($cm2=6; $cm2>=1; $cm2--){
		  	$mes_actual_izq=(date('m',strtotime($nombre_mes))-$cm2);

            if ($mes_actual_izq<=0){
		   		$cma_2=0;
		   		$mes_actual_izq_ant=12+$mes_actual_izq;
                $mes_actual_izq_ant=str_pad($mes_actual_izq_ant, 2, "0", STR_PAD_LEFT);
                $ano_ant=($ano-1);
                //-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
	             if ($_GET['inicio']){
			  	   $link="booking-calendar.php?&inicio=".$_GET['inicio']."&villa=".$_GET['villa']."&dia=1&nuevo_mes=$mes_actual_izq_ant&nuevo_ano=$ano_ant";
			  	 }else{
			  	   $link="booking-calendar.php?dia=1&nuevo_mes=$mes_actual_izq_ant&nuevo_ano=$ano_ant";
	             }
             	//-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
		    	echo "<span style='font-size:8.5px;' id=\"meses_6_year\"><a href=\"$link\" alt=\"\" >".$mes_short_letter[$mes_actual_izq_ant]." ".(substr(($ano_ant),2,2))."</a></span>|";
        	}

            if ($mes_actual_izq>0){
		  	 $mes_actual_izq=str_pad($mes_actual_izq, 2, "0", STR_PAD_LEFT);
            //-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
             if ($_GET['inicio']){
		  	   $link="booking-calendar.php?&inicio=".$_GET['inicio']."&villa=".$_GET['villa']."&dia=1&nuevo_mes=$mes_actual_izq&nuevo_ano=$ano";
		  	 }else{
		  	   $link="booking-calendar.php?dia=1&nuevo_mes=$mes_actual_izq&nuevo_ano=$ano";
             }
             //-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
		    echo "<span style='font-size:8.5px;' id=\"meses_6\"><a href=\"$link\" alt=\"\" >".$mes_short_letter[$mes_actual_izq]." ".$ano."</a></span>|";
            }

		  }
	   echo "<span style='font-size:9px;text-transform:uppercase;'>$nombre_mes $ano</span>";  //----------------CENTRO--------------------------
	     $cm=0;    //----------HACIA LA DERECHA------------------------------------------------


		   for ($cm=1; $cm<=6; $cm++){
              $mes_actual_der=(date('m',strtotime($nombre_mes))+$cm);
              if ($mes_actual_der<=12){
				  $mes_actual_der=str_pad($mes_actual_der, 2, "0", STR_PAD_LEFT);
				  	//-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
		             if ($_GET['inicio']){
				  	   $link="booking-calendar.php?&inicio=".$_GET['inicio']."&villa=".$_GET['villa']."&dia=1&nuevo_mes=$mes_actual_der&nuevo_ano=$ano";
				  	 }else{
				  	   $link="booking-calendar.php?dia=1&nuevo_mes=$mes_actual_der&nuevo_ano=$ano";
		             }
		             //-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
			      echo "|<span style='font-size:8.5px;' id=\"meses_6\"><a href=\"$link\" alt=\"\" >".$mes_short_letter[$mes_actual_der]." ".$ano."</a></span>";
			  }

		   	if ($mes_actual_der>12){
		   		$cma=0;
		   	 	for ($cm_1=$cm; $cm_1<=6; $cm_1++){
                  $mes_actual_der=1+$cma;
                  $cma++;
                  $mes_actual_der=str_pad($mes_actual_der, 2, "0", STR_PAD_LEFT);
                  $ano_sig=($ano+1);
                  //-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
		             if ($_GET['inicio']){
				  	   $link="booking-calendar.php?&inicio=".$_GET['inicio']."&villa=".$_GET['villa']."&dia=1&nuevo_mes=$mes_actual_der&nuevo_ano=$ano_sig";
				  	 }else{
				  	   $link="booking-calendar.php?dia=1&nuevo_mes=$mes_actual_der&nuevo_ano=$ano_sig";
		             }
		          //-------------SE FABRICAN LOS ENLANCES---------------------------------------------------------------------------------------------
		      	  echo "|<span style='font-size:8.5px;' id=\"meses_6_year\"><a href=\"$link\" alt=\"\" >".$mes_short_letter[$mes_actual_der]." ".substr(($ano_sig),2,2)."</a></span>";
		      //date('y', strtotime($ano."+1 year"))
		   	 	}
		   	 	$cm=$cm_1;//porque si $cm es igual a final no vuelve a ejecutarse
        	}
		   }
	   echo "</div></td>";
	 //------------------------------------------------------------------------------------------------------------------------------------------------

	 echo "<td align=right style=font-size:9pt;font-weight:bold;color:white>";
	//calculo el mes y ano del mes siguiente
			$mes_siguiente = $mes + 1;
			$ano_siguiente = $ano;
			if ($mes_siguiente==13){
				$ano_siguiente++;
				$mes_siguiente=1;
			}

			if ($_GET['inicio']){
				/*echo "<a title='Next Month' style=color:white;text-decoration:none href=\"booking-calendar.php?&inicio=".
				$_GET['inicio']."&villa=".$_GET['villa']."&dia=1&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente\">&gt;&gt;</a></td></tr></table></td></tr>"; */
				echo "<a title='Next Month' style=color:white;text-decoration:none href=\"booking-calendar.php?&inicio=".
				$_GET['inicio']."&villa=".$_GET['villa']."&dia=1&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente\">&gt;&gt;</a></td></tr></table>";
		    }else{
		     // echo "<a title='Next Month' style=color:white;text-decoration:none href='booking-calendar.php?dia=1&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente'>&gt;&gt;</a></td></tr></table></td></tr>";
		     echo "<a title='Next Month' style=color:white;text-decoration:none href='booking-calendar.php?dia=1&nuevo_mes=$mes_siguiente&nuevo_ano=$ano_siguiente'>&gt;&gt;</a></td></tr></table>";
		    }  //end head month year

   echo "<table width=100% cellspacing='0' cellpadding='0' border='1' id=\"table\" style=\"border: thin solid grey;\">";
  // 	$spandir=$ultimo_dia-2;
           //-------HACER EL GRUPO DE COLUMNA POR LAS CANTIDAD DE VILLAS AQUI--------

           # foreach($result as $k){
           /*	for ($i=1; $i<=$ultimo_dia; $i++){
              echo "<colgroup></colgroup>";
             } */
             for ($i=0; $i<=$ultimo_dia; $i++){
              echo "<colgroup></colgroup>";
             }
           ///----TERMINAN LOS GRUPOS DE COLUMNAS PARA LAS CANTIDADES DE VILLAS AQUI----------

   /* echo "<tr ><td colspan=$ultimo_dia align=center class=\"tit\">";*/ /*FILLA PARA LOS MESES DEL A�O*/


    //print letter acutal day, mon as in monday, etc.
    echo "<tr >";/*style='background-color:#cecccc' fila de los dias de la semna en nombre*/
    echo "<td align=center class=\"name_head_today\" style='border:none;'>&nbsp;</td>";/* COLUMNA ADDICIONAL PARA MARCAR, PEDICION DE GABINO*/
     for ($i=1; $i<=$ultimo_dia; $i++){

     $name_day=date("D", mktime(0, 0, 0, $mes, $i, $ano));

      if ($name_day=='Sat'){
       if ($i==$hoy){ echo "<td align=center class=\"name_head_today\" style='color:green'>$name_day</td>";}else{echo "<td align=center style='color:green' class='fuentes'>$name_day</td>";}

      }elseif ($name_day=='Sun'){
       if ($i==$hoy){echo "<td align=center class=\"name_head_today\" style='color:#ac1212;'>$name_day</td>";}else{ echo "<td align=center style='color:#ac1212;' class='fuentes'>$name_day</td>";}

      }else{
          if ($i==$hoy){echo "<td align=center class=\"name_head_today\" style='border: solid 1px #FF0000;' >$name_day</td>";}else{echo "<td align=center class='fuentes' >$name_day</td>";}
      }
	}
	echo "</tr>";
   //end printing day name

   echo "<tr >";/*style='background-color:#efebeb' fila de los dias de la semana en numero*/
     $width=100/$ultimo_dia;
     echo "<td align=center width=\"24\" class=\"name_head_today\" style='border:none;'>&nbsp;</td>";/* COLUMNA ADDICIONAL PARA MARCAR, PEDICION DE GABINO*/
    for ($i=1; $i<=$ultimo_dia; $i++){

      if ($i==$hoy){
       echo "<td align=center width=\"24\" class=\"name_head_today\" >$i</td>";
      }else{
  	   echo "<td align=center width=\"24\" class='fuentes'>$i</td>";
  	  }
	}
	echo "</tr>";

  // $total_casas=5;
   $x=1;  $c=0;
   //       $x<=$total_casas
  while($x<=$count){
  	//==========================MAKE THE CALENDAR FASTER============================================================
	$primer_dia='01';
	$fecha_inicio_mes="$ano-$mes-$primer_dia";
	$fecha_fin_mes="$ano-$mes-$ultimo_dia";
	/*$busy=$db->see_occupancy_no_zero2($result[$c]['id'], $fecha_inicio_mes, $fecha_fin_mes);*/ //see_occupancy_no_zero2($villa_id, $inicio_mes, $fin_mes)
	$busy=$db->see_occupancy_no_zero2_NoTemp($result[$c]['id'], $fecha_inicio_mes, $fecha_fin_mes); //see_occupancy_no_zero2($villa_id, $inicio_mes, $fin_mes)
	//==========================END MAKE THE CALENDAR FASTER============================================================
  #$busy=$db->see_occupancy_no_zero($result[$c]['id']);     //verificar ocupabilidad
   if (!empty($busy)){ //solo si hay datos de ocupabilidad
    //echo $result[$c]['no']." A <br>";
    $busy_count=1;
    foreach ($busy as $busy){
    ${"inicia{$busy_count}"}=$busy['start'];
    ${"finaliza{$busy_count}"}=$busy['end'];
    ${"estadia{$busy_count}"}=$busy['nights'];
    ${"status{$busy_count}"}=$busy['status'];
    ${"ocup_id{$busy_count}"}=$busy['busyid'];
	 ${"source{$busy_count}"}=$busy['source'];
	 ${"ref{$busy_count}"}=$busy['ref'];
   // echo $result[$c]['no']." ".${"inicia{$busy_count}"}." ".${"finaliza{$busy_count}"}." $busy_count<br>";
    $busy_count++;
    }
    }

	 $widthW=820; $heightW=570; /*height and width for windows*/
   //echo "<tr  onmouseover=\"this.style.backgroundColor='#900;'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\">";
	echo "<tr  onmouseover=\"this.style.cursor='hand';this.style.cursor='pointer';\" >";
         $count_nights=0;
         $ocupaciones=0;
         $ultima_ocup=$busy_count-1;
        // $ocup=0;
        echo "<td class='name_head' style='border:none;'>&nbsp;</td>";/* COLUMNA ADDICIONAL PARA MARCAR, PEDICION DE GABINO*/
   for ($i=1; $i<=$ultimo_dia; $i++){
    $fecha_actual_dia="$ano-$mes-$i"; //for background when get id
          if (!empty($busy)){
               $current_date="$ano-$mes-$i";

               $calendar_date=strtotime(date("Y-m-d", strtotime($current_date)));



                 if (($count_nights==0 ) && ($ocupaciones<=$ultima_ocup)){


                       for ($ocup=$ocupaciones; $ocup<=$ultima_ocup; $ocup++){
                              $inicia=${"inicia{$ocup}"};   //fecha de inicio
                     		  $estadia=${"estadia{$ocup}"};  //cantidad de noches
                     		  $termina=${"finaliza{$ocup}"};  //fecha fin
                              $status=${"status{$ocup}"};
                              $ocup_id=${"ocup_id{$ocup}"};
							  $fuente=${"source{$ocup}"};
							  $referencia=${"ref{$ocup}"};
                              $inicio_date = strtotime(date("Y-m-d", strtotime($inicia)));
                              $fin_date = strtotime(date("Y-m-d", strtotime($termina)));
                              //$dia_actual=(date("Y-m-d",$current_date));
                              $dd=strtotime($current_date);
                              $d_hoy_fecha=date("Y-m-d", $dd);
                             // @$result_inicio=$data->daysDifference($inicia,$d_hoy_fecha);
                             // $result_fin=$data->daysDifference($termina,$d_hoy_fecha);
                             $result_inicio=$data->nights_qty($inicia,$d_hoy_fecha);
                             $result_fin=$data->nights_qty($termina,$d_hoy_fecha);
							
							if($fuente==3){//apollo
							$letra1= 'A';
							}else{ //short tern
							$letra1= 'S';
							}

                             if ($calendar_date==$inicio_date){
                          		switch ($status){
                          		    case 1:     //check in short term
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT

	                          		    if ($_GET['inicio']){
                                  				$end_date="$ano-$mes-$i";
												echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkin\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">$letra1</td>";
											}else{
							 					 echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\"
	                          		     		onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">$letra1<!--$ocup--></td>";
							 				}
	                          		     }else{     //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                          		     		$end_date="$ano-$mes-$i";
												echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkin\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
											}else{
	                          		     	 echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">U</td>";
	                          		     	 $ocupaciones=$ocup;
	                          		     	 break 2;
                                              }
	                          		     }
                          		     break;
                          		     case 2:    //confirmed short term
	                          		     if ($estadia>1){//BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
                                  			$end_date="$ano-$mes-$i";
											echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reserved\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">$letra1</td>";
                                  			}else{
	                          		     	echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">$letra1</td>";
	                          		     	}
	                          		     }else{ //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
                                  			$end_date="$ano-$mes-$i";
                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reserved\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
	                          		    	echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
	                          		     	$ocupaciones=$ocup;
		                          		 	break 2;
		                          		 	}
	                          		     }
                          		     break;
                          		     case 3:  //transit short term
	                          		     if ($estadia>1){  //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
                                  			$end_date="$ano-$mes-$i";
                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transit\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">$letra1</td>";
                                  			}else{
	                          		     	echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">$letra1</td>";
	                          		     	}
	                          		     }else{ //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
                                  			$end_date="$ano-$mes-$i";
                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transit\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  	echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 4:  //checkout short term
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
                                  			$end_date="$ano-$mes-$i";
                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkout\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">$letra1</td>";
                                  			}else{
	                          		     	echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkout\">$letra1</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
                                  			$end_date="$ano-$mes-$i";
                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkout\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  	echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkout\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 5:  //maintenance
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"maintenance\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">&nbsp;</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"maintenance\">&nbsp;</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"maintenance\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"maintenance\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 6:  //vip short rentals check in
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"vip_rentals\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">SV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"vip_rentals\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 7:  //owner SHORT staying  check in
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">SO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 8:  //Long term rental check in
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"long_rental\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">L</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"long_rental\">L</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"long_rental\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"long_rental\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 9:  //Long term rental CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedL\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">L</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedL\">L</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedL\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedL\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 10:  //Long term rental NO CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitL\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">L</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitL\">L</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitL\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitL\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 11:  //Long term rental check OUT
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutL\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">L</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutL\">L</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutL\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutL\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 12:  //vip short rentals confirmed
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">SV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 13:  //vip short rentals not confirmed
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">SV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 14:  //vip short rentals check out
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">SV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 15:  //vip long rentals check in
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"vip_rentals\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">LV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"vip_rentals\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 16:  //vip LONG rentals CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">LV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 17:  //vip LONG rentals NOT CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">LV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		      case 18:  //vip LONG rentals check OUT
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LV</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">LV</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutV\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 19:  //owner SHORT staying  CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">SO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 20:  //owner SHORT staying  NOT CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">SO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 21:  //owner SHORT staying  check OUT
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">SO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">SO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 22:  //owner LONG staying  check in
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">LO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 23:  //owner LONG staying  CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">LO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;

                          		     case 24:  //owner LONG staying  NOT CONFIRMED
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">LO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 25:  //owner LONG staying  check OUT
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">LO</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">LO</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 26:  /*Buyer check in-Long*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BL</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">BL</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 28:  /* Buyer confirmed-Long*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BL</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">BL</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reservedO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;

                          		     case 27:  /*Buyer no confirmed-Long*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BL</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">BL</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transitO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 29:  //*Buyer checked out-Long*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BL</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">BL</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 30:  /*Buyer check in-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BS</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">BS</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"owners_staying\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 31:  /* Buyer no confirmed-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transit\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BS</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">BS</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transit\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;

                          		     case 32:  /*Buyer confirmed-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reserved\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BS</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">BS</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reserved\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     case 33:  //*Buyer checked out-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">BS</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">BS</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
										 case 34:  //*Buyer checked out-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkin\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">M</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">M</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkin\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
									  case 35:  //*Buyer checked out-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transit\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">M</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">M</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"transit\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
									  case 36:  //*Buyer checked out-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reserved\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">M</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">M</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"reserved\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
									  case 37:  //*Buyer checked out-Short*/
	                          		     if ($estadia>1){ //BELOW SHOW ONLY IF STAYING IS MAYOR TO ONE NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i'  onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">M</td>";
                                  			}else{
	                          		     		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">M</td>";
	                          		     	}
	                          		     }else{    //BELOW IS SHOWING ONLY IF STAYING IS EQUAL TO A NIGHT
	                          		     	if ($_GET['inicio']){
	                                  			$end_date="$ano-$mes-$i";
	                                            echo "<td class='name_head' style=\"color:blue\" align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=".$_GET['inicio']."&end=$end_date'\" id=\"checkoutO\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">U</td>";
                                  			}else{
                          		     	  		echo "<td align=center style=\"color:blue\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                          		     	 	$ocupaciones=$ocup;
	                          		     	break 2;
	                          		     	}
	                          		     }
                          		     break;
                          		     }
                                $count_nights++;
                                $ocupaciones=$ocup;
                          		break; //could be 'break 1' also
                            }elseif($result_inicio<0 && $result_fin>0){ //BELOW SHOW WHAT IS COMING FRON LAST MONTH WITH GREEN
                                switch ($status){
                                 case 1:  //check in short term
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\"onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">U</td>";
	                                  }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">$letra1</td>";
	                                 }
                                 	break;                //$ocupaciones=$ocup; $ocupaciones=0;
                                 case 2:    //confirmed short term
	                                  if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
	                                 }else{
	                                 	echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">$letra1</td>";
	                                 }
	                                 break;
                                 case 3:   //transit short term
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">$letra1</td>";
	                                 }
	                                 break;
	                             case 4:   //checkout   short term
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkout\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkout\">$letra1</td>";
	                                  }
	                                  break;
	                              case 5:   //maintenance
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"maintenance\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"maintenance\">&nbsp;</td>";
	                                  }
	                                  break;
	                              case 6:   //vip SHORT rentals check in
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">SV</td>";
	                                  }
	                                  break;
	                               case 7:   //owner SHORT staying check in
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">SO</td>";
	                                  }
	                                  break;
	                              case 8:   //Long term rental check in
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"long_rental\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"long_rental\">L</td>";
	                                  }
	                                 break;
	                               case 9:   //Long term rental CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedL\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedL\">L</td>";
	                                  }
	                                 break;
	                               case 10:   //Long term rental NO CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitL\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitL\">L</td>";
	                                  }
	                                 break;
	                               case 11:   //Long term rental check OUT
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutL\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutL\">L</td>";
	                                  }
	                                 break;
	                               case 12:   //vip SHORT rentals CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">SV</td>";
	                                  }
	                                  break;
	                               case 13:   //vip SHORT rentals NOT CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">SV</td>";
	                                  }
	                                  break;
	                               case 14:   //vip SHORT rentals check OUT
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">SV</td>";
	                                  }
	                                  break;
	                               case 15:   //vip LONG rentals check in
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">LV</td>";
	                                  }
	                                  break;
	                               case 16:   //vip LONG rentals CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">LV</td>";
	                                  }
	                                  break;
	                               case 17:   //vip LONG rentals NOT CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">LV</td>";
	                                  }
	                                  break;
	                               case 18:   //vip LONG rentals check OUT
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">LV</td>";
	                                  }
	                                  break;
	                               case 19:   //owner SHORT staying CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">SO</td>";
	                                  }
	                                  break;
	                               case 20:   //owner SHORT staying NOT CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">SO</td>";
	                                  }
	                                  break;
	                               case 21:   //owner SHORT staying check OUT
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">SO</td>";
	                                  }
	                                  break;
	                               case 22:   //owner LONG staying check in
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">LO</td>";
	                                  }
	                                  break;
	                               case 23:   //owner LONG staying CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\reservedO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">LO</td>";
	                                  }
	                                  break;
	                               case 24:   //owner LONG staying NO CONFIRMED
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">LO</td>";
	                                  }
	                                  break;
	                               case 25:   //owner LONG staying check OUT
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">LO</td>";
	                                  }
	                                  break;
	                                 case 26:   /*Buyer check in-Long*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">BL</td>";
	                                  }
	                                  break;
	                               case 28:   /*Buyer confirmed-Long*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\reservedO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">BL</td>";
	                                  }
	                                  break;
	                               case 27:   /* Buyer no confirmed-Long*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">BL</td>";
	                                  }
	                                  break;
	                               case 29:   /*Buyer checked out-Long*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">BL</td>";
	                                  }
	                                  break;
	                                 case 30:   /*Buyer check in-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">BS</td>";
	                                  }
	                                  break;
	                               case 31:   /*Buyer no confirmed-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\transit\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">BS</td>";
	                                  }
	                                  break;
	                               case 32:   /* Buyer confirmed-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">BS</td>";
	                                  }
	                                  break;
	                               case 33:   /*Buyer checked out-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">BS</td>";
	                                  }
	                                  break;
									   case 34:   /*Buyer checked out-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">M</td>";
	                                  }
	                                  break;
									   case 35:   /*Buyer checked out-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">M</td>";
	                                  }
	                                  break;
									   case 36:   /*Buyer checked out-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">M</td>";
	                                  }
	                                  break;
									   case 37:   /*Buyer checked out-Short*/
	                                 if ($result_fin==1){
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
	                                 }else{
	                                 echo "<td align=center style=\"color:green\" class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">M</td>";
	                                  }
	                                  break;

	                             }
                                 $green=2;
                                break; //could be 'break 1' also
                            }elseif($ocup==$ultima_ocup){

                                $ocupaciones=0;
                                break; //could be 'break 1' also
                            }elseif ($result_fin<0){
                            $green=1;
                            }

                            $ocupaciones=$ocup;
                       }
                       //DO THIS BELOW IF THIS DAY IS FREE OF OCUPACCION
	                    if ($calendar_date!=$inicio_date && $green!=2){
				                  if ($_GET['inicio']){
						          	  $begin=$_GET['inicio'];
						              $no_villa=$result[$c]['no'];
						              $end_date="$ano-$mes-$i";
				                  }

						         if ($i == $hoy){


						            if ($_GET['inicio']){
						            		if (strtotime($fecha_actual_dia)==strtotime($_GET['inicio'])&&($result[$c]['id'])==($_GET['villa'])){ //if starting date selected iqual today
						             		 echo "<td id=\"starting_selected\" align=center class=\"name_head_today\" align=center title='Click for Ending Today' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">&nbsp;</td>";
						             		}else{
						             		 echo "<td align=center class=\"name_head_today\" align=center title='Click for Ending Today' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">&nbsp;</td>";
						             		}
						            }else{ //SI NO HAY FECHA DE INICIO
						             echo "<td align=center class=\"name_head_today\" align=center title='Click for Starting Today' onclick=\"location.href='booking-calendar.php?inicio=$ano-$mes-$i&villa=".$result[$c]['id']."&dia=$i&nuevo_mes=$mes&nuevo_ano=$ano'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#004879';\">&nbsp;</td>";
						            }
						         }else {   //SI NO ES HOY
									if ($_GET['inicio']){
										if (strtotime($fecha_actual_dia)==strtotime($_GET['inicio'])&&($result[$c]['id'])==($_GET['villa'])){ //if starting date selected iqual today
										 echo "<td id=\"starting_selected\" class='name_head' align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">&nbsp;</td>";
										}else{
										 echo "<td class='name_head' align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#f8b618';\">&nbsp;</td>";
										}
									}else{
							 			echo "<td class='name_head' align=center title='Click for Starting day $i' onclick=\"location.href='booking-calendar.php?inicio=$ano-$mes-$i&villa=".$result[$c]['id']."&dia=$i&nuevo_mes=$mes&nuevo_ano=$ano'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#004879';\">&nbsp;</td>";
							 			}

				                     }
	                     }

                }elseif($count_nights>0){ //DO THIS BELOW ONLY IF IT HAS NIGHTS TO STAY IN VILLA

                  switch ($status){
                  case 1: //check in  short term
	                  if ($count_nights==($estadia-1)){
	                  echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">U</td>";
	                  }else{
	                  echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">$letra1</td>";
	                  }
                  break;
                  case 2: //confirmed  short term
	                  if ($count_nights==($estadia-1)){
	                  echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
	                  }else{
	                  echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">$letra1</td>";
	                  }
                  break;
                  case 3: //transit   short term
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">$letra1</td>";
                 	}
                  break;
                  case 4: //checkout  short term
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkout\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkout\">$letra1</td>";
                 	}
                  break;
                  case 5: //maintenance
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"maintenance\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"maintenance\">&nbsp;</td>";
                 	}
                  break;
                  case 6: //vip SHORT rentals  check in
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">SV</td>";
                 	}
                  break;
                  case 7: //owner SHORT staying  check in
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">SO</td>";
                 	}
                  break;
                  case 8: //Long term rental check in
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"long_rental\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"long_rental\">L</td>";
                 	}
                  break;
                  case 9: //Long term rental CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedL\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedL\">L</td>";
                 	}
                  break;
                  case 10: //Long term rental NO CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitL\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitL\">L</td>";
                 	}
                  break;
                  case 11: //Long term rental check OUT
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutL\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutL\">L</td>";
                 	}
                  break;
                 case 12: //vip SHORT rentals  CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">SV</td>";
                 	}
                  break;
                 case 13: //vip SHORT rentals NOT CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">SV</td>";
                 	}
                  break;
                 case 14: //vip SHORT rentals  CHECK OUT
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">SV</td>";
                 	}
                  break;
                 case 15: //vip LONG rentals  check in
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"vip_rentals\">LV</td>";
                 	}
                  break;
                 case 16: //vip LONG rentals  CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedV\">LV</td>";
                 	}
                  break;
                 case 17: //vip LONG rentals  NO CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitV\">LV</td>";
                 	}
                  break;
                 case 18: //vip LONG rentals  CHECK OUT
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutV\">LV</td>";
                 	}
                  break;
                 case 19: //owner SHORT staying  CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">SO</td>";
                 	}
                  break;
                 case 20: //owner SHORT staying  NOT CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">SO</td>";
                 	}
                  break;
                 case 21: //owner SHORT staying  check OUT
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">SO</td>";
                 	}
                  break;
                 case 22: //owner LONG staying  check in
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">LO</td>";
                 	}
                  break;
                 case 23: //owner LONG staying  CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">LO</td>";
                 	}
                  break;
                 case 24: //owner LONG staying  NOT CONFIRMED
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">LO</td>";
                 	}
                  break;
                 case 25: //owner LONG staying  check OUT
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">LO</td>";
                 	}
                  break;
                   case 26: /*Buyer check in-Long*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">BL</td>";
                 	}
                  break;
                 case 28: /*Buyer confirmed-Long*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reservedO\">BL</td>";
                 	}
                  break;
                 case 27: /* Buyer no confirmed-Long*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transitO\">BL</td>";
                 	}
                  break;
                 case 29: /*Buyer checked out-Long*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">BL</td>";
                 	}
                  break;
                  case 30: /*Buyer check in-Short*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"owners_staying\">BS</td>";
                 	}
                  break;
                 case 31: /*Buyer no confirmed-Short*/
				
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW,  $widthW)\" id=\"transit\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">BS</td>";
                 	}
                  break;
                 case 32: /* Buyer confirmed-Short*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">BS</td>";
                 	}
                  break;
                 case 33: /*Buyer checked out-Short*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">BS</td>";
                 	}
                  break;
				  
				   case 34: /*Mid Term - checked in*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkin\">M</td>";
                 	}
                  break; 
					case 35: /*Mid Term - No confirmed*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"transit\">M</td>";
                 	}
                  break; 
					case 36: /*Mid Term - confirmed*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"reserved\">M</td>";
                 	}
                  break; 
					case 37: /*Mid Term - checked out*/
                	if ($count_nights==($estadia-1)){
                 	echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">U</td>";
                 	}else{
                 	 echo "<td align=center class=\"name_head\" align=center title=\"Click to see ref: $referencia\" onclick=\"reserva('reserva_details.php?id=".$ocup_id."','Details for Selection', $heightW, $widthW)\" id=\"checkoutO\">M</td>";
                 	}
                  break;
                 }

                  if ($count_nights<$estadia) $count_nights++;
                  if ($count_nights==$estadia){ $count_nights=0; $green=1;}

                }

          }else{//SI LA VILLA NO TIENE OCUPABILIDAD

           if ($_GET['inicio']){
	          $begin=$_GET['inicio'];
	          $no_villa=$result[$c]['no'];
	          $end_date="$ano-$mes-$i";
           }


		   if ($i == $hoy){

		     if ($_GET['inicio']){
		     	if (strtotime($fecha_actual_dia)==strtotime($_GET['inicio'])&&($result[$c]['id'])==($_GET['villa'])){  //if starting date selected iqual today
				  echo "<td id=\"starting_selected\" onmouseover=\"this.style.backgroundColor='#f8b618'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" align=center class=\"name_head_today\" align=center title='Click for Ending Today' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\">&nbsp;</td>";
				}else{
				  echo "<td onmouseover=\"this.style.backgroundColor='#f8b618'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" align=center class=\"name_head_today\" align=center title='Click for Ending Today' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\">&nbsp;</td>";
				}

		     }else{ //SI ES LA FECHA DE INICIO
		      echo "<td onmouseover=\"this.style.backgroundColor='#004879'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" align=center class=\"name_head_today\" align=center title='Click for Starting Today' onclick=\"location.href='booking-calendar.php?inicio=$ano-$mes-$i&villa=".$result[$c]['id']."&dia=$i&nuevo_mes=$mes&nuevo_ano=$ano'\">&nbsp;</td>";
		     }
		   }else {   //SI NO ES HOY
			if ($_GET['inicio']){

			  	if (strtotime($fecha_actual_dia)==strtotime($_GET['inicio'])&&($result[$c]['id'])==($_GET['villa'])){ //if starting date selected iqual today
			 		echo "<td id=\"starting_selected\" onmouseover=\"this.style.backgroundColor='#f8b618'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" class='name_head' align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\" >&nbsp;</td>";
			 	}else{
			 		echo "<td onmouseover=\"this.style.backgroundColor='#f8b618'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" class='name_head' align=center title='Click for Ending day $i' onclick=\"location.href='short-term-book.php?villa=".$_GET['villa']."&v2=".$result[$c]['id']."&start=$begin&end=$end_date'\" >&nbsp;</td>";
			 	}
			}else{
			 echo "<td onmouseover=\"this.style.backgroundColor='#004879'; this.style.cursor='hand';this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor=''\" class='name_head' align=center title='Click for Starting day $i' onclick=\"location.href='booking-calendar.php?inicio=$ano-$mes-$i&villa=".$result[$c]['id']."&dia=$i&nuevo_mes=$mes&nuevo_ano=$ano'\" >&nbsp;</td>";
			}

			}
          }

	}  //end moths' days count
	$x++; $c++;
   echo "</tr>";
	} //untill villas for rent finish

   echo "</table>";

	?>
 </td></tr></table>
	<?
 } //END FUNCTION
?>