<?
$villa_id=$_POST['villa']; $f_date=$_POST['from']; $t_date=$_POST['to'];
$client=$_POST['client']; $adults=$_POST['adults']; $children=$_POST['children'];
$comment=$_POST['comment'];
if ((!validate_date($f_date))||(!validate_date($t_date))){
	 echo '<h2>Error with dates</h2>';
}else{
 if (is_date($f_date)){
	  if (is_date($t_date)){
			$massage=$_POST['massage']; $pickup=$_POST['pickup'];$VIPpickup=$_POST['VIPpickup']; $chef=$_POST['chef']; $fridge=$_POST['fridge'];//varibles para servicios
			$busyid=$_POST['busyid'];   $reference=$_POST['ref'];
			$nights=dayPeriod($t_date, $f_date);//get nights in period
		if ($nights>0){
			 $status=$_POST['status'];

			 $reserveid=$_POST['reserveid'];

			if ($_POST['refnumb']) $reference=$_POST['refnumb'];
			if ($_GET['refnumb']) $reference=$_GET['refnumb'];
				$db= new getQueries();

			 if (($reference!="")&&($f_date!="")&&($t_date!="")&&($villa_id!="")&&($status!="")&&($client!="")){
                    /*
						$fecha_rota=explode('-',$f_date);
						$fecha_rota2=explode('-',$t_date);
						  $mes=$fecha_rota[1]; $year=$fecha_rota[0];
			              $busy=$db->busy_availability_noID($villa_id, $mes, $year, $reserveid);//debe seleccionarse una reserva sin escoger esta para comparar
			              $counting=0;

		               //VARIABLES
		               $AI=$fecha_rota[0];
		               $MI=$fecha_rota[1];
		               $DI=$fecha_rota[2];
		               $AF=$fecha_rota2[0];
		               $MF=$fecha_rota2[1];
		               $DF=$fecha_rota2[2];

			        foreach ($busy as $occ){

				               $alojamiento=strtotime($year."-".$mes."-".($fecha_rota[2]+$i));
				               $f_a=date('Y-m-d',$alojamiento);
				              for ($z=$AI; $z<=$AF; $z++){ //a�os
				              	if ($z==$AI){$mes_inicial=$MI;}else{$mes_inicial=1;}
				              	if ($z==$AF){$mes_final=$MF;}else{$mes_final=12;}

				                for ($m=$mes_inicial; $m<=$mes_final; $m++){ //meses

				                	if (($z==$AI)&&($m==$MI)){ $dia_inicial=$DI; }else{$dia_inicial=1; }
				                	if (($z==$AF)&&($m==$MF)){ $dia_final=$DF; }else{ $dia_final=ultimoDia($m,$z); }

				                   for ($x=$dia_inicial; $x<=$dia_final; $x++){  //dias
				                        $contador=$x;
					      				if (($z==$AF)&&($m==$MF)&&($x==$DF)){$contador--;}//para que se pueda tomar el mismo dia que empieza otra
					      				$estadia=strtotime($z."-".$m."-".$contador);
				               			$f_a=date('Y-m-d',$estadia);

									   if ((strtotime($f_a))==(strtotime($occ['start']))){

										   echo "<h2>Error: Busy period selected</h2>";
										   die();
									   }

									}//fin dias
								 }//fin meses
							   }//fin de los a�os

					}*/ //fin ocupaciones
			   $edit_busy=check_villa_edit($villa_id, $start_date=$f_date, $end_date=$t_date, $id_this_reserve=$reserveid);
			   $cant_edit=count($edit_busy);
			   if(!$cant_edit>0){
						//VERIFY ####################################################################################
					   $villa_selected=$db->villa($villa_id);  //GET VILLA DETAILS
					   $booking=$db->see_occupancy_ref($reference);  //GET BOOKING DETAILS

					   #$price_default=$villa_selected[0]['p_low'];
					   //--------------------high season and low season prices-----
						/*if ($booking[0]['villa']==$villa_id){//si la misma villa precio anterior si > k cero
						  if ($booking[0]['ppn']<>0){$price_LS=$booking[0]['ppn'];}else{$price_LS=$villa_selected[0]['p_low'];}
						  if ($booking[0]['PHS']<>0){$price_HS=$booking[0]['PHS'];}else{$price_HS=$villa_selected[0]['p_high'];}
						}else{
						  $price_LS=$villa_selected[0]['p_low'];
						  $price_HS=$villa_selected[0]['p_high'];
						}
						*/
						$price_LS=$booking[0]['ppn'];
						$price_HS=$booking[0]['PHS'];
					   //---------------------------------------------------------
					   $qty_nights=$nights;
					   #$qty_nights=$noches;
					   if ($_POST['from'] && $_POST['to']){
						$starting_date=$_POST['from']; $ending_date=$_POST['to'];
					   }else{
						$starting_date=$_GET['start']; $ending_date=$_GET['end'];
					   }


					  //--------------starting and ending dates --------------
					 $fecha_empiezas=date_to_insert($starting_date);
					 $fecha_termina=date_to_insert($ending_date);
					  //----------------------- hight and low seasons dates -----------------
					  $seasons=$db->seasons();//GET SEASONS DETAILS
					  $start_HS=$seasons[0]['h_starting']; $end_HS=$seasons[0]['h_ending'];
					  $start_LS=$seasons[0]['l_starting']; $end_LS=$seasons[0]['l_ending'];
					  //--------------------------------------------------------------------

					   $casa=$villa_selected[0];
				?>
				<p>&nbsp</p>
				<h2 style="color:#13a703;">Editing booking <span style="color:black;">No.<?=$reference?></span> - Short Rental Owners<? $estado=$status; if (($estado==6)||($estado==12)||($estado==13)||($estado==14)) echo ", <span style=\"color:red\">VIP</span>";?> - step 2</h2>
				 <hr />
				<form method="post" action="edit_owner_so2.php">

			<div style="width:300px; float:left;">
					<fieldset><legend>Villa details</legend>
						   <!--INFORMACIONES DE LA VILLAS INICIAN-->
						   <input type="hidden" name="starting" value="<?=$starting_date?>"  />
						   <input type="hidden" name="ending" value="<?=$ending_date?>"  />
						   <input type="hidden" name="nights" value="<?=$qty_nights?>"  />
						   <input type="hidden" name="villa_id" value="<?=$casa['id']?>"  />
						   <input type="hidden" name="villa_no" value="<?=$casa['no']?>" />

						   <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="123" height="73"/>
						   <p id="td0" style="font-weight:bold;">No. <span class="azul"><?=$casa['no']?></span></p>
						   <p id="td0" style="font-weight:bold;">Size: <span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
						   <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> <br/> Airs: <span class="azul"><?=$casa['AC']?></span> <br/> Baths: <span class="azul"><?=$casa['bath']?></span></p>

						   <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
						   <!--START PRICE FOR THIS RENT-->
						   <?

	//-----------------------HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------

								 if (is_date($fecha_empiezas)){
								 	if (is_date($fecha_termina)){

										$db= new getQueries ();
										$season=$db->show_id('seasons', 1);
										//echo date("M-d-Y", easter_date(2010));  //easter day of an year   (Domingo Santo)

										$inicio_t_alta=$season[0]['h_starting'];
										$fin_t_alta=$season[0]['h_ending'];

										 $HS_inicio=explode('-', $inicio_t_alta);
										 $HS_fin=explode('-', $fin_t_alta);
										/* $LS_inicio=explode('-', $inicio_t_baja);
										 $LS_fin=explode('-', $fin_t_baja);*/
										$Fecha_Inicio=explode('-', $fecha_empiezas);
										$Fecha_Final=explode('-', $fecha_termina);
										// ---------------------------------------------
										$MI=$Fecha_Inicio[1];   //Mes inicio
										$DI=$Fecha_Inicio[2];   //dia inicio
										$AI=$Fecha_Inicio[0];  //a�o inicio

										$MF=$Fecha_Final[1];  //mes final
										$DF=$Fecha_Final[2];  //dia final
										$AF=$Fecha_Final[0];   //a�o final

										$MIHS=$HS_inicio[1];  //mes inicio HS
										$DIHS=$HS_inicio[2];   //dia inicio HS
										$AIHS=$HS_inicio[0];    //a�o inicio HS

										$MFHS=$HS_fin[1];    //mes final HS
										$DFHS=$HS_fin[2];   //Dia final HS
										$AFHS=$HS_fin[0];    //a�o final HS

										 //================================================================================
										  $temporada_alta_mes_dia=array();  //array than content all the month and day of HS

										 //SOLO SI FECHA DE INICIO DE HS IS MAYOR FINAL, SINO ERROR (WEBMASTER)
										 if ($AIHS==$AFHS){
										 	echo "Error year1:Seasons";
										 	die();
										  //echo "el mismo year";

										 }elseif(($AIHS+1)==$AFHS){ //a�o de inio de HS es uno anterior al que termina
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

										    }
										   }
										   //proximo a�o
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

										  ////TERMINO DE ESCRIBIR LOS MES CON SUS DIAS CORRESPONDIENTE A LA TEMPORADA ALTA
										   //$night_qty=dayPeriod($termina, $empieza);
										   $night_qty=daysDifference2($fecha_termina, $fecha_empiezas);

										  //INICIO PROCESO CON LAS FECHAS SELECCIONADAS PARA ESTA RESERVA A DETERMINAR LOS HS Y LS
										   $m=0; $cant_noches_LS=0;
										   $x=0; $cant_noches_HS=0;
										  for ($z=$AI;$z<=$AF; $z++  ){//a�os
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

										 }


									}else{
								 	echo "Wrong,ending date";
								 	 die();
								 	}
								 }else{
								 	echo "Wrong,starting date";
								    die();
								 }


									$LS_nights=($night_qty-$cant_noches_HS);          $HS_nights=$cant_noches_HS;

									if (($LS_nights=="0")&&($HS_nights>=
									"1")){    //solo HS
						             ?>
						            	<? if ($_SESSION['info']['level']==1){?>
								       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
								       		<input type="hidden" name="price" value="0" />
								       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
							            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
							            <?}else{?>
							            	PriceHS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
							            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
							            	<input type="hidden" name="price" value="0" />
							            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
							            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
							            <?}?>
						            <?
									}elseif(($HS_nights=="0")&&($LS_nights>="1")){ //solo LS
						             ?>
							             <? if ($_SESSION['info']['level']==1){?>
								       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_LS,2);?>" /></span>
								       		<input type="hidden" name="priceHS" value="0" />
								       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
							            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
							            <?}else{?>
							            	PriceLS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_LS,2);?></span>
							            	<input type="hidden" name="price" value="<?=number_format($price_LS,2);?>" />
							            	<input type="hidden" name="priceHS" value="0" />
							            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
							            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
							            <?}?>
						            <?

									}else{ //existen ambas
						                 ?>
						             	<? if ($_SESSION['info']['level']==1){?>
								       		PriceLS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="price" size="5" value="<?=number_format($price_LS,2);?>" /></span>
								       		PriceHS&nbsp;US$&nbsp;<span class="azul"><input type="text" name="priceHS" size="5" value="<?=number_format($price_HS,2);?>" /></span>
								       		<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
							            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
							            <?}else{?>
							            	PriceLS&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_LS,2);?></span>
							            	<input type="hidden" name="price" value="<?=number_format($price_LS,2);?>" />
							            	PriceLH&nbsp;US$&nbsp;<span class="azul"><?=number_format($price_HS,2);?></span>
							            	<input type="hidden" name="priceHS" value="<?=number_format($price_HS,2);?>" />
							            	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />
							            	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
							            <?}?>
						            <?
									}
//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------
						   ?>
					</fieldset>
						   </p>
						   <!--END PRICE FOR THIS RENT-->
				  </div>


				<div style="width:600px; float:left;">
				  <p class="p_estilos">From: <span class="azul"><?=$starting_date?></span></p>
				   <p class="p_estilos">To: <span class="azul"><?=$ending_date?></span></p>
				   <?  $owner=$db->show_id('owners', $client);$cl=$owner[0];?>
				   <p class="p_estilos">Owner: <span class="azul"> <?/*=$client*/?> <? echo $cl['name']." ".$cl['lastname']; ?></span> Phone: <span class="azul"><? echo $cl['phone']?></span> Email: <span class="azul"><? echo $cl['email']?></span></p>
				   <p class="p_estilos">Total nights:<span class="azul"> <?=$nights?></span> (LS <span class="azul"><?=$LS_nights?></span> and HS<span class="azul"> <?=$HS_nights?></span>)<p>
				   <p class="p_estilos">Adults: <span class="azul"><?=$adults?></span><p>
				   <p class="p_estilos">Kids: <span class="azul"><?=$children?></span><p>
				</div>

				<div style="width:900px; clear:both; margin-left:auto; margin-right:auto;">
				   <!--STATUS-->
				 <!-- <p>status</p> <p>ni�os</p><p>adultos</p>-->
				   <? //if (($status!=6)&&($status!=12)&&($status!=13)&&($status!=14)){ //it is not a VIP
				   ?>
						<p style="text-align:leftt; font-size:11px;">
						  <span style="font-weight:bold;">Status:</span>
						  <span style="color:#09F">
							  <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
								<input type="radio" name="status" value="21" checked="checked">Checked out
								<input type="radio" name="status" value="7" <? if ($status==7){?> checked="checked" <?}?>>Checking in
							  <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
								 <input type="radio" name="status" value="7" <? if ($status==7){?> checked="checked" <?}?>>Checking in
								 <input type="radio" name="status" value="19" <? if ($status==19){?> checked="checked" <?}?>>Confirmed
								 <input type="radio" name="status" value="20"  <? if ($status==20){?> checked="checked" <?}?> <? /* if (($status!=1)&&($status!=2)&&($status!=3)){?> checked="checked" <?}*/?>>No Confirmed
							  <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
								 <input type="radio" name="status" value="19" <? if ($status==19){?> checked="checked" <?}?>>Confirmed
								 <input type="radio" name="status" value="20" <? if ($status==20){?> checked="checked" <?}?> <?  if (($status!=20)&&($status!=19)){?> checked="checked" <?}?>>No Confirmed
							  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
								<input type="radio" name="status" value="7" checked="checked">Checked in
							  <?}?>
						  </span>

							<span style="margin-left:40px;">Number of Vehicules: <select name="vehicles">
		        			<? for ($i=0; $i<=5; $i++){?>
								<option value="<?=$i?>" <? if ($booking[0]['vehicles']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
							<? }?>
		                 </select></span>
					   <p>

				   <!--STATUS-->
				   <input type="hidden" name="from" value="<?=$f_date?>"/>
				   <input type="hidden" name="to" value="<?=$t_date?>"/>
				   <input type="hidden" name="ref" value="<?=$reference?>"/>
				   <input type="hidden" name="villa" value="<?=$villa_id?>"/>
				   <input type="hidden" name="client" value="<?=$client?>"/>
				   <input type="hidden" name="adults" value="<?=$adults?>"/>
				   <input type="hidden" name="children" value="<?=$children?>"/>
				   <input type="hidden" name="comment" value="<?=$comment?>"/>
				   <input type="hidden" name="massage" value="<?=$massage?>"/>
				   <input type="hidden" name="pickup" value="<?=$pickup?>"/>
				   <input type="hidden" name="VIPpickup" value="<?=$VIPpickup?>"/>
				   <input type="hidden" name="chef" value="<?=$chef?>"/>
				   <input type="hidden" name="fridge" value="<?=$fridge?>"/>
				   <input type="hidden" name="busyid" value="<?=$busyid?>"/>
				   <input type="hidden" name="reserveid" value="<?=$reserveid?>"/>
                   <input type="hidden" name="referal" value="<?=$_POST['referal']?>"/>
				  <hr/>
				   <INPUT class="book_but" TYPE="button" onClick="location.href='edit-booking.php?refnumb=<?=$reference?>'"  VALUE="Back" title="Hit to go back">&nbsp;
				 <input type="submit" name="next" value="next" class="book_but" />
				</div>



				 </form>

			 <?
               }else{
               	change_booking_busy_error($f_date, $t_date);
               }
             }else{
			  echo '<h2>Error with data, try again</h2>';
			 // die();
			 }
         }else{ echo "<h2>Error on nights quantity</h2>"; }
     }else{ echo "<h2>Error on ending date</h2>"; }
   }else{ echo "<h2>Error on starting date</h2>"; }
}
?>