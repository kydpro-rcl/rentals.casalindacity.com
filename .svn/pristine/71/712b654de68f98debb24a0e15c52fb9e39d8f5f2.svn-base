<?php
//$_GET['pasos']=5;
if ($_POST['services']=="Next"){

	unset($_SESSION['massage']); $_SESSION['massage']=$_POST['massage'];
	unset($_SESSION['pickup']); $_SESSION['pickup']=$_POST['pickup'];
	unset($_SESSION['fridge']); $_SESSION['fridge']=$_POST['fridge'];
	unset($_SESSION['VIPpickup']); $_SESSION['VIPpickup']=$_POST['VIPpickup'];
	unset($_SESSION['chef']); $_SESSION['chef']=$_POST['chef'];

	unset($_SESSION['carros']); $_SESSION['carros']['id']=$_POST['cars'];
	$cant_carro='qtydcars'.$_POST['cars'];	$_SESSION['carros']['qty']=$_POST[$cant_carro];

	unset($_SESSION['chofer']); $_SESSION['chofer']['id']=$_POST['chofer'];
	$cant_chofer='qtydchofer'.$_POST['chofer'];	$_SESSION['chofer']['qty']=$_POST[$cant_chofer];

   unset($_SESSION['laundry']); $_SESSION['laundry']=$_POST['laundry'];
	unset($_SESSION['dish']); $_SESSION['dish']=$_POST['dish'];

	unset($_SESSION['airline']); $_SESSION['airline']="arrival:".$_POST['aairline']."- Departure:".$_POST['dairline'];
	unset($_SESSION['datetime']); $_SESSION['datetime']="Arival:".$_POST['adatetime']."-Departure:".$_POST['ddatetime'];
	unset($_SESSION['buy']);$_SESSION['buy']=$_POST['buy'];
	unset($_SESSION['comment']); $_SESSION['comment']=$_POST['comment'];
	unset($_SESSION['promotion']); $_SESSION['promotion']=$_POST['promotion_code'];
 }

 if ($_POST['services']=="Next"){
  $_SESSION['cars']=$_POST['car'];
  $_SESSION['cars_qty']=$_POST['car_qty'];
  $_SESSION['car_price']=$_POST['car_price'];
 }

 if ($_SESSION['C']['n'])  $_POST['name']=$_SESSION['C']['n'];
 if ($_SESSION['C']['ln']) $_POST['lastname']=$_SESSION['C']['ln'];
 if ($_SESSION['C']['el']) $_POST['email']=$_SESSION['C']['el'];
 if ($_SESSION['C']['ph']) $_POST['phone']=$_SESSION['C']['ph'];
 if ($_SESSION['C']['ad']) $_POST['address']=$_SESSION['C']['ad'];
 if ($_SESSION['C']['a']) $_POST['adults']=$_SESSION['C']['a'];
 if ($_SESSION['C']['k']) $_POST['kids']=$_SESSION['C']['k'];
?>

<p>&nbsp;</p>
<p>&nbsp;</p>

			 <!--//   codigo para promotion code//-->
			<?   $_POST['promotion_code']=trim($_POST['promotion_code']);

   			  if ($_POST['promotion_code']!=""){
   			 	$db= new getQueries;
                $this_pro=$db->show_active_limit1("promotion", "code", $_POST['promotion_code'], "=");
                $pro_found=$this_pro[0];
                if (!$pro_found){
                	$_GET['promotion_error']="Promotion code not found in our system.";
        	    }else{
                	//entonces hacer procedimientos de calculos con esta promocion           0
                    //$_GET['promotion_error']="Promotion encontrada id->".$pro_found['id'];
                    //variables
                    $inicia_pro=strtotime($pro_found['desde']);
                    $fin_pro=strtotime($pro_found['hasta']);

                    // echo $_POST['promotion_code']; echo "hasta:". $pro_found['hasta'];    echo "Hoy:".date('Y-m-d');
                    $today_date=strtotime(date('Y-m-d'));

                    //----------------------------------------------------------------------------------------
                   if ($fin_pro<=$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="We sorry this promotion is over now";
                   }
                    if ($inicia_pro>$today_date){ //si la promocion ya paso
                    $_GET['promotion_error']="This promotion is coming soon, not active yet.";
                   }

				    //--------limit date to book---------------------------
		                  $only_book_from=strtotime($pro_found['bookingfrom']);
		                  $only_book_to=strtotime($pro_found['bookingto']);

		                  $fecha_inicio_booking=strtotime($_SESSION['desde']);
		                  $fecha_termina_booking=strtotime($_SESSION['hasta']);
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
                    $amount_nightsLS=($_SESSION['noches_LS']*$_SESSION['villa_details']['p_low']);
                    $amount_nightsHS=($_SESSION['noches_HS']*$_SESSION['villa_details']['p_high']);
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
                     }elseif($pro_found['tipo']=="1"){
                        $descuento=($amount_nights*($pro_found['cant_porc']/100));
                         $variable_descuento=number_format($pro_found['cant_porc'],0)." % ";
                         $tipo_dsec="porcient";
                         $promotion_code=$pro_found['code'];
                     }
                    $pro_id=$pro_found['id'];
                   }
                }
   			  }

			if ($_GET['promotion_error']){?>
			 	<div style="text-align:center; color:#080563; background-color:yellow;">Warning: <?=$_GET['promotion_error'];?></div>
			 <?}?>
			<!--//   codigo para promotion code//-->
