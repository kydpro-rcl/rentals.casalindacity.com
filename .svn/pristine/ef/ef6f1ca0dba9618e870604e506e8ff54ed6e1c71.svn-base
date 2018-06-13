<h3 style="color:#06F; text-align:center;">Searching Results</h3>
<hr/>
<p>&nbsp;</p>
<?php
	$_POST['fecha_ini']=trim($_POST['fecha_ini']); $_POST['fecha_ter']=trim($_POST['fecha_ter']);

	$fecha_e=explode('/', $_POST['fecha_ini']);
    $fecha_t=explode('/', $_POST['fecha_ter']);
  //  print_r ($fecha_e);
    $_POST['ddlStartYear']=$fecha_e[2];$_POST['ddlStartMonth']=$fecha_e[0];$_POST['ddlStartDay']=$fecha_e[1];
    $_POST['ddlEndYear']=$fecha_t[2];$_POST['ddlEndMonth']=$fecha_t[0];$_POST['ddlEndDay']=$fecha_t[1];

   // echo $_POST['fecha_ini'];  echo $_POST['fecha_ter'];
 //--------------------------------------------------------------------------------------------------------------------------
    $empieza=$_POST['ddlStartYear']."-".$_POST['ddlStartMonth']."-".$_POST['ddlStartDay'];   //join starting date as string
    $termina=$_POST['ddlEndYear']."-".$_POST['ddlEndMonth']."-".$_POST['ddlEndDay'];        //join ending date as string
   $valid_dates1=is_date($empieza); //chek if the date is valid
   $valid_dates2=is_date($termina);  //check if the date if real (valid)
