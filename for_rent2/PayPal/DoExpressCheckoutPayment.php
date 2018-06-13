<?php
error_reporting(E_ALL & ~E_NOTICE);// Report all errors except E_NOTICE
/**********************************************************
DoExpressCheckoutPayment.php

This functionality is called to complete the payment with
PayPal and display the result to the buyer.

The code constructs and sends the DoExpressCheckoutPayment
request string to the PayPal server.

Called by GetExpressCheckoutDetails.php.

Calls CallerService.php and APIError.php.

**********************************************************/

require_once 'CallerService.php';
require_once('init.php');
session_start();


ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);



/* Gather the information to make the final call to
   finalize the PayPal payment.  The variable nvpstr
   holds the name value pairs
   */
$token =urlencode( $_SESSION['token']);
$paymentAmount =urlencode ($_SESSION['TotalAmount']);
$paymentType = urlencode($_SESSION['paymentType']);
$currCodeType = urlencode($_SESSION['currCodeType']);
$payerID = urlencode($_SESSION['payer_id']);
$serverName = urlencode($_SERVER['SERVER_NAME']);

$nvpstr='&TOKEN='.$token.'&PAYERID='.$payerID.'&PAYMENTACTION='.$paymentType.'&AMT='.$paymentAmount.'&CURRENCYCODE='.$currCodeType.'&IPADDRESS='.$serverName ;



 /* Make the call to PayPal to finalize payment
    If an error occured, show the resulting errors
    */
$resArray=hash_call("DoExpressCheckoutPayment",$nvpstr);

/* Display the API response back to the browser.
   If the response from PayPal was a success, display the response parameters'
   If the response was an error, display the errors received using APIError.php.
   */
$ack = strtoupper($resArray["ACK"]);


	if($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING'){
		$_SESSION['reshash']=$resArray;
		$location = "APIError.php";
		header("Location: $location");
    }
