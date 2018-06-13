<?
 if ($_SESSION['info']){
   if ($_POST){
   	 $_SESSION['NO_REFRESH']=1;

	$adults=$_POST['adults'];	$client=$_POST['client'];	$children=$_POST['children'];
	$massage=$_POST['massage'];	$pickup=$_POST['pickup'];  	$VIPpickup=$_POST['VIPpickup'];
	$chef=$_POST['chef'];  	$fridge=$_POST['fridge'];	$villa_no=$_POST['villa_no'];
	$starting=$_POST['starting'];	
	$ending=$_POST['ending'];	
	$nights=$_POST['nights'];
	$villa_id=$_POST['villa_id'];  
	//$starting=$_POST['starting'];
	//$ending=$_POST['ending'];
	$status=$_POST['status']; 
	$comment=$_POST['comment'];
	if(($status==34)||($status==35)||($status==36)||($status==37)){
		$mid_term_booking="1";
	}else{
		$mid_term_booking="0";
	}
	$price=$_POST['price']; $priceHS=$_POST['priceHS'];
	
	//echo $price;
	$LS_nights=$_POST['LS_nights'];$HS_nights=$_POST['HS_nights'];

    if($_POST['exp_id']!=''){$_SESSION['exp_id']=$_POST['exp_id'];}
    if($_POST['exp_amount']!=''){$_SESSION['exp_amount']=$_POST['exp_amount'];}

	/*echo $_SESSION['exp_amount']; echo '<br/>';
	echo $_POST['exp_id'];*/
	?>
	<!--<img src="images/logo.gif" border="0" style="float:left"><br/>  -->
	<?php
	if($mid_term_booking=='1'){ 
	?>
		 <h2 style="text-align:center; color:red;">Mid Term Rental - Step 2</h2>
	<?php
	}else{ 
	?>
	    <h2 style="text-align:center; color:#06C;"><? if($_SESSION['apolo']==3){ ?>Apollo <?}else{?>Short Term Rental - Step 2<?}?></h2>
	<?php 
	} 
	?>
			 <!--//   codigo para promotion code//-->
			<?   $_POST['promotion_code']=trim($_POST['promotion_code']);

   			  if ($_POST['promotion_code']!=""){
   			 	$db= new getQueries;
                $this_pro=$db->show_active_limit1("promotion", "code", $_POST['promotion_code'], "=");
                $pro_found=$this_pro[0];
                if (!$pro_found){
                	$_GET['promotion_error']="Promotion code not found or disabled in our system.";
        	    }else{
                	//entonces hacer procedimientos de calculos con esta promocion
                    //$_GET['promotion_error']="Promotion encontrada id->".$pro_found['id'];
                    //variables
                    $inicia_pro=strtotime($pro_found['desde']);
                    $fin_pro=strtotime($pro_found['hasta']);

                    $today_date=strtotime(date('Y-m-d'));

                    //----------------------------------------------------------------------------------------
                   if ($fin_pro<$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="We sorry this promotion is over now";
                   }
                    if ($inicia_pro>$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="This promotion is coming soon, not active yet.";
                   }
                   //--------limit date to book---------------------------
                  $only_book_from=strtotime($pro_found['bookingfrom']);
                  $only_book_to=strtotime($pro_found['bookingto']);

                  $fecha_inicio_booking=strtotime($starting);
                  $fecha_termina_booking=strtotime($ending);
                   /*echo*/ $APF=$only_book_from;/* echo '<br/>';  echo $pro_found['bookingfrom']; echo '<br/>'; */
                   /*echo*/ $APT=$only_book_to;/* echo '<br/>';  echo $pro_found['bookingto']; echo '<br/>'; */
                   /*echo*/ $A1=$fecha_inicio_booking; /*echo '<br/>'; echo $starting; echo '<br/>';*/
                  /*echo*/  $B1=$fecha_termina_booking; /* echo '<br/>';  echo $ending; echo '<br/>';*/

                 if((($A1>=$APF)&&($A1<=$APT))||(($B1>=$APF)&&($B1<=$APT))){
                   //esta correcto la fecha
                    $fecha_promocion_validad="Yes";
                 }else{
                    //arrojar un error
                    $fecha_promocion_validad="No";
                    $_GET['promotion_error']="This promotion is only valid for bookings from: ".$pro_found['bookingfrom']." to: ".$pro_found['bookingto'];
                 }
                  //------------limit date to book here ------------------


                   if ((($inicia_pro)<=($today_date))&&(($fin_pro)>=($today_date))&&($fecha_promocion_validad=="Yes")){ //esta activa
                    //hacer calculos
                    $amount_nightsLS=($LS_nights*$price);
                    $amount_nightsHS=($HS_nights*$priceHS);
                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

                     if  ($pro_found['tipo']=="2"){   //Amount
                      //vefiricar aqui que el monto no sea mayor que la renta, si es asi no descontar nada
                        if  ($pro_found['cant_porc']>=$amount_nights){   //Amount
                            $_GET['promotion_error']="This promotion is not applicable to this booking.";
                        }else{
                           $descuento=($pro_found['cant_porc']);
                           $variable_descuento="US$ ".$pro_found['cant_porc']." ";
                           $tipo_dsec="monto";
                           $promotion_code=$pro_found['code'];
                        }
                     }elseif($pro_found['tipo']=="1"){ //percent
                        $descuento=($amount_nights*($pro_found['cant_porc']/100));
                         $variable_descuento=number_format($pro_found['cant_porc'],0)." % ";
                         $tipo_dsec="porcient";
                         $promotion_code=$pro_found['code'];
                     }elseif($pro_found['tipo']=="3"){  //days

                      if($nights>=$pro_found['min_days']){
                        if ($LS_nights!=0 &&  $HS_nights==0){//solo low season
                           $descuento=$price*$pro_found['qty_days'];
                        }

                        if (($LS_nights==0)&&($HS_nights!=0)){//solo High season
                           $descuento=$priceHS*$pro_found['qty_days'];
                        }

                        if ($LS_nights!=0 &&  $HS_nights!=0){//ambas season
                          if($LS_nights>=$pro_found['qty_days']){
                         	$descuento=$price*$pro_found['qty_days'];
                          }else{
                          	$descuento=$price*$LS_nights;
                          	$descuento+=$priceHS*($pro_found['qty_days']-$LS_nights);
                          }
                        }

                         $variable_descuento=$pro_found['qty_days']." Nights ";
                         $tipo_dsec="days";
                         $promotion_code=$pro_found['code'];
                      }else{
                       $_GET['promotion_error']="This promotion requires minimun ".$pro_found['min_days']." nights";
                      }
                     }
                    $pro_id=$pro_found['id'];
                   }
                }
   			  }

			  /* END	NEW PROMOTION TIPE */
			  //echo $ending;
			  if($_POST['applypro']==2){
				$promocion=auto_promotion($starting, $ending, $priceHPT='100');
				if($promocion){
					$promotion_apply=$promocion['title'];//title
					$promotion_ends="Hurry! Offer ends in ".date('M j Y',strtotime($promocion['fin']));
					$promotion_sale=$promocion['msg'];
					$discount_percent=$promocion['qty_perc'];
					$_POST['promotion_code']=$promocion['code'];
					$pro_id=$promocion['id'];
				}
			  }
			//print_r($promocion);
			//echo "Hola";
		/* END	NEW PROMOTION TIPE */
		
			if ($_GET['promotion_error']){?>
			 	<div style="text-align:center; color:#080563; background-color:yellow;">Warning: <?=$_GET['promotion_error'];?></div>
			 <?}
			 
			 if ($promotion_apply){?>
			 	<div style="text-align:center; "><h3>Promotion: <u><?=$promotion_apply;?></u></h3></div>
			 <?}?>
			<!--//   codigo para promotion code//-->
	 	     <hr />
	      <form method="post" action="short-term-book3.php" name="st">

<div style="float:left; width:450px; border:0px solid red; padding:0px 0px 0px 20px;">   <!--START DIV DETAILS-->
	<!--EMPIEZO A MOSTRAR RESUMEN DE LAS INFORMACIONES SELECCIONADAS PARA LA RESERVA-->
	<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
		<tr>
			<td colspan="2" bgcolor="#3794ea" align="center">
				<span style="color:white;">BOOKING INFORMATION</span>
			</td>
		</tr>
		<tr>
			<td id="td" colspan="2" style="color:blue;" align="right">
				Villa No.<strong><?=$villa_no?></strong><br />
				Reservation from: <strong><?=formatear_fecha($starting);?></strong>
				<br/> To: <strong><?=formatear_fecha($ending);?></strong>
			</td>
		</tr>
	    <tr>
	    <? if (($HS_nights>0)&&($LS_nights>0)){ ?>
	    	<td id="td" style="text-align:right;">
	    		<?=$LS_nights?> Nights x LS US$ <?=$price;?> =<br />
	    		<?=$HS_nights?> Nights x HS US$ <?=$priceHS;?> =
	    	</td>
	    	<td id="td" width="90" style="text-align:right;">
	    		<? $amount_nightsLS=($LS_nights*$price); echo "US$ ".number_format($amount_nightsLS,2); ?><br />
	    		<? $amount_nightsHS=($HS_nights*$priceHS); echo "US$ ".number_format($amount_nightsHS,2); ?>
	    	 </td>
	    <? }?>

	    <? if (($HS_nights>0)&&($LS_nights==0)){ ?>
	    	<td id="td" style="text-align:right;">
	    		<?=$nights?> Nights x HS US$ <?=$priceHS;?> =
	    	</td>
	    	<td id="td" width="90" style="text-align:right;">
	    		<? $amount_nightsHS=($nights*$priceHS); echo "US$ ".number_format($amount_nightsHS,2); ?>
	    	 </td>
	    <? }?>

	    <? if (($HS_nights==0)&&($LS_nights>0)){ ?>
	    	<td id="td" style="text-align:right;">
	    		<?=$nights?> Nights x LS US$ <?=$price;?> =
	    	</td>
	    	<td id="td" width="90" style="text-align:right;">
	    		<? $amount_nightsLS=($nights*$price); echo "US$ ".number_format($amount_nightsLS,2); ?>
	    	 </td>
	    <? }
	     $amount_nights=$amount_nightsLS+$amount_nightsHS;
		 $amount_discounted=($amount_nights+$amount_nights*0.18)*($discount_percent/100);
		 $amount_discounted_no_tax=$amount_nights*($discount_percent/100);
		 //echo $amount_discounted; echo 'descuento';
	    ?>
	    </tr>
		
		
	     <!--//codigo promotion//-->
	    <? if (($descuento>0)&&($tipo_dsec=="monto")){?>
	       <input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
	    <tr>
	    	<td id="td" style="text-align:right; color:green;">
	    	(<?=$promotion_code?>)	Discount =
	    	</td>
	    	<td id="td" style="text-align:right; color:green;">
	    		<? echo "US$ ".number_format($descuento,2); ?>
	    	</td>
	    </tr>
	    <?}?>
	    <? if (($descuento>0)&&($tipo_dsec=="porcient")){?>
	    	<input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
	    <tr>
	    	<td id="td" style="text-align:right; color:green;">
	    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=number_format($amount_nights,2);?> =
	    	</td>
	    	<td id="td" style="text-align:right; color:green;">
	    		<? echo "US$ ".number_format($descuento,2); ?>
	    	</td>
	    </tr>
	    <?}?>
	    <? if (($descuento>0)&&($tipo_dsec=="days")){?>
	    	<input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
	    <tr>
	    	<td id="td" style="text-align:right; color:green;">
	    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=$nights?> nights =
	    	</td>
	    	<td id="td" style="text-align:right; color:green;">
	    		<? echo "US$ ".number_format($descuento,2); ?>
	    	</td>
	    </tr>
	    <?}?>



	    <!--NUEVO CODIGO PARA LOS SERVICIOS-->
          <?
		  
		  if($amount_discounted>0){
			  //$descuento=$amount_discounted_no_tax;
		  }
          if($_POST['car']){
           $_SESSION['cars']=$_POST['car'];
		   $_SESSION['cars_qty']=$_POST['car_qty'];
		   $_SESSION['car_price']=$_POST['car_price'];

		   foreach($_POST['car'] AS $k){
		   	$_SESSION['car_price'][$k]=priceRentalCar($idCar=$k, $start_date=$starting, $qtyDays=$_SESSION['cars_qty'][$k]);
		   }
		  }
          ?>
         <?
         	$sub_services=0;
         	$total_service=0;
        foreach($_POST['servicios_id'] AS $k){
          	if($k>0){
          		$data= new getQueries;
          		$this_service=$data->show_id('serv_add', $k);
                $serv=$this_service[0];

                if($serv['type']=='Car_Rental'){/*si es rental car*/
                 $cars_qty++;
                /*if ($_POST['qty'][$serv['type'].$cars_qty]<5){ $precio_servicio=$serv['price'];}else{$precio_servicio=$serv['price_min'];} */
                $precio_servicio=price_vehicle($id=$serv['id'], $start_date=$starting, $days=$_POST['qty'][$serv['type'].$cars_qty]);
                $amount_cars+=$precio_servicio*$_POST['qty'][$serv['type'].$cars_qty];  /*need it to calculate the taxes for this services*/
                }else{
                	$precio_servicio=$serv['price'];
                }

               if($serv['type']=='Personal_Driver'){
                //si es driver personal necesita cantidad tambien
               }

            	if($serv['type']!='Car_Rental'){/*si no es rental car*/
	               if($_POST['qty'][$serv['type']]>0){
	                 $total_service=$precio_servicio*$_POST['qty'][$serv['type']];
	               }else{
	                 $total_service=$precio_servicio;
	               }
              	}

                if($_POST['qty'][$serv['type'].$cars_qty]>0){
                 $total_service=$precio_servicio*$_POST['qty'][$serv['type'].$cars_qty];
               }/*else{
                 $total_service+=$precio_servicio;
               }*/

               if($serv['type']=='Dish Washing Service'){

                $total_service=$precio_servicio*($nights+1);
               }

          	?>
               <tr><td id="td" style="text-align:right; color:#00F;">
                 <?=$serv['type']?> <?=substr($serv['name'],0,15);?> <? if(($_POST['qty'][$serv['type']]>0)||($_POST['qty'][$serv['type'].$cars_qty])){  ?>(<?=$_POST['qty'][$serv['type']]?> <?=$_POST['qty'][$serv['type'].$cars_qty]?> days at <?=$precio_servicio?>) <?}?>=
               </td>
               <td id="td" style="text-align:right; color:#00F;">
                US$ <?=number_format($total_service,2);?>

                <input type="hidden" name="ids_services[]" value="<?=$serv['id']?>"/>
                <? if ($_POST['qty'][$serv['type']]){$cantidad_servicio=$_POST['qty'][$serv['type']]; }else{$cantidad_servicio=$_POST['qty'][$serv['type'].$cars_qty]; }?>
                <input type="hidden" name="qty_services[<?=$k?>]" value="<?=$cantidad_servicio;?>"/>
                <input type="hidden" name="amount_services[<?=$k?>]" value="<?=$total_service?>"/>

				<input type="hidden" name="tax_services[<?=$k?>]" value="0"/>
				<input type="hidden" name="desc_services[<?=$k?>]" value="<?=$serv['type']?> <?=substr($serv['name'],0,15);?>"/>
				<input type="hidden" name="unit_services[<?=$k?>]" value="<?=$precio_servicio?>"/>
				<input type="hidden" name="tipo_services[<?=$k?>]" value="1"/>
               </td>
               </tr>
          		<?
          		$sub_services+=$total_service;
          	}
        }
		  
		if($_POST['servicesLR']){
			foreach($_POST['servicesLR'] AS $k){
				if($k>0){
					/*$data= new getQueries;
					$this_service=$data->show_id('services', $k);
					$serv=$this_service[0];*/
					//print_r($serv);
				?>
				<tr>
				   <td id="td" style="text-align:right; color:#00F;">
					 <?=substr($_POST['servicesLR_desc'][$k],0,15);?> 			 
						 (<?=$_POST['servicesLR_qty'][$k]?> at <? echo $_POST['servicesLR_price'][$k];
							if($_POST['servicesLR_tax'][$k]>0){
								echo " + Tax";
							}
						 $total_service=$_POST['servicesLR_qty'][$k]*$_POST['servicesLR_price'][$k]*(1+$_POST['servicesLR_tax'][$k]);
						 ?>) 
					=
				   </td>
				   <td id="td" style="text-align:right; color:#00F;">
					US$ <?=number_format($total_service,2);?>
					
					<input type="hidden" name="ids_services[]" value="<?=$k?>"/>
					<input type="hidden" name="qty_services[<?=$k?>]" value="<?=$_POST['servicesLR_qty'][$k];?>"/>
					<input type="hidden" name="amount_services[<?=$k?>]" value="<?=$total_service?>"/>
					<input type="hidden" name="tax_services[<?=$k?>]" value="<?=$_POST['servicesLR_tax'][$k]?>"/>
					<input type="hidden" name="desc_services[<?=$k?>]" value="<?=$_POST['servicesLR_desc'][$k]?>"/>
					<input type="hidden" name="unit_services[<?=$k?>]" value="<?=$_POST['servicesLR_price'][$k]?>"/>
					<input type="hidden" name="tipo_services[<?=$k?>]" value="2"/>
				   </td>
				</tr>
					<?
					$sub_services+=$total_service;
				}
			}
	    }

          if($sub_services>0){
            ?>
               <tr><td id="td" style="text-align:right; color:#00F; font-weight:bold;">
                Total per services=
               </td>
               <td id="td" style="text-align:right; color:#00F; font-weight:bold;">
                US$ <?=number_format($sub_services,2)?>
               </td>
               </tr>
          		<?
          }
         ?>

	    <!--TERMINA NUEVO CODIGO PARA LOS SERVICIOS-->
			   <tr>
			   		<td id="td" style="text-align:right;">
			   			<strong>Sub total =</strong>
			   		</td>
			   		<td id="td" style="text-align:right;">
			   			<? $sub_total=(($amount_nights-$descuento)+$sub_services); echo "<strong>US$ ".number_format($sub_total,2)."</strong>";?>
			   		</td>
			   	</tr>
				<? if($_SESSION['apolo']==3){ 
					$itbis=0;
				}else{?>
			   	<tr>
			    <td id="td" style="text-align:right;">
			    	VAT - TAX <?=TAX_PERCENT?> of <?=number_format($amount_nights-$descuento+$amount_cars,2);?> =
			    </td>
			    <td id="td" style="text-align:right;">
			    		<? $itbis=(($amount_nights-$descuento+$amount_cars)*TAX_DECIMAL); echo "US$ ".number_format($itbis,2); ?>
			    	</td>
			    </tr>
				<?}?>
				
				<!--//NEW PROMOTION STARTS HERE//-->
				 <? if ($amount_discounted>0){?>
				   <input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
					<input type="hidden" name="amount_discounted" value="<?=$amount_discounted?>"/>
				<tr>
					<td id="td" style="text-align:right; color:green;">
					(<?=$_POST['promotion_code']?>)	Discount =
					</td>
					<td id="td" style="text-align:right; color:green;">
						<? echo "US$ ".number_format($amount_discounted,2); ?>
					</td>
				</tr>
				<?}?>
				<!--//NEW PROMOTION END HERE//-->
				
				
	            <!--SERVICES ADDITIONALS-->
	            <tr><td id="td" style="text-align:right;"><strong>TOTAL <?  if($_POST['car']){?>WITHOUT CARS<?}?> = </strong></td><td id="td" style="text-align:right;"><? $general_amount=$sub_total+$itbis; echo "<strong>US$ ".number_format($general_amount-$amount_discounted,2)."</strong>"; ?></td></tr></table>
				<?php
				if($mid_term_booking=='1'){ 
				?>
				<p><span style="color:red;font-weight:bold;">NOTE: Electricity is charged separate as per consumption.</span></p>
				<?php 
				}
				?>


     </div>   <!--END FIRST DIV DETAILS-->

<div style="float:left; width:450px; border-bottom:0px solid blue;">   <!--START SECOND DIV DETAILS-->


	           <table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;"><tr><td colspan="4" bgcolor="#3794ea" align="center"><span style="color:white;">MORE BOOKING DETAILS</span></td></tr>

				<tr><td  id="td"><strong>Adults:</strong></td><td id="td"><span style="color:#3b3838;"> <?=$adults?>  Person(s)</span> </td><td id="td"><strong>Chidren:</strong></td><td id="td"><span style="color:#3b3838">  <?=$children?> kid(s)</span></td></tr>
	            <? $db=new getQueries; $client_details=$db->customer($client);?>
	   			  <tr><td id="td"> <strong>Customer:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['name']." ".$client_details['lastname'];?></span></td><td id="td"> <strong>Email:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['email'];?></span></td></tr>
	              <? if ($client_details['phone']!=''){?>
	               <tr><td id="td"><!--<br />--><strong> Phone:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"> <?=$client_details['phone'];?></span></td></tr>
	               <? }?>
	               <? if ($client_details['address']!=''){?>
	                <tr><td id="td"><!--<br />--><strong>Address:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"><?=$client_details['address'].", ".$client_details['country'];?></span></td></tr>
	               <? }?>

				  <? if($client_details['id_commission']>0){
				  	  $_POST['referal']=$client_details['id_commission'];
				  }?>

	              <? if ($_POST['referal']>0){
					  $r=new getQueries; $intermediario=$r->intermediario($_POST['referal']);
					  ?>
					  <tr><td id="td"><!--<br />--><strong>Refered&nbsp;by:</strong></td><td colspan="3" id="td"> <span style="color:#3b3838;"><? echo $intermediario['name']." ".$intermediario['lastname']; echo "-".($intermediario['percent']*100)."%"?> </span></td></tr>
	                  <?/* $total_comision=$amount_nights*$intermediario['percent'];*/ ?>
	                	<input type="hidden" name="id_referal" value="<?=$_POST['referal'];?>"/>
	              <? } ?>

	               <? if ($comment!=''){?>
	           <tr><td id="td" colspan="4"> <strong>Reservation Comment:</strong><br /><span style="color:#3b3838;"> <?=wordwrap($comment, 75, "\n", true);?> </span><?}?></td></tr>
	            <tr><td id="td" style="text-align:right"> <strong>Status: </strong></td><td id="td" nowrap="nowrap"><? //=$status
				switch ($status){
					case 1: echo "<span style='color:green;'>Checking in</span>";
						break;
					case 2: echo "<span style='color:#00F;'>Confirmed</span>";
					        /*echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=000.00>";*/
						break;
					case 3: echo "<span style='color:#FF0000;'>Not confirmed</span>";
							//echo " - <span style='color:green;'>Deposit</span> <input type=text name=deposit size=5 value=000.00>";
						break;
					case 4: echo "<span style='color:#FF0000;'>Check out</span>";
							break;
					
					case 34: echo "<span style='color:green;'>Mid term - checked in</span>";
						break;
					case 35: echo "<span style='color:#00F;'>Mid term - No confirmed</span>";
					        /*echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=000.00>";*/
						break;
					case 36: echo "<span style='color:#FF0000;'>Mid term - Confirmed</span>";
							//echo " - <span style='color:green;'>Deposit</span> <input type=text name=deposit size=5 value=000.00>";
						break;
					case 37: echo "<span style='color:#FF0000;'>Mid term - Check out</span>";
							break;
				}
				?> </td><td id="td" style="text-align:right"><strong>Made by: </strong></td><td id="td"><span style="color:#3b3838;"><?=$_SESSION['info']['name']?></span></td></tr></table>
	 </div><!--END SECOND DIV DETAILS-->
     <?/* if ($status==4 || $status==14){ tripadvisor_question(); } */?>
<div style="clear:both; width:100%; border-bottom:0px solid black;">   <!--START THIRD DIV DETAILS-->
     <fieldset><legend>Adults Names</legend>
	  <? for ($i=1; $i<=$adults;$i++){
	       // if ($adults==1){
	       if ($i==1){
	          $custom=new getQueries; $client_name=$custom->customer($client); //$cm=$client_name['name']." ".$client_name['lastname'];
	        	?>
	        <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$client_name['name']?>" /> Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$client_name['lastname'];?>" /></p>
	      <? }else{  ?>
	       <p style="text-align:center;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
	       <?=$i;?> Name: <input type="text" size="25" name="a_name<?=$i;?>" value="" /> Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="" /></p>
	     <?  }
	   } ?>
	      </fieldset><br>

	      <? if($children>0){?>
	           <fieldset><legend>Children Names</legend>
	          <?for ($i=1; $i<=$children;$i++){?>
	           <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="25" name="c_name<?=$i;?>" value="" /> Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" value="" /></p>
	          <? }  ?>
	        </fieldset>
	      <? }?>

</div>   <!--END THIRD DIV DETAILS-->

      <? /*======================================================================================================================================================*/
      if($_SESSION['cars']){

      	?>
           <h1 style="text-align:right; text-transform:uppercase; font-size:16px; color:blue; margin-right:136px;">Car rental To be pay upon arrival</h1>
       <?
       $amount_cars_rented=0;  $db= new getQueries;
         foreach($_SESSION['cars'] AS $k){
         	/*$_SESSION['car_price'][$k]=priceRentalCar($idCar=$k, $start_date=$_SESSION['desde'], $qtyDays=$_SESSION['cars_qty'][$k]);*//*get pricing with qty of days in rental cars*/
         	$totalThisCar=$_SESSION['cars_qty'][$k]*$_SESSION['car_price'][$k];
         	$amount_cars_rented+=$totalThisCar;
         	 $this_car=$db->show_any_data_limit1("carros", "id", $k, "=");
         	?>

         	<p style=" padding:0px; margin:0px; text-align:right; margin-right:136px;"><?=$this_car[0]['name'];?> <?=$_SESSION['cars_qty'][$k];?> x <?=$_SESSION['car_price'][$k];?> =<?=number_format($totalThisCar,2);?> </p>
        <?
         }
         $cars_taxes=$amount_cars_rented*0.18;
         ?>
          <p style="font-weight:bold; padding:0px; margin:0px;text-align:right; margin-right:136px;">Taxes = USD <?=number_format($cars_taxes,2)?></p>
         <p style="font-weight:bold; padding:0px; margin:0px;text-align:right; margin-right:136px;">Total for Cars Rental = USD <?=number_format($amount_cars_rented+$cars_taxes,2)?></p>
         <?
      }
       /*==========================================================================================================================================*/
    ?>
    <hr />
	<!--campos que envian datos a la seccion final-->
	<input type="hidden" name="id_villa" value="<?=$villa_id;?>" />
	<input type="hidden" name="id_customer" value="<?=$client;?>" />
	<input type="hidden" name="id_adm" value="<?=$_SESSION['info']['id'];?>" />
	<input type="hidden" name="starting_date" value="<?=$starting;?>" />
	<input type="hidden" name="ending_date" value="<?=$ending;?>" />
	<input type="hidden" name="qty_nights" value="<?=$nights;?>" />
	<input type="hidden" name="price_per_night" value="<?=$price;?>" />
	<input type="hidden" name="amount_per_nights" value="<?=$amount_nights;?>" />
	<input type="hidden" name="ITBIS" value="<?=$itbis;?>" />
	<input type="hidden" name="sub_total_rent" value="<?=$sub_total;?>" />
	<input type="hidden" name="general_amount" value="<?=$general_amount;?>" />
	<input type="hidden" name="priceHS" value="<?=$priceHS;?>" />
	<input type="hidden" name="LS_nights" value="<?=$LS_nights;?>" />
	<input type="hidden" name="HS_nights" value="<?=$HS_nights;?>" />

	<? if ($children>0){?>
	<input type="hidden" name="children_qty" value="<?=$children;?>" />
	<?}?>
	<input type="hidden" name="adults_qty" value="<?=$adults;?>" />
	<? if ($client_details['id_commission']>0){?>
	<input type="hidden" name="interm_id" value="<?=$client_details['id_commission'];?>" />
	<?}?>

	<input type="hidden" name="reserve_comment" value="<?=$comment;?>" />

	<input type="hidden" name="status" value="<?=$status;?>" />

	<!--campos que envian datos a la seccion final-->
	<?
	if($_SESSION['apolo']==3){?>
	    <INPUT class="book_but" TYPE="button" onClick="location.href='short-term-book.php?villa=<?=$villa_id?>&v2=<?=$villa_id?>&start=<?=$starting?>&end=<?=$ending?>&destine=apolo'"  VALUE="Back" title="Hit to go back" />
	<?}else{?>
		 <INPUT class="book_but" TYPE="button" onClick="location.href='short-term-book.php?villa=<?=$villa_id?>&v2=<?=$villa_id?>&start=<?=$starting?>&end=<?=$ending?>&destine=regular'"  VALUE="Back" title="Hit to go back" />
<?	}	?>
		
	    <input class="book_but" type="submit" name="confirm" value="Done"  title="Save Reservation" onclick="return muestraConfirm('<?=$general_amount?>', document.st.deposit.value);"/>
	    <span style="font-size:10px; color: #06F; font-family:Arial, Helvetica, sans-serif;"><span style="color:red"><strong>WARNING!:</strong></span> Make sure that all information is correct before confirming reservation</span>
	     <!-- <input class="submit" onmouseover="this.className='submitover'" onmouseout="this.className='submit'" type="submit" name="confirm" value="Done"  title="Save Reservation" />-->
	      </form>

	<?
   }else{ echo "<h2>Error with data, try again.</h2>";}
 }else{
	 header('Location:login.php');
	 die();
 }
?>