<hr style="border: 1px solid #9c0000;"/>
<table width="90%" align="center" style="background-color:#FFF;">
	<tr>
        <td width="50%">
        <span style="font-weight:bold;">CUSTOMER:</span><br/>
        <?if (!$_SESSION['customer']){ ?>
	        <?=$_POST['name']?> <?=$_POST['lastname']?><br/>
	        <?=$_POST['email']?><br/>
	        <?=$_POST['phone']?><br/>
	        <?=$_POST['address']?><br/>
       <? }else{?>
	        <?=utf8_decode($_SESSION['customer']['name'])?> <?=utf8_decode($_SESSION['customer']['lastname'])?><br/>
	        <?=$_SESSION['customer']['email']?><br/>
	        <?=$_SESSION['customer']['phone']?><br/>
	        <?=utf8_decode($_SESSION['customer']['address'])?><br/>
       <? } ?>
        </td>
        <td>
        <span style="font-weight:bold;">BOOKING DETAILS:</span><br/>
        Villa No:<?=$_SESSION['villa_details']['no']?><br/>
        From: <?=formatear_fecha($_SESSION['desde'])?> <br/>
        To: <?=formatear_fecha($_SESSION['hasta'])?><br/>
        <?=$_POST['adults']?> adults <br/>
        <?=$_POST['kids']?> children<br/>

        </td>
	</tr>