//===================================DO THE RESERVATIONS AND SAVE INFORMATION ONLY IF PAYMENT HAS BEEN APROVED=======================================================
	if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
		 //$link=new DB;
		 $database=new DB;
		 $savedPayment=$database->checkTokenPayment($tk=$_SESSION['token']);
		 if(!$savedPayment){
		  //IF NOT CLIENT SESSION ID, INSERT CLIENT
		  //SAVE RESERVATION
		  //SAVE SERVICES
		  //SAVE EXCURSION
		  /*=====================================================================================================================*/
		 $new_busy=check_villa_new($_SESSION['villa_details']['id'], $_SESSION['desde'], $_SESSION['hasta']);/*check if this villa is available*/
		 $cant_new=count($new_busy);
		 if(!$cant_new>0){

			 	$db= new subDB();
			//------varibles para el cliente----//
			if(!$_SESSION['customer_id']){
				if (!$_SESSION['customer']){
					$intermediario=$_SESSION['agent_id'];
					$password=$_SESSION['C']['pa'];
					$name_client=$_SESSION['C']['n'];
					$lastname_client=$_SESSION['C']['ln'];
					$email=$_SESSION['C']['el'];
					$phone=$_SESSION['C']['ph'];
					$phone2=$_SESSION['C']['ph2'];
					$fax=$_SESSION['C']['fx'];
					$cedula=$_SESSION['C']['c'];
					$passport=$_SESSION['C']['p'];
					$language=$_SESSION['C']['lg'];
					$zip=$_SESSION['C']['zp'];
					$address=$_SESSION['C']['ad'];
					$country=$_SESSION['C']['cy'];
					$state=$_SESSION['C']['state'];
					$city=$_SESSION['C']['city'];
					$photo="";
					$comentario="How did you hear about us? ".$_SESSION['C']['ha'];
					if ($_SESSION['C']['rn']!=""){$comentario.=": ".$_SESSION['C']['rn']; }
					$comentario.=" (IP:".$_SERVER['REMOTE_ADDR'].")";
					if ($_SESSION['buy']==1){$comentario.="<br/> This client is interested in purchase information"; }

					$active="1";
					$class="0";
					$id_adm="0";
					$ename=$_SESSION['C']['ne'];
					$ephone=$_SESSION['C']['phe'];

					//-----------terminan variales del cliente----------//
					$id_client=$db->newCustomer_online($intermediario, $password, '1', $name_client, $lastname_client, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $id_adm, '0', $ename, $ephone, $_SESSION['buy']); //save new client				
					
				}else{//if the client logged in
					$id_client=$_SESSION['customer']['id'];
				}
			}else{/*DO THE TASK BELOW IF EMAIL IS FOUND REGISTERED ALREADY IN THE SYSTEM*/
				/*echo "<pre>"; print_r($_SESSION['C']);echo "</pre>";*/
				   $intermediario=$_SESSION['agent_id'];
					$name_client=$_SESSION['C']['n'];
					$lastname_client=$_SESSION['C']['ln'];
					$email=$_SESSION['C']['el'];
					$phone=$_SESSION['C']['ph'];
					$country=$_SESSION['C']['cy'];
			
					$comentario="How did you hear about us? ".$_SESSION['C']['ha'];
					if ($_SESSION['C']['rn']!=""){$comentario.=": ".$_SESSION['C']['rn']; }
					$comentario.=" (IP:".$_SERVER['REMOTE_ADDR'].")";
					if ($_SESSION['buy']==1){$comentario.="<br/> This client is interested in purchase information"; }					
				//-------SI EL CLIENTE YA EXISTE ENTONCES SE ACTUALIZA CON LOS NUEVOS DATOS------/
					  
					  $info=array('id_commission'=>$intermediario,
								  'name'=>$name_client,
								  'lastname'=>$lastname_client,
								  'email'=>$email,
								  'phone'=>$phone,
								  'country'=>$country,
								  'info'=>$comentario);
					   $datos=$db->update_gral($_SESSION['customer_id'], $info, 'customers'); 
					   $id_client=$_SESSION['customer_id'];
					//------------FINALIZO ACTULIZANDO CLIENTE------------------------------------/
			}/*END UPDATING CLIENT INFO HERE*/
				/*$deposit=$resArray["AMT"]-$resArray["FEEAMT"];*//*REMOVE FEES*/
				//--variables para la ocupacion----//
				$starting=$_SESSION['desde'];
				$ending=$_SESSION['hasta'];
				$id_villa=$_SESSION['villa_details']['id'];
				$id_adm="0";
				//--variables para la ocupacion----//
				@$id_ocupacion=$db->insert_ocupacion_short_reserve($starting, $ending, $id_villa, $id_adm); //insert ocupation and returm id of insertion
				//-----varialbles para la reserva-----//
				$ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
				$id_customer=$id_client;
				$adults_qty=$_SESSION['C']['a'];   //no quitar todavia estos valores
				$children_qty=$_SESSION['C']['k']; //no quitar todavia estos valores
				$interm_id="0";
				$qty_nights=$_SESSION['total_noches'];
				$HS_nights=$_SESSION['noches_HS'];
				$LS_nights=$_SESSION['noches_LS'];
				$price_per_night=$_SESSION['villa_details']['p_low'];
				$priceHS=$_SESSION['villa_details']['p_high'];
				$amount_commision="0";
				$sub_total_rent=(($_SESSION['noches_LS']*$_SESSION['price_LS'])+($_SESSION['price_HS']*$_SESSION['noches_HS']));
				$ITBIS=$_SESSION['itbis'];
				$services_amount="0";
				$general_amount=$_SESSION['total'];
				/*$status="50"; */ /*temporary status no booked, only to save the info until received the payment[Invalid-no paid]*/
				$status="2"; /*---Confirmed*/
				if ($_SESSION['buy']==1){$reserve_comment.="<br/> This client is interested in purchase information"; }

				//$reserve_comment="";
				$vd=$_SESSION['villa_details'];

				//-----variables para la reserva-----//

				@$id_reserve=$db->insert_short_reserva_online($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment, "1");  //INSERT RESERVE AND TAKE IT ID

				//--------------- INSERT SERVICES BELOW----------------------------------------------------------------------------------
                $all_services_booked=array();
				if ($_SESSION['massage']>0){ $db->insert_additional_services($_SESSION['massage'], $id_reserve, $qty=1, $_POST['massage_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['massage']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['massage_amount']));
				}
				if ($_SESSION['pickup']>0){ $db->insert_additional_services($_SESSION['pickup'], $id_reserve, $qty=1, $_POST['pickup_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['pickup']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['pickup_amount']));
				}
				if ($_SESSION['VIPpickup']>0){ $db->insert_additional_services($_SESSION['VIPpickup'], $id_reserve, $qty=1, $_POST['VIPpickup_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['VIPpickup']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['VIPpickup_amount']));
				}
				if ($_SESSION['chef']>0){ $db->insert_additional_services($_SESSION['chef'], $id_reserve, $qty=1, $_POST['chef_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['chef']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['chef_amount']));
				}
				if ($_SESSION['fridge']>0){ $db->insert_additional_services($_SESSION['fridge'], $id_reserve, $qty=1, $_POST['fridge_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['fridge']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['fridge_amount']));
				}
				/*if ($_POST['cars_id']>0){ $db->insert_additional_services($_POST['cars_id'], $id_reserve,$_POST['cars_days'], $_POST['cars_amount'], $comment="");    //INSERT RENTAL CARS
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['carros']['title'], 'qty'=>$_POST['cars_days'], 'price'=>'', 'total'=>$_POST['cars_amount']));
				} */
				if ($_POST['chofer_id']>0){ $db->insert_additional_services($_POST['chofer_id'], $id_reserve,$_POST['chofer_days'], $_POST['chofer_amount'], $comment="");    //INSERT CHOFER SERVICES
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['chofer']['title'], 'qty'=>$_POST['chofer_days'], 'price'=>'', 'total'=>$_POST['chofer_amount']));
				}

				if ($_POST['laundry_id']>0){ $db->insert_additional_services($_POST['laundry_id'], $id_reserve,$qty=1, $_POST['laundry_amount'], $comment="");    //laundry
				     array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['laundry']['title'], 'qty'=>'', 'price'=>'', 'total'=>$_POST['laundry_amount']));
				}
				if ($_POST['dish_id']>0){ $db->insert_additional_services($_POST['dish_id'], $id_reserve,$_POST['dish_days'], $_POST['dish_amount'], $comment="");    //dish washing
				    array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['dish']['title'], 'qty'=>$_POST['dish_days'], 'price'=>'', 'total'=>$_POST['dish_amount']));
				}
				$_SESSION['servicios_selected']=$all_services_booked;

				/*===================================insert cars no charge them to RCL=======================================*/
				if($_SESSION['cars']){ /*si hay carros seleccionados*/
                 //insertarlos en la base de datos
                  foreach($_SESSION['cars'] AS $k){
                  	$total4thiscar=$_SESSION['cars_qty'][$k]*$_SESSION['car_price'][$k];
                  	$car_taxes=$total4thiscar*0.18;
	                 $inf_data=array('ref'=>$ref,
					                 'date'=>date("Y-m-d G:i:s"),
					                 'qty_days'=>$_SESSION['cars_qty'][$k],
					                 'id_car'=>$k,
					                 'price'=>$_SESSION['car_price'][$k],
					                 'taxes'=>$car_taxes,
					                 'status'=>'1',
					                 'ip_address'=>$_SERVER['REMOTE_ADDR'],
					                 'user_id'=>'0');

				  	$in_cars=$db->insert_gral($inf_data, $table='cars_rented');
				  }
				}
				/*============================================================================================================*/
				//------------------END INSERTING SERVICES--------------------------------------------------------------------------------
				$adults_qty=$_SESSION['C']['a'];
				$children_qty=$_SESSION['C']['k'];

					if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
					  for ($x=1;$x<=$adults_qty; $x++){
					  	$a_name="a_name$x"; $a_lastname="a_lastname$x";
					  	$name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];
					    $db->insert_adults($id_reserve, $name, $lastname, $cedula="");
					  }
					}

					if ($children_qty>0){    //si la cantidad de niños sobrepasa 1 entonces son insertado en la base de datos
					  for ($c=1;$c<=$children_qty; $c++){
					  	$c_name="c_name$c"; $c_lastname="c_lastname$c";
					  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname];
					    $db->insert_children($id_reserve, $name, $lastname, $passport="");
					  	}
					}
				 //-----------------------DISCOUNT FOR THIS BOOKING-------------------------------------------------------------------------------------
				   if ($_SESSION['promo_id']>0){
				     $link= new getQueries();
				     $descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');//details discount before saved as discount
				     $desc=$descuento_anterior[0];
			     	 $this_pro=$link->show_active_limit1("promotion", "id", $_SESSION['promo_id'], "=");//details for this promotion
			     	   $pro=$this_pro[0];
					  if ($descuento_anterior){
					  	$id_upd_d=$db->insert_discount_modified($desc['fecha'],$desc['reference'],$desc['pro_code'],$desc['pro_id'],$desc['pro_from'],$desc['pro_to'],$desc['pro_type'],$desc['pro_qty'], $desc['id_adm']);
					   $actualizarlo=$db->update_discount($desc['id'],$ref,$pro['code'],$pro['id'],$pro['desde'],$pro['hasta'],$pro['tipo'],$pro['cant_porc'], $id_adm,$id_upd_d);
					  }else{

						$result=$db->insert_discount($ref,$pro['code'],$pro['id'],$pro['desde'],$pro['hasta'],$pro['tipo'],$pro['cant_porc'], $min_days='',$qty_days='',$id_adm='');
						//insert_discount($ref,$pro_code,$pro_id,$pro_from,$pro_to,$pro_type,$pro_qty,$min_days,$qty_days, $id_adm)
					  }
					 // unset($_SESSION['promotion_id']);
				    }
			   //----------------------- TERMINA DISCOUNT FOR THIS BOOKING ----------------------------------------------------------------------------

				    if($_SESSION['evento']){ /* GUARDAR EVENTO SI HAY EN LA SESSION*/
				     //print_r($_SESSION['evento']);
				     $fecha=date("Y-m-d G:i:s");
				     $result=$db->insert_events_saved($fecha,$ref,$_SESSION['evento']['name'],$_SESSION['evento']['from_date'],$_SESSION['evento']['to_date'],$_SESSION['evento']['qty'],$_SESSION['evento']['type'],$_SESSION['evento']['increase'], $id_adm, $_SESSION['evento']['id']);

				    }
				   /* TERMINO DE GUARDAR LOS EVENTOS*/

			    	if ($_SESSION['WEBSITE']){
		                  $result=$db->in_webpage($ref, $_SESSION['WEBSITE']);
		            }  //END WEBPAGE  URL
		      //----------------- save this website as a referral------------------------------------------------
                    $_SESSION['REFERRALID']=$_SESSION['agent_id'];

		            if ($_SESSION['REFERRALID']>0){
						    $link= new getQueries();
						    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');

							  if ($referido_anterior){
							  	$id_update=$db->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
							    $actualizado=$db->update_assign($referido_anterior[0]['id'], $ref, $_SESSION['REFERRALID'], $id_adm, $id_update);
							  }else{

								$result=$db->Assign_a_booking($ref, $_SESSION['REFERRALID'], $id_adm);
							  }
				    }
		     //INSERTAR EXCURSIONES MAS ABAJOS
		      if ($_SESSION['excursions']){
		       $all_excur_booked=array();
		      	foreach($_SESSION['excursions'] AS $k){
					$id_excursion=$k;
					$id_reserva=$id_reserve;
					$qty_adult=$_SESSION['excur'][$k]['adults'];
					$qty_child=$_SESSION['excur'][$k]['kids'];
					$precio_a=$_SESSION['excur'][$k]['pa'];
					$precio_c=$_SESSION['excur'][$k]['pc'];
					$total_excursion=(($qty_adult*$precio_a)+($qty_child*$precio_c));
		         	$excursiones=$db->in_excur_booked($id_excursion, $id_reserva, $qty_adult, $qty_child, $precio_a, $precio_c, $total_excursion); //insert ocupation and returm id of insertion
		         	array_push($all_excur_booked, array('title'=>$_SESSION['excur'][$k]['title'], 'adult'=>$qty_adult, 'kid'=>$qty_child, 'Pa'=>$precio_a, 'Pk'=>$precio_c, 'total'=>$total_excursion));
		      	}
		      	 $_SESSION['all_info']['excursion']=$all_excur_booked;
		    }
		  /*=====================================================================================================================*/
			$savePayment=$database->paypalPayments($tk=$_SESSION['token'], $book=$ref, $data=json_encode($resArray));/*save info a payments*/
			$savePaid=$database->savePaypalAmount($ref, $resArray['AMT'], $resArray['TRANSACTIONID']);
			//send notification to rcl
		}
	}
 }
