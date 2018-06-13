<?
 $_SESSION['NO_REFRESH']=1;
$db=new getQueries;
$villa_id=$_POST['villa']; $f_date=$_POST['from']; $t_date=$_POST['to'];
$client=$_POST['client']; $adults=$_POST['adults']; $children=$_POST['children'];
$comment=$_POST['comment'];

$massage=$_POST['massage']; $pickup=$_POST['pickup'];$VIPpickup=$_POST['VIPpickup']; $chef=$_POST['chef']; $fridge=$_POST['fridge'];/*//varibles para servicios*/
$busyid=$_POST['busyid'];   $reference=$_POST['ref'];

	$reserveid=$_POST['reserveid'];

    $vehiculos_ant=$db->show_any_data('vehicle', 'ref_book', $reference, '='); /* // informaicones para los vehiculos*/

	$booked=$db->see_occupancy_id($_POST['busyid']);

	 $gente_reserva=$db->people($reserveid);
	 $servicios_reserva=$db->services_reserved($reserveid);
	 $villa_reserva=$db->villa($villa_id);
	/*# $price=$villa_reserva[0]['p_low'];*/
	 $status=$_POST['status'];

	 $gentes_adultos=array();
	 $gentes_kids=array();

	 foreach ($gente_reserva as $g){
	 	if ($g['type']==1) array_push($gentes_adultos,$g['name'], $g['lastname'],$g['passport'] );
        if ($g['type']==2) array_push($gentes_kids, $g['name'],$g['lastname'],$g['passport'] );
	 }

/*#$priceHS=$villa_reserva[0]['p_high'];*/

/*###################################################################################*/
$price=$_POST['price'];
$priceHS=$_POST['priceHS'];
$HS_nights=$_POST['HS_nights'];/*// echo $HS_nights."<br>";*/
$LS_nights=$_POST['LS_nights']; /*//echo $LS_nights."<br>";*/
$nights=($HS_nights+$LS_nights);
/*##################################################################################*/
?>