</table>
<p>&nbsp;</p>
<table width="90%" align="center">
	<tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
        <span style="color:#06F; font-weight:bold;">ORDER DETAILS:</span>
        </td>
     </tr>
     <tr>
        <td align="right" >

        <? /*SPECIAL EVENT MANAGEMENT*/
         $_SESSION['villa_details']['p_low']=special_event(date('Y-m-d',strtotime($_SESSION['desde'])), date('Y-m-d',strtotime($_SESSION['hasta'])),  $_SESSION['villa_details']['p_low']);
         $_SESSION['villa_details']['p_high']=special_event(date('Y-m-d',strtotime($_SESSION['desde'])), date('Y-m-d',strtotime($_SESSION['hasta'])),  $_SESSION['villa_details']['p_high']);
         $_SESSION['villa_details']['p_low']=price_rent_online($nights_qty=$_SESSION['total_noches'], $normal_price=$_SESSION['villa_details']['p_low']);
         $_SESSION['villa_details']['p_high']=price_rent_online($nights_qty=$_SESSION['total_noches'], $normal_price=$_SESSION['villa_details']['p_high']);
        ?>

        None-Peak Season <?=$_SESSION['noches_LS']?> nights x US$ <?=number_format($_SESSION['villa_details']['p_low'],2)?> = <br/>
        Peak Season <?=$_SESSION['noches_HS']?> nights x US$ <?=number_format($_SESSION['villa_details']['p_high'],2)?> =<br/>
          <!--//codigo promotion//-->
	    <? if (($descuento>0)&&($tipo_dsec=="monto")){?>
	       <input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
           <? $_SESSION['promotion_id']=$pro_id; ?>
	    <span style="text-align:right; color:green;">
	    	(<?=$promotion_code?>)	Discount =</span><br/>
	    <?}?>
	    <? if (($descuento>0)&&($tipo_dsec=="porcient")){?>
	    	<input type="hidden" name="promotion_id" value="<?=$pro_id?>"/>
             <? $_SESSION['promotion_id']=$pro_id; ?>
	       <span style="text-align:right; color:green;">
	    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=number_format($amount_nights,2);?> = </span><br/>
	    <?}?>

	     <!--//fin codigo promotion//-->

        <span style="font-weight:bold;">Sub-Total =</span><br/>


         <!--SERVICES ADDITIONALS-->


	         <? if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_SESSION['carros']['id']>0 || $_SESSION['chofer']['id']>0 || $_SESSION['dish']>0 || $_SESSION['laundry']>0){
					$result= new getQueries;
						if ($_SESSION['massage']>0){
						$massage_details=$result->additional_service($_SESSION['massage'], 'massage');
						?>
						<span style="color:blue;">Massage <?=$massage_details['name'];?> =</span> <? $amount_massage=$massage_details['price']; ?><br/>
                         <? $_SESSION['info_servicios']['massage']['title']="Massage ".$massage_details['name'];?>
						<? } ?>

						 <?
						if ($_SESSION['pickup']>0){
						$pickup_details=$result->additional_service($_SESSION['pickup'], 'Airport Pick Up');
						?>
							<span style="color:blue;"><?=$pickup_details['name'];?> =</span><? $amount_pickup=$pickup_details['price'];  ?><br/>
							<? $_SESSION['info_servicios']['pickup']['title']=$pickup_details['name'];?>
						<? } ?>

					 	<?
						if ($_SESSION['VIPpickup']>0){
						$VIPpickup_details=$result->additional_service($_SESSION['VIPpickup'], 'VIP Airport Pick Up');
						?>
						<span style="color:blue;"><?=$VIPpickup_details['name'];?> =</span><? $amount_VIPpickup=$VIPpickup_details['price']; ?><br/>
						<? $_SESSION['info_servicios']['VIPpickup']['title']=$VIPpickup_details['name'];?>
						<? } ?>

						 <?
						if ($_SESSION['chef']>0){
						$chef_details=$result->additional_service($_SESSION['chef'], 'chef');
						?>
						<span style="color:blue;"> <?=$chef_details['name'];?> =</span><? $amount_chef=$chef_details['price']; ?><br/>
						<? $_SESSION['info_servicios']['chef']['title']=$chef_details['name'];?>
						<? } ?>

						<?
						if ($_SESSION['fridge']>0){
							$fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
						?>
						<span style="color:blue;">Filled Fridge <?=$fridge_details['name'];?> =</span><? $amount_fridge=$fridge_details['price']; ?><br/>
						<? $_SESSION['info_servicios']['fridge']['title']="Filled Fridge ".$fridge_details['name'];?>
						<? }?>
						<? //empiezan los servicios para carros
						if ($_SESSION['carros']['id']>0){
						$cars_details=$result->additional_service($_SESSION['carros']['id'], 'Car_Rental');
						/*if ($_SESSION['carros']['qty']<5){ $precio_renta_cars=$cars_details['price'];}else{$precio_renta_cars=$cars_details['price_min'];}*/
						$precio_renta_cars=price_vehicle($id=$_SESSION['carros']['id'], $start_date=$_SESSION['desde'], $days=$_SESSION['carros']['qty']);
						?>
						<span style="color:blue;"><?=substr($cars_details['name'],0,15);?> (<?=$_SESSION['carros']['qty']?> days at <?=$precio_renta_cars?>)=</span><? $amount_cars=$precio_renta_cars*$_SESSION['carros']['qty'];?><br/><? $deta_carro=substr($cars_details['name'],0,15)." (".$_SESSION['carros']['qty']." days at ".$precio_renta_cars." )"; ?>
						<? $_SESSION['info_servicios']['carros']['title']=$deta_carro;?>
	                   <!--// <input type="hidden" name="cars_id" value="<?=$_POST['cars'];?>" /> <input type="hidden" name="carros_online" value="<?=$deta_carro;?>" />
	             		<input type="hidden" name="cars_amount" value="<?=$amount_cars;?>" />
	             		<input type="hidden" name="cars_days" value="<?=$_POST['qtydcars'];?>" />//-->
						<? } ///terminan los servicios para carro
						?>

						<? //empiezan los servicios para chofer
						if ($_SESSION['chofer']['id']>0){
						$chofer_details=$result->additional_service($_SESSION['chofer']['id'], 'Personal_Driver');
						?>
						<span style="color:blue;"><?=substr($chofer_details['name'],0,15);?> (<?=$_SESSION['chofer']['qty']?> days at <?=$chofer_details['price']?>)=</span><? $amount_chofer=$chofer_details['price']*$_SESSION['chofer']['qty'];?><br/><? $deta_chofer=substr($chofer_details['name'],0,15)." (".$_SESSION['chofer']['qty']." days at ".$chofer_details['price']." )"; ?>

						<? $_SESSION['info_servicios']['chofer']['title']=substr($chofer_details['name'],0,15);?>
						<? } ///terminan los servicios para chofer
                           ?>

                           <?
						if ($_SESSION['laundry']>0){
							$la=$result->additional_service($_SESSION['laundry'], 'Laundry');
						?>
						<span style="color:blue;"><?=$la['name'];?> =</span><? $amount_laundry=$la['price']; ?><br/>
							<? $_SESSION['info_servicios']['laundry']['title']=$la['name'];?>
						<? }?>

      					<?
						if ($_SESSION['dish']>0){
							$di=$result->additional_service($_SESSION['dish'], 'Dish Washing Service');
						?>
						<span style="color:blue;"><?=$di['name'];?> =</span><? $amount_dish=$di['price']*($nights_qty+1); ?><br/>
							<? $_SESSION['info_servicios']['dish']['title']=$di['name'];?>
						<? }?>

                           <?
						$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup+$amount_cars+$amount_chofer+$amount_dish+$amount_laundry); ?>
	                   <!--//Total additionals services=<br/>//-->
			<?}?>

	            <!--SERVICES ADDITIONALS-->

	        <!--EXCURSIONES PARA ESTE BOOKING-->
             <? if($_SESSION['excursions']){?>

                <? foreach($_SESSION['excursions'] AS $k){?>                   <span style="color:#cc1c0a;"><?=substr($_SESSION['excur'][$k]['title'],0,30)?> (<?=$_SESSION['excur'][$k]['adults']?> adults) (<?=$_SESSION['excur'][$k]['kids']?> kids)</span><br/>
                <?}?>

             <?}?>
	        <!--EXCURSIONES PARA ESTE BOOKING-->
           VAT-TAX <?=TAX_PERCENT?> =<br/>
         <span style="font-weight:bold;">TOTAL <? if($_SESSION['cars']){ echo "WITHOUT CARS"; } ?>=</span>
         <?
          $total_ls=($_SESSION['noches_LS']*$_SESSION['villa_details']['p_low']);
		  $total_hs=($_SESSION['noches_HS']*$_SESSION['villa_details']['p_high']);
		 ?>
        </td>
        <td align="right" width="105px">
        <? /*echo $amount_massage; echo '<pre>'; print_r($_SESSION); echo '</pre>';*/?>
        US$ <?=number_format($total_ls,2)?><br/>
        US$ <?=number_format($total_hs,2)?><br/>
        <!--//promotion code//-->
         <? if ($descuento>0){
          echo "<span style=\" color:green;\">US$ ".number_format($descuento,2)."</span><br/>";
         }?>
        <!--//promotion code//-->
        <span style="font-weight:bold;">
        US$ <? echo number_format((($total_ls+$total_hs)-$descuento),2); ?><br/>
        </span>



				<?  if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_SESSION['carros']['id']>0 || $_SESSION['chofer']['id']>0 || $_SESSION['dish']>0 || $_SESSION['laundry']>0){

						if ($_SESSION['massage']>0){
							?>
						 <span style="color:blue;">US$ <? echo $amount_massage; ?> </span><br/>

						<? } ?>

						 <?
						if ($_SESSION['pickup']>0){

						?>
						<span style="color:blue;">US$ <?  echo $amount_pickup; ?></span><br/>
						<? } ?>

					 	<?
						if ($_SESSION['VIPpickup']>0){
						?>
						<span style="color:blue;">US$ <? $amount_VIPpickup=$VIPpickup_details['price']; echo $amount_VIPpickup; ?></span> <br/>
						<? } ?>

						 <?
						if ($_SESSION['chef']>0){
						?>
						<span style="color:blue;">US$ <? echo $amount_chef; ?></span> <br/>
						<? } ?>

						<?
						if ($_SESSION['fridge']>0){

						?>
						<span style="color:blue;">US$ <?  echo $amount_fridge; ?></span> <br/>
						<? }
						?>
						<?
						if ($_SESSION['carros']['id']>0){

						?>
						<span style="color:blue;">US$ <?  echo number_format($amount_cars,2); ?></span> <br/>
						<? } ?>

	                	<?
						if ($_SESSION['chofer']['id']>0){

						?>
						<span style="color:blue;">US$ <?  echo number_format($amount_chofer,2); ?></span> <br/>
						<? } ?>

						<?
						if ($_SESSION['laundry']>0){

						?>
						<span style="color:blue;">US$ <?  echo number_format($amount_laundry,2); ?></span> <br/>
						<? } ?>

						<?
						if ($_SESSION['dish']>0){

						?>
						<span style="color:blue;">US$ <?  echo number_format($amount_dish,2); ?></span> <br/>
						<? } ?>

				<?	}?>

				<!--EXCURSIONES PARA ESTE BOOKING-->
             <? if($_SESSION['excursions']){?>
                 <? $total_excursions=0;?>
                <? foreach($_SESSION['excursions'] AS $k){?>
                   <span style="color:#cc1c0a;">US$ <? $total_esta_excursion=($_SESSION['excur'][$k]['adults']*$_SESSION['excur'][$k]['pa'])+($_SESSION['excur'][$k]['kids']*$_SESSION['excur'][$k]['pc']); $total_excursions+=$total_esta_excursion; echo number_format($total_esta_excursion,2); ?></span><br/>
                <?}?>

             <?}?>
	        <!--EXCURSIONES PARA ESTE BOOKING-->
	        	US$ <? $sub_totales=(($total_ls+$total_hs)-$descuento); $itbis_desc=(($sub_totales+$amount_cars)*TAX_DECIMAL); $_SESSION['itbis']=$itbis_desc; echo number_format($itbis_desc,2)?><br/>
		<span style="font-weight:bold;">
        US$ <?=number_format($sub_totales+$itbis_desc+$sub_services+$total_excursions,2)?> <? $_SESSION['total']=$sub_totales+$itbis_desc+$sub_services+$total_excursions;?>
        </span>

        </td>