?>


<? 
include('../template/header.pp.php');
//Send email to client

$total_sin_impuestos=($general_amount/1.18);//RETURN QUANTITIES WITHOUT TAXES
$impuestos=number_format(($total_sin_impuestos*0.18),2);
$PAYMENT_DUE=number_format(($general_amount-$resArray['AMT']),2);
$villa_number=$vd['no'];
$general_amount=number_format($general_amount,2);
$body="<!doctype html>
<html>
<head>
<meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<title>Booking Confirmation-Residencial Casa Linda</title>
<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
</head>


<body>
<div class=\"container\">
<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

<p>&nbsp;</p>
<p>Dear $name_client $lastname_client,</p>

<p>Thank you for booking with Residencial Casa Linda,
<p><strong>BOOKING CONFIRMATION: $ref.
  
  </strong>
<p><strong>To stay in villa $villa_number for $qty_nights nights<br>
  Check-In $starting		 Check-in time: 3.00 PM<br>
  Check-Out
</strong><strong> $ending
  Check-out time: 12.00 Noon<br>
  <br>
  Price: $total_sin_impuestos USD
  <br>
  Taxes:
  $impuestos USD<br>
  Total price: $general_amount USD<br>
  Balance due: $PAYMENT_DUE USD</strong></p>
<p>  <br>
  Bring yours and all adults who checks in with you passport or Valid ID into the check-in office in order to check-in.<br>
  We will ask for a security deposit of 75USD per room, this can be in cash or 
  CC slip.<br>
