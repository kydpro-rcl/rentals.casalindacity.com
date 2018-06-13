<? 
if($_GET){
	$_POST['beds']=$_GET['b'];
	$_POST['fecha_ini']=$_GET['i'];
	$_POST['fecha_ter']=$_GET['t'];
}

if(isset($_SESSION['clientIP'])){ unset($_SESSION['clientIP']); } 
$_SESSION['clientIP']=$_SERVER['REMOTE_ADDR'];

if(!$_POST){
	//include_once('page-generic.php');
	//die();
 }else{
	quitar_evento();/*quita la session de evento en caso de que existiera antes*/
	$db= new getQueries ();
	$fecha_checkin=date('Y-m-d', strtotime($_POST['fecha_ini']));
	$fecha_checkout=date('Y-m-d', strtotime($_POST['fecha_ter']));
	
	if(($_POST['beds']!=5)&&($_POST['beds']!=6)){
		$promocion=auto_promotion($fecha_checkin, $fecha_checkout, $price='100', $code=trim($_POST['promo']));/*WITH THIS LINE IS POSSIBLE TO GET AUTO PROMOTION ACTIVATED*/
	}//echo $promocion;
	//echo "Promocion";
	//die();
		if($promocion){
			$promotion_apply=$promocion['title'];//title
			$promotion_ends="Hurry! Offer ends in ".date('M j Y',strtotime($promocion['fin']));
			$promotion_sale=$promocion['msg'];
			$discount_percent=$promocion['qty_perc'];
			$_POST['promotion_code']=$promocion['code'];
		}
			
		if($promocion['id']!=''){
			 $pro=$db->display_table($table='promotion', $condition=" id='".trim($promocion['id'])."' AND active='1'", $order='id');
		}
		if($pro[0]){
			$fecha_checkin=strtotime($_POST['fecha_ini']);
			$fecha_checkout=strtotime($_POST['fecha_ter']);
			$valid_from=strtotime($pro[0]['desde']);
			$valid_to=strtotime($pro[0]['hasta']);
			$tobook_from=strtotime($pro[0]['bookingfrom']);
			$tobook_to=strtotime($pro[0]['bookingto']);
			$now_date=time();
			$night_qty=daysDifference2(date('Y-m-d', $fecha_checkout), date('Y-m-d', $fecha_checkin));
			
					if(($night_qty>=$pro[0]['min_days'])&&($night_qty<=$pro[0]['max_days'])){
						//type
						switch($pro[0]['tipo']){
							case 1:
								//1-percent
								$promotion_apply=$pro[0]['qty']."% off";
								$discount_percent=$pro[0]['qty'];
								break;
								
							case 2://2-amount
								$promotion_apply=$pro[0]['qty']." USD off";
								#$discount_percent='';
								break;
								
							case 3://3-nights
								$promotion_apply=$pro[0]['qty']." nights off";
								$one_villa4rent=$db->oneVilla4rent();
								/*echo "<pre>";
								print_r($one_villa4rent);
								echo "</pre>";*/
								$villa_price=$one_villa4rent[0]['p_low'];
								
								$this_villa_total=$villa_price*$night_qty; 
								$this_villa_discounted_amt=$pro[0]['qty']*$villa_price;
								
								$discount_percent=convert_amount_to_percent($this_villa_total, $this_villa_discounted_amt);
								break;
						}
						
						$promotion_ends="Hurry! Offer ends in ".date('M j Y',strtotime($pro[0]['bookingto']));
						$promotion_sale="Sale!";

					}else{
						$promotion_apply="This promotion do not apply (1)";
						$discount_percent='';
					}

		}
	?>

<h3 style="color:#333; text-align:center;">Your search result for:<br/>
  <?php if(trim($_POST['uniqueVilla'])!=''){
	$villas_no=$db->singleVilla4rent($id=$_POST['uniqueVilla']); //villas for rent with this bedrooms qty.
	if(!$villas_no){
		die('Error: villa not found!');// stop here is villa is not available online
	}
	?>
  <span style="color:#0098da; text-transform:uppercase;">villa
  <?=$villas_no[0]['no']?>
  </span><br/>
  <?}else{?>
  <span style="color:#0098da; text-transform:uppercase;">
  <?if($_POST['beds']==10){ echo "All"; }else{ echo $_POST['beds']; }?>
  Bedrooms villas</span><br/>
  <?}?>
  <span style="color:#333; text-transform:uppercase;">From: </span> 
  <span style="color:#0098da; text-transform:uppercase;">
  <?=formatear_fecha(date('Y-m-d',strtotime($_POST['fecha_ini'])))?>
  </span>
  <span style="color:#333; text-transform:uppercase;">To: </span>
  <span style="color:#0098da; text-transform:uppercase;">
  <?=formatear_fecha(date('Y-m-d',strtotime($_POST['fecha_ter'])))?>
  </span>
  </h3>
<?php
	    if ($_POST['webpage']){ unset($_SESSION['WEBSITE']); $_SESSION['WEBSITE']=$_POST['webpage']; };  //SAVE WEBPAGE URL EVEN WHEN ERROR OR WRONG INFO
	    if ($_POST['referral_id']){ unset($_SESSION['REFERRALID']); $_SESSION['REFERRALID']=$_POST['referral_id']; };  //SAVE WEBPAGE URL EVEN WHEN ERROR OR WRONG INFO
		$_POST['fecha_ini']=trim($_POST['fecha_ini']); $_POST['fecha_ter']=trim($_POST['fecha_ter']);
		$fecha_e=explode('/', $_POST['fecha_ini']);
	    $fecha_t=explode('/', $_POST['fecha_ter']);
	    $_POST['ddlStartYear']=$fecha_e[2];$_POST['ddlStartMonth']=$fecha_e[0];$_POST['ddlStartDay']=$fecha_e[1];
	    $_POST['ddlEndYear']=$fecha_t[2];$_POST['ddlEndMonth']=$fecha_t[0];$_POST['ddlEndDay']=$fecha_t[1];
	 //--------------------------------------------------------------------------------------------------------------------------
	    $empieza=$_POST['ddlStartYear']."-".$_POST['ddlStartMonth']."-".$_POST['ddlStartDay'];   //join starting date as string
	    $termina=$_POST['ddlEndYear']."-".$_POST['ddlEndMonth']."-".$_POST['ddlEndDay'];        //join ending date as string
	 ?>
<?php require_once('inc/promo_code.php');?>
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
					/*   $valid_dates1=is_date($empieza); //chek if the date is valid
					   $valid_dates2=is_date($termina);  //check if the date if real (valid)

						if ($valid_dates1 && $valid_dates2){
							$fecha_de_inicio=date('Y-m-d',(strtotime($empieza)));  //transform date to YYYY-MM-DD format
							$fecha_de_termino=date('Y-m-d',(strtotime($termina))); //transform date to YYYY-MM-DD format
						}

					$db= new getQueries ();
					$season=$db->show_id('seasons', 1);

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
					 if ($AIHS==$AFHS){
					 	echo "Error year1:Seasons";
					 	die();
					 }elseif(($AIHS+1)==$AFHS){ //año de inio de HS es uno anterior al que termina
					   $m=0;
					   $x=0;
					  // echo "year inicio:"; echo "<br/>";
					   for ($m=$MIHS; $m<=12; $m++){       //meses
					   	 if ($m==$MIHS){ 	$i=$DIHS;	}else{  $i=1; }
					         $ultimo_dia_mes=ultimoDia($m,$AIHS);
					    for ($x=$i; $x<=$ultimo_dia_mes; $x++){  //dias
					     	$HS_array=array('mes'=>$m,'dia'=>$x);
						    array_push($temporada_alta_mes_dia,$HS_array);
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

					    }
					   }
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
					 }*/
					 
				}else{
			 	echo "Wrong,ending date";
			 	 die();
			 	}
			 }else{
			 	echo "Wrong,starting date";
			    die();
			 }
			 $cant_noches_HS=0;
			$LS_nights=($night_qty-$cant_noches_HS); 
			$HS_nights=$cant_noches_HS;
			
			/*echo $LS_nights;
			echo "<br/>";
			echo $HS_nights;
			echo die();*/
	//-----------------------END HIGHT AND LOW SEASONS QUANTITY-----------------------------------------------------------------------------
	
		if(time()<(strtotime('2017-04-16'))){/*if date min only until ending holy week*/
			//echo "Menor del 1";
			if((strtotime($empieza)>=(strtotime('2017-04-11')))&&(strtotime($termina)<=(strtotime('2017-04-16')))){
				$minimu_stay=3;
			}else{
				$minimu_stay=2;
			}
		}else{
			$minimu_stay=2;
			//echo "despues del 1";
		}	
			
			
			if ($night_qty>=$minimu_stay){
				$price_settings=$db->show1_active('price_settings');  //get the price settings details
				//print_r($price_settings);
				//----------------SEARCH THROUGH ALL AVAILABLE VILLAS---------------
              if ($night_qty<$price_settings['long_m_night']){ /*no hacer reservas online long term*/
					$mes=$_POST['ddlStartMonth'];
					$year=date('Y',strtotime($_POST['ddlEndYear']));
					$dia=$_POST['ddlStartDay'];
					if(trim($_POST['villa'])!=''){
						$busy=$db->see_occupancy_online_3($fecha_de_inicio, $fecha_de_termino, $_POST['villa']);
					}else{
						$busy=$db->see_occupancy_online_2($fecha_de_inicio, $fecha_de_termino, $beds);//try
					}
			              $counting=0;
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

						if(trim($_POST['uniqueVilla'])!=''){
							$villas_for_rent=$db->singleVilla4rent($id=$_POST['uniqueVilla']);
							if(!$villas_for_rent){ die('This villa is out of the Rentals Program, please contact: reservations@casalindacity.com');}
						}else{
		                  $villas_for_rent=$db->villas_for_rent_online($beds);//villas for rent with this bedrooms qty.
		               		//print_r($villas_for_rent);
						}

		            foreach ($villas_for_rent AS $v){
			          $esta_villa=array('id'=>$v['id'],'no'=>$v['no']);
						if (!in_array($esta_villa,$villas_ocupadas)){
		                  array_push($villas_disponibles,$v);
					    }else{  //if villa is not available sent details to other array for busy
					     array_push($villas_nodisponibles,$v);
					    }
			         }

					 if ($night_qty>=$price_settings['mid_m_night']){ /*mid terms note*/
						echo "<h4 style='color:red; padding-left:10%;'>NOTE: Electricity is charged separate as per consumption.</h4>";
					 }
					 					 
		             if (!empty($villas_disponibles)){
                          shuffle($villas_disponibles);//mostrar de forma aleatoria el resultado.
						  $contador=0;
				          foreach ($villas_disponibles AS $d){		
							//==============================START NEW PRICES FOR SEASONS 3======================================================
								$p=$db->get_season3_prices($startdate=$fecha_de_inicio, $pricelow=$d['p_low'], $priceshoulder=$d['p_shoulder'], $pricehigh=$d['p_high']);	
							   /*print_r($p);
							   echo "hola";
							   die();*/
							   if($p['price']==0){
								   //if the villa price for that season is 0 or there is problems with seasons getting price, do not continue.
								   die('Fatal Error: There is a pricing error, please try again.');
							   }
						  //==============================END NEW PRICES FOR SEASONS 3======================================================
						  
                                 $d['p_low']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)),  $p['price']);
                                 $d['p_high']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)), $p['price']);
                                  //-----------------------apply weekly and monthly rate--------------------------------------
										$precio_anteriorLS=	$d['p_low'];
										$precio_anteriorHS=	$d['p_high'];
										//echo "Eric Sand";echo "<br/>";
										if($discount_percent){/*case any promotion apply*/
											$d['p_low']-=$d['p_low']*($discount_percent/100);
											$d['p_high']-=$d['p_high']*($discount_percent/100);
											
										}
										
										$amount_before_total_per_nights=(($precio_anteriorLS*$LS_nights)+($precio_anteriorHS*$HS_nights));
										//$amount_before_taxes=$amount_before_total_per_nights*TAX_DECIMAL;
										$amount_before_taxes=$amount_before_total_per_nights;
										$precio_total_anterior=($amount_before_total_per_nights);
										$precio_anteriorVPN=($amount_before_taxes)/($LS_nights+$HS_nights);//important: what gives the previous prices
										$precio_anteriorVPN=number_format($precio_anteriorVPN,2);
																			
						             $nights_qty=daysDifference2(date('Y-m-d',strtotime($fecha_de_termino)), date('Y-m-d',strtotime($fecha_de_inicio)));
						             $night_Price_LS=$d['p_low'];   $night_Price_HS=$d['p_high'];
									 
						             $d['p_low']=price_rent_online($nights_qty, $normal_price=$d['p_low'], $d['bed']);
						             $d['p_high']=price_rent_online($nights_qty, $normal_price=$d['p_high'], $d['bed']);
						           //----------------------end apply weekly and monthly rate----------------------------------------------                           
					                $total_LS=$LS_nights*$d['p_low'];
					                $total_HS=$HS_nights*$d['p_high'];
					                $amount_per_nights=($total_LS+$total_HS);
																		
					                $itbis=($amount_per_nights*TAX_DECIMAL);
					               // $total_amount=($amount_per_nights+$itbis);
									 $total_amount=($amount_per_nights);	
				           ?>
									<!--RESPONSIVE VILLAS DETAILS START-->
									<div class="container">
									  <div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
										  <div class="panel panel-primary rcorners2">
											<div class="row padall">
											  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> <span></span> <a   class="thumbnails"  href="villa-details.php?v=<?=$d['id']?>" target="_blank" ><img class="img-responsive img-thumbnail" src="../booking/<?=$d['pic']?>" /></a> </div>
											  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
												<div class="clearfix">
												 <!-- <div class="pull-left"> <span class="fa fa-dollar icon">
													<?=number_format($total_amount)?>
													</span> Total -
													<?if ($LS_nights>0){?>
													<?=$LS_nights?>
													nights at $
													<?=number_format($d['p_low'],2);?>
													<?}?>
													<?if ($HS_nights>0){?>
													<?=$HS_nights?>
													nights at $
													<?=number_format($d['p_high'],2);?>
													<?}?>
													+
													<?=TAX_PERCENT?>
													TAX </div>-->
												  <div class="pull-right">
													<?=number_format($d['ft2'])?>
													SqFt |
													<?=$d['bed']?>
													Bdr |
													<?=$d['bath']?>
													Baths 
													|
													<?=($d['bed']*2)?>
													Adults max. 
													</div>
												</div>
												<div>
												<a href="villa-details.php?v=<?=$d['id']?>" target="_blank" alt="">
												  <h4><!--<span class="fa fa-map-marker icon"></span>--> Villa
													<?=$d['no']?> <?php
																$txt_class='';//empty when return
																		switch($d['classification']){
																				case 1: //Premium
																					$txt_class='PREMIUM';
																					//$txt_class_color='#d72626';
																					$txt_class_color='#333333';
																					break;
																				case 2: //Deluxe
																					$txt_class='DELUXE';
																					$txt_class_color='#333333';
																					//$txt_class_color='#22ac22';
																					break;
																				case 3: //standard
																					$txt_class='STANDARD';
																					$txt_class_color='#333333';
																					break;
																		}																		
																	?>																	
																	<span style="color:<?=$txt_class_color?>;font-weight:normal;margin-left:15px;"><?=$txt_class;?> <?php /*=$d['classification'];*/?></span>
												  </h4>
												  </a>
												  <h4>
												  <?php 
												  
												  $total_nights=$night_qty;
												  $avg_night=$total_amount/$total_nights;
												  $precio_anteriorVPN=number_format($precio_anteriorVPN,0);
												  $avg_night=number_format($avg_night,0);
												 if($precio_anteriorVPN!=$avg_night){
													// $precio_anterior_sin_tax=($precio_anteriorVPN/1.18);
												 ?>
													<span style="color:#333;"><strike>$<?=number_format($precio_anteriorVPN)?></strike> </span>
												 <?php } 
												 //$avg_night_sin_tax=($avg_night/1.18);
												 ?>
												 
													<span style="color:#333;">$<?=number_format($avg_night)?></span> <small>avg/night</small> - 
												<?php if($precio_anteriorVPN!=$avg_night){	
												 $monto_descontado=$precio_total_anterior-$total_amount;
												 $precio_total_anterior_sin_tax=($precio_total_anterior/1.18);
												?>
													<span style="color:#333;"><strike>$<?=number_format($precio_total_anterior_sin_tax)?></strike> </span>
												<?php } 
													//$total_amount_sin_tax=($total_amount/1.18);
												?>	
													<span style="color:#333;">$<?=number_format($total_amount)?> </span><small>Total (+ 18% tax)</small>
												  </h4>
												  
												 
												  <?=readmore_villas($d['head'],$d['id']);?>
												  <!--<a href="#"><span class="fa fa-search icon pull-right"> More</span></a>--> 
												</div>
												
												<div class="pull-right" style="margin-right:10%">
												  <div class="row">
													<div class="col-xs-6 col-sm-4"> 
													
													</div>
													<div class="col-xs-6 col-sm-4">
													</div>
													<div class="col-xs-6 col-sm-4">
													  <form class="form-inline" name="bookform" id="bookform2" method="post" action="client-details.php">
														<input type="hidden" name="amount_discounted" value="<?=$monto_descontado?>"/>
														<input type="hidden" name="id_promocion" value="<?=$pro[0]['id']?>"/>
														
														
														<input type="hidden" name="desde" value="<?=$fecha_de_inicio?>"/>
														<input type="hidden" name="hasta" value="<?=$fecha_de_termino?>"/>
														<input type="hidden" name="T_nights" value="<?=$night_qty?>"/>
														<input type="hidden" name="LS_nights" value="<?=$LS_nights?>"/>
														<input type="hidden" name="HS_nights" value="<?=$HS_nights?>"/>
														<input type="hidden" name="LS_price" value="<?=$d['p_low']?>"/>
														<input type="hidden" name="HS_price" value="<?=$d['p_high']?>"/>
														<input type="hidden" name="itbis" value="<?=$itbis?>"/>
														<input type="hidden" name="g_total" value="<?=$total_amount?>"/>
														<input type="hidden" name="v" value="<?=$d['id']?>"/>
														<input type="hidden" name="adults" value="<?=$_POST['adults']?>"/>
														<input type="hidden" name="kids" value="<?=$_POST['kids']?>"/>
														<button type="submit" name="continue" class="btn btn-primary pull-left">Book Now</button>
													  </form>
													</div>
												  </div>
												</div>
												<!--</div>--> 
											  </div>
											</div>
										  </div>
										</div>
									  </div>
									</div>
									<!--RESPONSIVE VILLAS DETAILS END--> 