</table>
<hr style="border: 1px solid #9c0000;"/>
	<!--//</tr>//-->
<form action="booking_confirm_SE.php" method="post" >
<fieldset><legend>Payment Options</legend>
<input type="radio" name="payment_option" value="50" />Click here to pay 50% to confirm your reservation.<br/>
<input type="radio" name="payment_option" value="100" checked="checked" />Click here to pay now in full.<br/>
</fieldset>

<p style="color:red">For security reasons, please type the first and last names of all guests occupying the villa.</p>

 <input type="hidden" name="cars_id" value="<?=$_SESSION['carros']['id'];?>" />
 <input type="hidden" name="carros_online" value="<?=$deta_carro;?>" />
 <input type="hidden" name="cars_amount" value="<?=$amount_cars;?>" />
 <input type="hidden" name="cars_days" value="<?=$_SESSION['carros']['qty'];?>" />

  <input type="hidden" name="chofer_id" value="<?=$_SESSION['chofer']['id'];?>" />
 <input type="hidden" name="chofer_online" value="<?=$deta_chofer;?>" />
 <input type="hidden" name="chofer_amount" value="<?=$amount_chofer;?>" />
 <input type="hidden" name="chofer_days" value="<?=$_SESSION['chofer']['qty'];?>" />

	<input type="hidden" name="massage_amount" value="<?=$amount_massage;?>" />
	<input type="hidden" name="pickup_amount" value="<?=$amount_pickup;?>" />
	<input type="hidden" name="VIPpickup_amount" value="<?=$amount_VIPpickup;?>" />
	<input type="hidden" name="chef_amount" value="<?=$amount_chef;?>" />
	<input type="hidden" name="fridge_amount" value="<?=$amount_fridge;?>" />
	<input type="hidden" name="services_amount" value="<?=$sub_services;?>" />

	  <input type="hidden" name="laundry_id" value="<?=$_SESSION['laundry'];?>" />
