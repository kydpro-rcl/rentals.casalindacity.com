<?
$_SESSION['NO_REFRESH']=1;
$db=new getQueries;
$villa_id=$_POST['villa']; $f_date=$_POST['from']; $t_date=$_POST['to'];
$client=$_POST['client']; $adults=$_POST['adults']; $children=$_POST['children'];
$comment=$_POST['comment'];

$massage=$_POST['massage']; $pickup=$_POST['pickup'];$VIPpickup=$_POST['VIPpickup']; $chef=$_POST['chef']; $fridge=$_POST['fridge'];/*//varibles para servicios*/
$busyid=$_POST['busyid'];   $reference=$_POST['ref'];

/*//----------------------------------------*/
	$vehiculos_ant=$db->show_any_data('vehicle', 'ref_book', $reference, '=');
	$reserveid=$_POST['reserveid'];

	$booked=$db->see_occupancy_id($_POST['busyid']);

	 $gente_reserva=$db->people($reserveid);
	 $servicios_reserva=$db->services_reserved($reserveid);
	 $villa_reserva=$db->villa($villa_id);
	/*# $price=$villa_reserva[0]['p_low'];*/
	 $status=$_POST['status'];

	 $gentes_adultos=array();
	 $gentes_kids=array();

	 foreach ($gente_reserva as $g){
	 	if ($g['type']==1) array_push($gentes_adultos,$g['name'], $g['lastname'], $g['passport'] );
        if ($g['type']==2) array_push($gentes_kids, $g['name'],$g['lastname'], $g['passport'] );
	 }

/*#$priceHS=$villa_reserva[0]['p_high'];

###################################################################################*/
$price=$_POST['price'];
$priceHS=$_POST['priceHS'];
$HS_nights=$_POST['HS_nights'];/*// echo $HS_nights."<br>";*/
$LS_nights=$_POST['LS_nights'];/* //echo $LS_nights."<br>";*/
$nights=($HS_nights+$LS_nights);
/*##################################################################################*/
?>

<?
   /*// echo $nights." Nocches ";  echo $priceHS." PHS ";  echo $price." p ";*/