<?
  /* // echo $nights." Nocches ";  echo $priceHS." PHS ";  echo $price." p ";
//if (($nights>0)&&(($priceHS+$price)>0)){*/	if ($nights>0){	?>
	<!--<img src="images/logo.gif" border="0" style="float:left"><br/>  -->
			<p>&nbsp;</p>
		    <h2 style="color:#13a703;">Editing booking <span style="color:black;">No.<?=$reference?></span> - Short Rental Owners<? $estado=$status; 		if (($estado==6)||($estado==12)||($estado==13)||($estado==14)) echo ", <span style=\"color:red\">VIP</span>";?> - step 3</h2>

		      <hr />
		<form method="post" action="edit_owner_so3.php">

	  <div style="float:left; width:450px; border:0px solid red; padding:0px 0px 0px 20px;">   <!--START SECOND DIV DETAILS-->
		<!--EMPIEZO A MOSTRAR RESUMEN DE LAS INFORMACIONES SELECCIONADAS PARA LA RESERVA-->
		<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
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
		        <tr>
		        	<td id="td" style="text-align:right;">
		        		VAT - <?=TAX_PERCENT?> of <?=number_format($amount_nights,2);?> =
		        	</td>
		        	<td id="td" style="text-align:right;">
		        		<? $itbis=($amount_nights*TAX_DECIMAL); echo "US$ ".number_format($itbis,2); ?>
		        	</td>
		        </tr>
	         	<tr>
	         		<td id="td" style="text-align:right;">
	         			<strong>Sub total =</strong>
	         		</td>
	         		<td id="td" style="text-align:right;"><? $sub_total=($amount_nights+$itbis); echo "<strong>US$ ".number_format($sub_total,2)."</strong>";?></td></tr>


		            <!--SERVICES ADDITIONALS-->
		            <?  if ($massage>0 || $pickup>0 || $VIPpickup>0 || $chef>0 || $fridge>0){
						/*//$result= new getQueries;*/
							if ($massage>0){
							/*//$result=$_SESSION['consultas'];*/
							$massage_details=$db->additional_service($massage, 'massage');
							?>
							<tr>
								<td id="td" style="text-align:right; color:#00F;">
									Massage <?=$massage_details['name'];?> =
								</td>
								<td id="td" style="text-align:right; color:#00F;">
									US$ <? $amount_massage=$massage_details['price']; echo $amount_massage; ?></td></tr>
		                    <input type="hidden" name="massage_id" value="<?=$massage;?>" />
		             		<input type="hidden" name="massage_amount" value="<?=$amount_massage;?>" />
							<? } ?>

							 <?
							if ($pickup>0){
							/*//$result= new getQueries;*/
							$pickup_details=$db->additional_service($pickup, 'Airport Pick Up');
							?>
							<tr><td id="td" style="text-align:right;  color:#00F;"><?=$pickup_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_pickup=$pickup_details['price']; echo $amount_pickup; ?></td></tr>
		                    <input type="hidden" name="pickup_id" value="<?=$pickup;?>" />
		             		<input type="hidden" name="pickup_amount" value="<?=$amount_pickup;?>" />
							<? } ?>

						 	<?
							if ($VIPpickup>0){
							/*//$result= new getQueries;*/
							$VIPpickup_details=$db->additional_service($VIPpickup, 'VIP Airport Pick Up');
							?>
							<tr><td id="td" style="text-align:right;  color:#00F;"><?=$VIPpickup_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_VIPpickup=$VIPpickup_details['price']; echo $amount_VIPpickup; ?></td></tr>
		                    <input type="hidden" name="VIPpickup_id" value="<?=$VIPpickup;?>" />
		             		<input type="hidden" name="VIPpickup_amount" value="<?=$amount_VIPpickup;?>" />
							<? } ?>

							 <?
							if ($chef>0){
							/*//	$result= new getQueries;*/
							$chef_details=$db->additional_service($chef, 'chef');
							?>
							<tr><td id="td" style="text-align:right;  color:#00F;"> <?=$chef_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_chef=$chef_details['price']; echo $amount_chef; ?></td></tr>
		                    <input type="hidden" name="chef_id" value="<?=$chef;?>" />
		             		<input type="hidden" name="chef_amount" value="<?=$amount_chef;?>" />
							<? } ?>

							<?
							if ($fridge>0){
							/*//$result= new getQueries;*/
							$fridge_details=$db->additional_service($fridge, 'Filled Fridge');
							?>
							<tr><td id="td" style="text-align:right;  color:#00F;">Filled Fridge <?=$fridge_details['name'];?> =</td><td id="td" style="text-align:right; color:#00F;">US$ <? $amount_fridge=$fridge_details['price']; echo $amount_fridge; ?></td></tr>
		                    <input type="hidden" name="fridge_id" value="<?=$fridge;?>" />
		             		<input type="hidden" name="fridge_amount" value="<?=$amount_fridge;?>" />
							<? }
							$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup); ?>
		                    <tr><td id="td" style="text-align:right;  color:#00F; font-weight:bold;">Total additionals services=</td><td id="td" style="text-align:right; color:#00F; font-weight:bold;">US$ <?=number_format($sub_services,2); ?></td></tr>
		                    <input type="hidden" name="services_amount" value="<?=$sub_services;?>" />

				<?	}?>
		            <!--SERVICES ADDITIONALS-->
		            <tr><td id="td" style="text-align:right;"><strong>GENERAL AMOUNT = </strong></td><td id="td" style="text-align:right;"><? $general_amount=$sub_total+$sub_services; echo "<strong>US$ ".number_format($general_amount,2)."</strong>"; ?></td></tr></table>
	</div>   <!--END FIRST DIV DETAILS-->

	<div style="float:left; width:450px; border-bottom:0px solid blue;">   <!--START SECOND DIV DETAILS-->
		           <table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
					<tr><td colspan="4" bgcolor="#3794ea" align="center"><span style="color:white;">MORE BOOKING DETAILS</span></td></tr>
					<tr><td  id="td"><strong>Adults:</strong></td><td id="td"><span style="color:#3b3838;"> <?=$adults?>  Person(s)</span> </td><td id="td"><strong>Chidrem:</strong></td><td id="td"><span style="color:#3b3838">  <?=$children?> kid(s)</span></td></tr>
		            <? /*$db=new getQueries;*/ $owner=$db->show_id('owners', $client);/*$cl=$owner[0]; */$client_details=$owner[0];?>
		   			  <tr><td id="td"> <strong>Owner:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['name']." ".$client_details['lastname'];?></span></td><td id="td"> <strong>Email:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['email'];?></span></td></tr>

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
						case 7: echo "<span style='color:green;'>Checked in, Short</span>";
								echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=\"deposit\" size=5 value=".$booked[0]['dep'].">";
								break;
						case 19: echo "<span style='color:#00F;'>Confirmed, Short</span>";
						        echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";
								break;
						case 21: echo "<span style='color:#00F;'>Checked out, Short</span>";
						        echo "&nbsp;-&nbsp;<span style='color:green;'>Deposit</span>&nbsp;<input type=text name=deposit size=5 value=".$booked[0]['dep'].">";
								break;
						case 20: echo "<span style='color:#FF0000;'>No Confirmed, Short</span>";
								break;
					}
					/*//echo $old_info[0]['dep'];*/
					?> </td><td id="td" style="text-align:right"><strong>Modified&nbsp;by: </strong></td><td id="td"><span style="color:#3b3838;"><?=$_SESSION['info']['name']?></span>			</td></tr></table>
	 </div><!--END SECOND DIV DETAILS-->
     <? /* if ($status==21){  tripadvisor_question(); } */?>
	<div style="clear:both; width:100%; border-bottom:0px solid black;">   <!--START THIRD DIV DETAILS-->
		     <fieldset><legend>Adults Names</legend>
		  <?
		  			$c_n=0;    /*//count name*/
		           	$c_l=1;    /*//count last name*/
	                $c_p=2;    /*//count passport*/
		  for ($i=1; $i<=$adults;$i++){
		      /* // if ($adults==1){*/
		       if ($i==1){
		          /*$custom=new getQueries;*/ $client_name=$owner[0]; /*//$cm=$client_name['name']." ".$client_name['lastname'];*/
		        	?>
		        <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
		        	<?=$i;?> Name:
		        	<input type="text" size="25" name="a_name<?=$i;?>" value="<?=$client_name['name']?>" />
		        	 Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$client_name['lastname'];?>" />
		        	 Passport/Cedula: <input type="text" size="15" name="cedula<?=$i;?>" value="<? if ($client_name['passport']){ echo $client_name['passport']; }elseif ($gentes_adultos[$c_p]){ echo $gentes_adultos[$c_p];}?>" />
		        </p>
		      <?  $c_n+=3;$c_l+=3;$c_p+=3;
		      }else{  ?>
		       <p style="text-align:center;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
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
		           $c_p=2;    /*//count passport*/
		          for ($i=1; $i<=$children;$i++){?>
		           <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
			           <?=$i;?> Name:
			           <input type="text" size="25" name="c_name<?=$i;?>" value="<?=$gentes_kids[$c_n]?>" />
			           Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" value="<?=$gentes_kids[$c_l]?>" />
			           Passport: <input type="text" size="15" name="passport<?=$i;?>" value="<?=$gentes_kids[$c_p]?>" />
		           </p>
		          <? $c_n+=3;$c_l+=3;$c_p+=3;
		          	}  ?>
		        </fieldset>
		      <? }?>
		        <? if ($massage>0 || $pickup>0 || $VIPpickup>0 || $chef>0 || $fridge>0){?>
					   <fieldset><legend>Services Notes</legend>
					<table align="center" border="0">
					   <? if($massage>0){

					   	 /* //$massage_details=$db->additional_service($massage, 'massage');*/
					   	 $servicios_detalles=$db->det_services($massage, $reserveid); /*//get details for if this service is reserved*/
					   	/*// print_r($servicios_detalles);*/
					   	?>
					   	<tr>
	                      <td>
						   <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Massage:</p>
	                      </td>
						  <td>
						   <input type="text" size="55" name="massage_comment" value="<?=$servicios_detalles[0]['comment'];?>" />
						  </td>
					  </tr>
					  <? }?>
		              <? if($pickup>0){
		              	$servicios_detalles=$db->det_services($pickup, $reserveid); /*//get details for if this service is reserved*/
		              	?>
		              	<tr>
	                      <td>
						  	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Pickup: </p>
						   </td>
						   <td>
						  	<input type="text" size="55"  name="pickup_comment" value="<?=$servicios_detalles[0]['comment'];?>" />
						  </td>
					  </tr>
					  <? }?>
		              <? if($VIPpickup>0){
		              	$servicios_detalles=$db->det_services($VIPpickup, $reserveid); /*//get details for if this service is reserved*/

		              	?>
	                    <tr>
	                      <td>
						  	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">VIP Pickup:</p>
	                       </td>
						   <td>
						  	<input type="text" size="55" name="VIPpickup_comment" value="<?=$servicios_detalles[0]['comment'];?>" />
	                    </td>
					  </tr>
					  <? }?>
		              <? if($chef>0){
		              	 $servicios_detalles=$db->det_services($chef, $reserveid); /*//get details for if this service is reserved*/
		              	?>
	                     <tr>
	                       <td>
						   		<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Chef:</p>
	                       </td>
						   <td>
						  	 <input type="text" size="55" name="chef_comment" value="<?=$servicios_detalles[0]['comment'];?>" />
	                       </td>
						 </tr>
					  <? }?>
		              <? if($fridge>0){
		              	$servicios_detalles=$db->det_services($fridge, $reserveid); /*//get details for if this service is reserved*/
		              	?>
						 <tr>
	                       <td>
							 <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">Filled Fridge:</p>                      </td>
						   <td>
							 <input type="text" size="55" name="fridge_comment" value="<?=$servicios_detalles[0]['comment'];?>" />
						   </td>
						 </tr>
					  <? }?>
	                   </table>
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
	<?php
	}else{
	  echo '<h2>Error with data, try again</h2>';
	  }
	?>