<!--// <input type="hidden" name="chofer_online" value="<?=$deta_chofer;?>" />//-->
 <input type="hidden" name="laundry_amount" value="<?=$amount_laundry;?>" />
<!--// <input type="hidden" name="laundry_days" value="<?=$_SESSION['chofer']['qty'];?>" />//-->

   <input type="hidden" name="dish_id" value="<?=$_SESSION['dish'];?>" />
 <!--//<input type="hidden" name="chofer_online" value="<?=$deta_chofer;?>" />//-->
 <input type="hidden" name="dish_amount" value="<?=$amount_dish;?>" />
 <input type="hidden" name="dish_days" value="<?=$nights_qty+1;?>" />


    <fieldset id="fieldsets"><legend id="legends"> <?=$_POST['adults']?>Adults Names </legend>
          <?
          if ($_SESSION['C']['a']){
          	$_POST['adults']=$_SESSION['C']['a'];
          }

          for ($i=1; $i<=$_POST['adults'];$i++){

               if ($i==1){
                  //$custom=new getQueries; $client_name=$custom->customer($client); //$cm=$client_name['name']." ".$client_name['lastname'];
                    ?>
                     <?if (!$_SESSION['customer']){ ?>
                    	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">(<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=$_POST['name']?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=$_POST['lastname'];?>" /></p>
                    <?}else{ ?>
                    	<p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">(<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="<?=utf8_decode($_SESSION['customer']['name'])?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="<?=utf8_decode($_SESSION['customer']['lastname']);?>" /></p>
                    <?}?>
              <? }else{  ?>
                   <p style="text-align:center;  padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
                   (<?=$i;?>) Name: <input type="text" size="25" name="a_name<?=$i;?>" value="" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="a_lastname<?=$i;?>" value="" /></p>
              <?  } ?>
           <?} ?>
              </fieldset><br>

              <? if($_POST['kids']>0){?>
                   <fieldset id="fieldsets"><legend id="legends"> <?=$_POST['kids']?> Children Names </legend>
                  <? for ($i=1; $i<=$_POST['kids'];$i++){?>
                       <p style="text-align:center; padding-bottom:0px; margin-bottom:0px; margin-top:1px; padding-top:1px; margin-right:2px;" id="td">
                        (<?=$i;?>) Name: <input type="text" size="25" name="c_name<?=$i;?>" /> (<?=$i;?>) Lastname: <input type="text" size="25" name="c_lastname<?=$i;?>" />
                       </p>
                  <? }  ?>
                </fieldset>
              <? }?>
    <?
       if($_SESSION['cars']){?>
           <h1 style="float:left; color:red; font-size:28px;">Vehicle rental is paid at check-in</h1><h1 style="text-align:right; color:black; clear:both;">Cost details</h1>
       <?
       $amount_cars_rented=0;  $db= new getQueries;
         foreach($_SESSION['cars'] AS $k){
         	$_SESSION['car_price'][$k]=priceRentalCar($idCar=$k, $start_date=$_SESSION['desde'], $qtyDays=$_SESSION['cars_qty'][$k]);/*get pricing with qty of days in rental cars*/         	$totalThisCar=$_SESSION['cars_qty'][$k]*$_SESSION['car_price'][$k];
         	$amount_cars_rented+=$totalThisCar;
         	 $this_car=$db->show_any_data_limit1("carros", "id", $k, "=");
         	?>

         	<p style=" padding:0px; margin:0px; text-align:right;"><?=$this_car[0]['name'];?> <?=$_SESSION['cars_qty'][$k];?> x <?=$_SESSION['car_price'][$k];?> =<?=number_format($totalThisCar,2);?> </p>
        <?         }
         $cars_taxes=$amount_cars_rented*0.18;
         ?>
          <p style="font-weight:bold; padding:0px; margin:0px;text-align:right;">Taxes = USD <?=number_format($cars_taxes,2)?></p>
         <p style="font-weight:bold; padding:0px; margin:0px;text-align:right;">Total for Cars Rental = USD <?=number_format($amount_cars_rented+$cars_taxes,2)?></p>
         <?
       }
    ?>
<hr style="border: 2px solid #9c0000;"/>
<p style="text-align:right; padding-right:12px;"><input class="boton" type="submit" name="confirm" value="Check Out" onClick="return confirmSubmitText('IMPORTANT INFORMATION:\n 1. Upon arrival, a credit card or a deposit of 75.00 USD per bedroom will be required to handle any damages or missing inventory.\n 2. Even if you do not have a paypal account, you can pay with your debit or credit card.')" /></p>
</form>