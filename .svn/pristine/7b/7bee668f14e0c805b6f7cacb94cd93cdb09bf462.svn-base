<h2>Welcome, <?=$_SESSION['owner']['name']." ".$_SESSION['owner']['lastname']?></h2>
<p style="clear:both;">&nbsp;</p>
<hr style="border:1px solid #f9a80b;" />
<?
	try{
		$db= new getQueries();
		$villas_para_dueno=$db->villas_for_owner($_SESSION['owner']['id']); //pickup all the villas for this owner
	}catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}	

	 if($villas_para_dueno){   //if this owner has any villa
			/*$cantidad_villas=0;
			foreach ($villas_para_dueno AS $vi){
				// echo $vi['no']."<br/>";
			    $cantidad_villas++;   //count villas
			}
			

        $link=new DATA();
        if(!$_GET['v']){
	        $villa_actual_no=$villas_para_dueno[0]['no'];
	        $villa_actual_id=$villas_para_dueno[0]['id'];
	        $info_villa_seleccionada=$villas_para_dueno[0];

        }else{
        	$villa_actual_id=$_GET['v'];
        	$villa_selected=$db->show_id('villas', $villa_actual_id);
        	if ($villa_selected[0]['id_owner']!=$_SESSION['owner']['id']) die('Error:This owner do not own this villa');
             $villa_actual_no=$villa_selected[0]['no'];
             $info_villa_seleccionada=$villa_selected[0];
        }*/
       
          //esta villa no se renta
         ?>
        <!--// <p>&nbsp</p>//-->
         <h3 style="color:#2A6EBB; text-transform:uppercase;">Create a new booking on your villa</h3>
		 <p>&nbsp;</p>
        	<?
			/*=================================START CONTENT========================================================================*/
			
			include('required/date-picker1.php');
		?>		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<form class="form-inline" method="post" action="new_booking.php" >
		  <div class="form-group">
			<label for="datepicker">Check-in</label>
			<input type="text" class="form-control" id="datepicker" name="start" placeholder="Arrival (YYYY-MM-DD)" required>
		  </div>
		  <div class="form-group">
			<label for="exampleInputEmail2">Check-out</label>
			<input type="text" class="form-control" id="datepicker1" name="end" placeholder="Departure (YYYY-MM-DD)" required>
		  </div>
		  <button type="submit" class="btn btn-primary">Search</button>
		</form>
		
		<? if($_POST){
			?>
			<p>&nbsp;</p>
			<h2>Searching from <?=$_POST['start']?> to <?=$_POST['end']?></h2>
			<?
		}?>
		<p>&nbsp;</p>
		<hr style="border:1px solid #f9a80b;" />
		<?
		try{	
			if($_POST){
				$villas_en_renta=$db->villas_for_owner_in_pool($_SESSION['owner']['id']);  //pickup all the villas for this owner in rental pool
				
				if($villas_en_renta){
					
					
					$fecha_de_inicio=$_POST['start'];
						$fecha_de_termino=$_POST['end'];	
						$fecha_checkin=strtotime($_POST['start']);
						$fecha_checkout=strtotime($_POST['end']);
						$night_qty=daysDifference2(date('Y-m-d', $fecha_checkout), date('Y-m-d', $fecha_checkin));	
					//echo $night_qty;
					$valid_dates1=is_date($_POST['start']); //chek if the date is valid
					$valid_dates2=is_date($_POST['end']); //chek if the date is valid
					
					if ($fecha_checkin < time()) {
						// checkin date is minor than today
						die("<h1 style='color:red'>Error: Checkin is minor than today's date</h1>");
					}elseif($fecha_checkout < time()){
						// checkout date is minor than today
						die("<h1 style='color:red'>Error: Checkout is minor than today's date</h1>");
					} 

					if(!$valid_dates1){
						echo "<h1 style='color:red'>Error: checkin date invalid - ".$_POST['start']."</h1>";
						die();
					}
					if(!$valid_dates2){
						echo "<h1 style='color:red'>Error: checkout date invalid - ".$_POST['end']."</h1>";
						die();
					}
					
					if($night_qty<2){
						echo "<h1 style='color:green'>The Minimum stay should be 2 nights</h1>";
						die();
					}
					
					if (strtotime($numerical." ".$day." of ".date("F")) < time()) {
						
					}
					
					if($night_qty>=365){
						echo "<h1 style='color:green'>To make a booking longer than a year, please contact us.</h1>";
						die();
					}
				
				
				
					if(($night_qty>=2)&&($night_qty<=90)){
					
						$reservation_in_dates=$db->seeOccupancyOwnersPortal($starting=$_POST['start'], $ending=$_POST['end'], $idOwner=$_SESSION['owner']['id']);
						
									$villas_ocupadas=array();
									$villas_disponibles=array();
									$villas_nodisponibles=array();
																 
								foreach ($reservation_in_dates as $k){  //TODAS LAS OCUPACIONES QUE EMPIZAN EN ESTE MES
									//empuja en un arreglo el id de la villa ocupada
									$array_villas_ocupada=array('id'=>$k['villa_id'],'no'=>$k['villa_number']);
									if (!in_array($array_villas_ocupada,$villas_ocupadas)){
										array_push($villas_ocupadas,$array_villas_ocupada);
									}
								  $counting++;
								} // end foreach
								  
								  
								foreach ($villas_en_renta AS $v){
									$esta_villa=array('id'=>$v['id'],'no'=>$v['no']);
									if (!in_array($esta_villa,$villas_ocupadas)){
									  array_push($villas_disponibles,$v);
									}else{  //if villa is not available sent details to other array for busy
									 array_push($villas_nodisponibles,$v);
									}
								}
								
						if($villas_disponibles){
							

							foreach ($villas_disponibles AS $d){
								
								/*echo "<pre>Disponibles";
								print_r($v);
								echo "</pre>";*/?>
							<!--RESPONSIVE VILLAS DETAILS START-->
											<!--<div class="container">-->
											  <div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
												  <div class="panel panel-primary rcorners2">
													<div class="row padall">
													  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"> <span></span> <a   class="thumbnails" rel="lightbox[group<?=$d['no']?>]" href="../booking/<?=$d['pic']?>" target="_blank"><img class="img-responsive img-thumbnail" src="../booking/<?=$d['pic']?>" /></a> </div>
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
														  <h4><!--<span class="fa fa-map-marker icon"></span>--> Villa
															<?=$d['no']?> <?php
																		$txt_class='';//empty when return
																				switch($d['classification']){
																				
																						case 1: //Premium
																							$txt_class='PREMIUM';
																							
																							$txt_class_color='#333333';
																							break;
																						case 2: //Deluxe
																							$txt_class='DELUXE';
																							$txt_class_color='#333333';
																							
																							break;
																				}


																	
																			?>																	
																			<span style="color:<?=$txt_class_color?>;font-weight:normal;margin-left:15px;"><?=$txt_class;?> <?php ?></span>
														  </h4>
																																						 
														  <?=$d['head']?>
														  <!--<a href="#"><span class="fa fa-search icon pull-right"> More</span></a>--> 
														</div>
														
														<div class="pull-right">													
															<div class="col-xs-12 col-sm-4">
															  <form class="form-inline" name="bookform" id="bookform2" method="post" action="new_booking1.php">						
																<input type="hidden" name="desde" value="<?=$fecha_de_inicio?>"/>
																<input type="hidden" name="hasta" value="<?=$fecha_de_termino?>"/>
																<input type="hidden" name="T_nights" value="<?=$night_qty?>"/>
																
																<input type="hidden" name="v" value="<?=$d['id']?>"/>
																<input type="hidden" name="vnumber" value="<?=$d['no']?>"/>
																<input type="hidden" name="owner" value="<?=$_SESSION['owner']['id']?>"/>
																<input type="hidden" name="adults" value="1"/>
																<input type="hidden" name="kids" value="0"/>
																<button type="submit" name="continue" class="btn btn-success pull-left">Book Now</button>
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
											<!--</div>--> 
											<!--RESPONSIVE VILLAS DETAILS END--> 
											<?							
							}
							
						}else{
							?>
						  <h3 style="color:green; padding:5px; margin:5px;">Dear Owner, you villa(s) are occupied during the selected period.</h3>
						<?
						}		
						/*echo "<pre>Disponibles";
						print_r($villas_disponibles);
						echo "</pre>";
						
						echo "<pre>Ocupadas";
						print_r($villas_nodisponibles);
						echo "</pre>";*/
						
						
						/*echo "<pre>";
						print_r($reservation_in_dates);
						echo "</pre>";
						
						echo $_SESSION['owner']['id'];
						echo "<br/>";
						echo $_POST['start'];
						echo "<br/>";
						echo $_POST['end'];
						echo "<br/>";
						
						echo "<pre>";
						print_r($villas_en_renta);
						echo "</pre>";*/
					}
				}else{
						?>
					  <h3 style="color:red; background-color:yellow; padding:5px; margin:5px;">Dear Owner, you villa must be in our rental pool in order to create a new booking. Please, contact us for further information</h3>
					<?
				}
					
			}
				
		 /*=================================START CONTENT========================================================================*/			
			
		}catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}		
			?>
		
	<?}else{ ?>
	  <h3 style="color:red; background-color:yellow; padding:5px; margin:5px;">Dear Owner, you appear as if you do not have any villa still in our system,<br/> please, contact us for further information</h3>
	<?}?>