<p>&nbsp;</p>
<p>&nbsp;</p>
<?
 $db=new getQueries ();
if ($_POST['services']=="Next"){

	$servicios_selected=array();
	if($_POST['massage']){
       	$service=$db->show_id('serv_add', $_POST['massage']);
    	$se=$service[0];
		array_push($servicios_selected,array('id'=>$_POST['massage'],'type'=>$se['type'],'qty'=>1,'details'=>$se));
	}
	if($_POST['pickup']){
       	$service=$db->show_id('serv_add', $_POST['pickup']);
    	$se=$service[0];
		array_push($servicios_selected,array('id'=>$_POST['pickup'],'type'=>$se['type'],'qty'=>1,'details'=>$se));
	}
	if($_POST['fridge']){
       	$service=$db->show_id('serv_add', $_POST['fridge']);
    	$se=$service[0];
		array_push($servicios_selected,array('id'=>$_POST['fridge'],'type'=>$se['type'],'qty'=>1,'details'=>$se));
	}
	if($_POST['VIPpickup']){
       	$service=$db->show_id('serv_add', $_POST['VIPpickup']);
    	$se=$service[0];
		array_push($servicios_selected,array('id'=>$_POST['VIPpickup'],'type'=>$se['type'],'qty'=>1,'details'=>$se));
	}
	if($_POST['chef']){
       	$service=$db->show_id('serv_add', $_POST['chef']);
    	$se=$service[0];
		array_push($servicios_selected,array('id'=>$_POST['chef'],'type'=>$se['type'],'qty'=>1,'details'=>$se));
	}
	if($_POST['cars']){
       	$service=$db->show_id('serv_add', $_POST['cars']);
    	$se=$service[0];$cant_carro='qtydcars'.$_POST['cars'];
		array_push($servicios_selected,array('id'=>$_POST['cars'],'type'=>$se['type'],'qty'=>$_POST[$cant_carro],'details'=>$se));
	}
	if($_POST['chofer']){
       	$service=$db->show_id('serv_add', $_POST['chofer']);
    	$se=$service[0];$cant_chofer='qtydchofer'.$_POST['chofer'];
		array_push($servicios_selected,array('id'=>$_POST['chofer'],'type'=>$se['type'],'qty'=>$_POST[$cant_chofer],'details'=>$se));
	}
	if($_POST['laundry']){
       	$service=$db->show_id('serv_add', $_POST['laundry']);
    	$se=$service[0];
		array_push($servicios_selected,array('id'=>$_POST['laundry'],'type'=>$se['type'],'qty'=>1,'details'=>$se));
	}
	if($_POST['dish']){
       	$service=$db->show_id('serv_add', $_POST['dish']);
    	$se=$service[0];$nights_qty=($_SESSION['cust_book']['NLS']+$_SESSION['cust_book']['NHS']); $qty_dish=$nights_qty+1;
		array_push($servicios_selected,array('id'=>$_POST['dish'],'type'=>$se['type'],'qty'=>$qty_dish,'details'=>$se));
	}
    $_SESSION['servicios_selected']=$servicios_selected;
 }
  /* echo "<pre>";

   print_r($_SESSION['excursions']);
   echo "</pre>";
   echo "<pre>";
    print_r($_SESSION['servicios_selected']);
    echo "</pre>";
 */

 if((!$_SESSION['servicios_selected'])&&(!$_SESSION['excursions'])){
 //sent client to excursion again
  ?>
   <meta http-equiv="refresh" content="3;url=excursions.php">
   <a href="excursions.php">No excursions or services selected</a><br/>
   Please wait 3 seconds or click above to choose your excursions and/or services.
   <?
 }else{/*if we found new excursion and services then continue*/
	$informacion_villa=$db->villa($_SESSION['cust_book']['villa']);
	$_SESSION['villa_details']=$informacion_villa[0];

	  $_SESSION['customer']=$_SESSION['cust_online'];

	  $_SESSION['desde']=$_SESSION['cust_book']['start'];
	  $_SESSION['hasta']=$_SESSION['cust_book']['end'];
	  $_SESSION['noches_LS']=$_SESSION['cust_book']['NLS'];
	  $_SESSION['noches_HS']=$_SESSION['cust_book']['NHS'];

	$servicios_reserva=$db->services_reserved($_SESSION['cust_book']['reserveid']);
	$excursiones_reserva=$db->excrusiones_reserved($_SESSION['cust_book']['reserveid']);
	?>
	<hr style="border: 1px solid #9c0000;"/>
	<table width="90%" align="center" style="background-color:#FFF;">
		<tr>
	        <td width="50%" align="left">
	        <span style="font-weight:bold;">CUSTOMER:</span><br/>

		        <?=utf8_decode($_SESSION['customer']['name'])?> <?=utf8_decode($_SESSION['customer']['lastname'])?><br/>
		        <?=$_SESSION['customer']['email']?><br/>
		        <?=$_SESSION['customer']['phone']?><br/>
		        <?=utf8_decode($_SESSION['customer']['address'])?><br/>

	        </td>
	        <td align="left">
	        <span style="font-weight:bold;">BOOKING DETAILS:</span><br/>
	        Reference number: <b><?=$_SESSION['cust_book']['ref']?></b> <br/>Villa No: <b><?=$_SESSION['villa_details']['no']?></b><br/>
	        From: <b><?=formatear_fecha($_SESSION['desde'])?></b> <br/>
	        To: <b><?=formatear_fecha($_SESSION['hasta'])?></b><br/>
	        (<?=$_SESSION['cust_book']['adults']?> adults )
	        (<?=$_SESSION['cust_book']['kids']?> children)<br/>

	        </td>
		</tr>
	</table>
	<p >&nbsp;</p>
	<table width="90%" align="center" bgcolor="#FFFFFF">
		<tr>
	        <td colspan="2" align="center" bgcolor="#CCCCCC">
	        <span style="color:#06F; font-weight:bold;">ORDER DETAILS:</span>
	        </td>
	     </tr>
	     <tr>
	        <td align="right" >

	        <? /*SPECIAL EVENT MANAGEMENT*/
	        /* $_SESSION['villa_details']['p_low']=special_event(date('Y-m-d',strtotime($_SESSION['desde'])), date('Y-m-d',strtotime($_SESSION['hasta'])),  $_SESSION['villa_details']['p_low']);
	         $_SESSION['villa_details']['p_high']=special_event(date('Y-m-d',strtotime($_SESSION['desde'])), date('Y-m-d',strtotime($_SESSION['hasta'])),  $_SESSION['villa_details']['p_high']);
	         $_SESSION['villa_details']['p_low']=price_rent_online($nights_qty=$_SESSION['cust_book']['nights'], $normal_price=$_SESSION['villa_details']['p_low']);
	         $_SESSION['villa_details']['p_high']=price_rent_online($nights_qty=$_SESSION['cust_book']['nights'], $normal_price=$_SESSION['villa_details']['p_high']);*/
	           $_SESSION['villa_details']['p_low']=$_SESSION['cust_book']['ppn'];
	           $_SESSION['villa_details']['p_high']=$_SESSION['cust_book']['PHS'];
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
		        <!--EXCURSIONES PARA ESTE BOOKING-->
	             <? /*if($_SESSION['excursions']){?>

	                <? foreach($_SESSION['excursions'] AS $k){?>
	                   <span style="color:#cc1c0a;"><?=substr($_SESSION['excur'][$k]['title'],0,30)?> (<?=$_SESSION['excur'][$k]['adults']?> adults) (<?=$_SESSION['excur'][$k]['kids']?> kids)</span><br/>
	                <?}?>

	             <?}*/?>
	             <?
	             if (!empty($excursiones_reserva)){
							$total_excursion=0;
			                 foreach ($excursiones_reserva as $k){
			                 echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= </p>";
			                 $total_excursion+=$k['total'];
			                 }

				 }
				 //---------------------------------NUEVAS EXCURSIONES-----------------------------
	               if($_SESSION['excursions']){
	                  foreach($_SESSION['excursions'] AS $k){
	                    echo "<P id='right_blue' style='color:#4ca702;'>".substr($k['title'],0,15)." (".$k['qty_adult']." adults)(".$k['qty_kid']." kids)= </p>";
	                  }

				 //-----------------------------------------------------------------------------------
	                echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = </strong></p>";
				   }
				?>
				<?
				        if (!empty($servicios_reserva)){
							$total_services=0;
							foreach ($servicios_reserva AS $s){
						   // echo $s['price']." ";
							   if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
								echo "<P id='right_blue'>".$s['name']." = </p>"; $total_services+=$s['price'];
							   }elseif($s['type']=="Car_Rental"){
			                    echo "<P id='right_blue'>".substr($s['name'],0,15)." (".$s['qty']." days)= </p>"; $total_services+=$s['price'];
							   }else{
								echo "<P id='right_blue'>".ucfirst($s['type'])." ( ".substr($s['name'],0,15).")= </p>"; $total_services+=$s['price'];
							   }

							}

						 }
						 //--------------------NUEVOS SERVICIOS-----------------------
	                    if($_SESSION['servicios_selected']){
	                      foreach($_SESSION['servicios_selected'] AS $k){
	                           if (($k['type']=="Airport Pick Up") || ($k['type']=="VIP Airport Pick Up") ){
								echo "<P id='right_blue' style='color:#4ca702;'>".$k['details']['name']." = </p>"; /*$total_services+=$s['price'];*/
							   }elseif($k['type']=="Car_Rental"){
			                    echo "<P id='right_blue' style='color:#4ca702;'>".substr($k['details']['name'],0,15)." (".$k['qty']." days)= </p>"; /*$total_services+=$s['price'];*/
							   }else{
								echo "<P id='right_blue' style='color:#4ca702;'>".ucfirst($k['type'])." ( ".substr($k['details']['name'],0,15).")= </p>"; /*$total_services+=$s['price'];*/
							   }
	                      }


	                    echo "<P id='right_blue'><strong>Total per Services = </strong></p>";
						} //----------------------------------------------------------
						 $grand_total=($ocupabilidad['subtotal']+$total_services);
						 ?>
		        <!--EXCURSIONES PARA ESTE BOOKING-->
	           VAT-TAX <?=TAX_PERCENT?> =<br/>
	         <span style="font-weight:bold;">GRAND TOTAL =</span>
	         <?
	          $total_ls=($_SESSION['noches_LS']*$_SESSION['villa_details']['p_low']);
			  $total_hs=($_SESSION['noches_HS']*$_SESSION['villa_details']['p_high']);
			 ?>
	        </td>



	        <td align="right" width="105px" align="right">
	        <?=number_format($total_ls,2)?><br/>
	         <?=number_format($total_hs,2)?><br/>
	        <!--//promotion code//-->
	         <? if ($descuento>0){
	          echo "<span style=\" color:green;\">US$ ".number_format($descuento,2)."</span><br/>";
	         }?>
	        <!--//promotion code//-->
	        <span style="font-weight:bold;">
	        USD <? echo number_format((($total_ls+$total_hs)-$descuento),2); ?><br/>
	        </span>


	             <?
	             if (!empty($excursiones_reserva)){
							$total_excursion=0;
			                 foreach ($excursiones_reserva as $k){
			                 echo "<P id='right_blue' style='color:#cc1c0a;'>".$k['total']."</p>";
			                 $total_excursion+=$k['total'];
			                 }

				 }
				  //---------------------------------NUEVAS EXCURSIONES-----------------------------
	               if($_SESSION['excursions']){
	                  foreach($_SESSION['excursions'] AS $k){
	                  	 $total_this_excurc=($k['qty_adult']*$k['price_a'])+($k['qty_kid']*$k['price_k']);
	                    echo "<P id='right_blue' style='color:#4ca702;'>".number_format($total_this_excurc,2)."</p>";
	                    $total_excursion+=$total_this_excurc;
	                  }
	               }
				 //-----------------------------------------------------------------------------------
	              if($total_excursion>0){
	              	 echo "<P id='right_blue' style='color:#cc1c0a;'><strong> USD ".number_format($total_excursion,2)."</strong></p>";
	              }
				?>
				<?
				        if (!empty($servicios_reserva)){
							$total_services=0;
							foreach ($servicios_reserva as $s){
						   // echo $s['price']." ";
							   if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
								echo "<P id='right_blue'>".$s['price']."</p>";
							   }elseif($s['type']=="Car_Rental"){
			                    echo "<P id='right_blue'>".$s['price']."</p>"; $total_services_CAR+=$s['price'];
							   }else{
								echo "<P id='right_blue'>".$s['price']."</p>";
							   }
	                           $total_services+=$s['price'];
							}


						 }

						  //--------------------NUEVOS SERVICIOS-----------------------
	                    if($_SESSION['servicios_selected']){
	                      foreach($_SESSION['servicios_selected'] AS $k){

							   if($k['type']=="Car_Rental"){
							   	$total_noches=$_SESSION['noches_HS']+$_SESSION['noches_LS'];
							   	$car_price=price_vehicle($id=$k['id'], $start_date=$_SESSION['cust_book']['start'], $days=$k['qty']);
                                $total_this_service=$k['qty']*$car_price;
							   	$total_services_CAR+=$total_this_service;
			                    echo "<P id='right_blue' style='color:#4ca702;'>".number_format($total_this_service,2)."</p>";
							   }else{
							   	$total_this_service=$k['qty']*$k['details']['price'];
								echo "<P id='right_blue' style='color:#4ca702;'>".number_format($total_this_service,2)."</p>";
							   }
							   $total_services+=$total_this_service;
	                      }
	                    }

	                    if($total_services>0){
	                      echo "<P id='right_blue'><strong> USD ".number_format($total_services,2)."</strong></p>";
	                    }
						 //----------------------------------------------------------
						 $grand_total=($ocupabilidad['subtotal']+$total_services);
						 ?>
		        <!--EXCURSIONES PARA ESTE BOOKING-->
		        	USD <? $sub_totales=(($total_ls+$total_hs)-$descuento); $itbis_desc=(($sub_totales+$total_services_CAR)*TAX_DECIMAL); $_SESSION['itbis']=$itbis_desc; echo number_format($itbis_desc,2)?><br/>
			<span style="font-weight:bold;">
	        USD <?=number_format($sub_totales+$itbis_desc+$total_services+$total_excursion,2)?> <? $_SESSION['total']=$sub_totales+$itbis_desc+$total_services+$total_excursion;?>
	        </span>
	        </td>
	</table>
	<hr style="border: 1px solid #9c0000;"/>

        <?
         $amount_to_pay=($_SESSION['total']-$_SESSION['cust_book']['dep']);
        ?>
	<form action="confirm.php" method="post" >
     <input type="hidden" name="new_total" value="<?=$_SESSION['total']?>"/>
     <input type="hidden" name="new_taxes" value="<?=$itbis_desc?>"/>
     <input type="hidden" name="amount_to_pay" value="<?=$amount_to_pay?>"/>
	<p style="text-align:right; padding-right:12px;">
	<input class="boton" type="submit" name="confirm" value="Confirm Booking" onClick="return confirmSubmitText('IMPORTANT INFORMATION:\n 1. Upon arrival, a credit card or a deposit of 75.00 USD per bedroom will be required to handle any damages or missing inventory.\n 2. Even if you do not have a paypal account, you can pay with your debit or credit card.')" />
	</p>
	</form>

 <?}
