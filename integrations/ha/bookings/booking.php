<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	require('inc/SimpleRest.php');
	require('inc/funct.php');
	require_once('../../../booking/init.php');
	$sr=new SimpleRest();
	$statusCode=http_response_code();
	$contentType='application/xml';
	$contentType1='text/html';
	$contentType2='application/json';
	$sr->setHttpHeaders($contentType, $statusCode);

	$postBody = file_get_contents("php://input");
				  //  $postBody = json_decode($postBody);
					
					//echo $postBody;

	//$xmlfile = file_get_contents($path);

	$xmlfile = $postBody;
	$ob= simplexml_load_string($xmlfile);//Interprets a string of XML into an object
	$json  = json_encode($ob);//Returns the JSON representation of a value
	$configData = json_decode($json, true);//Decodes a JSON string
	 
	$ha_villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$ha_villa_url=trim($configData['bookingRequestDetails']['propertyUrl']);
	$ha_channel=trim($configData['bookingRequestDetails']['listingChannel']);
	$ha_mchannel=trim($configData['bookingRequestDetails']['masterListingChannel']);
	$ha_client_ip=trim($configData['bookingRequestDetails']['clientIPAddress']);
	$ha_client_msg=trim($configData['bookingRequestDetails']['message']);
	$ha_cl_tit=trim($configData['bookingRequestDetails']['inquirer']['title']);
	$ha_cl_fn=trim($configData['bookingRequestDetails']['inquirer']['firstName']);
	$ha_cl_ln=trim($configData['bookingRequestDetails']['inquirer']['lastName']);
	$ha_cl_ema=trim($configData['bookingRequestDetails']['inquirer']['emailAddress']);
	$ha_cl_pho=trim($configData['bookingRequestDetails']['inquirer']['phoneNumber']);
	
	
	$ha_cl_add=trim($configData['bookingRequestDetails']['inquirer']['address']['addressLine1']);
	$ha_cl_add1=trim($configData['bookingRequestDetails']['inquirer']['address']['addressLine3']);
	$ha_cl_add2=trim($configData['bookingRequestDetails']['inquirer']['address']['addressLine4']);
	$ha_cl_add3=trim($configData['bookingRequestDetails']['inquirer']['address']['country']);
	$ha_cl_add4=trim($configData['bookingRequestDetails']['inquirer']['address']['postalCode']);
	//echo $ha_cl_fn; echo " ".$ha_cl_ln;
	
	$ha_res_adu=trim($configData['bookingRequestDetails']['reservation']['numberOfAdults']);
	$ha_res_kid=trim($configData['bookingRequestDetails']['reservation']['numberOfChildren']);
	$ha_res_pet=trim($configData['bookingRequestDetails']['reservation']['numberOfPets']);
	
	$ha_res_beg=trim($configData['bookingRequestDetails']['reservation']['reservationDates']['beginDate']);
	$ha_res_end=trim($configData['bookingRequestDetails']['reservation']['reservationDates']['endDate']);
	
	$ha_ord_pta=trim($configData['bookingRequestDetails']['orderItemList']['orderItem']['preTaxAmount']);
	$ha_ord_tam=trim($configData['bookingRequestDetails']['orderItemList']['orderItem']['totalAmount']);
	
	/*$ha_res_adu=trim($configData['bookingRequestDetails']['reservation']['numberOfAdults']);
	$ha_res_adu=trim($configData['bookingRequestDetails']['reservation']['numberOfAdults']);
	$ha_res_adu=trim($configData['bookingRequestDetails']['reservation']['numberOfAdults']);
	$ha_res_adu=trim($configData['bookingRequestDetails']['reservation']['numberOfAdults']);*/
	/*$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);
	$villa_id=trim($configData['bookingRequestDetails']['unitExternalId']);*/
	 
	if(!empty($postBody)){	

	//save info in database of HA
		$data=new DB();
		$info=array('txt'=>$postBody,
					'ip'=>$_SERVER['REMOTE_ADDR'],
					'type'=>1,
					'date'=>time());
		/*
		case type: 1=booking; 2-Quote; 3-bookingUpdate; 4-fastAvailability
		*/					
		$saveRequest = $data->insert_id($info, $table='ha');
		//=================START VALIDATING DATA===================================
		$ckin=validateDate($ha_res_beg, 'Y-m-d'); # true
		if(!$ckin==1){
			die('Error: invalid checkin date');
		}
		
		$ckout=validateDate($ha_res_end, 'Y-m-d'); # true
		if(!$ckout==1){
			die('Error: invalid checkout date');
		}
		
		$night_qty=daysDifference2($fecha_de_termino=$ha_res_end, $fecha_de_inicio=$ha_res_beg);
		
			if($night_qty>=2){/*validate quantity of nights*/
				if((trim($ha_villa_id)=='')||(!$ha_villa_id>0)){
					die('Error: villa id is missing');
				}
				 $link= new getQueries();
				 $villa=$link->show_id($table='villas', $id=$ha_villa_id);
				 
				 if(empty($villa[0])){ die('Error: Property not found'); }
				 
				 $v=$villa[0];
				 
				if($ha_res_adu>$v['capacity']){ 
					$error_list0="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
								<bookingResponse>
									<documentVersion>1.2</documentVersion>
									<errorList>
										<error>
											<errorType>EXCEEDS_MAX_OCCUPANCY</errorType>
											<message>Guest Limit Exceeded</message>
										</error>
									</errorList>
								</bookingResponse>";
					echo $error_list0;
					die();
				}
			 //======================== START CREATE BOOKING IN RCL DATABASE================================
				
				if(trim($ha_res_beg)==''){
					/*$error_list="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
								<bookingResponse>
									<documentVersion>1.2</documentVersion>
									<errorList>
										<error>
											<errorType>MIN_STAY_NOT_MET</errorType>
											<message>Property requires a longer stay</message>
										</error>
									</errorList>
								</bookingResponse>";*/
					die('Error: checkin date is missing');
				}
				if(trim($ha_res_end)==''){
					die('Error: checkout data is missing');
				}
				if(trim($ha_cl_ema)==''){
					die('Error: email address is missing');
				}
				if(trim($ha_cl_fn)==''){
					die('Error: please, verify first name');
				}
				if(trim($ha_cl_ln)==''){
					die('Error: last name is missing');
				}
				if(trim($ha_cl_pho)==''){
					die('Error: missing phone number');
				}
				if((trim($ha_res_adu)=='')||(!$ha_res_adu>0)){
					die('Error: please, verify the adult quantity');
				}
				if((trim($ha_ord_tam)=='')||(!$ha_ord_tam>0)){
					die('Error: total amount is not valid');
				}
				/*if((trim($_POST['amount_paid'])=='')||(!$_POST['amount_paid']>0)){
					die('Error: please, verify the amount paid');
				}
				if(trim($_POST['pp_transc_id'])==''){
					die('Error: invalid transaction ID');
				}
				if((trim($_POST['unit_price'])=='')||(!$_POST['unit_price']>0)){
					die('Error: nightly price per this unit is missing');
				}*/
				
				
			
				$new_busy=check_villa_new($ha_villa_id, $ha_res_beg, $ha_res_end);/*check if this villa is available*/
				 $cant_new=count($new_busy);
				if(!$cant_new>0){/*if villa is available*/
					$data= new subDB();
					//created booking in the system
						if (!filter_var($ha_cl_ema, FILTER_VALIDATE_EMAIL)){
							$error['email1']='Email is not valid';
						}else{
						//search for email in db
							//$link= new getQueries();
							$result=$link->checkEmail($ha_cl_ema);
							if ($result[0]['email']==$ha_cl_ema){// $_GET['error']['email']='Email already registered:'.$result[0]['id'];
								$id_customer=$result[0]['id'];
								//CHECK THAT CLIENT IS NOT BLACKLISTED
								if($result[0]['active']==0){/*CLIENT IS BLACKLISTED*/
									//$error['blacklisted']=true;
								}
								//$_SESSION['error']['email']='Email already registered,<br/> Please login to book';
							}
						}
						if (!$id_customer){//insert client if not found in database
							$intermediario='';
							$password='';
							$name_client=$ha_cl_fn;
							$lastname_client=$ha_cl_ln;
							$email=$ha_cl_ema;
							$phone=$ha_cl_pho;
							$phone2='';
							$fax='';
							$cedula='';
							$passport='';
							$language='';
							$zip=$ha_cl_add4;
							$address=$ha_cl_add;
							$country=$ha_cl_add3;
							$state=$ha_cl_add2;
							$city=$ha_cl_add1;
							$photo="";
							$comentario.="Booking received via RESTful HA (IP:".$_SERVER['REMOTE_ADDR'].")";
							$active="1";
							$class="0";
							$id_adm="0";
							$ename='';
							$ephone='';

							//-----------terminan variales del cliente----------//
							$id_customer=$data->newCustomer_online($intermediario, $password, '1', $name_client, $lastname_client, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $id_adm, '0', $ename, $ephone, ''); //save new client				
						}
						
					   $id_ocupacion=$data->insert_ocupacion_short_reserve($starting=$ha_res_beg, $ending=$ha_res_end, $id_villa=$ha_villa_id, $id_adm=0); //insert occupation and return id of insertion
					   $ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
					   
					   $source=12;//user from RESTful
					   
					   
					  $ITBIS=(($ha_ord_tam/1.18)*0.18);
					   $sub_total_rent=($ha_ord_tam-$ITBIS);
					   $price_per_night=($sub_total_rent/$night_qty);
						//=================INSERT RESERVATION=================================
					   $info3=array('ref'=>$ref,
							'id_occupancy'=>$id_ocupacion,
							'id_client'=>$id_customer,
							'adults'=>$ha_res_adu,
							'children'=>$ha_res_kid,
							'vehicles'=>'',
							'id_interm'=>'',
							'qty_nights'=>$night_qty,
							'nightsHS'=>0,
							'nightsLS'=>$night_qty,
							'price_per_night'=>$price_per_night,
							'priceHS'=>0,
							'commision'=>'',
							'amount'=>$sub_total_rent,
							'tax'=>$ITBIS,
							'services_amount'=>'',
							'deposit'=>'',
							'total'=>$ha_ord_tam,
							'status'=>3,
							'comment'=>'Booking made via RESTful connection HA',
							'pagos_qty'=>'',
							'pagos_monto'=>'',
							'price_long'=>'',
							'extra_nights'=>'',
							'online'=>$source,
							'ip'=>$_SERVER['REMOTE_ADDR'],
							'hearabout'=>'',
							'paid'=>'',
							'api_bookings_id'=>$saveRequest);	
							
						$data->insert($info3, $table='reserves');
					
					//==============END CREATING BOOKING IN RCL DATABASE===================================
				
				
				//======================START SHOWING RESPONSE=================================
				
				$externalId=$id_ocupacion; //reservacion id
				$status='UNCONFIRMED';//Reservation on hold for payment and/or final confirmation
				$rental_status='ACCEPTED';
				$url_cancellation='https://rentals.casalindacity.com/vacationrentals/terms-conditions.php';
				$additional_deposit='An addition damage deposits of $75/per bedroom must be charged upon arrival and will be refunded 24-hours after check out if there are no damages or missing items in the villa.';
				$reservation_payment_status='UNPAID';
				$ckin_time='15:00';
				$ckout_time='12:00';
				$due_date=date('Y-m-d');
				//$status='CONFIRMED';//Reservation and payment
				
						$response="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
						<bookingResponse>
							<documentVersion>1.2</documentVersion>
							<bookingResponseDetails>
								<advertiserAssignedId>CASA_LINDA</advertiserAssignedId>
								<listingExternalId>$ha_villa_id</listingExternalId>
								<unitExternalId>$ha_villa_id</unitExternalId>
								<externalId>$externalId</externalId>
								<locale>en_US</locale>
								<orderList>
									<order>
										<currency>USD</currency>
										<orderItemList>
											<orderItem>
												<description>Rent</description>
												<feeType>RENTAL</feeType>
												<name>Rent</name>
												<preTaxAmount currency=\"USD\">$sub_total_rent</preTaxAmount>
												<status>$rental_status</status>
												<totalAmount currency=\"USD\">$ha_ord_tam</totalAmount>
											</orderItem>
										</orderItemList>
										<paymentSchedule>
											<acceptedPaymentForms>
												<paymentCardDescriptor>
													<paymentFormType>CARD</paymentFormType>
													<cardCode>VISA</cardCode>
													<cardType>CREDIT</cardType>
												</paymentCardDescriptor>
												<paymentCardDescriptor>
													<paymentFormType>CARD</paymentFormType>
													<cardCode>MASTERCARD</cardCode>
													<cardType>CREDIT</cardType>
												</paymentCardDescriptor>
												<paymentCardDescriptor>
													<paymentFormType>CARD</paymentFormType>
													<cardCode>DISCOVER</cardCode>
													<cardType>CREDIT</cardType>
												</paymentCardDescriptor>
												<paymentInvoiceDescriptor>
													<paymentFormType>INVOICE</paymentFormType>
													<paymentNote>A note about invoice processing</paymentNote>
												</paymentInvoiceDescriptor>
											</acceptedPaymentForms>
											<paymentScheduleItemList>
												<paymentScheduleItem>
													<amount currency=\"USD\">$ha_ord_tam</amount>
													<dueDate>$due_date</dueDate>
												</paymentScheduleItem>
											</paymentScheduleItemList>
										</paymentSchedule>
										<reservationCancellationPolicy>
											<description>$url_cancellation</description>
										</reservationCancellationPolicy>
										<stayFees>
											<stayFee>
												<description>$additional_deposit</description>
											</stayFee>
										</stayFees>
									</order>
								</orderList>
								<rentalAgreement>
									<agreementText>$url_cancellation</agreementText>
								</rentalAgreement>
								<reservationPaymentStatus>$reservation_payment_status</reservationPaymentStatus>
								<reservation>
									<numberOfAdults>$ha_res_adu</numberOfAdults>
									<numberOfChildren>$ha_res_kid</numberOfChildren>
									<numberOfPets>0</numberOfPets>
									<reservationDates>
										<beginDate>$ha_res_beg</beginDate>
										<endDate>$ha_res_end</endDate>
									</reservationDates>
									<checkinTime>$ckin_time</checkinTime>
									<checkoutTime>$ckout_time</checkoutTime>
									<reservationOriginationDate>".gmdate("Y-m-d\TH:i:s\Z")."</reservationOriginationDate>
								</reservation>
								<reservationStatus>$status</reservationStatus>
							</bookingResponseDetails>
						</bookingResponse>";

						echo $response;
				//======================END SHOWING RESPONSE=================================
				}else{
					$error_list0="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
								<bookingResponse>
									<documentVersion>1.2</documentVersion>
									<errorList>
										<error>
											<errorType>PROPERTY_NOT_AVAILABLE</errorType>
											<message>Property is not available in submitted dates</message>
										</error>
									</errorList>
								</bookingResponse>";
					echo $error_list0;
					die();
				}
			}else{
				$error_list0="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
								<bookingResponse>
									<documentVersion>1.2</documentVersion>
									<errorList>
										<error>
											<errorType>MIN_STAY_NOT_MET</errorType>
											<message>Property requires a longer stay</message>
										</error>
									</errorList>
								</bookingResponse>";
				echo $error_list0;
				die();
			}
		
	
	//verify if villa is available and all requirement are ok. Then created the booking with source from HA
	
	
	//Common Errors
	//MIN_STAY_NOT_MET 
	//EXCEEDS_MAX_OCCUPANCY – Traveler will see message Guest Limit Exceeded
	//PROPERTY_NOT_AVAILABLE
	//EXCEEDS_MAX_STAY
	//Quote Response Error Sample:   
/*	
	<?xml version="1.0" encoding="UTF-8"?>
	<quoteResponse>
		<documentVersion>1.2</documentVersion>
		<errorList>
			<error>
				<errorType>MIN_STAY_NOT_MET</errorType>
				<message>Property requires a longer stay</message>
			</error>
		</errorList>
	</quoteResponse>
*/

		
		//email to rcl notifying about the booking
	}else{
		 http_response_code(409);//Conflict
	}
		
}else{
	 http_response_code(400);//Bad Request
}

?>