if ($valid_dates1 && $valid_dates2){
	$fecha_de_inicio=date('Y-m-d',(strtotime($empieza)));  //transform date to YYYY-MM-DD format
	$fecha_de_termino=date('Y-m-d',(strtotime($termina))); //transform date to YYYY-MM-DD format
	/*
	echo $fecha_de_inicio;
	echo "<br/>";
	echo $fecha_de_termino;
	 */
	 $beds=$_POST['beds'];

	if (strtotime($fecha_de_inicio)>=strtotime(date('Y-m-d'))){  //si fecha de inicio es mayor o igual que la fecha actual

	//	$night_qty=dayPeriod($fecha_de_termino, $fecha_de_inicio);     with one night less online
         $night_qty=daysDifference2($fecha_de_termino, $fecha_de_inicio);



  /*
		//echo $night_qty;
		//----------------------- hight and low seasons dates ------------
			          $seasons=$db->seasons();
				      $start_HS=$seasons[0]['h_starting']; $end_HS=$seasons[0]['h_ending'];
				      $start_LS=$seasons[0]['l_starting']; $end_LS=$seasons[0]['l_ending'];
				     // echo  $start_HS;
				      //----------------------------------------------------------------
	              //  <!--START NIGHTS FOR THIS RENT-->
	              	$qty_nights=$night_qty; $fecha_empiezas=$fecha_de_inicio;$fecha_termina=$fecha_de_termino;

				        if ((strtotime($fecha_empiezas))<(strtotime($start_HS))&&(strtotime($fecha_termina))<(strtotime($start_HS))||(strtotime($fecha_empiezas))>(strtotime($start_HS))&&(strtotime($fecha_empiezas))>(strtotime($end_HS))){
			            	$HS_nights=0; $LS_nights=$qty_nights;
			            }elseif ((strtotime($fecha_empiezas))>=(strtotime($start_HS))&&(strtotime($fecha_termina))<=(strtotime($end_HS))){
			                $HS_nights=$qty_nights; $LS_nights=0;
			            }elseif ((strtotime($fecha_empiezas))>=(strtotime($start_HS))&&(strtotime($fecha_termina))>(strtotime($end_HS))&&(strtotime($fecha_empiezas))<=(strtotime($end_HS))){
							$HS_nights=dayPeriod($end_HS, $fecha_empiezas);    $LS_nights=dayPeriod($fecha_termina, $end_HS);
			            }elseif ((strtotime($fecha_empiezas))<(strtotime($start_HS))&&(strtotime($fecha_termina))>(strtotime($start_HS))&&(strtotime($fecha_termina))<=(strtotime($end_HS))){
							$LS_nights=dayPeriod($start_HS, $fecha_empiezas); 	$HS_nights=dayPeriod($fecha_termina, $start_HS);
			            }elseif ((strtotime($fecha_empiezas))<(strtotime($start_HS))&&(strtotime($fecha_termina))>(strtotime($end_HS))){
							$HS_nights=dayPeriod($end_HS, $start_HS); $LS_nights=($qty_nights-$HS_nights);
			            }
	           	       //<!--END NIGHTS FOR THIS RENT-->
	           	       */

	     //-----------------------HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------
		/*	$empieza=$_POST['ddlStartYear']."-".$_POST['ddlStartMonth']."-".$_POST['ddlStartDay'];   //join starting date as string
			$termina=$_POST['ddlEndYear']."-".$_POST['ddlEndMonth']."-".$_POST['ddlEndDay'];        //join ending date as string */
		 if (is_date($empieza)){
		 	if (is_date($termina)){
				   $valid_dates1=is_date($empieza); //chek if the date is valid
				   $valid_dates2=is_date($termina);  //check if the date if real (valid)

					if ($valid_dates1 && $valid_dates2){
						$fecha_de_inicio=date('Y-m-d',(strtotime($empieza)));  //transform date to YYYY-MM-DD format
						$fecha_de_termino=date('Y-m-d',(strtotime($termina))); //transform date to YYYY-MM-DD format
					}

				/*echo $empieza;
				echo "<br/>";
				echo $termina;
				echo "<br/>"; */

				$db= new getQueries ();
				$season=$db->show_id('seasons', 1);
				//echo date("M-d-Y", easter_date(2010));  //easter day of an year   (Domingo Santo)

				$inicio_t_alta=$season[0]['h_starting'];
				$fin_t_alta=$season[0]['h_ending'];
				$inicio_t_baja=$season[0]['l_starting'];
				$fin_t_baja=$season[0]['l_ending'];

				//echo $inicio_t_alta;
				 //  $date = explode('/', $date);
				 $HS_inicio=explode('-', $inicio_t_alta);
				 $HS_fin=explode('-', $fin_t_alta);
				 $LS_inicio=explode('-', $inicio_t_baja);
				 $LS_fin=explode('-', $fin_t_baja);
				// ---------------------------------------------
				$MI=$_POST['ddlStartMonth'];   //Mes inicio
				$DI=$_POST['ddlStartDay'];   //dia inicio
				$AI=$_POST['ddlStartYear'];  //año inicio

				$MF=$_POST['ddlEndMonth'];  //mes final
				$DF=$_POST['ddlEndDay'];  //dia final
				$AF=$_POST['ddlEndYear'];   //año final

				$MIHS=$HS_inicio[1];  //mes inicio HS
				$DIHS=$HS_inicio[2];   //dia inicio HS
				$AIHS=$HS_inicio[0];    //año inicio HS

				$MFHS=$HS_fin[1];    //mes final HS
				$DFHS=$HS_fin[2];   //Dia final HS
				$AFHS=$HS_fin[0];    //año final HS

				 //================================================================================
				  $temporada_alta_mes_dia=array();  //array than content all the month and day of HS

				 //SOLO SI FECHA DE INICIO DE HS IS MAYOR FINAL, SINO ERROR (WEBMASTER)
				 if ($AIHS==$AFHS){				 	echo "Error year1:Seasons";
				 	die();
				  //echo "el mismo year";

				 }elseif(($AIHS+1)==$AFHS){ //año de inio de HS es uno anterior al que termina
				   // echo "diferente year";
				   $m=0;
				   $x=0;
				  // echo "year inicio:"; echo "<br/>";
				   for ($m=$MIHS; $m<=12; $m++){       //meses


				   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
				         $ultimo_dia_mes=ultimoDia($m,$AIHS);
				    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  //dias
				     #echo "mes:".$m." dia:".$x;
				     #echo "<br/>";
				     	$HS_array=array('mes'=>$m,'dia'=>$x);
						//if (!in_array($esta_villa,$villas_ocupadas)){
					     array_push($temporada_alta_mes_dia,$HS_array);
						//  }else{  //if villa is not available sent details to other array for busy
						//  array_push($villas_nodisponibles,$v);
						// }
				    }
				   }
				   //proximo año
				   $m=0;
				   $x=0;
				  // echo "year fin:"; echo "<br/>";
				    for ($m=1; $m<=$MFHS; $m++){       //meses

				     if ($m==$MFHS){$i=$DFHS;}else{$ultimo_dia_mes=ultimoDia($m,$AFHS);$i=$ultimo_dia_mes;}

				    for ($x=1; $x<=$i; $x++){       //dias
				     $HS_array1=array('mes'=>$m,'dia'=>$x);
				     array_push($temporada_alta_mes_dia,$HS_array1);
				     // echo "mes:".$m." dia:".$x;
				     // echo "<br/>";
				    }
				   }
				   /*
					echo "<pre>";
					print_r($temporada_alta_mes_dia);
					echo "</pre>";
				    */
				  ////TERMINO DE ESCRIBIR LOS MES CON SUS DIAS CORRESPONDIENTE A LA TEMPORADA ALTA
				   //$night_qty=dayPeriod($termina, $empieza);
				  # $night_qty=daysDifference2($termina, $empieza);
				  /* echo "Total noches en una HS:".dayPeriod($fin_t_alta, $inicio_t_alta);
				   echo "<br/>";
				   echo "total de noches elegidas:".$night_qty;  */

				  //INICIO PROCESO CON LAS FECHAS SELECCIONADAS PARA ESTA RESERVA A DETERMINAR LOS HS Y LS
				   $m=0; $cant_noches_LS=0;
				   $x=0; $cant_noches_HS=0;
				  for ($z=$AI;$z<=$AF; $z++  ){//años
				          if($z==$AI){$iniciar_mes=$MI;}else{$iniciar_mes=1;}
				          if($z==$AF){$finalizar_mes=$MF;}else{$finalizar_mes=12;}
					  for ($m=$iniciar_mes; $m<=$finalizar_mes; $m++){//meses
				           if (($z==$AI)&&($m==$MI)){$dia_comienzo=$DI;}else{$dia_comienzo=1;}
				           if (($z==$AF)&&($m==$MF)){$dia_finaliza=($DF-1);}else{$dia_finaliza=ultimoDia($m,$z);}
						  for($x=$dia_comienzo; $x<=$dia_finaliza; $x++){//dias

				           $mes_y_dia=array('mes'=>$m,'dia'=>$x);
				           if (in_array($mes_y_dia,$temporada_alta_mes_dia)){$cant_noches_HS++;}
						  }
					  }
				  }

				 }else{
				 	echo "Error year:Seasons";
				 	die();
					// 	Error: seasons are large than a whole year (HS start at: year-> moth-> day->  || HS end at:   year-> moth-> day->
					//quien estaba haciendo esta reserva (session amin...)
					//die();
				 }

				/*echo "<br/>";
				echo "HS contada:".$cant_noches_HS;
				echo "<br/>";*/
				//$cant_noches_LS=($night_qty-$cant_noches_HS);
				//echo "LS deducidas:".$cant_noches_LS;
			}else{
		 	echo "Wrong,ending date";
		 	 die();
		 	}
		 }else{
		 	echo "Wrong,starting date";
		    die();
		 }

			/*echo "<br/>";
			echo "HS contada:".$cant_noches_HS;
			echo "<br/>";
			$cant_noches_LS=($night_qty-$cant_noches_HS);
			echo "LS deducidas:".$cant_noches_LS;    */
			$LS_nights=($night_qty-$cant_noches_HS);          $HS_nights=$cant_noches_HS;
//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------

		if ($night_qty>0){
			//----------------SEARCH THROUGH ALL AVAILABLE VILLAS---------------

				$mes=$_POST['ddlStartMonth'];
				$year=date('Y',strtotime($_POST['ddlEndYear']));
				$dia=$_POST['ddlStartDay'];
				#echo $mes." mes - year="; echo $year;
				#echo $dia;echo "<br/>";
				#$db=new getQueries ();
				//echo $beds;
				//$busy=$db->see_occupancy_online($mes, $year, $beds);
				$busy=$db->see_occupancy_online_2($fecha_de_inicio, $fecha_de_termino, $beds);//try
		              $counting=0;
	                 // print_r ($busy);
	                //-------ARRAY FOR VILLAS----
	                     $villas_ocupadas=array();
	                     $villas_disponibles=array();
                         $villas_nodisponibles=array();
	                    //  echo $fecha_de_inicio."<br/>";
	                    //  echo $fecha_de_termino."<br/>";
		              foreach ($busy as $k){  //TODAS LAS OCUPACIONES QUE EMPIZAN EN ESTE MES

	                     // echo "start: ".$k['start']." End: ".$k['end']." Villa: ".$k['villa_number']." status: ".$k['status']."<br/>";

								//empuja en un arreglo el id de la villa ocupada
								  $array_villas_ocupada=array('id'=>$k['villa_id'],'no'=>$k['villa_number']);
									if (!in_array($array_villas_ocupada,$villas_ocupadas)){
	                                	array_push($villas_ocupadas,$array_villas_ocupada);
				               		}

		              $counting++;
		              } // end foreach


	                  $villas_for_rent=$db->villas_for_rent_online($beds);//villas for rent with this bedrooms qty.
	               		//print_r($villas_for_rent);

	             foreach ($villas_for_rent AS $v){
		            $esta_villa=array('id'=>$v['id'],'no'=>$v['no']);
					if (!in_array($esta_villa,$villas_ocupadas)){
	                  array_push($villas_disponibles,$v);
				    }else{  //if villa is not available sent details to other array for busy				     array_push($villas_nodisponibles,$v);				    }
		         }

	             if (!empty($villas_disponibles)){



			          foreach ($villas_disponibles AS $d){
			            //echo $d['no']." disponible";
			           // echo "<br/>";
			           ?>

			           <form method="post" name="villa_disponible" action="booking_details.php">
			           		<input type="hidden" name="v" value="<?=$d['id']?>"/>
				          <div style="height:105px; padding-right:5px;" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#00f4fd'" onClick="this.form.submit()">
				         <!--// onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';this.style.cursor='pointer';" onClick="this.form.submit()"//-->
				          	<img  style="float:left; padding-right:5px;" src="../booking/<?=$d['pic']?>" alt="villa <?=$d['no']?>" title="villa <?=$d['no']?>" width="153" height="103"/>
				            <p><b>Villa No.<?=$d['no']?></b> - Starting: <b><?=formatear_fecha($fecha_de_inicio)?></b> Ending: <b><?=formatear_fecha($fecha_de_termino)?></b><br/>                    <?=$d['bed']?> Bedrooms<br/>
				           	<!--//Nights quantity:<?/*=$night_qty*/?>  <br/>//-->
				           	<?if ($LS_nights>0){?>
		                    	<b>Nights Low Season: <?=$LS_nights?> x <?=number_format($d['p_low'],2);?> <? $total_LS=($LS_nights*$d['p_low']); echo " = US$".number_format($total_LS,2); ?></b> <br/>
		                    <?}?>
		                    <?if ($HS_nights>0){?>
		                    	<b>Nights High Season: <?=$HS_nights?> x <?=number_format($d['p_high'],2);?> <? $total_HS=($HS_nights*$d['p_high']); echo " = US$".number_format($total_HS,2); ?></b><br/>
	                        <?}?>
	                        <input type="hidden" name="desde" value="<?=$fecha_de_inicio?>"/>
	                        <input type="hidden" name="hasta" value="<?=$fecha_de_termino?>"/>
	                        <input type="hidden" name="T_nights" value="<?=$night_qty?>"/>
	                        <input type="hidden" name="LS_nights" value="<?=$LS_nights?>"/>
	                        <input type="hidden" name="HS_nights" value="<?=$HS_nights?>"/>
	                        Sub-Total US$ <? $amount_per_nights=($total_LS+$total_HS); echo number_format($amount_per_nights,2);?>  + 16% VAT - TAX (<? $itbis=($amount_per_nights*0.16); echo number_format($itbis,2); ?>)=<span style="color:red"> US$ <?$total_amount=($amount_per_nights+$itbis); echo number_format($total_amount,2);?> Total </span>         <input type="hidden" name="itbis" value="<?=$itbis?>"/>
	                        <input type="hidden" name="g_total" value="<?=$total_amount?>" />
				          <input id="boton" type="submit" name="continuar" value="Choose this villa"/></p>
                          <!--<br />-->
                          <div style="height:17px;">

       <span style="color:#000; font-size:10px; font-weight:bold;">

       <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="house('<?=$d['no']?>'); return false;"><div style="float:left; background-image:url(images/fondo.png);  height:16px; width:131px; color:white; font-size:11px; padding:0px; margin-right:5px; text-align:center;">Pictures of villa No.<?=$d['no']?></div></a>

       <!--// |//--> <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="calendar('<?=$d['id']?>'); return false;"><div style="float:left; background-image:url(images/calendar2.png);  height:16px; width:127px; color:white; font-size:11px; padding:0px; margin-right:5px; text-align:center;">See&nbsp;this&nbsp;villa&nbsp;Calendar</div></a>

       <a href="http://casalindacity.com/PAGES/Contact%20Us/Contact%20Us.php" target="_blank"><div style="float:left; background-image:url(images/ask2.png);  height:16px; width:91px; color:white; font-size:11px; padding:0px; margin-right:5px; text-align:center;">More info</div></a>

       </span></div>
				          </div>
			          </form>
	              <?
			          }


			     }else{
			       echo "<p style='text-align:center;'><span style='color:red'>We sorry, All our <span style='color:black'>".$beds." bedrooms</span> villas are busy from: <span style='color:black'>".formatear_fecha($fecha_de_inicio)."</span> to: <span style='color:black'>".formatear_fecha($fecha_de_termino)."</span></span></p><br/><p>&nbsp;</p><p style='text-align:center;'><a href=\"book_search.php\" alt=\"Go Back\"><img src=\"images/goback.jpg\" alt=\"Go Back\" title=\"Go Back\" border=\"0\"/></a></p>";
			     }

			     if ($_POST['show']==1){ //SHOW VILLAS NOT AVAILABLE BELOW IF ALL INVENTORY
			       // print_r($villas_nodisponibles);
                   foreach ($villas_nodisponibles AS $vb){
			        ?>



				          <div style="height:105px; padding-right:5px;" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFF99'" >

				          	<img  style="float:left; padding-right:5px;" src="../booking/<?=$vb['pic']?>" alt="villa <?=$vb['no']?>" title="villa <?=$vb['no']?>" width="153" height="103"/>
				            <p><b>Villa No.<?=$vb['no']?></b> - Starting: <b><?=formatear_fecha($fecha_de_inicio)?></b> Ending: <b><?=formatear_fecha($fecha_de_termino)?></b><br/>                    <?=$d['bed']?> Bedrooms<br/>
				           	<!--//Nights quantity:<?/*=$night_qty*/?>  <br/>//-->
				           	<?if ($LS_nights>0){?>
		                    	<b>Nights Low Season: <?=$LS_nights?> x <?=number_format($vb['p_low'],2);?> <? $total_LS=($LS_nights*$vb['p_low']); echo " = US$".number_format($total_LS,2); ?></b> <br/>
		                    <?}?>
		                    <?if ($HS_nights>0){?>
		                    	<b>Nights High Season: <?=$HS_nights?> x <?=number_format($vb['p_high'],2);?> <? $total_HS=($HS_nights*$vb['p_high']); echo " = US$".number_format($total_HS,2); ?></b><br/>
	                        <?}?>

	                        Sub-Total US$ <? $amount_per_nights=($total_LS+$total_HS); echo number_format($amount_per_nights,2);?>  + 16% VAT - TAX (<? $itbis=($amount_per_nights*0.16); echo number_format($itbis,2); ?>)=<span style="color:red"> US$ <?$total_amount=($amount_per_nights+$itbis); echo number_format($total_amount,2);?> Total </span>
				          <img src="images/occupied.jpg" alt="Occupeid" /></p>
                          <!--<br />-->
                          <div style="height:17px;">

            <span style="color:#000; font-size:10px; font-weight:bold;">

       <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="house('<?=$vb['no']?>'); return false;"><div style="float:left; background-image:url(images/fondo.png);  height:16px; width:131px; color:white; font-size:11px; padding:0px; margin-right:5px; text-align:center;">Pictures of villa No.<?=$vb['no']?></div></a>

       <a href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="calendar('<?=$vb['id']?>'); return false;"><div style="float:left; background-image:url(images/calendar2.png);  height:16px; width:127px; color:white; font-size:11px; padding:0px; margin-right:5px; text-align:center;">See&nbsp;this&nbsp;villa&nbsp;Calendar</div></a>

          <a href="http://casalindacity.com/PAGES/Contact%20Us/Contact%20Us.php" target="_blank"><div style="float:left; background-image:url(images/ask2.png);  height:16px; width:91px; color:white; font-size:11px; padding:0px; margin-right:5px; text-align:center;">More info</div></a>

       </span></div>

				   </div>

	              <?
	              }//end all the busy villas			     }//only if all inventory selected end here

			//----------------SEARCH THROUGH ALL AVAILABLE AND NOT AVAILABLE VILLAS---------------
		}else{
		echo "<p>&nbsp;</p><p style='text-align:center;'><span style='color:red'>Error: Dates are incorrect, please go back and try again.</span><p>&nbsp;</p><p style='text-align:center;'><a href=\"book_search.php\" alt=\"Go Back\"><img src=\"images/goback.jpg\" alt=\"Go Back\" title=\"Go Back\"/></a>";
		}
	}else{

	   echo "<p>&nbsp;</p><p style='text-align:center;'><span style='color:red'>Error: Please, check starting date and tray again.</span></p>";
	   echo "<p style='text-align:center;'><strong>It is impossible start at:<span style='color:green'> ".formatear_fecha($fecha_de_inicio)."</span></strong></p><p style='text-align:center;'><a href=\"book_search.php\" alt=\"Go Back\"><img src=\"images/goback.jpg\" alt=\"Go Back\" title=\"Go Back\" border=\"0\" /></a><p>&nbsp;</p>";
	}
}else{
 echo "<p>&nbsp;</p><p style='text-align:center;'><span style='color:red'>Error: One or both dates are not valid.</span></p><p style='text-align:center;'><a href=\"book_search.php\" alt=\"Go Back\"><img src=\"images/goback.jpg\" alt=\"Go Back\" title=\"Go Back\" border=\"0\"/></a>";

} //end if valid dates
?>