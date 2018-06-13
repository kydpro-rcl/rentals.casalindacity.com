<?
     $reference=$_POST['reference'];

     $db= new getQueries();
     $book=$db->see_occupancy_ref($reference); //get reservation details

	   $info_book=$book[0];
       $servicios_reserva_long=$db->services_reserved_long($info_book['reserveid']);
	   $starting_date=$_POST['fecha_inicio']; $ending_date=$_POST['fecha_final'];
	   //verificar fechas
	 //  print_r($servicios_reserva_long);
	   $qty_nights=dayPeriod($ending_date, $starting_date);
	   $villa=$db->villa($_POST['villa']); //get villa details
	  $casa=$villa[0];
	 $status=$_POST['estado'];
  if (is_date($starting_date)){
  	if (is_date($ending_date)){
				  		//VERIFY PERIOD############################################################################
							/*	$villa_id=$casa['id']; $reserveid=$info_book['reserveid'];
								$fecha_rota=explode('-',$starting_date);
								$fecha_rota2=explode('-',$ending_date);
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
						              for ($z=$AI; $z<=$AF; $z++){ //años
						              	if ($z==$AI){$mes_inicial=$MI;}else{$mes_inicial=1;}
						              	if ($z==$AF){$mes_final=$MF;}else{$mes_final=12;}

						                for ($m=$mes_inicial; $m<=$mes_final; $m++){ //meses

						                	if (($z==$AI)&&($m==$MI)){ $dia_inicial=$DI; }else{$dia_inicial=1; }
						                	if (($z==$AF)&&($m==$MF)){ $dia_final=$DF; }else{ $dia_final=ultimoDia($m,$z); }

						                   for ($x=$dia_inicial; $x<$dia_final; $x++){  //dias
							      				$estadia=strtotime($z."-".$m."-".$x);
						               			$f_a=date('Y-m-d',$estadia);

											   if ((strtotime($f_a))==(strtotime($occ['start']))){

												   echo "<h2>Error: Busy period selected</h2>";
												   die();
											   }

											}//fin dias
										 }//fin meses
									   }//fin de los años

							} *///fin ocupaciones
	 $edit_busy=check_villa_edit($_POST['villa'], $start_date=$starting_date, $end_date=$ending_date, $id_this_reserve=$info_book['reserveid']);
	 /*echo "villa id:".$_POST['villa']; echo "<br/>";
	  echo "inicio:".$starting_date; echo "<br/>";
	   echo "fin:".$ending_date;  echo "<br/>";
	    echo "id reserva:".$info_book['reserveid']; echo "<br/>";   */
	 $cant_edit=count($edit_busy);
	 if(!$cant_edit>0){
								//VERIFY ####################################################################################
				     //-------------------FOR NOT ADMIN DO THIS------------------------------------------------------
				     if ($_SESSION['info']['level']>1){
				       if ($qty_nights<21){
				             	echo $qty_nights." nights";
				             	echo "<br/>";
				             	echo "<span style='color:red'>Long term rental must be minimun 3 weeks</span>";
				       }else{

				              $entrada=breakdate($starting_date); //return dates in pieces
				              $salida=breakdate($ending_date); //return dates in pieces

				              $payment_day=array();
				              $fechas_de_pago=array();

				              	$years_qty=($salida['year']-$entrada['year']);  //return quantity of years

				                for ($years=$entrada['year']; $years<=$salida['year']; $years++){
				                	//echo $years."<br>";
				                	if ($years==$entrada['year']){  //starting year

				                       if ($entrada['year']!=$salida['year']){//si tiene mas de un año
				                        $months_start_year=12-$entrada['month'];

				                         $months_starting=12-$months_start_year; //return month starting first year
					                        for ($i=$months_starting; $i<=12; $i++){ //each month first year
						                          $last_day_month=ultimoDia($i,$years);
						                          if ($last_day_month<=$entrada['day']){
						                          	$dia_de_pago=$last_day_month;
						                          }else{
						                          	$dia_de_pago=$entrada['day'];

						                          }
						                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
				                                   array_push($fechas_de_pago,$payment_day);

					                        } //END MONTH FIRST YEAR
					                   }else{//ES EL MISMO AÑO DE ENTRADA QUE DE SALIDA
				                             for ($i=$entrada['month']; $i<=$salida['month']; $i++){ //each month first year
						                          $last_day_month=ultimoDia($i,$years);
						                          if ($last_day_month<=$entrada['day']){
						                          	$dia_de_pago=$last_day_month;
						                          }else{
						                          	$dia_de_pago=$entrada['day'];

						                          }
						                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
					                                if  ($i!=$salida['month']){
					                                   	array_push($fechas_de_pago,$payment_day);
					                                 }

													if  ($i==$salida['month']){
							                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

						                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año

						                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
						                                  //echo  $ultimo_pago;
						                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
						                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
							                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
							                       		}

						                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

						                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

						                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

						                                 $solo_cobrar=30-$noches_NO_cobrar;
						                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO
						                                # echo  $ending_date." - ".$solo_cobrar." noches";  //last payment
						                                }

														if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
						                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año
						                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
						        						}

							                        }
					                        } //END MONTH FIRST YEAR

					                   }//END MONTH FIRST YEAR
				                	}elseif($years==$salida['year']){   //ending year

				                        $months_end_year=$salida['month'];

				                        for ($i=1; $i<=$salida['month']; $i++){ //each month last year

					                        $last_day_month=ultimoDia($i,$years);
					                          if ($last_day_month<=$entrada['day']){
					                          	$dia_de_pago=$last_day_month;
					                          }else{
					                          	$dia_de_pago=$entrada['day'];

					                          }

				                              $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
					                           if  ($i!=$salida['month']){

						                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para ultimo año
						                        # echo "<br/>";
					                           }

					                           if  ($i==$salida['month']){
					                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

				                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año

				                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
				                                  //echo  $ultimo_pago;
				                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
				                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
					                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
					                       		}

				                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

				                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

				                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

				                                 $solo_cobrar=30-$noches_NO_cobrar;
				                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO

				                                }

												if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
				                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año
				                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
				        						}

					                           }


					                        // echo $i."meses;";
					                        //   echo "<br/>";

					                    } //END MONTHS ENDIND YEAR



				                	}else{  //middle years

				                		for ($i=1; $i<=12; $i++){ //each month last year
					                          // echo $i."meses;";
					                          // echo "<br/>";
					                          $last_day_month=ultimoDia($i,$years);
					                          if ($last_day_month<=$entrada['day']){
					                          	$dia_de_pago=$last_day_month;
					                          }else{
					                          	$dia_de_pago=$entrada['day'];

					                          }
					                           $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
					                          //echo $payment_day;
					                         //  print_r($payment_day);
					                         //  echo "<br/>";
					                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para años del medio
					                    } //END MONTHS MIDDLE YEAR

				                    }
				                   //print whole array


				                } //END ALL THE YEARS


				    			$size_pagos=count($fechas_de_pago);//CANTIDAD DE PAGOS A HACER
				    			$contador=0;

				    			if ($_SESSION['last_payment_date']) unset($_SESSION['last_payment_date']);
				    			if ($_SESSION['payments']) unset($_SESSION['payments']);
				    			if ($_SESSION['payments_qty']) unset($_SESSION['payments_qty']);
				    			if ( $_SESSION['nights_last_payment']) unset( $_SESSION['nights_last_payment']);
				                 $_SESSION['last_payment_date']="";  //ultima fecha de pago
				                 $_SESSION['payments']=array(); //fechas de pago
				                 $_SESSION['payments_qty']=0;    //cantidad de pagos
				                 $_SESSION['nights_last_payment']=0; //cantidad de noches

				       		 foreach ($fechas_de_pago AS $k){
				                   $contador++;
				                   if ($contador!=$size_pagos){

				                   }

				                 if ($contador==$size_pagos){

					                 if ($nights_last_payment>0){
				                       $_SESSION['last_payment_date']=date_to_insert($k['year']."-".$k['month']."-".$k['day']);    //ultimo pago
				                     //  array_push($_SESSION['payments'], date_to_insert($k['year']."-".$k['month']."-".$k['day']));  //fechas de pago
				                       $_SESSION['payments_qty']=$size_pagos;//cantidad de pagos
				                     }else{
				                      	$_SESSION['payments_qty']=($size_pagos-1);//cantidad de pagos
				                     }
				                }

				               $_SESSION['payments']=$fechas_de_pago;
				               // $_SESSION['payments_qty']=$size_pagos;
				                $_SESSION['nights_last_payment']=$nights_last_payment;

				             }
				            //============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================


				?>
				<h2 style="text-align:center; color:red;">Changing <? if(($status==22)||($status==23)||($status==24)||($status==25)){?> <span style="color:green">Owner -</span><?}?> Long Term Rental <span style="color:black">No.<?=$_POST['reference']?></span></h2>
					 	     <div style="width:571px; height:33px; text-align:center; margin: 0 auto;"><img src="images/steps/2-4.png" alt="" width="571px" height="33px"/> </div>
					 	     <hr />
					<form method="post" action="edit_long_term_rental3.php" name="long_2">
				            <input type="hidden" name="rate" value="<?=$_POST['rate']?>"/>
				             <input type="hidden" name="FM" value="<?=$_POST['FM']?>"/>
				              <input type="hidden" name="FB" value="<?=$_POST['FB']?>"/>
				        <div style="float:left; width:600px; height:180px;/* background-color:orange;*/ padding:0px;">

				        <fieldset><legend>Detalles de villa</legend>
					         <!--INFORMACIONES DE LA VILLAS INICIAN-->

						       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="223" height="165px" />
						       <p id="td0" style="font-weight:bold;">No.
							        <span class="azul"><?=$casa['no']?></span>
						       </p>
						       <p id="td0" style="font-weight:bold;">Size:<span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
						       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

						       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
					           <!--START PRICE FOR THIS RENT-->
							      Price&nbsp;US$&nbsp;<span class="azul"><?=$_POST['price_long']?></span>
						       </p>
						       <!--END PRICE FOR THIS RENT-->
				        </fieldset>

				        </div>

				<fieldset><legend>Services for Long Term</legend>
					       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->

					      <p style="text-align:right; font-weight:bold"><span id="td0" > Maintenance: </span><!--<br />-->
					      <input type="text" class="azul" style="text-align:right" name="maintenance" value="<?=$casa['maintenance']?>" >
					           </p>
					       <!--<br />-->

					       <p style="text-align:right; font-weight:bold"><span id="td0">Pool and garden: </span><!--<br />-->
						    <? if($price_pool>0){?>
						    <input type="text" class="azul" style="text-align:right" name="pool_garden" value="<?=$price_pool?>" >
						   <?}else{?>
						   <input type="text" class="azul" style="text-align:right" name="pool_garden" value="<?=$casa['p_out_clear']?>" >
						   <?}?>
						   
						   </p>
					       <!--<br />-->

					       <p style="text-align:right; font-weight:bold"><span id="td0">Water: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_water" value="<?=price_water($bed=$casa['bed'])?>" ></p>
					         <p style="text-align:right; font-weight:bold"><span id="td0">Gas: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_gas" value="<?=price_gas($bed=$casa['bed'])?>" ></p>
					       <!--<br />-->

					       <p style="text-align:right; font-weight:bold">
					        <?
					          if ($servicios_reserva_long){
					            	 foreach ($servicios_reserva_long as $sl){
					            	 	if ($sl['name']=="Maid Service"){ $price_maid=$sl['price'];}
									}
								}?>
					       	<span id="td0">Maid service: </span><!--<br />-->
							<? if($price_maid>0){?>
								<input type="text" class="azul" style="text-align:right" name="maid" value="<?=$sl['price']?>" >
							<?}else{?>
					       	<select  class="azul" style="text-align:right" name="maid" size=1>

					       	<option value="<?=$casa['p_in_clear']?>" <? if($price_maid==$casa['p_in_clear']) echo 'selected="selected"'; ?> >Recomended(<?=$casa['p_in_clear']?>)</option>

					       	<option value="0.00" <? if(!$price_maid) echo 'selected="selected"'; ?>  >No</option>
					       	 <?   // $casa['bed']=2;
					       	switch($casa['bed']){
				                	case 2: if($price_maid==50) $seleccionado='selected="selected"'; echo "<option value=\"50.00\" $seleccionado >A day per week (50.00)</option>";
				                			if($price_maid==125) $seleccionado='selected="selected"'; echo "<option value=\"125.00\" $seleccionado >Two days per week (125.00)</option>";
				                			break;
				                	case 3: if($price_maid==60) $seleccionado='selected="selected"'; echo "<option value=\"60.00\" $seleccionado >A day per week (60.00)</option>";
				                			break;
				                	case 4: if($price_maid==70) $seleccionado='selected="selected"'; echo "<option value=\"70.00\" $seleccionado >A day per week (70.00)</option>";
				                			break;
				                	case 6: if($price_maid==100) $seleccionado='selected="selected"'; echo "<option value=\"100.00\" $seleccionado >A day per week (100.00)</option>";
				                			break;
					       	}
					       	 ?>
					       	</select>
							<?}?></p>
					       <!--<br />-->
				            <?// echo $price_maid;
				             ?>
					       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
					       </fieldset>

				           <?  //print_r($servicios_reserva_long);
									//echo $casa['bed'];
									?>

					       <!--INFORMACIONES DE LA RENTA INICIA-->
					      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
					       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
					       		<option value="<?=$i?>" <? if ($info_book['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
					       <? } ?>
					       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
					       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
					       		<option value="<?=$i?>" <? if ($info_book['kids'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
					       <? } ?>
					       </select>&nbsp;&nbsp;&nbsp;Number of Vehicules: <select name="vehicles">
					        			<? for ($i=0; $i<=5; $i++){?>
											<option value="<?=$i?>" <? if ($info_book['vehicles']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
										<? }?>
					                 </select>


				 <p><span style="font-weight:bold;"> Payments: </span><u><span style="color:#09F"><?if ($nights_last_payment==0){ echo ($contador-1);}else{echo $contador;}?></span></u></p>

				  <p style="text-align:leftt; font-size:11px;">
						      <span style="font-weight:bold;">Status:</span>
						      <span style="color:#09F">
							      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
							      	<input type="radio" name="status" value="11" checked="checked">Checked out
							      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
								     <input type="radio" name="status" value="8" <? if ($info_book['status']==8) echo "checked=\"checked\"";?> <? if (($info_book['status']!=8)&&($info_book['status']!=9)&&($info_book['status']!=10)) echo "checked=\"checked\"";?>>Checking in
								     <input type="radio" name="status" value="9" <? if ($info_book['status']==9) echo "checked=\"checked\"";?>>Confirmed
								     <input type="radio" name="status" value="10" <? if ($info_book['status']==10) echo "checked=\"checked\"";?> >No confirmed
							      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
							      	 <input type="radio" name="status" value="9" checked="checked" <? if ($info_book['status']==9) echo "checked=\"checked\"";?> <? if (($info_book['status']!=9)&&($info_book['status']!=10)) echo "checked=\"checked\"";?>>Confirmed
								     <input type="radio" name="status" value="10" <? if ($info_book['status']==10) echo "checked=\"checked\"";?>>No confirmed
								  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
				                    <input type="radio" name="status" value="8" checked="checked">Checked in
								  <?}?>
						      </span>
					      <p>
					      <input type="hidden" name="price_long" value="<?=$_POST['price_long']?>"/>
					      <input type="hidden" name="client" value="<?=$_POST['client']?>"/>
					      <input type="hidden" name="comment" value="<?=$_POST['comment']?>"/>
					      <input type="hidden" name="ref" value="<?=$_POST['reference']?>"/>
					      <input type="hidden" name="reserveid" value="<?=$info_book['reserveid']?>"/>
					      <input type="hidden" name="starting" value="<?=$starting_date?>"/>
					      <input type="hidden" name="ending" value="<?=$ending_date?>"/>
					      <input type="hidden" name="ending" value="<?=$ending_date?>"/>
					       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"/>
					      <input type="hidden" name="villa_no" value="<?=$casa['no']?>"/>
					      <p><input class="book_but" type="submit" name="confirm" value="Continue" /></p>
					     </form>
				<?
				   	   }
				   	 } //END IF SESSION USER LEVER IS NOT ADMIN


					 //-------------------FOR ADMIN DO THIS------------------------------------------------------
				    if ($_SESSION['info']['level']==1){
				   	   if ($qty_nights<1){
				             	echo $qty_nights." nights";
				             	echo "<br/>";
				             	echo "<span style='color:red'>Long term rental must be minimun 3 weeks (21 nights) OR ONE NIGHT FOR ADMIN USERS</span>";
				       }else{

				              $entrada=breakdate($starting_date); //return dates in pieces
				              $salida=breakdate($ending_date); //return dates in pieces

				              $payment_day=array();
				              $fechas_de_pago=array();


				              	$years_qty=($salida['year']-$entrada['year']);  //return quantity of years

				                for ($years=$entrada['year']; $years<=$salida['year']; $years++){
				                	//echo $years."<br>";
				                	if ($years==$entrada['year']){  //starting year

				                       if ($entrada['year']!=$salida['year']){//si tiene mas de un año
				                        $months_start_year=12-$entrada['month'];

				                         $months_starting=12-$months_start_year; //return month starting first year
					                        for ($i=$months_starting; $i<=12; $i++){ //each month first year
						                          $last_day_month=ultimoDia($i,$years);
						                          if ($last_day_month<=$entrada['day']){
						                          	$dia_de_pago=$last_day_month;
						                          }else{
						                          	$dia_de_pago=$entrada['day'];

						                          }
						                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
				                                   array_push($fechas_de_pago,$payment_day);

					                        } //END MONTH FIRST YEAR
					                   }else{//ES EL MISMO AÑO DE ENTRADA QUE DE SALIDA
				                             for ($i=$entrada['month']; $i<=$salida['month']; $i++){ //each month first year
						                          $last_day_month=ultimoDia($i,$years);
						                          if ($last_day_month<=$entrada['day']){
						                          	$dia_de_pago=$last_day_month;
						                          }else{
						                          	$dia_de_pago=$entrada['day'];

						                          }
						                          $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
					                                if  ($i!=$salida['month']){
					                                   	array_push($fechas_de_pago,$payment_day);
					                                 }

													if  ($i==$salida['month']){
							                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

						                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año

						                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
						                                  //echo  $ultimo_pago;
						                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
						                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
							                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
							                       		}

						                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

						                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

						                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

						                                 $solo_cobrar=30-$noches_NO_cobrar;
						                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO
						                                # echo  $ending_date." - ".$solo_cobrar." noches";  //last payment
						                                }

														if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
						                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año
						                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
						        						}

							                        }
					                        } //END MONTH FIRST YEAR

					                   }//END MONTH FIRST YEAR
				                	}elseif($years==$salida['year']){   //ending year

				                        $months_end_year=$salida['month'];

				                        for ($i=1; $i<=$salida['month']; $i++){ //each month last year

					                        $last_day_month=ultimoDia($i,$years);
					                          if ($last_day_month<=$entrada['day']){
					                          	$dia_de_pago=$last_day_month;
					                          }else{
					                          	$dia_de_pago=$entrada['day'];

					                          }

				                              $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
					                           if  ($i!=$salida['month']){

						                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para ultimo año
						                        # echo "<br/>";
					                           }

					                           if  ($i==$salida['month']){
					                       		if ($salida['day']>$dia_de_pago){  //SI SALE DESPPUES DE LA FECHA DE PAGO

				                                   array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año

				                                  $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];
				                                  //echo  $ultimo_pago;
				                                  $noches_por_cobrar=dayPeriod($ending_date, $ultimo_pago);
				                                 // echo ($ending_date." ".$noches_por_cobrar);//OJO NOCHES NO SON CANTIDAD DE DIAS HABRA QUE SUMAR UNO
					                       		 $nights_last_payment= $noches_por_cobrar;  //NOCHES EN EL ULTIMO PAGO
					                       		}

				                          		if ($salida['day']<$dia_de_pago){// SI SALE ANTES DE LA FECHA DE PAGO

				                                 $ultimo_pago=$payment_day['year']."-".$payment_day['month']."-".$payment_day['day'];

				                                 $noches_NO_cobrar=dayPeriod($ultimo_pago,$ending_date);

				                                 $solo_cobrar=30-$noches_NO_cobrar;
				                                 $nights_last_payment=$solo_cobrar;  //NOCHES EN EL ULTIMO PAGO

				                                }

												if ($salida['day']==$dia_de_pago){// SI SALE EL MISMO DIA DE LA FECHA DE PAGO (NO PAGAR ESA FECHA)
				                               	 	array_push($fechas_de_pago,$payment_day);//agregar una fecha de pago en el ultimo año
				                                	$nights_last_payment=0;  //NOCHES EN EL ULTIMO PAGO
				        						}

					                           }


					                        // echo $i."meses;";
					                        //   echo "<br/>";

					                    } //END MONTHS ENDIND YEAR



				                	}else{  //middle years

				                		for ($i=1; $i<=12; $i++){ //each month last year
					                          // echo $i."meses;";
					                          // echo "<br/>";
					                          $last_day_month=ultimoDia($i,$years);
					                          if ($last_day_month<=$entrada['day']){
					                          	$dia_de_pago=$last_day_month;
					                          }else{
					                          	$dia_de_pago=$entrada['day'];

					                          }
					                           $payment_day=array('year'=>$years, 'month'=>$i, 'day'=>$dia_de_pago);
					                          //echo $payment_day;
					                         //  print_r($payment_day);
					                         //  echo "<br/>";
					                         array_push($fechas_de_pago,$payment_day);  //fechas de pago para años del medio
					                    } //END MONTHS MIDDLE YEAR

				                    }
				                   //print whole array


				                } //END ALL THE YEARS


				    			$size_pagos=count($fechas_de_pago);//CANTIDAD DE PAGOS A HACER
				    			$contador=0;

				    			if ($_SESSION['last_payment_date']) unset($_SESSION['last_payment_date']);
				    			if ($_SESSION['payments']) unset($_SESSION['payments']);
				    			if ($_SESSION['payments_qty']) unset($_SESSION['payments_qty']);
				    			if ( $_SESSION['nights_last_payment']) unset( $_SESSION['nights_last_payment']);
				                 $_SESSION['last_payment_date']="";  //ultima fecha de pago
				                 $_SESSION['payments']=array(); //fechas de pago
				                 $_SESSION['payments_qty']=0;    //cantidad de pagos
				                 $_SESSION['nights_last_payment']=0; //cantidad de noches

				       		 foreach ($fechas_de_pago AS $k){
				                   $contador++;
				                   if ($contador!=$size_pagos){

				                   }

				                 if ($contador==$size_pagos){

					                 if ($nights_last_payment>0){
				                       $_SESSION['last_payment_date']=date_to_insert($k['year']."-".$k['month']."-".$k['day']);    //ultimo pago
				                     //  array_push($_SESSION['payments'], date_to_insert($k['year']."-".$k['month']."-".$k['day']));  //fechas de pago
				                       $_SESSION['payments_qty']=$size_pagos;//cantidad de pagos
				                     }else{
				                      	$_SESSION['payments_qty']=($size_pagos-1);//cantidad de pagos
				                     }
				                }

				               $_SESSION['payments']=$fechas_de_pago;
				               // $_SESSION['payments_qty']=$size_pagos;
				                $_SESSION['nights_last_payment']=$nights_last_payment;

				             }
				            //============= ARRAY WITH MONTH DAY AND YEAR (PIECES) for Long term rental =====================


				?>
				<h2 style="text-align:center; color:red;">Changing <? if(($status==22)||($status==23)||($status==24)||($status==25)){?> <span style="color:green">Owner -</span><?}?> Long Term Rental <span style="color:black">No.<?=$_POST['reference']?></span></h2>
					 	     <div style="width:571px; height:33px; text-align:center; margin: 0 auto;"><img src="images/steps/2-4.png" alt="" width="571px" height="33px"/> </div>
					 	    <? if ($qty_nights<21){?>
					 	     <p style="color:red; background-color:yellow; font-size:11px;">WARNING: This long term rental is out of normal, because it has only <?=$qty_nights?> nights (normal is 21 nights or more)</p>
					 	    <? }?>
					 	     <hr />
					<form method="post" action="edit_long_term_rental3.php" name="long_2">
				           <input type="hidden" name="rate" value="<?=$_POST['rate']?>"/>
				             <input type="hidden" name="FM" value="<?=$_POST['FM']?>"/>
				              <input type="hidden" name="FB" value="<?=$_POST['FB']?>"/>
				        <div style="float:left; width:600px; height:180px;/* background-color:orange;*/ padding:0px;">

				        <fieldset><legend>Detalles de villa</legend>
					         <!--INFORMACIONES DE LA VILLAS INICIAN-->

						       <img  style="float:right; padding-right:5px; padding-left:5px;" src="<?=$casa['pic']?>" width="223" height="165px" />
						       <p id="td0" style="font-weight:bold;">No.
							        <span class="azul"><?=$casa['no']?></span>
						       </p>
						       <p id="td0" style="font-weight:bold;">Size:<span class="azul"><?=$casa['m2']?>&nbsp;M&sup2;&nbsp;/&nbsp;<?=number_format($casa['ft2'],0)?>&nbsp;Ft&sup2;</span></p>
						       <p  id="td0" style="font-weight:bold;">Bedrooms: <span class="azul"><?=$casa['bed']?></span> - Airs: <span class="azul"><?=$casa['AC']?></span> - Baths: <span class="azul"><?=$casa['bath']?></span></p>

						       <p  id="td0" style="font-weight:bold;">Max. Persons: <span class="azul"><?=$casa['capacity']?></span>
					           <!--START PRICE FOR THIS RENT-->
							      Price&nbsp;US$&nbsp;<span class="azul"><?=$_POST['price_long']?></span>
						       </p>
						       <!--END PRICE FOR THIS RENT-->
				        </fieldset>

				        </div>

				<fieldset><legend>Services for Long Term</legend>
					       <!--INFORMACIONES DE LOS SERVICIOS INICIAN-->

					      <p style="text-align:right; font-weight:bold"><span id="td0" > Maintenance: </span><!--<br />-->
					      <input type="text" class="azul" style="text-align:right" name="maintenance" value="<?=$casa['maintenance']?>" READONLY>
					           </p>
					       <!--<br />-->

					       <p style="text-align:right; font-weight:bold"><span id="td0">Pool and garden: </span><!--<br />-->
						   <?
					            if ($servicios_reserva_long){
					            	 foreach ($servicios_reserva_long as $sl){
					            	 	if ($sl['name']=="Garden and Pool"){ $price_pool=$sl['price'];}
									}

								}?>
								
						   <? if($price_pool>0){?>
						    <input type="text" class="azul" style="text-align:right" name="pool_garden" value="<?=$price_pool?>" >
						   <?}else{?>
						   <input type="text" class="azul" style="text-align:right" name="pool_garden" value="<?=$casa['p_out_clear']?>" >
						   <?}?>
						   
						   </p>
					       <!--<br />-->

					       <p style="text-align:right; font-weight:bold"><span id="td0">Water: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_water" value="<?=price_water($bed=$casa['bed'])?>" ></p>
					         <p style="text-align:right; font-weight:bold"><span id="td0">Gas: </span><!--<br />--><input type="text" class="azul" style="text-align:right" name="long_gas" value="<?=price_gas($bed=$casa['bed'])?>" ></p>
					       <!--<br />-->

					        <p style="text-align:right; font-weight:bold">
					        <?
					            if ($servicios_reserva_long){
					            	 foreach ($servicios_reserva_long as $sl){
					            	 	if ($sl['name']=="Maid Service"){ $price_maid=$sl['price'];}
									}

								}?>
					       	<span id="td0">Maid service: </span><!--<br />-->
							<? if($price_maid>0){?>
								<input type="text" class="azul" style="text-align:right" name="maid" value="<?=$sl['price']?>" >
							<?}else{?>
								<select  class="azul" style="text-align:right" name="maid" size=1>
								<option value="<?=$casa['p_in_clear']?>" >Full (<?=$casa['p_in_clear']?>)</option>
								<option value="<?=$casa['p_in_clear']*0.7?>">3 days (<?=$casa['p_in_clear']*0.7?>)</option>
								<option value="<?=$casa['p_in_clear']*0.4?>">2 days (<?=$casa['p_in_clear']*0.4?>)</option>
								<option value="0.00"  selected="selected">None</option>
								 
								 <? /*switch($casa['bed']){
										case 2: echo "<option value=\"50.00\" >A day per week (50.00)</option>";
												echo "<option value=\"125.00\" >Two days per week (125.00)</option>";
												break;
										case 3: echo "<option value=\"60.00\" >A day per week (60.00)</option>";
												
												break;
										case 4: echo "<option value=\"70.00\" >A day per week (70.00)</option>";
												
												break;
										case 6: echo "<option value=\"100.00\" >A day per week (100.00)</option>";
											
												break;
								 }*/

								 ?>
							</select>
							<?}?></p>
					       <!--INFORMACIONES DE LOS SERVICIOS CULMINAN-->
					       </fieldset>


					       <!--INFORMACIONES DE LA RENTA INICIA-->
					      <p style="text-align:right; font-weight:bold"><span id="td0">Adults: <select name="adults">
					       <? for ($i=1; $i<=$casa['capacity'];$i++){?>
					       		<option value="<?=$i?>" <? if ($info_book['adults'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
					       <? } ?>
					       </select>&nbsp;&nbsp;&nbsp; Children: <select name="children">
					       <? for ($i=0; $i<=$casa['capacity'];$i++){?>
					       		<option value="<?=$i?>" <? if ($info_book['kids'] == $i) {echo " SELECTED";} ?>><?=$i?></option>
					       <? } ?>
					       </select>&nbsp;&nbsp;&nbsp;Number of Vehicules: <select name="vehicles">
					        			<? for ($i=0; $i<=5; $i++){?>
											<option value="<?=$i?>" <? if ($info_book['vehicles']==$i){ echo "selected='selected'";}?> ><?=$i?></option>
										<? }?>
					                 </select>


				 <p><span style="font-weight:bold;"> Payments: </span><u><span style="color:#09F"><?if ($nights_last_payment==0){ echo ($contador-1);}else{echo $contador;}?></span></u></p>

				  <p style="text-align:leftt; font-size:11px;">
						      <span style="font-weight:bold;">Status:</span>
						      <? if(($status==22)||($status==23)||($status==24)||($status==25)){?>
                                  <span style="color:#09F">
							      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
							      	<input type="radio" name="status" value="25" checked="checked">Checked out - Owner
							      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
								     <input type="radio" name="status" value="22" <? if ($info_book['status']==22) echo "checked=\"checked\"";?> <? if (($info_book['status']!=22)&&($info_book['status']!=23)&&($info_book['status']!=24)) echo "checked=\"checked\"";?>>Checking in - Owner
								     <input type="radio" name="status" value="23" <? if ($info_book['status']==23) echo "checked=\"checked\"";?>>Confirmed  - Owner
								     <input type="radio" name="status" value="24" <? if ($info_book['status']==24) echo "checked=\"checked\"";?> >No confirmed - Owner
							      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
							      	 <input type="radio" name="status" value="23" checked="checked" <? if ($info_book['status']==23) echo "checked=\"checked\"";?> <? if (($info_book['status']!=23)&&($info_book['status']!=24)) echo "checked=\"checked\"";?>>Confirmed - Owner
								     <input type="radio" name="status" value="24" <? if ($info_book['status']==24) echo "checked=\"checked\"";?>>No confirmed - Owner
								  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
				                    <input type="radio" name="status" value="22" checked="checked">Checked in - Owner
								  <?}?>
						         </span>

						      <?}else{?>
                                 <span style="color:#09F">
							      <? if ((strtotime($ending_date))<=(strtotime(date("Y-m-d")))){?>
							      	<input type="radio" name="status" value="11" checked="checked">Checked out
							      <?}elseif((strtotime($starting_date))==(strtotime(date("Y-m-d")))){?>
								     <input type="radio" name="status" value="8" <? if ($info_book['status']==8) echo "checked=\"checked\"";?> <? if (($info_book['status']!=8)&&($info_book['status']!=9)&&($info_book['status']!=10)) echo "checked=\"checked\"";?>>Checking in
								     <input type="radio" name="status" value="9" <? if ($info_book['status']==9) echo "checked=\"checked\"";?>>Confirmed
								     <input type="radio" name="status" value="10" <? if ($info_book['status']==10) echo "checked=\"checked\"";?> >No confirmed
							      <?}elseif((strtotime($starting_date))>(strtotime(date("Y-m-d")))){?>
							      	 <input type="radio" name="status" value="9" checked="checked" <? if ($info_book['status']==9) echo "checked=\"checked\"";?> <? if (($info_book['status']!=9)&&($info_book['status']!=10)) echo "checked=\"checked\"";?>>Confirmed
								     <input type="radio" name="status" value="10" <? if ($info_book['status']==10) echo "checked=\"checked\"";?>>No confirmed
								  <?}elseif((strtotime($starting_date))<(strtotime(date("Y-m-d")))&&(strtotime($ending_date))>=(strtotime(date("Y-m-d")))){?>
				                    <input type="radio" name="status" value="8" checked="checked">Checked in
								  <?}?>
						         </span>
						      <?}?>


					      <p>
					      <input type="hidden" name="price_long" value="<?=$_POST['price_long']?>"/>
					      <input type="hidden" name="client" value="<?=$_POST['client']?>"/>
					      <input type="hidden" name="comment" value="<?=$_POST['comment']?>"/>
					      <input type="hidden" name="ref" value="<?=$_POST['reference']?>"/>
					      <input type="hidden" name="reserveid" value="<?=$info_book['reserveid']?>"/>
					      <input type="hidden" name="starting" value="<?=$starting_date?>"/>
					      <input type="hidden" name="ending" value="<?=$ending_date?>"/>
					      <input type="hidden" name="ending" value="<?=$ending_date?>"/>
					       <input type="hidden" name="villa_id" value="<?=$casa['id']?>"/>
					      <input type="hidden" name="villa_no" value="<?=$casa['no']?>"/>
					      <input type="hidden" name="referal" value="<?=$_POST['referal']?>"/>
					      <p><input class="book_but" type="submit" name="confirm" value="Continue" /></p>
					     </form>
				<?
				   	   }//END ONLY FOR ADMINS
				    } //END IF IT IS ADMIN

     }else{
      change_booking_busy_error($starting_date, $ending_date);
     }
   }else{ echo "<h2>Error on ending date</h2>"; }
 }else{ echo "<h2>Error on starting date</h2>"; }
?>