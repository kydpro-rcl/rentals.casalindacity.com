<link media="screen" rel="stylesheet" type="text/css" href="css/forent.css">
<? if($_POST){
	quitar_evento();/*quita la session de evento en caso de que existiera antes*/
	$db= new getQueries ();
	?>
	<h3 style="color:#06F; text-align:center;">Your search result for:<br/>
	<?if(trim($_POST['villa'])!=''){
	$villas_no=$db->show_id($table='villas', $id=$_POST['villa']); //villas for rent with this bedrooms qty.
	?>
	  <span style="color:#cc1c0a; text-transform:uppercase;">villa <?=$villas_no[0]['no']?></span><br/>
	<?}else{?>
	 <span style="color:#cc1c0a; text-transform:uppercase;"><?=$_POST['beds']?> Bedrooms villas</span><br/>
	<?}?>
	 From:  <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_POST['fecha_ini'])))?></span> To: <span style="color:#cc1c0a; text-transform:uppercase;"><?=formatear_fecha(date('Y-m-d',strtotime($_POST['fecha_ter'])))?></span></h3>
	 <?php
		//echo $_POST['webpage'];
	    if ($_POST['webpage']){ unset($_SESSION['WEBSITE']); $_SESSION['WEBSITE']=$_POST['webpage']; };  //SAVE WEBPAGE URL EVEN WHEN ERROR OR WRONG INFO
	     if ($_POST['referral_id']){ unset($_SESSION['REFERRALID']); $_SESSION['REFERRALID']=$_POST['referral_id']; };  //SAVE WEBPAGE URL EVEN WHEN ERROR OR WRONG INFO

		$_POST['fecha_ini']=trim($_POST['fecha_ini']); $_POST['fecha_ter']=trim($_POST['fecha_ter']);

		$fecha_e=explode('/', $_POST['fecha_ini']);
	    $fecha_t=explode('/', $_POST['fecha_ter']);
	  //  print_r ($fecha_e);
	    $_POST['ddlStartYear']=$fecha_e[2];$_POST['ddlStartMonth']=$fecha_e[0];$_POST['ddlStartDay']=$fecha_e[1];
	    $_POST['ddlEndYear']=$fecha_t[2];$_POST['ddlEndMonth']=$fecha_t[0];$_POST['ddlEndDay']=$fecha_t[1];

	 //--------------------------------------------------------------------------------------------------------------------------
	    $empieza=$_POST['ddlStartYear']."-".$_POST['ddlStartMonth']."-".$_POST['ddlStartDay'];   //join starting date as string
	    $termina=$_POST['ddlEndYear']."-".$_POST['ddlEndMonth']."-".$_POST['ddlEndDay'];        //join ending date as string
	 ?>
	 
	 <?php /*require_once('inc/promo_code.php');*/?>
	<hr style="border: 1px solid #9c0000;"/>
	<p>&nbsp;</p>
	<?php
		
	   $valid_dates1=is_date($empieza); //chek if the date is valid
	   $valid_dates2=is_date($termina);  //check if the date if real (valid)
	if ($valid_dates1 && $valid_dates2){
		$fecha_de_inicio=date('Y-m-d',(strtotime($empieza)));  //transform date to YYYY-MM-DD format
		$fecha_de_termino=date('Y-m-d',(strtotime($termina))); //transform date to YYYY-MM-DD format

		 $beds=$_POST['beds'];

		if (strtotime($fecha_de_inicio)>=strtotime(date('Y-m-d'))){  //si fecha de inicio es mayor o igual que la fecha actual

	         $night_qty=daysDifference2($fecha_de_termino, $fecha_de_inicio);

		     //-----------------------HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------

			 if (is_date($empieza)){
			 	if (is_date($termina)){
					   $valid_dates1=is_date($empieza); //chek if the date is valid
					   $valid_dates2=is_date($termina);  //check if the date if real (valid)

						if ($valid_dates1 && $valid_dates2){
							$fecha_de_inicio=date('Y-m-d',(strtotime($empieza)));  //transform date to YYYY-MM-DD format
							$fecha_de_termino=date('Y-m-d',(strtotime($termina))); //transform date to YYYY-MM-DD format
						}

					$db= new getQueries ();
					
				
				/*	$season=$db->show_id('seasons', 1);

					$inicio_t_alta=$season[0]['h_starting'];
					$fin_t_alta=$season[0]['h_ending'];
					$inicio_t_baja=$season[0]['l_starting'];
					$fin_t_baja=$season[0]['l_ending'];

					 $HS_inicio=explode('-', $inicio_t_alta);
					 $HS_fin=explode('-', $fin_t_alta);
					 $LS_inicio=explode('-', $inicio_t_baja);
					 $LS_fin=explode('-', $fin_t_baja);
					// ---------------------------------------------
					$MI=$_POST['ddlStartMonth'];   //Mes inicio
					$DI=$_POST['ddlStartDay'];   //dia inicio
					$AI=$_POST['ddlStartYear'];  //a�o inicio

					$MF=$_POST['ddlEndMonth'];  //mes final
					$DF=$_POST['ddlEndDay'];  //dia final
					$AF=$_POST['ddlEndYear'];   //a�o final

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


					 }elseif(($AIHS+1)==$AFHS){ //a�o de inio de HS es uno anterior al que termina

					   $m=0;
					   $x=0;
					  // echo "year inicio:"; echo "<br/>";
					   for ($m=$MIHS; $m<=12; $m++){       //meses


					   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
					         $ultimo_dia_mes=ultimoDia($m,$AIHS);
					    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  //dias

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

					    }
					   }


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
*/

				}else{
			 	echo "Wrong,ending date";
			 	 die();
			 	}
			 }else{
			 	echo "Wrong,starting date";
			    die();
			 }


				$LS_nights=($night_qty);          $HS_nights=0;
	           //-----------------------END HIGHT AND LOW SEASONS QUANTITY--------------------------------------

			if ($night_qty>1){
				
				$price_settings=$db->show1_active('price_settings');  //get the price settings details
				//----------------SEARCH THROUGH ALL AVAILABLE VILLAS---------------
              if ($night_qty<$price_settings['long_m_night']){ /*no hacer reservas online long term*/
					$mes=$_POST['ddlStartMonth'];
					$year=date('Y',strtotime($_POST['ddlEndYear']));
					$dia=$_POST['ddlStartDay'];
					if(trim($_POST['villa'])!=''){
						$busy=$db->see_occupancy_online_3($fecha_de_inicio, $fecha_de_termino, $_POST['villa']);
					}else{
						$busy=$db->seeOccupancyReferrals($fecha_de_inicio, $fecha_de_termino, $beds);//try
					}
			              $counting=0;
		                 // print_r ($busy);
		                //-------ARRAY FOR VILLAS----
		                     $villas_ocupadas=array();
		                     $villas_disponibles=array();
	                         $villas_nodisponibles=array();

			              foreach ($busy as $k){  //TODAS LAS OCUPACIONES QUE EMPIZAN EN ESTE MES
									//empuja en un arreglo el id de la villa ocupada
									  $array_villas_ocupada=array('id'=>$k['villa_id'],'no'=>$k['villa_number']);
										if (!in_array($array_villas_ocupada,$villas_ocupadas)){
		                                	array_push($villas_ocupadas,$array_villas_ocupada);
					               		}

			              $counting++;
			              } // end foreach

						if(trim($_POST['villa'])!=''){
							 $villas_for_rent=$db->show_id($table='villas', $id=$_POST['villa']); //villas for rent with this bedrooms qty.
						}else{
		                  $villas_for_rent=$db->villas_for_rent_online($beds);//villas for rent with this bedrooms qty.
		               		//print_r($villas_for_rent);
						}

		            foreach ($villas_for_rent AS $v){
						if($v['wish_referal']==0){/*only if the owner wish referral*/
						  $esta_villa=array('id'=>$v['id'],'no'=>$v['no']);
							if (!in_array($esta_villa,$villas_ocupadas)){
								array_push($villas_disponibles,$v);
							}else{  //if villa is not available sent details to other array for busy
								array_push($villas_nodisponibles,$v);
							}
						}
					 }

		             if (!empty($villas_disponibles)){

						/*-----------------NUEVA PROMOCION-----------------*/	
							$promocion=auto_promotion($fecha_de_inicio, $fecha_de_termino, $price='100', '');
							if($promocion){
								$promotion_apply=$promocion['title'];//title
								$promotion_ends="Hurry! Offer ends in ".date('M j Y',strtotime($promocion['fin']));
								$promotion_sale=$promocion['msg'];
								$discount_percent=$promocion['qty_perc'];
								$_POST['promotion_code']=$promocion['code'];
								$pro_id=$promocion['id'];
								$_SESSION['promotion_code']=$promocion['code'];
							
							/*print_r($promocion);	*/
							?>
							<h3><?=$promocion['title'];?></h3>
							<p><?=$promotion_ends;?></p>
							<?
							}
						/*-----------------FIN NUEVA PROMOCION-----------------*/		
                          shuffle($villas_disponibles);//mostrar de forma aleatoria el resultado.
				          foreach ($villas_disponibles AS $d){
							  
							  $p=$db->get_season3_prices($startdate=$fecha_de_inicio, $pricelow=$d['p_low'], $priceshoulder=$d['p_shoulder'], $pricehigh=$d['p_high']);	
							  /*echo "<pre>";
							  print_r($p);
							  echo "</pre>";*/
								if($p['price']==0){
									//if the villa price for that season is 0 or there is problems with seasons getting price, do not continue.
									$villano=$d['p_low'];
									die('Fatal Error: There is a pricing error, please try again.'.$villano);
								}	
								 $d['p_low']=$p['price'];
								 $d['p_high']=$p['price'];
				           ?>

				           <form method="post" name="villa_disponible" action="create_booking3.php">
				           <?
						  if(trim($_POST['referral'])!=''){?>
							<input type="hidden" name="agent" value="<?=trim($_POST['referral']);?>"/>
				           <?}?>

                                <?
                                 $d['p_low']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)),  $d['p_low']);
                                 $d['p_high']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)), $d['p_high']);
                                  //-----------------------apply weekly and monthly rate-------------------------------------------------------------
						             $nights_qty=daysDifference2(date('Y-m-d',strtotime($fecha_de_termino)), date('Y-m-d',strtotime($fecha_de_inicio)));
						             $night_Price_LS=$d['p_low'];   
									 
									 $night_Price_HS=$d['p_high'];
									 
									  $price_LS_before=$d['p_low'];  
									  $price_HS_before=$d['p_high'];
									  
						             $d['p_low']=price_rent_online($nights_qty, $normal_price=$d['p_low'], $d['bed']);
						             $d['p_high']=price_rent_online($nights_qty, $normal_price=$d['p_high'], $d['bed']);
									 
									 if($promocion){
										 $night_Price_LS-=$night_Price_LS*($promocion['qty_perc']/100);
										 $night_Price_HS-=$night_Price_HS*($promocion['qty_perc']/100);
									 }
						           //----------------------end apply weekly and monthly rate----------------------------------------------------
                                ?>
				           		<input type="hidden" name="v" value="<?=$d['id']?>"/>
				           		<input type="hidden" name="promotion_code" value="<?=$_POST['promotion_code']?>"/>

					            <div class="villas_detalles"  ><!-- onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#00f4fd'" -->
	                                   <div class="detalles1">
									   
									   <a href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_blank" alt="">
								          	<img  style="float:left; padding-right:5px;" src="../booking/<?=$d['pic']?>" alt="villa <?=$d['no']?>" title="villa <?=$d['no']?>" width="153" height="103"/>
										</a>
											
								            <h1 style="margin:0; padding:0; margin-bottom:5px;"><b>
											<a href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_blank" alt="">
												Villa No.<?=$d['no']?>
											</a>
											
											
											</b> -  <span style="color:black; font-size:10px; line-height:10px;"><?/*=$d['head']*/?>
											
											 <?=readmore_villas($d['head'],$d['id']);?>
											
											
											</span></h1>
								           	<?if ($LS_nights>0){?>
						                    	<p style="padding:0; margin:0; font-weight:bold;"> <?=$LS_nights?> nights at 
												<?php if($price_LS_before!=$night_Price_LS){?>
													<strike><?=$price_LS_before?></strike>
												<?php }?>

												<?=number_format($night_Price_LS,2);?> USD + <?=TAX_PERCENT?> TAX</p>
						                    <?}?>
						                    <?if ($HS_nights>0){?>
						                    	<p style="padding:0; margin:0; font-weight:bold;"><?=$HS_nights?> nights at
												<?php if($price_HS_before!=$night_Price_HS){?>
													<strike><?=$price_HS_before?></strike>
												<?php }?>
												 <?=number_format($night_Price_HS,2);?> USD + <?=TAX_PERCENT?> TAX</p>
					                        <?}?>
					                        <input type="hidden" name="desde" value="<?=$fecha_de_inicio?>"/>
					                        <input type="hidden" name="hasta" value="<?=$fecha_de_termino?>"/>
					                        <input type="hidden" name="T_nights" value="<?=$night_qty?>"/>
					                        <input type="hidden" name="LS_nights" value="<?=$LS_nights?>"/>
					                        <input type="hidden" name="HS_nights" value="<?=$HS_nights?>"/>
											<input type="hidden" name="LS_price" value="<?=$d['p_low']?>"/>
					                        <input type="hidden" name="HS_price" value="<?=$d['p_high']?>"/>
											<input type="hidden" name="sender" value="valid"/>
					                       <!--// Sub-Total US$ <?  /*echo number_format($amount_per_nights,2);?>  + 16% VAT-TAX (<? echo number_format($itbis,2); ?>)=<span style="color:red"> US$ <?echo number_format($total_amount,2);*/?>//-->

					                       <?
					                       		$total_LS=$LS_nights*$d['p_low'];
					                       		$total_HS=$HS_nights*$d['p_high'];												
					                            $amount_per_nights=($total_LS+$total_HS);
					                            $itbis=($amount_per_nights*TAX_DECIMAL);
					                            $total_amount=($amount_per_nights+$itbis);
												
												$total_LS2=$LS_nights*$night_Price_LS;
					                       		$total_HS2=$HS_nights*$night_Price_HS;																								
					                            $amount_per_nights2=($total_LS2+$total_HS2);
					                            $itbis2=($amount_per_nights2*TAX_DECIMAL);
					                            $total_amount2=($amount_per_nights2+$itbis2);
												
												$total_discount_with_taxes=$total_amount-$total_amount2;
												/*echo $total_discount_with_taxes;*/
												if($total_discount_with_taxes>0){
													$_SESSION['amount_discounted']=$total_discount_with_taxes;
													$_SESSION['id_promotion']=$promocion['id'];
												}else{
													$_SESSION['amount_discounted']=0;
													$_SESSION['id_promotion']='';
												}
					                       ?>
					                         <input type="hidden" name="itbis" value="<?=$itbis?>"/>
					                        <input type="hidden" name="g_total" value="<?=$total_amount?>" />
	                                        
					                        <!--<p style="padding:0; margin:0; margin-top:5px;">
					                         <a style="color:#9c0000;" href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="house('<?=$d['no']?>'); return false;" >
					                         	Pictures Gallery
					                         </a> |
					                         <a style="color:#9c0000;" href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="calendar('<?=$d['id']?>'); return false;" >
					                          See&nbsp;this&nbsp;villa&nbsp;Calendar
					                          </a></p>-->

					                   </div>
					                   <div class="detalles2">
					                   		<p class="price_t" style="font-weight:bold">Villa Total</p>
					                   		<p id="total"><sup>$</sup><span><?=number_format($total_amount2)?></span></p>
					                   		<p class="price_t" style="padding-top:3px;">(Including Tax)</p>
								          <p style="text-align:center; padding:0; margin:0; margin-top:5px;">
								          <!--//<input class="boton" type="submit" name="continuar" value="Select Villa" />//-->
								          <input type="hidden" name="continuar" value="continue"/>
								          <? if(($nights_qty>=30)&&($d['able_s']==1)){/*show as occupied if more than 29 nights and not monthly allow*/?>
								          	<img src="../for_rent/images/occupied.png" alt="Occupeid" />
								          <?}else{?>
								          	<input type="image" name="choose" src="../for_rent/images/select.png" >
								          <?}?>
								          </p>
	                                   </div>
					          </div>
				          </form>
		              <?
				          }


				     }else{
						if(trim($_POST['villa'])!=''){
							 $villas_for_rent=$db->show_id($table='villas', $id=$_POST['villa']); //villas for rent with this bedrooms qty.
							 echo "<h1 style='text-align:center;'><span style='color:red'>We sorry, villa <span style='color:black'>".$villas_for_rent[0]['no']." </span>  is busy from: <span style='color:black'>".formatear_fecha($fecha_de_inicio)."</span> to: <span style='color:black'>".formatear_fecha($fecha_de_termino)."</span></span></h1><br/><p>&nbsp;</p>";
						}else{
							echo "<h1 style='text-align:center;'><span style='color:red'>We sorry, All our <span style='color:black'>".$beds." bedrooms</span> villas are busy from: <span style='color:black'>".formatear_fecha($fecha_de_inicio)."</span> to: <span style='color:black'>".formatear_fecha($fecha_de_termino)."</span></span></h1><br/><p>&nbsp;</p>";
					   }
				     }

				     if ($_POST['show']==0){ //SHOW VILLAS NOT AVAILABLE BELOW IF ALL INVENTORY
				      // print_r($villas_nodisponibles);
	                  /*foreach ($villas_nodisponibles AS $vb){

	                      $vb['p_low']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)),  $vb['p_low']);
                          $vb['p_high']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)), $vb['p_high']);

                           //-----------------------apply weekly and monthly rate-------------------------------------------------------------
						             $nights_qty=daysDifference2(date('Y-m-d',strtotime($fecha_de_termino)), date('Y-m-d',strtotime($fecha_de_inicio)));
						             $night_Price_LS=$vb['p_low'];   $night_Price_HS=$vb['p_high'];
									 
									   $price_LS_before=$vb['p_low'];  $price_HS_before=$vb['p_high'];
						             $vb['p_low']=price_rent_online($nights_qty, $normal_price=$vb['p_low'], $vb['bed']);
						             $vb['p_high']=price_rent_online($nights_qty, $normal_price=$vb['p_high'], $vb['bed']);
						   //----------------------end apply weekly and monthly rate----------------------------------------------------

				        ?>

	                              <!--// style="height:105px; padding-right:5px;" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFF99'"//-->

					          <div class="villas_detalles1"  >
	                           <div class="detalles1">
					          	<img  style="float:left; padding-right:5px;" src="../booking/<?=$vb['pic']?>" alt="villa <?=$vb['no']?>" title="villa <?=$vb['no']?>" width="153" height="103"/>
					           <h1 style="margin:0; padding:0; margin-bottom:5px;"><b>Villa No.<?=$vb['no']?></b> - <span style="color:black; font-size:10px;"><?=$vb['head']?></span>  </h1>
								           	<?if ($LS_nights>0){?>
						                    	<p style="padding:0; margin:0; font-weight:bold;"> <?=$LS_nights?> nights at 
												<?php if($price_LS_before!=$vb['p_low']){?>
													<strike><?=$price_LS_before?></strike>
												<?php }?>
												
												<?=number_format($vb['p_low'],2);?> USD + <?=TAX_PERCENT?> TAX</p>
						                    <?}?>
						                    <?if ($HS_nights>0){?>
						                    	<p style="padding:0; margin:0; font-weight:bold;"><?=$HS_nights?> nights at 
													<?php if($price_HS_before!=$vb['p_high']){?>
														<strike><?=$price_HS_before?></strike>
													<?php }?>

												<?=number_format($vb['p_high'],2);?> USD + <?=TAX_PERCENT?> TAX</p>
					                        <?}?>
					               <?
					                       		$total_LS=$LS_nights*$vb['p_low'];
					                       		$total_HS=$HS_nights*$vb['p_high'];
					                           $amount_per_nights=($total_LS+$total_HS);
					                            $itbis=($amount_per_nights*TAX_DECIMAL);
					                            $total_amount=($amount_per_nights+$itbis);
					                       ?>


		                         <!--<p style="padding:0; margin:0; font-size:10px; line-height:12px;"><span style="color:#9e0303; text-transform:uppercase;">Nightly:</span>
		                           <?if ($HS_nights<=0){?>
		                          		<?=number_format($night_Price_LS,2)?>
		                           <?}else{?>
		                          		<?=number_format($night_Price_HS,2)?>
		                           <?}?>
		                           USD plus Tax<br/>

		                          <span style="color:#9e0303; text-transform:uppercase;">Weekly:</span>
		                          <?if ($HS_nights<=0){?>
		                          	<?=number_format(weekly_rate($night_Price_LS),2)?>
		                          <?}else{?>
		                          	<?=number_format(weekly_rate($night_Price_HS),2)?>
                                  <?}?>
		                           USD plus Tax<br/>

                              <? if($vb['able_s']!=1){?>
		                          <span style="color:#9e0303; text-transform:uppercase;">Monthly:</span>
		                           <?if ($HS_nights<=0){?>
		                           		<?=number_format(monthly_rate($night_Price_LS),2)?>
		                           <?}else{?>
		                           		<?=number_format(monthly_rate($night_Price_HS),2)?>
		                       	   <?}?>

		                            USD plus Tax
		                      <?}?>
		                            </p>-->

					             <p style="padding:0; margin:0; margin-top:5px;">  <a style="color:#9c0000;" href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="house('<?=$vb['no']?>'); return false;">
					              Pictures Gallery
					               </a> |
					               <a style="color:#9c0000;" href="#" onmouseover="this.style.cursor='hand';this.style.cursor='pointer';" onClick="calendar('<?=$vb['id']?>'); return false;">
					               See&nbsp;this&nbsp;villa&nbsp;Calendar
					              </a>
					            </p>

		                     </div>
					         <div class="detalles2">
					         <p class="price_t" style="font-weight:bold">Villa Total</p>
					         <p class="total"><sup>$</sup><span><?=number_format($total_amount)?></span></p>
					         <p class="price_t" style="padding-top:3px;">(Including Tax)</p>
					         <p style="text-align:center;padding:0; margin:0; margin-top:5px;"> <img src="../for_rent/images/occupied.png" alt="Occupeid" /></p>
					         </div>
	          		   </div>

		              <?
		              }*///end all the busy villas
				     }//only if all inventory selected end here
              }else{/*mensaje cuando el booking tiene 30 o mas dias*/
                  ?>

                  <h1 style="color:black; font-size:16px; font-family:Arial, Helvetica, sans-serif; line-height:22px;">To make a booking with <?=$price_settings['Long_nights']?> nights or longer, please contact our offices.<br/>
                      Phone: +1-809-571-1190 - Email: <a  style="color:red" href="mailto:reservations@CasaLindaCity.com">reservations@CasaLindaCity.com</a>

                  </h1>
               <?
              }
				//----------------SEARCH THROUGH ALL AVAILABLE AND NOT AVAILABLE VILLAS---------------
			}else{
			echo "<p>&nbsp;</p><h1 style='text-align:center;'><span style='color:red'>Error: Our minimum requirements are at least two nights, please try your search again on the calendar box to the left.</span></h1><p>&nbsp;</p>";
			}
		}else{
		   echo "<p>&nbsp;</p><h1 style='text-align:center;'><span style='color:red'>Error: Please, check starting date and try again.</span></h1>";
		   echo "<h1 style='text-align:center;'><strong>It is impossible start at:<span style='color:green'> ".formatear_fecha($fecha_de_inicio)."</span></strong></h1><p>&nbsp;</p>";
		}
	}else{
	 echo "<p>&nbsp;</p><h1 style='text-align:center;'><span style='color:red'>Error: One or both dates are not valid.</span></h1>";
	} //end if valid dates
	?>

<?}else{?>
<h1 style="color:red; font-size:18px; line-height:normal;">Please, select arrival and departure dates on the top left box of this page.</h1>

<?}?>

<hr style="border: 1px solid #9c0000;"/>