</p>
<p>Our office is located on the first gate to the left on El Choco Road.  </p>
<p>  Upon arrival you will recieve all controls and keys for the villa, when you come to the villa there will be a free water 5-gallon.
  <br>
  If you need any more come by the office with the empty one and for a small fee we will replace it for a full one.
  <br>
  There will also be an inventory list of what was there upon check-in from our staff, 
  please go through this as you are responsible for any breakage in the villa during your stay. <br>
  <br>
 You will recieve a one time welcome package in the villa:</p>
<ul>
  <li>Coffee</li>
  <li>Shampoo</li>
  <li>Bodywash</li>
  <li>Dish Soap</li>
  <li>Sponge</li>
</ul>
<p>Residencial Casa Linda strives to create the best relaxed and enjoyable vacations for all of our clients.<br>
  Therefore please respect our rules regarding parties and loud noices during your stay, more info will be give upon arrival.
</p>
<p>Daily housekeeping and pool service is included in your villa as well as Free shuttle bus from Sosua to Cabarete on a schedule.<br>
  <br>
  Don\'t miss out on our extra services we offer, airport pickup, excursions, car rental and more!<br>
More info on our website!</p>
<p>Best wishes,
  The Casa Linda team!</p>
<p>If you have any questions feel free to contact us.<br>
  Residencial Casa Linda <br>
  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
  Tel: +1 809 571 1190 <br>
  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
  <a href=\"mailto:Frontdesk@casalindacity.com\">Frontdesk@casalindacity.com</a></p>