/*======================================START ACCOUNTING INFO=============================================================*/
 $_SESSION['all_info']['client']=$_SESSION['customer'];
/* $_SESSION['all_info']['book']=$_SESSION['cust_book']; */
 $_SESSION['all_info']['villa']=$_SESSION['villa_details'];

  $_SESSION['all_info']['book']['ref']=$_SESSION['cust_book']['cust_book'];
  $_SESSION['all_info']['book']['from']=date('m/d/Y',strtotime($_SESSION['cust_book']['start']));
  $_SESSION['all_info']['book']['to']=date('m/d/Y',strtotime($_SESSION['cust_book']['end']));
  $_SESSION['all_info']['book']['LSnight']=$_SESSION['cust_book']['NLS'];
  $_SESSION['all_info']['book']['LSprice']=$_SESSION['cust_book']['ppn'];
  $_SESSION['all_info']['book']['HSnight']=$_SESSION['cust_book']['NHS'];
  $_SESSION['all_info']['book']['HSprice']=$_SESSION['cust_book']['PHS'];
  $_SESSION['all_info']['book']['sub-total']=$_SESSION['cust_book']['subtotal'];
  $_SESSION['all_info']['book']['itbis']=$itbis_desc;
  $_SESSION['all_info']['book']['total_geral']=$_SESSION['total'];
  $_SESSION['all_info']['book']['deposited']=$_SESSION['cust_book']['dep'];
 /*
  $array_accounting['service']['array ['title'] ['qty'] ['price']['total']]
  $array_accounting['excursion'][array ['title'] ['adult'] ['kid'] ['Pa'] ['Pk']['total']]
 */
 $all_excur_booked=array();
  if (!empty($excursiones_reserva)){
	//$total_excursion=0;
	foreach ($excursiones_reserva as $k){
	 $title=substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)";
     array_push($all_excur_booked, array('title'=>$title, 'adult'=>$k['qty_a'], 'kid'=>$k['qty_c'], 'Pa'=>'', 'Pk'=>'', 'total'=>$k['total']));
	}
  }

  if($_SESSION['excursions']){
	foreach($_SESSION['excursions'] AS $k){
	$total_excur=($k['qty_adult']*$k['price_a']+$k['price_k']*$k['qty_kid']);
     array_push($all_excur_booked, array('title'=>$k['title'], 'adult'=>$k['qty_adult'], 'kid'=>$k['qty_kid'], 'Pa'=>$k['price_a'], 'Pk'=>$k['price_k'], 'total'=>$total_excur));
	}
  }
 $_SESSION['all_info']['excursion']=$all_excur_booked;