if (($nights>0)&&(($priceHS+$price)>0)){?>
<!--<img src="images/logo.gif" border="0" style="float:left"><br/>  -->
		<p>&nbsp;</p>
		<?
		/*//=============================EXCURSIONS========================================================*/

 		 unset($_SESSION['EX']);/*//QUITAR LAS SESSIONES*/
                 $primera_vez=1;
            foreach($_SESSION['excursiones'] AS $k){

                  if (($_POST['adults_excrusions'][$k['id']]>0)||($_POST['kids_excrusions'][$k['id']]>0)){
                   /*//  echo $k['id']; echo '<br/>';*/
                   if ($primera_vez==1) { $_SESSION['EX']['id_selected']=array();}

                    array_push($_SESSION['EX']['id_selected'],$k['id']);/*//empujar los valores de los id en el array de id seleccionados*/
                    $_SESSION['EX'][$k['id']]['adults']=$_POST['adults_excrusions'][$k['id']];/*//cantidad de adultos*/
                    $_SESSION['EX'][$k['id']]['kids']=$_POST['kids_excrusions'][$k['id']]; /*//cantidad de niños*/
                    $_SESSION['EX'][$k['id']]['price_a']=$k['price_a'];
                    $_SESSION['EX'][$k['id']]['price_c']=$k['price_c'];
                    $_SESSION['EX'][$k['id']]['title']=$k['title'];
                    $primera_vez=2;/*//cambiar el valor de primera vez para que no se haga la variables del array de id seleccionados otra vez*/
                  }
            }

         /*//==============================================================================================*/
		 $estado=$status;
 		   ?>
	    <h2 >Editing booking <span style="color:black;">No.<?=$reference?></span> -<?  if (($estado==34)||($estado==35)||($estado==36)||($estado==37)){?>
			Mid Term Rental
		<? }else{ ?>  Short Rental  <? }  if (($estado==6)||($estado==12)||($estado==13)||($estado==14)) echo ", <span style=\"color:red\">VIP</span>";?> - step 3</h2>

			 <!--//   codigo para promotion code//-->
			<?  
/*echo $_POST['promotion_code'];*/
			$_POST['promotion_code']=trim($_POST['promotion_code']);
   			  if ($_POST['promotion_code']!=""){
   			 	$db= new getQueries;
   			 	$this_disc=$db->show_any_data_limit1("discount", "reference", $reference, "=");				
				if(!$this_disc){
					$this_disc=$db->show_any_data_limit1("discount_mod", "reference", $reference, "=");
					if($this_disc){
						$this_disc[0]['new']=1;
					}
				}					
   			  }			  
			if($this_disc[0]['new']==1){
		       $prom_apply=$db->show_any_data_limit1("promotion", "id", $this_disc[0]['pro_id'], "=");
			}
			if($_POST['promotion_id']!=''){
		       $prom_apply=$db->show_any_data_limit1("promotion", "id", trim($_POST['promotion_id']), "=");
			}						  
			if ($_GET['promotion_error']){?>
			 	<div style="text-align:center; color:#080563; background-color:yellow;">Warning: <?=$_GET['promotion_error'];?></div>
			 <?}?>
			<!--//   codigo para promotion code//-->
	      <hr />
	<form method="post" action="edit-booking3.php">

  <div style="float:left; width:450px; border:0px solid red; padding:0px 0px 0px 20px;">   <!--START SECOND DIV DETAILS-->
	<!--EMPIEZO A MOSTRAR RESUMEN DE LAS INFORMACIONES SELECCIONADAS PARA LA RESERVA-->
	<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;" cellpadding="0" cellspacing="0">
			<tr>
                <td colspan="2" bgcolor="#3794ea" align="center">
                    <span style="color:white;">BOOKING INFORMATION</span>
                </td>
			</tr>
            <tr>
				<td id="td" colspan="2" style="color:blue;" align="right">
					Booked Villa No.<strong><?=$villa_reserva[0]['no']?></strong><br />
					Reservation from: <strong><?=formatear_fecha($f_date);?></strong><br/>
					 To: <strong><?=formatear_fecha($t_date);?></strong>
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

	    	 <!--//fin codigo promotion//-->

               <!--NUEVO CODIGO PARA LOS SERVICIOS-->

         <?
         	$sub_services=0;
          foreach($_POST['servicios_id'] AS $k){
          	if($k>0){
          		$data= new getQueries;
          		$this_service=$data->show_id('serv_add', $k);
                $serv=$this_service[0];

                if($serv['type']=='Car_Rental'){
                   /* if ($_POST['qty']["Car_Rental".$serv['id']]<5){ $precio_servicio=$serv['price'];}else{$precio_servicio=$serv['price_min'];}*/
                    $precio_servicio=price_vehicle($id=$serv['id'], $start_date=$f_date, $days=$_POST['qty']["Car_Rental".$serv['id']]);
                	$amount_cars+=$precio_servicio*$_POST['qty']["Car_Rental".$serv['id']]; /*se necesita este total para calcular los impuestos de renta cars*/
                }else{
                	$precio_servicio=$serv['price'];
                }

               if($serv['type']=='Personal_Driver'){
               /* //si es driver personal necesita cantidad tambien*/

               }

                if($serv['type']=='Car_Rental'){
                	 if($_POST['qty']["Car_Rental".$serv['id']]>0){
	                 $total_service=$precio_servicio*$_POST['qty']["Car_Rental".$serv['id']];
	                 $cantidad_servicio=$_POST['qty']["Car_Rental".$serv['id']]; /*cantidad de servicios*/
	                }/*else{
	                 $total_service=$precio_servicio;
	                } */
                }else{
	                if($_POST['qty'][$serv['type']]>0){
	                 $total_service=$precio_servicio*$_POST['qty'][$serv['type']];
	                 $cantidad_servicio=$_POST['qty'][$serv['type']]; /*cantidad de servicios*/
	                }else{
	                 $total_service=$precio_servicio; /*sin esto algunos servicos son cero*/
	                }

                  if($serv['type']=='Dish Washing Service'){

	                $total_service=$precio_servicio*($nights+1);
	                $cantidad_servicio=1;
	               }

                }
          	?>
               <tr><td id="td" style="text-align:right; color:#00F;"><?  /*print_r($_POST);*//* echo "qty";*/?>
                 <?=$serv['type']?> <?=substr($serv['name'],0,15);?> <? if($cantidad_servicio>0){  ?>(<?=$cantidad_servicio?> days at <?=$precio_servicio?>) <?}?>=
               </td>
               <td id="td" style="text-align:right; color:#00F;">
                US$ <?=number_format($total_service,2);?>

                <input type="hidden" name="ids_services[]" value="<?=$serv['id']?>"/>
                <?/* if ($_POST['qty'][$serv['type']]){$cantidad_servicio=$_POST['qty'][$serv['type']]; }else{$cantidad_servicio=$_POST['qty']["Car_Rental".$serv['id']]; }*/?>
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


	            	<!--EXCURSIONES PARA ESTE BOOKING-->
             <? if($_SESSION['EX']['id_selected']){?>
                 <? $total_excursions=0;?>
                <? foreach($_SESSION['EX']['id_selected'] AS $k){?>
                   <tr><td id="td" style="text-align:right;">
                   		<span style="color:#cc1c0a;"><?=substr($_SESSION['EX'][$k]['title'],0,20)?> (<?=$_SESSION['EX'][$k]['adults']?> adults) (<?=$_SESSION['EX'][$k]['kids']?> kids)</span>
                   </td>
                   <td id="td" style="text-align:right;">
                   		<? $total_esta_excursion=($_SESSION['EX'][$k]['adults']*$_SESSION['EX'][$k]['price_a'])+($_SESSION['EX'][$k]['kids']*$_SESSION['EX'][$k]['price_c']); $total_excursions+=$total_esta_excursion;?>
                   		<span style="color:#cc1c0a;">US$ <? echo number_format($total_esta_excursion,2); ?></span>
                   	</td>
                  </tr>
                <?}?>
                <tr><td id="td" style="text-align:right;">
                   		<span style="color:#cc1c0a;font-weight:bold; text-transform:uppercase;">Total per Excursions</span>
                   </td>
                   <td id="td" style="text-align:right;">
                   		<span style="color:#cc1c0a; font-weight:bold;">US$ <? echo number_format($total_excursions,2); ?></span>
                   	</td>
                  </tr>

             <?}?>
	        <!--EXCURSIONES PARA ESTE BOOKING-->
			<?php
			
			$sub_total=(($amount_nights-$descuento)+$sub_services+$total_excursions);
				 $comission_discounted_amount=$db->show_any_data_limit1("bookingreferred", "ref_book", $reference, "=");
				 
				 if($comission_discounted_amount[0]['discounted']>0){
					 $percent_discounted=$comission_discounted_amount[0]['discounted'];
			?>
				<tr>
					<td id="td" style="text-align:right;">
						<span style="color:green;"><strong>Comission discount (<?=$percent_discounted;?> %) =</strong></span>
					</td>
					<td id="td" style="text-align:right;">
					<span style="color:green;">
					<? 
					   $comission_discounted=$sub_total*($percent_discounted/100);
						
					echo "<strong>US$ ".number_format($comission_discounted,2)."</strong>";?></span></td>
				</tr>
				<?php
				 }
				 ?>
				
				<?php
				
				$general_amount_villas=($amount_nights*1.18);
				
				if($prom_apply){
						/*echo "<pre>";		
						print_r($prom_apply);
						echo "</pre>";*/
						if(($nights>=$prom_apply[0]['min_days'])){
							/*//echo 'sigo aplicando el descuento';*/
							$_SESSION['remove_discount']=false;
							
							switch($prom_apply[0]['tipo']){
								case 3:
									$total_amount_discount_sin_impuestos=($amount_nights/$nights)*$prom_apply[0]['qty'];
									$total_amount_discount=$total_amount_discount_sin_impuestos*1.18;
										break;
								default:
									$total_amount_discount=$general_amount_villas*($prom_apply[0]['qty']/100);
									$total_amount_discount_sin_impuestos=$total_amount_discount-($total_amount_discount*(15.254/100));
							}
							
							
							$_SESSION['amount_discounted']=$total_amount_discount;
							$_SESSION['id_promotion']=$prom_apply[0]['id'];
							?>
							 <tr>
								<td id="td" style="color: green; text-align:right;">
									<strong>(<?=$prom_apply[0]['code']?>) Total Discount = </strong>
								</td>
								<td id="td" style="color:green; text-align:right;">
									<?  echo "<strong>US$ ".number_format($total_amount_discount_sin_impuestos,2)."</strong>"; ?>
								</td>
							</tr>
							<?
						}else{
							/*//echo 'se remueve el descuento';*/
							$_SESSION['remove_discount']=true;
							$_SESSION['amount_discounted']=0;
						}	
				   }else{
					   /*//echo 'se remueve el descuento';*/
							$_SESSION['remove_discount']=true;
							$_SESSION['amount_discounted']=0;
				   }
				   
				   ?>
				
				
               <tr>
         		<td id="td" style="text-align:right;">
         			<strong>Sub total =</strong>
         		</td>
         		<td id="td" style="text-align:right;"><? /*//$sub_total=(($amount_nights-$descuento)+$sub_services+$total_excursions);*/ 
				$sub_total-=$comission_discounted;
				echo "<strong>US$ ".number_format($sub_total-$total_amount_discount_sin_impuestos,2)."</strong>";?></td></tr>
	             <tr>
	        	<td id="td" style="text-align:right;">
	        	<? if((strtotime($booked[0]['date']))<(strtotime(TAX_FECHA))){/* si la fecha creada fue menor al 1 de enero 2013 solo aplica 16%*/?>
                    VAT - <?=TAX_PER_OLD?> of <?=number_format($amount_nights-$descuento+$amount_cars,2);?> =
	        	</td>
	        	<td id="td" style="text-align:right;">
	        		<? $itbis=(($amount_nights-$descuento-$total_amount_discount_sin_impuestos+$amount_cars)*TAX_DEC_OLD); echo "US$ ".number_format($itbis,2); ?>
	        	<?}else{?>
	        		VAT - <?=TAX_PERCENT?> of <?=number_format($amount_nights-$descuento-$total_amount_discount_sin_impuestos+$amount_cars,2);?> =
	        	</td>
	        	<td id="td" style="text-align:right;">
	        		<? $itbis=(($amount_nights-$descuento+$amount_cars)*TAX_DECIMAL); echo "US$ ".number_format($itbis-($total_amount_discount_sin_impuestos*0.18),2); ?>
	        	<?}?>
	        	</td>
	        </tr>
			

	            <tr><td id="td" style="text-align:right;"><strong>GENERAL AMOUNT = </strong></td><td id="td" style="text-align:right;"><? 

				$general_amount=$sub_total+$itbis;

				echo "<strong>US$ ".number_format($general_amount-$total_amount_discount,2)."</strong>"; ?>
				
				
				</td></tr></table>
				
				<?  if (($estado==34)||($estado==35)||($estado==36)||($estado==37)){?>
					<p><span style="color:red;font-weight:bold;">NOTE: Electricity is charged separate as per consumption.</span></p>
				<?php }?>
				
</div>   <!--END FIRST DIV DETAILS-->

<div style="float:left; width:450px; border-bottom:0px solid blue;">   <!--START SECOND DIV DETAILS-->
	           <table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
				<tr><td colspan="4" bgcolor="#3794ea" align="center"><span style="color:white;">MORE BOOKING DETAILS</span></td></tr>
				<tr><td  id="td"><strong>Adults:</strong></td><td id="td"><span style="color:#3b3838;"> <?=$adults?>  Person(s)</span> </td><td id="td"><strong>Chidrem:</strong></td><td id="td"><span style="color:#3b3838">  <?=$children?> kid(s)</span></td></tr>
	            <? /*$db=new getQueries;*/ $client_details=$db->customer($client);?>
	   			  <tr><td id="td"> <strong>Customer:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['name']." ".$client_details['lastname'];?></span></td><td id="td"> <strong>Email:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['email'];?></span></td></tr>

	               <? if ($client_details['address']!=''){?>
	                <tr><td id="td"><!--<br />--><strong>Address:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"><?=$client_details['address'].", ".$client_details['country'];?></span></td></tr>
	               <? }?>

	              <? if ($_POST['referal']>0){
					  $r=new getQueries; $intermediario=$r->intermediario($_POST['referal']);
					  ?>
					  <tr><td id="td"><!--<br />--><strong>Refered&nbsp;by:</strong></td><td colspan="3" id="td"> <span style="color:#3b3838;"><? echo $intermediario['name']." ".$intermediario['lastname']; echo "-".($intermediario['percent']*100)."%"?> </span></td></tr>
	                  <?/* $total_comision=$amount_nights*$intermediario['percent'];*/ ?>
	                	<input type="hidden" name="id_referal" value="<?=$_POST['referal'];?>"/>
	              <? } ?>

	            <tr><td id="td" style="text-align:right"> <strong>Status: </strong></td><td id="td" nowrap="nowrap"><? /*//=$status*/
				switch ($status){
					case 1: echo "<span style='color:green;'>Checked in, Short</span>";
							/*echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=\"deposit\" size=5 value=".$booked[0]['dep'].">";*/
							break;
					case 2: echo "<span style='color:#00F;'>Confirmed, Short</span>";
					       /* echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
							break;
					case 4: echo "<span style='color:#00F;'>Checked out, Short</span>";
					       /* echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
							break;

					case 3: echo "<span style='color:#FF0000;'>No Confirmed, Short</span>";
							break;
							/*/////////////---vip below--------------------------------*/
					case 6: echo "<span style='color:orange;'>checked in, short, VIP</span>";
							/* echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
							break;
					case 12: echo "<span style='color:#00F;'>Confirmed, short, VIP</span>";
					       /* echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
							break;
					case 13: echo "<span style='color:#FF0000;'>No Confirmed, short, VIP</span>";
							break;
					case 14: echo "<span style='color:#00F;'>Checked out, Short, VIP</span>";
					      /*  echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
							break;
					/*---buyer--------------------------------*/
					case 30: echo "<span style='color:orange;'>Checked in - Buyer Short</span><br/>";
						/*	 echo "<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
							break;
					case 31: echo "<span style='color:#00F;'>No Confirmed - Buyer Short</span><br/>";
					      /*  echo "<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
							break;
					case 32: echo "<span style='color:#FF0000;'>Confirmed - Buyer Short</span>";
							break;
					case 33: echo "<span style='color:#00F;'>Checked Out - Buyer Short</span><br/>";
					       /* echo "<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";*/
						break;
					case 33: echo "<span style='color:#00F;'>Checked Out - Buyer Short</span><br/>";
						break;
					case 33: echo "<span style='color:#00F;'>Checked Out - Buyer Short</span><br/>";
						break;
					case 33: echo "<span style='color:#00F;'>Checked Out - Buyer Short</span><br/>";
						break;
					case 33: echo "<span style='color:#00F;'>Checked Out - Buyer Short</span><br/>";
						break;
				}
				echo $old_info[0]['dep'];
				?> </td><td id="td" style="text-align:right"><strong>Modified&nbsp;by: </strong></td><td id="td"><span style="color:#3b3838;"><?=$_SESSION['info']['name']?></span>			</td></tr></table>
 </div><!--END SECOND DIV DETAILS-->

<?/* if ($status==4 || $status==14){ tripadvisor_question(); } */?>

<div style="clear:both; width:100%; border-bottom:0px solid black; padding:0px; margin:0px;">   <!--START THIRD DIV DETAILS-->
	     <fieldset><legend>Adults Names</legend>
	  <?
	  			$c_n=0;    /*//count name*/
	           	$c_l=1;    /*//count last name*/
                $c_p=2;    /*//count passport*/
	  for ($i=1; $i<=$adults;$i++){
	       /*// if ($adults==1){*/
	       if ($i==1){
	          /*$custom=new getQueries;*/ $client_name=$db->customer($client); /*//$cm=$client_name['name']." ".$client_name['lastname'];*/
	        	?>
	        <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
	        	<?=$i;?> Name:
	        	<input type="text" size="25" name="a_name<?=$i;?>" value="<?=$client_name['name']?>" />
	        	 Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$client_name['lastname'];?>" />
	        	 Passport/Cedula: <input type="text" size="15" name="cedula<?=$i;?>" value="<? if ($client_name['passport']){ echo $client_name['passport']; }elseif ($gentes_adultos[$c_p]){ echo $gentes_adultos[$c_p];}?>" />
	        </p>
	      <?  $c_n+=3;$c_l+=3;$c_p+=3;
	      }else{  ?>
	       <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
		       <?=$i;?> Name:
		        <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$gentes_adultos[$c_n]?>" />
		        Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$gentes_adultos[$c_l]?>" />
		        Passport/Cedula: <input type="text" size="15" name="cedula<?=$i;?>" value="<?=$gentes_adultos[$c_p]?>" />
	        </p>
	      <? $c_n+=3;$c_l+=3;$c_p+=3;
	      }
	   } ?>
	      </fieldset><br>

	      <? if($children>0){?>
	           <fieldset><legend>Children Names</legend>
	          <?
	           $c_n=0;    /*//count name*/
	           $c_l=1;    /*//count last name*/
	           $c_p=2;   /* //count passport*/
	          for ($i=1; $i<=$children;$i++){?>
	           <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
		           <?=$i;?> Name:
		           <input type="text" size="25" name="c_name<?=$i;?>" value="<?=$gentes_kids[$c_n]?>" />
		           Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" value="<?=$gentes_kids[$c_l]?>" />
		           Passport: <input type="text" size="15" name="passport<?=$i;?>" value="<?=$gentes_kids[$c_p]?>" />
	           </p>
	          <?  	$c_n+=3;$c_l+=3;$c_p+=3;
	          	}  ?>
	        </fieldset>
	      <? }?>

  </div>   <!--END THIRD DIV DETAILS-->

<? if ($_POST['vehicles']){
	/*//print_r($vehiculos_ant);*/
     $contador=0;
     for($i=1; $i<=$_POST['vehicles'];$i++){
		?>
	   <!--INFORMACIONES PARA VEHICULO ABAJO-->
	 <!--<p  style="clear:both;padding:0px; margin:0px;">&nbsp;</p>-->
	 <div style="clear:both; background-color:#6aabe7; padding:5px;margin-top:0px;">
		<p style="padding:0px; margin:0px;padding-left:98px; color:white; font-weight:bold;">VEHICLE DETAILS</p>
		<p style="padding:0px; margin:0px; text-align:center">Make:<select size="1" name="marca<?=$i?>">
          <? $todos_los_carros=vehicles();
           foreach($todos_los_carros AS $key=>$value){
          ?>
            <option <? if ($vehiculos_ant[$contador]['make']==$key){ echo 'selected="selected"'; }?> value="<?=$key?>"><?=$value?></option>
          <?}?>
	</select>  Model:<input type="text" name="modelo<?=$i?>" value="<?=$vehiculos_ant[$contador]['model']?>"/> Licence Plate:<input type="text" name="placa<?=$i?>" value="<?=$vehiculos_ant[$contador]['lic_plate']?>"/> Color:<select name="color<?=$i?>">
        <? $todos_los_colores=colors();
           foreach($todos_los_colores AS $ke=>$va){
          ?>
            <option <? if ($vehiculos_ant[$contador]['color']==$va){ echo 'selected="selected"'; }?> style="color:#666; background-color:<?=$ke?>;" value="<?=$va?>"><?=$va?></option>
          <?}?>
	</select></p>
	</div>
	<!--INFORMACIONES PARA VEHICULO ARRIBA-->
	<? $contador++;
	}
}?>
	 <hr />
	<!--campos que envian datos a la seccion final-->
	<input type="hidden" name="vehiculos" value="<?=$_POST['vehicles'];?>" />
	<input type="hidden" name="id_villa" value="<?=$villa_id;?>" />
	<input type="hidden" name="id_customer" value="<?=$client;?>" />
	<input type="hidden" name="id_adm" value="<?=$_SESSION['info']['id'];?>" />
	<input type="hidden" name="starting_date" value="<?=$f_date;?>" />
	<input type="hidden" name="ending_date" value="<?=$t_date;?>" />
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
	<input type="hidden" name="reserveid" value="<?=$reserveid;?>" />
	<input type="hidden" name="busyid" value="<?=$busyid;?>" />
	<input type="hidden" name="ref" value="<?=$reference;?>" />

	<!--campos que envian datos a la seccion final-->
	  <p style="text-align:center; font-size:10px; color: #06F; font-family:Arial, Helvetica, sans-serif; padding:0px 40px 0px 0px;">
		  <INPUT class="book_but" TYPE="button" onClick="location.href='edit-booking.php?refnumb=<?=$reference?>'"  VALUE="Back" title="Hit to go back">
		  <span style="color:red"><strong>WARNING!:</strong></span> Make sure that all information is correct before confirming reservation

	    <input class="book_but" type="submit" name="confirm" value="Save"  title="On click will Save it" />
	  </p>
	  <? /*echo $busyid;*/?>
	</form>
<?}else{
  echo '<h2>Error with data, try again</h2>';
  }
?>