<?
							}							
							shuffle($villas_nodisponibles);//mostrar de forma aleatoria el resultado.
						  $contador=0;
							
				     }else{
						if(trim($_POST['uniqueVilla'])!=''){
							 $villas_for_rent=$db->singleVilla4rent($id=$_POST['uniqueVilla']); //villas for rent with this bedrooms qty.
							 $d=$villas_for_rent[0];
							                                  $d['p_low']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)),  $d['p_low']);
                                 $d['p_high']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)), $d['p_high']);
                                  //-----------------------apply weekly and monthly rate-------------------------------------------------------------
						             $nights_qty=daysDifference2(date('Y-m-d',strtotime($fecha_de_termino)), date('Y-m-d',strtotime($fecha_de_inicio)));
						             $night_Price_LS=$d['p_low'];   $night_Price_HS=$d['p_high'];
									 
										$precio_anteriorLS=	$d['p_low'];
										$precio_anteriorHS=	$d['p_high'];
										$amount_before_total_per_nights=(($precio_anteriorLS*$LS_nights)+($precio_anteriorHS*$HS_nights));
										$amount_before_taxes=$amount_before_total_per_nights*TAX_DECIMAL;
										$precio_total_anterior=($amount_before_taxes+$amount_before_total_per_nights);
										$precio_anteriorVPN=($amount_before_taxes+$amount_before_total_per_nights)/($LS_nights+$HS_nights);
										$precio_anteriorVPN=number_format($precio_anteriorVPN,2);
									 
						             $d['p_low']=price_rent_online($nights_qty, $normal_price=$d['p_low'],$d['bed']);
						             $d['p_high']=price_rent_online($nights_qty, $normal_price=$d['p_high'],$d['bed']);
						           //----------------------end apply weekly and monthly rate----------------------------------------------------
					                $total_LS=$LS_nights*$d['p_low'];
					                $total_HS=$HS_nights*$d['p_high'];
					                $amount_per_nights=($total_LS+$total_HS);
					                $itbis=($amount_per_nights*TAX_DECIMAL);
					                $total_amount=($amount_per_nights+$itbis);  
				           ?>
							<!--RESPONSIVE VILLAS DETAILS START-->
							<div class="container">
							  <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
								  <div class="panel panel-primary rcorners2">
									<div class="row padall">
									  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> <span></span> <a   class="thumbnails"  href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_blank" ><img class="img-responsive img-thumbnail" src="../booking/<?=$d['pic']?>" /></a> </div>
									  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
										<div class="clearfix">
										  <!--<div class="pull-left"> <span class="fa fa-dollar icon">
											<?=number_format($total_amount)?>
											</span> Total -
											<?if ($LS_nights>0){?>
											<?=$LS_nights?>
											nights at $
											<?=number_format($d['p_low'],2);?>
											<?}?>
											<?if ($HS_nights>0){?>
											<?=$HS_nights?>
											nights at $
											<?=number_format($d['p_high'],2);?>
											<?}?>
											+
											<?=TAX_PERCENT?>
											TAX </div>-->
										  <div class="pull-right">
											<?=number_format($d['ft2'])?>
											SqFt |
											<?=$d['bed']?>
											Bedrooms |
											<?=$d['bath']?>
											Bathroom </div>
										</div>
										<div>
										<a href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_blank" alt="">
										  <h4><!--<span class="fa fa-map-marker icon"></span>--> Villa
													<?=$d['no']?> <?php
																$txt_class='';//empty when return
																		switch($d['classification']){
																				case 1: //Premium
																					$txt_class='PREMIUM';
																					$txt_class_color='#333333';
																					//$txt_class_color='#d72626';
																					break;
																				case 2: //Deluxe
																					$txt_class='DELUXE';
																					$txt_class_color='#333333';
																					//$txt_class_color='#22ac22';
																					break;
																				case 3: //standart
																					$txt_class='STANDARD';
																					$txt_class_color='#333333';
																					break;
																		}																		
																	?>
																	
																	<span style="color:<?=$txt_class_color?>;font-weight:normal;margin-left:15px;"><?=$txt_class;?> </span>
												  </h4>
												 </a>
										<?=readmore_villas($d['head'],$d['id']);?>
										</div>
										<div class="pull-right" style="margin-right:10%">
										  <div class="row">
											<div class="col-xs-6 col-sm-4"> 
											  
											</div>
											<div class="col-xs-6 col-sm-4">
											</div>
											<div class="col-xs-6 col-sm-4">
											  <button type="submit" name="continue" class="btn btn-danger pull-left">Occupied</button>
											</div>
										  </div>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
							<!--RESPONSIVE VILLAS DETAILS END-->
							<?
						}else{
                        shuffle($villas_nodisponibles);//mostrar de forma aleatoria el resultado.
						   $contador=0;
				          foreach ($villas_nodisponibles AS $d){							  
                                 $d['p_low']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)),  $d['p_low']);
                                 $d['p_high']=special_event(date('Y-m-d',strtotime($fecha_de_inicio)), date('Y-m-d',strtotime($fecha_de_termino)), $d['p_high']);
                                  //-----------------------apply weekly and monthly rate-------------------------------------------------------------
						             $nights_qty=daysDifference2(date('Y-m-d',strtotime($fecha_de_termino)), date('Y-m-d',strtotime($fecha_de_inicio)));
						             $night_Price_LS=$d['p_low'];   $night_Price_HS=$d['p_high'];
									 
										$precio_anteriorLS=	$d['p_low'];
										$precio_anteriorHS=	$d['p_high'];
										$amount_before_total_per_nights=(($precio_anteriorLS*$LS_nights)+($precio_anteriorHS*$HS_nights));
										$amount_before_taxes=$amount_before_total_per_nights*TAX_DECIMAL;
										$precio_total_anterior=($amount_before_taxes+$amount_before_total_per_nights);
										$precio_anteriorVPN=($amount_before_taxes+$amount_before_total_per_nights)/($LS_nights+$HS_nights);
										$precio_anteriorVPN=number_format($precio_anteriorVPN,2);
									 
						             $d['p_low']=price_rent_online($nights_qty, $normal_price=$d['p_low'],$d['bed']);
						             $d['p_high']=price_rent_online($nights_qty, $normal_price=$d['p_high'],$d['bed']);
						           //----------------------end apply weekly and monthly rate----------------------------------------------------
					                $total_LS=$LS_nights*$d['p_low'];
					                $total_HS=$HS_nights*$d['p_high'];
					                $amount_per_nights=($total_LS+$total_HS);
					                $itbis=($amount_per_nights*TAX_DECIMAL);
					                $total_amount=($amount_per_nights+$itbis);  
				           ?>
							<!--RESPONSIVE VILLAS DETAILS START-->
							<div class="container">
							  <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
								  <div class="panel panel-primary rcorners2">
									<div class="row padall">
									  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> <span></span> <a   class="thumbnails"  href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_blank" ><img class="img-responsive img-thumbnail" src="../booking/<?=$d['pic']?>" /></a> </div>
									  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
										<div class="clearfix">
										  <!--<div class="pull-left"> <span class="fa fa-dollar icon">
											<?=number_format($total_amount)?>
											</span> Total -
											<?if ($LS_nights>0){?>
											<?=$LS_nights?>
											nights at $
											<?=number_format($d['p_low'],2);?>
											<?}?>
											<?if ($HS_nights>0){?>
											<?=$HS_nights?>
											nights at $
											<?=number_format($d['p_high'],2);?>
											<?}?>
											+
											<?=TAX_PERCENT?>
											TAX </div>-->
										  <div class="pull-right">
											<?=number_format($d['ft2'])?>
											SqFt |
											<?=$d['bed']?>
											Bedrooms |
											<?=$d['bath']?>
											Bathroom </div>
										</div>
										<div>
										<a href="../vacationrentals/villa-details.php?v=<?=$d['id']?>" target="_blank" alt="">
										  <h4><!--<span class="fa fa-map-marker icon"></span>--> Villa
													<?=$d['no']?> <?php
																$txt_class='';//empty when return
																		switch($d['classification']){
																				case 1: //Premium
																					$txt_class='PREMIUM';
																					$txt_class_color='#333333';
																					//$txt_class_color='#d72626';
																					break;
																				case 2: //Deluxe
																					$txt_class='DELUXE';
																					$txt_class_color='#333333';
																					//$txt_class_color='#22ac22';
																					break;
																				case 3: //standart
																					$txt_class='STANDARD';
																					$txt_class_color='#333333';
																					break;
																		}																		
																	?>
																	
																	<span style="color:<?=$txt_class_color?>;font-weight:normal;margin-left:15px;"><?=$txt_class;?> <?php /*=$d['classification'];*/?></span>
												  </h4>
												 </a>
	
										 <?=readmore_villas($d['head'],$d['id']);?>

										</div>
										<div class="pull-right" style="margin-right:10%">
										  <div class="row">
											<div class="col-xs-6 col-sm-4"> 
											  
											</div>
											<div class="col-xs-6 col-sm-4">
											</div>
											<div class="col-xs-6 col-sm-4">
											  <button type="submit" name="continue" class="btn btn-danger pull-left">Occupied</button>
											</div>
										  </div>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
							<!--RESPONSIVE VILLAS DETAILS END-->
							<?}?>