$all_services_booked=array();
  if (!empty($servicios_reserva)){
   //$total_services=0;
   foreach ($servicios_reserva as $s){
   	if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
	  $title=$s['name'];
	}elseif($s['type']=="Car_Rental"){
	  $title=substr($s['name'],0,15)." (".$s['qty']." days)";
	}else{
	  $title=ucfirst($s['type'])." ( ".substr($s['name'],0,15).")";
	}
    array_push($all_services_booked,  array('title'=>$title, 'qty'=>$s['qty'], 'price'=>($s['price']/$s['qty']), 'total'=>$s['price']));
   }
  }

 if($_SESSION['servicios_selected']){
	foreach($_SESSION['servicios_selected'] AS $k){
	   if($k['type']=="Car_Rental"){
	   	$title=substr($k['details']['name'],0,15)." (".$k['qty']." days)";

				$total_noches=$_SESSION['noches_HS']+$_SESSION['noches_LS'];
	             $precio_renta_cars=price_vehicle($id=$k['id'], $start_date=$_SESSION['cust_book']['start'], $days=$k['qty']);
	             $total_this_service=$k['qty']*$precio_renta_cars;
	   }else{
			 if (($k['type']=="Airport Pick Up") || ($k['type']=="VIP Airport Pick Up") ){
				$title=$k['details']['name'];
			 }else{
				$title=ucfirst($k['type'])." ( ".substr($k['details']['name'],0,15).")";
			 }
			$total_this_service=$k['qty']*$k['details']['price'];
	   }
     array_push($all_services_booked,  array('title'=>$title, 'qty'=>$k['qty'], 'price'=>$k['details']['price'], 'total'=>$total_this_service));
	}
 }
 $_SESSION['all_info']['service']=$all_services_booked;

/*===========================================END ACCOUNTING INFO=============================================================================================*/
    #$template=email_template($email_client=$_SESSION['customer']['email'], $booking_no=$_SESSION['cust_book']['ref'], $array_info=$_SESSION['all_info'], $ip='');
    #echo $template;
 ?>