<p><small><strong>Unless you have paid in full, remember that you will receive invoices as we are closing up to arrival date (as per cancellation rules). <br>
Failure in doing this may result in a cancellation.
This way you will be fully paid for a smoother check-in.</strong></small> <strong><br>
<small><a href=\"http://www.casalindacity.com/Terms_and_conditions.php\" target=\"new\">Terms and Conditions </a></small></strong></p>
</div>
</body>
</html>";

sendMail_copy_reservations($body, $address=$email, $subject="Confirmation booking no:$ref", $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');
//save email sent for records

/*echo $body;*/

//-------SI EL CLIENTE YA EXISTE ENTONCES SE ACTUALIZA CON LOS NUEVOS DATOS------/
					  $db= new subDB();
					  $info5=array('email'=>$email, 'ref'=>$ref, 'msg'=>utf8_encode($body), 'date'=>time());
								  
					   $datos=$db->insert($info5, 'confirmation_sent'); 
					//------------FINALIZO ACTULIZANDO CLIENTE------------------------------------/
?>
<div class="cuerpo">
		<br>
		<center>
		<font size=2 color=black face=Verdana><b>Booking Created!</b></font>
		<br><br>

		<b>Order Processed! Thank you for your payment!</b><br><br>
		<p>&nbsp;</p>
		<h1>Your booking Number is: <?=$ref?></h1>
		<P>Please save this number to be used when contacting our offices</p>

    <!--<table width =400>-->

         <?php
   		 	/*require_once 'ShowAllResponse.php';*/
    	 ?>
   <!-- </table>-->
    </center>
    <a class="home" id="CallsLink" href="http://www.CasaLindaCity.com">Home Page</a>
</div>
<? include('../template/footer.pp.php');?>