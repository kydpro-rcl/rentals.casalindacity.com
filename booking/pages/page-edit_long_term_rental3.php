<?
 if ($_SESSION['info']){
 	$_SESSION['NO_REFRESH']=1;
   if ($_POST){
	$adults=$_POST['adults'];	$client=$_POST['client'];	$children=$_POST['children'];
	$villa_no=$_POST['villa_no'];
	$starting=$_POST['starting'];	$ending=$_POST['ending'];
	$villa_id=$_POST['villa_id'];  //	$starting=$_POST['starting'];
	$status=$_POST['status']; $comment=$_POST['comment'];

	//-------------------------------------------------
     $long_price=$_POST['price_long'];
     $maintenance=$_POST['maintenance'];
     $pool_garden=$_POST['pool_garden'];
     $long_water=$_POST['long_water'];
     $maid=$_POST['maid'];
     $long_gas=$_POST['long_gas'];
    //---------------------------------------------------------
     $db=new getQueries;
     $reserveid=$_POST['reserveid'];
     $gente_reserva=$db->people($reserveid);
     $vehiculos_ant=$db->show_any_data('vehicle', 'ref_book', $_POST['ref'], '=');
     $book_info=$db->see_occupancy_ref($_POST['ref']);
     $deposito=$book_info[0]['dep'];

     $gentes_adultos=array();
	 $gentes_kids=array();

	  foreach ($gente_reserva as $g){
	 	if ($g['type']==1) array_push($gentes_adultos,$g['name'], $g['lastname'] );
        if ($g['type']==2) array_push($gentes_kids, $g['name'],$g['lastname'] );
	 }
    // echo $_POST['rate'];
	?>
	<!--<img src="images/logo.gif" border="0" style="float:left"><br/>  -->
	    <h2 style="text-align:center; color:red;">Changing Long Term Rental <span style="color:black">No.<?=$_POST['ref']?></span></h2>
	 	     <div style="width:571px; height:33px; text-align:center; margin: 0 auto;"><img src="images/steps/3-4.png" alt="" width="571px" height="33px"/> </div>
	 	   <hr />
	      <form method="post" action="edit_long_term_rental4.php" name="st">

	     <div style="float:left; width:450px; border:0px solid red; padding:0px 0px 0px 20px; /*height:200px; overflow:auto; */">   <!--START DIV DETAILS-->
	<!--EMPIEZO A MOSTRAR RESUMEN DE LAS INFORMACIONES SELECCIONADAS PARA LA RESERVA-->
	<? if ($_POST['rate']=="regular"){ /* regular pricing*/?>
	<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
		<tr>
			<td colspan="2" bgcolor="#3794ea" align="center">
				<span style="color:white;">VILLA INFORMATION</span>
			</td>
		</tr>
		<tr>
			<td id="td" colspan="2" align="right" style="color:blue;">
				Villa No.<strong><?=$villa_no?></strong><br />
				Reservation from: <strong><?=formatear_fecha($starting);?></strong>
				<br/> To: <strong><?=formatear_fecha($ending);?></strong>
				<!--//<p>&nbsp;</p>//-->
			</td>
		</tr>


	    <tr >
	    	<td id="td" style="text-align:right;" colspan="2">
             <!--PRICE LONG TERM-->
               <?
               //$services_long_rental=array();
               $services_long_rental=array(
               		array('name'=>'Maintenance', 'price'=>$maintenance),
               		array('name'=>'Garden and Pool', 'price'=>$pool_garden),
               		array('name'=>'Water Service', 'price'=>$long_water),
               		array('name'=>'Gas Service', 'price'=>$long_gas));
               ?>

             <span style="color:red;">Monthly price per villa = <b>US$ <?=$long_price?></b></span><br/>
             Charge per Maintenance = <b>US$ <?=$maintenance?></b><br/>
             Garden and Pool Services = <b>US$ <?=$pool_garden?></b><br/>
             Water Service = <b>US$ <?=$long_water?></b><br/>
             Gas Service = <b>US$ <?=$long_gas?></b><br/>
            <? if ($maid>0){
            	array_push($services_long_rental,array('name'=>'Maid Service','price'=>$maid));
            	?>
             Maid Service = <b>US$ <?=$maid?></b><br/>
             <?/* $sub_total+=$maid;*/ ?>
             <?} /*print_r($services_long_rental);*/
              $_SESSION['long_services']=$services_long_rental;
             ?>

             <span style="color:blue">TOTAL MONTHLY PER SERVICES = US$ <?$monthly_per_services=$maid+$long_water+$maintenance+$pool_garden+$long_gas; echo number_format($monthly_per_services,2);?></span><br/>
             <span style="font-size:10px; color:red;">Note: Electricity is charged monthly per consumption</span><br/>
             <? $sub_total+=($long_price+$monthly_per_services);?>
             <!--PRICE LONG TERM-->
	    	</td>

	    </tr>

	            <tr><td id="td" style="text-align:right;">
	            <strong>MONTHLY PAYMENTS = </strong><br/>
	            PAYMENTS PER EXTRA NIGHTS =
	            </td>
	            <td id="td" style="text-align:right;">
	            <? $monthly_amount=$sub_total; echo "<strong>US$ ".number_format($monthly_amount,2)."</strong>"; ?><br/>
	            <? $amount_per_nights=($monthly_amount/30); echo "US$ ".number_format($amount_per_nights,2); $amount_per_nights=number_format($amount_per_nights,2); ?>

	            </td></tr>

	            </table>
     <?} /* regular pricing*/?>

     <? if ($_POST['rate']=="flat_month"){ /* flat month*/?>
	     <? $flat_price=$_POST['FM'];

	        $monthly_per_services=$maid+$long_water+$maintenance+$pool_garden+$long_gas;

	        if ($flat_price-$monthly_per_services>=0){
	        	$long_price=$flat_price-$monthly_per_services;
	     ?>
	     <input type="hidden" name="flat_qty" value="<?=$flat_price;?>" />
		<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
			<tr>
				<td colspan="2" bgcolor="#3794ea" align="center">
					<span style="color:white;">VILLA INFORMATION</span>
				</td>
			</tr>
			<tr>
				<td id="td" colspan="2" align="right" style="color:blue;">
					Villa No.<strong><?=$villa_no?></strong><br />
					Reservation from: <strong><?=formatear_fecha($starting);?></strong>
					<br/> To: <strong><?=formatear_fecha($ending);?></strong>
					<!--//<p>&nbsp;</p>//-->
				</td>
			</tr>


		    <tr >
		    	<td id="td" style="text-align:right;" colspan="2">
	             <!--PRICE LONG TERM-->
	               <?
	               //$services_long_rental=array();
	               $services_long_rental=array(
	               		array('name'=>'Maintenance', 'price'=>$maintenance),
	               		array('name'=>'Garden and Pool', 'price'=>$pool_garden),
	               		array('name'=>'Water Service', 'price'=>$long_water),
	               		array('name'=>'Gas Service', 'price'=>$long_gas));
	               ?>

	             <span style="color:red;">Monthly price per villa = <b>US$ <?=$long_price?></b></span><br/>
	             Charge per Maintenance = <b>US$ <?=$maintenance?></b><br/>
	             Garden and Pool Services = <b>US$ <?=$pool_garden?></b><br/>
	             Water Service = <b>US$ <?=$long_water?></b><br/>
	             Gas Service = <b>US$ <?=$long_gas?></b><br/>
	            <? if ($maid>0){
	            	array_push($services_long_rental,array('name'=>'Maid Service','price'=>$maid));
	            	?>
	             Maid Service = <b>US$ <?=$maid?></b><br/>
	             <? /*$sub_total+=$maid; */?>
	             <?} /*print_r($services_long_rental);*/
	              $_SESSION['long_services']=$services_long_rental;
	             ?>

	             <span style="color:blue">TOTAL MONTHLY PER SERVICES = US$ <? echo number_format($monthly_per_services,2);?></span><br/>
	             <span style="font-size:10px; color:red;">Note: Electricity is charged monthly per consumption</span><br/>
	             <? $sub_total+=($long_price+$monthly_per_services);?>
	             <!--PRICE LONG TERM-->
		    	</td>

		    </tr>
		            <tr><td id="td" style="text-align:right;">
		            <strong>MONTHLY PAYMENTS = </strong><br/>
		            PAYMENTS PER EXTRA NIGHTS =
		            </td>
		            <td id="td" style="text-align:right;">
		            <? $monthly_amount=$sub_total+$itbis; echo "<strong>US$ ".number_format($monthly_amount,2)."</strong>"; ?><br/>
		            <? $amount_per_nights=($monthly_amount/30); echo "US$ ".number_format($amount_per_nights,2); $amount_per_nights=number_format($amount_per_nights,2); ?>
	  	            </td></tr>
	              </table>
	     <?}else{
	     	$_GET['error']['flat']="<span style='color:red; font-weight:bold;'>ERROR:<br/>Flat price per months ($flat_price USD) must be iqual or more than: $monthly_per_services USD";/*.(($flat_price)-($monthly_per_services));*/
	     	echo $_GET['error']['flat'];
	     }

     } /* end flat month*/?>

     <? if ($_POST['rate']=="flat_booking"){ /* flat booking*/?>
	      <? $flat_price=$_POST['FB'];
            $total_de_pagos=$_SESSION['payments_qty'];
			 if (($total_de_pagos>=1)&&($_SESSION['nights_last_payment']==0)){
            	$pagos_enteros=$total_de_pagos;
            }elseif(($total_de_pagos>=1)&&($_SESSION['nights_last_payment']>0)){
                $pagos_enteros=$total_de_pagos-1;
            }

	        $monthly_per_services=$maid+$long_water+$maintenance+$pool_garden+$long_gas;
	        $sevice_per_extra_night=($monthly_per_services/30);

            $total_booking_per_services=(($monthly_per_services*$pagos_enteros)+($_SESSION['nights_last_payment']*$sevice_per_extra_night));

	     if ($flat_price-$total_booking_per_services>=0){
	        	$todo_por_villa=($flat_price-$total_booking_per_services); //total price for villa in the whole booking
	        	$total_noches_booking=(($pagos_enteros*30)+$_SESSION['nights_last_payment']); //all nights caculated in the bookings
                $pago_por_noche= $todo_por_villa/$total_noches_booking;  //prices per extra nights
                $pago_entero_villa=($pago_por_noche*30);//pago mensual

	        	$long_price=$pago_entero_villa;
	     ?>
	     <input type="hidden" name="flat_qty" value="<?=$flat_price;?>" />
		<table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;">
			<tr>
				<td colspan="2" bgcolor="#3794ea" align="center">
					<span style="color:white;">VILLA INFORMATION</span>
				</td>
			</tr>
			<tr>
				<td id="td" colspan="2" align="right" style="color:blue;">
					Villa No.<strong><?=$villa_no?></strong><br />
					Reservation from: <strong><?=formatear_fecha($starting);?></strong>
					<br/> To: <strong><?=formatear_fecha($ending);?></strong>
					<!--//<p>&nbsp;</p>//-->
				</td>
			</tr>


		    <tr >
		    	<td id="td" style="text-align:right;" colspan="2">
	             <!--PRICE LONG TERM-->
	               <?
	               //$services_long_rental=array();
	               $services_long_rental=array(
	               		array('name'=>'Maintenance', 'price'=>$maintenance),
	               		array('name'=>'Garden and Pool', 'price'=>$pool_garden),
	               		array('name'=>'Water Service', 'price'=>$long_water),
	               		array('name'=>'Gas Service', 'price'=>$long_gas));
	               ?>

	             <span style="color:red;">Monthly price per villa = <b>US$ <?=number_format($long_price,2)?></b></span><br/>
	             Charge per Maintenance = <b>US$ <?=$maintenance?></b><br/>
	             Garden and Pool Services = <b>US$ <?=$pool_garden?></b><br/>
	             Water Service = <b>US$ <?=$long_water?></b><br/>
	             Gas Service = <b>US$ <?=$long_gas?></b><br/>
	            <? if ($maid>0){
	            	array_push($services_long_rental,array('name'=>'Maid Service','price'=>$maid));
	            	?>
	             Maid Service = <b>US$ <?=$maid?></b><br/>
	             <? /*$sub_total+=$maid; */?>
	             <?} /*print_r($services_long_rental);*/
	              $_SESSION['long_services']=$services_long_rental;
	             ?>

	             <span style="color:blue">TOTAL MONTHLY PER SERVICES = US$ <? echo number_format($monthly_per_services,2);?></span><br/>
	             <span style="font-size:10px; color:red;">Note: Electricity is charged monthly per consumption</span><br/>
	             <? $sub_total+=($long_price+$monthly_per_services);?>
	             <!--PRICE LONG TERM-->
		    	</td>

		    </tr>
		            <tr><td id="td" style="text-align:right;">
		            <strong>MONTHLY PAYMENTS = </strong><br/>
		            PAYMENTS PER EXTRA NIGHTS =
		            </td>
		            <td id="td" style="text-align:right;">
		            <? $monthly_amount=$sub_total; echo "<strong>US$ ".number_format($monthly_amount,2)."</strong>"; ?><br/>
		            <? $amount_per_nights=($monthly_amount/30); echo "US$ ".number_format($amount_per_nights,2); $amount_per_nights=number_format($amount_per_nights,2); ?>
	  	            </td></tr>
	              </table>
	     <?}else{
	     	$_GET['error']['flat']="<span style='color:red; font-weight:bold;'>ERROR:<br/>Flat price per booking ($flat_price USD) must be iqual or more than: ".number_format($total_booking_per_services,2)." USD";
	     	echo $_GET['error']['flat'];
	     } ?>
     <?} /* end flat booking*/?>

     </div>   <!--END FIRST DIV DETAILS-->

<div style="float:left; width:450px; border-bottom:0px solid blue;">   <!--START SECOND DIV DETAILS-->


	           <table width="400" style="border-bottom:1px solid #060; border-top:1px solid #060; border-left:1px solid #060; border-right:1px solid #060;"><tr><td colspan="4" bgcolor="#3794ea" align="center"><span style="color:white;">BOOKING DETAILS</span></td></tr>

				<tr><td  id="td"><strong>Adults:</strong></td><td id="td"><span style="color:#3b3838;"> <?=$adults?>  Person(s)</span> </td><td id="td"><strong>Chidren:</strong></td><td id="td"><span style="color:#3b3838">  <?=$children?> kid(s)</span></td></tr>
	            <? $db=new getQueries;
	                if(($status==22)||($status==23)||($status==24)||($status==24)){
	                	$owner=$db->show_id('owners', $client);
	                	$client_details=$owner[0];
	                }else{
	                	$client_details=$db->customer($client);
	                }

	            ?>
	   			  <tr><td id="td"> <strong>Customer:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['name']." ".$client_details['lastname'];?></span></td><td id="td"> <strong>Email:</strong></td><td id="td"><span style="color:#3b3838"> <?=$client_details['email'];?></span></td></tr>
	              <? if ($client_details['phone']!=''){?>
	               <tr><td id="td"><!--<br />--><strong> Phone:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"> <?=$client_details['phone'];?></span></td></tr>
	               <? }?>
	               <? if ($client_details['address']!=''){?>
	                <tr><td id="td"><!--<br />--><strong>Address:</strong></td><td colspan="3" id="td"><span style="color:#3b3838"><?=$client_details['address'].", ".$client_details['country'];?></span></td></tr>
	               <? }?>

	                <? if ($_POST['referal']>0){
					  $r=new getQueries; $intermediario=$r->intermediario($_POST['referal']);
					  ?>
					  <tr><td id="td"><!--<br />--><strong>Refered&nbsp;by:</strong></td><td colspan="3" id="td"> <span style="color:#3b3838;"><? echo $intermediario['name']." ".$intermediario['lastname']; echo "-".($intermediario['percent']*100)."%"?> </span></td></tr>
	                  <? /*$total_comision=0;*//*$amount_nights*$intermediario['percent'];*/ ?>
	                	<input type="hidden" name="id_referal" value="<?=$_POST['referal'];?>"/>
	                  <? } ?>

	               <? if ($comment!=''){?>
	           <tr><td id="td" colspan="4"> <strong>Reservation Comment:</strong><br /><span style="color:#3b3838;"> <?=wordwrap($comment, 75, "\n", true);?> </span><?}?></td></tr>
	            <tr><td id="td" style="text-align:right"> <strong>Status: </strong></td><td id="td" nowrap="nowrap"><? //=$status
				switch ($status){
					case 8: echo "<span style='color:green;'>Checking in</span>";
							echo "&nbsp;-&nbsp;<span style='color:green;'><!--Deposit--></span>&nbsp;<input type=hidden name=deposit size=5 value=$deposito>";
						break;
					case 9: echo "<span style='color:#00F;'>Confirmed</span>";
					        echo "&nbsp;-&nbsp;<span style='color:green;'><!--Deposit--></span>&nbsp;<input type=hidden name=deposit size=5 value=$deposito>";
						break;
					case 10: echo "<span style='color:#FF0000;'>No confirmed</span>";
							//echo " - <span style='color:green;'>Deposit</span> <input type=text name=deposit size=5 value=000.00>";
						break;
					case 11: echo "<span style='color:#FF0000;'>Check out</span>";
						break;
					case 22: echo "<span style='color:green;'>Checking in-Owner</span>";
							echo "&nbsp;-&nbsp;<span style='color:green;'><!--Deposit--></span>&nbsp;<input type=hidden name=deposit size=5 value=$deposito>";
						break;
					case 23: echo "<span style='color:#00F;'>Confirmed-Owner</span>";
					        echo "&nbsp;-&nbsp;<span style='color:green;'><!--Deposit--></span>&nbsp;<input type=hidden name=deposit size=5 value=$deposito>";
						break;
					case 24: echo "<span style='color:#FF0000;'>No confirmed-Owner</span>";
							//echo " - <span style='color:green;'>Deposit</span> <input type=text name=deposit size=5 value=000.00>";
						break;
					case 25: echo "<span style='color:#FF0000;'>Check out-Owner</span>";
						break;
				}
				?> </td><td id="td" style="text-align:right"><strong>Modified&nbsp;by: </strong></td><td id="td"><span style="color:#3b3838;"><?=$_SESSION['info']['name']?></span></td></tr></table>
                   <?/*=$status*/?>
				<p>
				<? $total_de_pagos=$_SESSION['payments_qty']; ?>

				<?if ($_SESSION['nights_last_payment']>0){?>
				   Extra nights (Last payment): <b><?=$_SESSION['nights_last_payment'];?> Night<?if ($_SESSION['nights_last_payment']>1) echo "s";?></b> (on <b><?=formatear_fecha($_SESSION['last_payment_date']);?></b>)<br/> <br/>

                 <?}?>
                 First Payment: <b><?=formatear_fecha($starting);?></b><br/>
                 Total payments:<b> <?=$total_de_pagos;?> Payment<? if ($total_de_pagos>1) echo "s";?></b><br/>

			<!--//Payments = //-->
            <?// print_r($_SESSION['payments']);
            if (($total_de_pagos>=1)&&($_SESSION['nights_last_payment']==0)){
            	$pagos_enteros=$total_de_pagos;
            }elseif(($total_de_pagos>=1)&&($_SESSION['nights_last_payment']>0)){
                $pagos_enteros=$total_de_pagos-1;
            }
               echo "<span style='color:blue'><strong>GENERAL AMOUNT US$: ";
             if(($pagos_enteros==0)&&($_SESSION['nights_last_payment']>0)){/*asign monthly price when less than one month*/
              // $monto_total=$monthly_amount;
				 $monto_total=($pagos_enteros*$monthly_amount)+($_SESSION['nights_last_payment']*$amount_per_nights);
             }else{  /*if it is more than one month everything continue normal as before*/
               $monto_total=($pagos_enteros*$monthly_amount)+($_SESSION['nights_last_payment']*$amount_per_nights);
             }

               echo number_format($monto_total,2);
               echo "</span></strong>";
           ?>

				</p>
	 </div><!--END SECOND DIV DETAILS-->

<div style="clear:both; width:100%; border-bottom:0px solid black;">   <!--START THIRD DIV DETAILS-->
     <fieldset><legend>Adults Names</legend>
	  <?
	  	$c_n=0;    //count name
	    $c_l=1;    //count last name

	  	for ($i=1; $i<=$adults;$i++){
	       // if ($adults==1){
	       if ($i==1){
	          $custom=new getQueries; $client_name=$custom->customer($client); //$cm=$client_name['name']." ".$client_name['lastname'];
	        	?>
	        <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$client_name['name']?>" /> Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$client_name['lastname'];?>" /></p>
	      <?  $c_n+=2;$c_l+=2;
	      }else{  ?>
	       <p style="text-align:center;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
	       <?=$i;?> Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$gentes_adultos[$c_n]?>" /> Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$gentes_adultos[$c_l]?>" /></p>
	      <?$c_n+=2;$c_l+=2;
	      }
	   } ?>
	      </fieldset><br>

	      <? if($children>0){?>
	           <fieldset><legend>Children Names</legend>
	          <?
	          $c_n=0;    //count name
	           $c_l=1;    //count last name

	          for ($i=1; $i<=$children;$i++){?>
	           <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td"><?=$i;?> Name: <input type="text" size="25" name="c_name<?=$i;?>" value="<?=$gentes_kids[$c_n]?>" /> Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" value="<?=$gentes_kids[$c_l]?>" /></p>
	          <?
	          	$c_n+=2;$c_l+=2;
	          }  ?>
	        </fieldset>
	      <? }?>

</div>   <!--END THIRD DIV DETAILS-->

	<? if ($_POST['vehicles']){
		//print_r($vehiculos_ant);
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
    <? $sub_total_gral=($monto_total-$itbis);?>
	<!--campos que envian datos a la seccion final-->
	<input type="hidden" name="rate" value="<?=$_POST['rate'];?>" />

	<input type="hidden" name="vehiculos" value="<?=$_POST['vehicles'];?>" />
	<input type="hidden" name="id_villa" value="<?=$villa_id;?>" />
	<input type="hidden" name="id_customer" value="<?=$client;?>" />
	<input type="hidden" name="id_adm" value="<?=$_SESSION['info']['id'];?>" />
	<input type="hidden" name="starting_date" value="<?=$starting;?>" />
	<input type="hidden" name="ending_date" value="<?=$ending;?>" />
	<? $qty_nights=dayPeriod($ending, $starting);?>
	<input type="hidden" name="qty_nights" value="<?=$qty_nights;?>" />
	<input type="hidden" name="price_per_extra_night" value="<?=$amount_per_nights;?>" />
	<input type="hidden" name="amount_per_nights" value="<?=$amount_per_nights;?>" />
	<input type="hidden" name="ITBIS" value="<?=$itbis;?>" />
	<input type="hidden" name="sub_total_rent" value="<?=$sub_total_gral;?>" />
	<input type="hidden" name="general_amount" value="<?=$monto_total;?>" />

	<input type="hidden" name="long_price" value="<?=$long_price;?>" />
	<input type="hidden" name="qty_pagos" value="<?=$total_de_pagos;?>" />
	<input type="hidden" name="monto_pagos" value="<?=$monthly_amount;?>" />
	<input type="hidden" name="services_amount" value="<?=$monthly_per_services;?>" />
	<input type="hidden" name="qty_nights_extra" value="<?=$_SESSION['nights_last_payment'];?>" />

    <input type="hidden" name="reserveid" value="<?=$reserveid;?>" />
	<input type="hidden" name="ref" value="<?=$_POST['ref'];?>" />

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
	 <p style="text-align:center">
          <INPUT class="book_but" TYPE="button" onClick="location.href='edit-booking.php?refnumb=<?=$_POST['ref']?>'"  VALUE="Back" title="Hit to go back">
        <? if (!$_GET['error']['flat']){?>
	    <span style="font-size:10px; color: #06F; font-family:Arial, Helvetica, sans-serif;"><span style="color:red"><strong>WARNING!:</strong></span> Make sure that all information is correct before confirming reservation</span>   <input class="book_but" type="submit" name="confirm" value="Done"  title="Save Reservation" onclick="return muestraConfirm('<?=$general_amount?>', document.st.deposit.value);"/>
	      <?}?>
	    </p>
	     <!-- <input class="submit" onmouseover="this.className='submitover'" onmouseout="this.className='submit'" type="submit" name="confirm" value="Done"  title="Save Reservation" />-->
	      </form>

	<?
   }else{ echo "<h2>Error with data, try again.</h2>";}
 }else{
	 header('Location:login.php');
	 die();
 }
?>