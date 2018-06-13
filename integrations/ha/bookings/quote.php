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
	//$postBody = json_decode($postBody);
	//echo $postBody;
	//$xmlfile = file_get_contents($path);

	$xmlfile = $postBody;
	$ob= simplexml_load_string($xmlfile);//Interprets a string of XML into an object
	$json  = json_encode($ob);//Returns the JSON representation of a value
	$configData = json_decode($json, true);//Decodes a JSON string
	
	$ha_asig_id=trim($configData['quoteRequestDetails']['advertiserAssignedId']);
	$ha_listeID=trim($configData['quoteRequestDetails']['listingExternalId']);
	$ha_villa_id=trim($configData['quoteRequestDetails']['unitExternalId']);
	$ha_villa_url=trim($configData['quoteRequestDetails']['propertyUrl']);
	$ha_lchannel=trim($configData['quoteRequestDetails']['listingChannel']);
	$ha_mchannel=trim($configData['quoteRequestDetails']['masterListingChannel']);
	$ha_client_ip=trim($configData['quoteRequestDetails']['clientIPAddress']);
	
	$ha_res_adul=trim($configData['quoteRequestDetails']['reservation']['numberOfAdults']);
	$ha_res_kid=trim($configData['quoteRequestDetails']['reservation']['numberOfChildren']);
	$ha_res_pet=trim($configData['quoteRequestDetails']['reservation']['numberOfPets']);

	$ha_res_beg=trim($configData['quoteRequestDetails']['reservation']['reservationDates']['beginDate']);
	$ha_res_end=trim($configData['quoteRequestDetails']['reservation']['reservationDates']['endDate']);
	$ha_tck_id=trim($configData['quoteRequestDetails']['trackingUuid']);

	if(!empty($postBody)){	
	//save info in database of HA
		$data=new DB();
		$info=array('txt'=>$postBody,
					'ip'=>$_SERVER['REMOTE_ADDR'],
					'type'=>2,
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
		

		if((trim($ha_villa_id)=='')||(!$ha_villa_id>0)){
			die('Error: villa id is missing');
		}
		
		$link= new getQueries();
		$villa=$link->show_id($table='villas', $id=$ha_villa_id);
		 
		if(empty($villa[0])){ die('Error: Property not found'); }
		 
		$v=$villa[0];
		 
		if($ha_res_adul>$v['capacity']){ 
			$error_list0="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
						<quoteResponse>
							<documentVersion>1.2</documentVersion>
							<errorList>
								<error>
									<errorType>EXCEEDS_MAX_OCCUPANCY</errorType>
									<message>Guest Limit Exceeded</message>
								</error>
							</errorList>
						</quoteResponse>";
			echo $error_list0;
			die();
		}	
		if($night_qty<2){
			$error_list0="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
						<quoteResponse>
							<documentVersion>1.2</documentVersion>
							<errorList>
								<error>
									<errorType>MIN_STAY_NOT_MET</errorType>
									<message>Property requires a longer stay</message>
								</error>
							</errorList>
						</quoteResponse>";
			echo $error_list0;
			die();
		}
		
		$p=$link->get_season3_prices($startdate=$ha_res_beg, $pricelow=$v['p_low'], $priceshoulder=$v['p_shoulder'], $pricehigh=$v['p_high']);	
		
		//echo $p['price']; die();
		//======================START SHOWING RESPONSE=================================
				$total_per_villa=$night_qty*$p['price'];
				$total_inc_taxes=$total_per_villa*1.18;
				
				$url_terms='https://rentals.casalindacity.com/vacationrentals/terms-conditions.php';
				$additional_deposit='An addition damage deposits of $75/per bedroom must be charged upon arrival and will be refunded 24-hours after check out if there are no damages or missing items in the villa.';
				$due_date=date('Y-m-d');
				//$status='CONFIRMED';//Reservation and payment
				
						$response="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
									<quoteResponse>
										<documentVersion>1.2</documentVersion>
										<quoteResponseDetails>
											<locale>en_US</locale>
											<orderList>
												<order>
													<currency>USD</currency>
													<orderItemList>
														<orderItem>
															<description>Rent</description>
															<feeType>RENTAL</feeType>
															<name>Rent</name>
															<preTaxAmount currency=\"USD\">$total_per_villa</preTaxAmount>
															<totalAmount currency=\"USD\">$total_inc_taxes</totalAmount>
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
																<amount currency=\"USD\">$total_inc_taxes</amount>
																<dueDate>$due_date</dueDate>
															</paymentScheduleItem>
														</paymentScheduleItemList>
													</paymentSchedule>
													<reservationCancellationPolicy>
														<description>$url_terms</description>
													</reservationCancellationPolicy>
													<stayFees>
														<stayFee>
															<description>$additional_deposit</description>
														</stayFee>
													</stayFees>
												</order>
											</orderList>
											<rentalAgreement>
												<agreementText>$url_terms</agreementText>
											</rentalAgreement>
										</quoteResponseDetails>
									</quoteResponse>";

						echo $response;
				//======================END SHOWING RESPONSE=================================
		
	}else{
		 http_response_code(409);//Conflict
	}
		
}else{
	 http_response_code(400);//Bad Request
}

?>