<?
					   }
				     }

              }else{/*mensaje cuando el booking tiene 30 o mas dias*/
                  ?>
<h1 style="color:black; font-size:16px; font-family:Arial, Helvetica, sans-serif; line-height:22px;">To make a booking with
  <?=$price_settings['long_m_night']?>
  nights or longer, please contact our offices.<br/>
  Phone: +1-809-571-1190 - Email: <a  style="color:red" href="mailto:reservations@CasaLindaCity.com">reservations@CasaLindaCity.com</a> </h1>
<?
              }
				//----------------SEARCH THROUGH ALL AVAILABLE AND NOT AVAILABLE VILLAS---------------
			}else{
			echo "<p>&nbsp;</p><h1 style='text-align:center;'><span style='color:#0098da'>Error: Our minimum requirements are at least $minimu_stay nights, please try your search again on the top calendar.</span></h1><p>&nbsp;</p>";
			}
		}else{
		   echo "<p>&nbsp;</p><h1 style='text-align:center;'><span style='color:#0098da'>Error: Please, check starting date and try again.</span></h1>";
		   echo "<h1 style='text-align:center;'><strong>It is impossible start at:<span style='color:green'> ".formatear_fecha($fecha_de_inicio)."</span></strong></h1><p>&nbsp;</p>";
		}
	}else{
	 echo "<p>&nbsp;</p><h1 style='text-align:center;'><span style='color:#0098da'>Error: One or both dates are not valid.</span></h1>";
	} //end if valid dates
	?>
<?
 } /*END IF POST*/ 
 ?>
