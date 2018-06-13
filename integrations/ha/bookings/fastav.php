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
	$sr->setHttpHeaders($contentType2, $statusCode);

	$postBody = file_get_contents("php://input");
	//$json  = json_encode($postBody);//Returns the JSON representation of a value
	//print_r($inf);
	if(!empty($postBody)){	
		$inf = json_decode($postBody, true);//Decodes a JSON string
		$ha_sys_id=$inf['systemExternalId']; //echo ":A<br/>";
		$ha_adv_id=$inf['advertiserExternalId']; //echo ":B<br/>";
		$ha_lis_id=$inf['listingExternalId']; //echo ":C<br/>";
		$ha_arrival=$inf['dateRange']['arrivalDate']; //echo ":D<br/>";
		$ha_departure=$inf['dateRange']['departureDate']; //echo ":E<br/>";
		$ha_adult=$inf['adults']; //echo ":F<br/>";
		$ha_kids=$inf['children']; //echo ":G<br/>";
		$ha_pets=$inf['pets']; //echo ":H<br/>";
		$ha_villa_id=$inf['units'][0]['unitExternalId']; //echo ":I<br/>";
		//save info in database of HA
		$data=new DB();
		$info=array('txt'=>$postBody,
					'ip'=>$_SERVER['REMOTE_ADDR'],
					'type'=>4,
					'date'=>time());
		/*
		case type: 1=booking; 2-Quote; 3-bookingUpdate; 4-fastAvailability
		*/					
		$saveRequest = $data->insert_id($info, $table='ha');
		//=================START VALIDATING DATA===================================
		$ckin=validateDate($ha_arrival, 'Y-m-d'); # true
		if(!$ckin==1){
			die('Error: invalid checkin date');
		}
		
		$ckout=validateDate($ha_departure, 'Y-m-d'); # true
		if(!$ckout==1){
			die('Error: invalid checkout date');
		}
		
		$night_qty=daysDifference2($fecha_de_termino=$ha_departure, $fecha_de_inicio=$ha_arrival);
		
		if((trim($ha_villa_id)=='')||(!$ha_villa_id>0)){
			die('Error: villa id is missing');
		}
		
		$link= new getQueries();
		$villa=$link->show_id($table='villas', $id=$ha_villa_id);
		 
		if(empty($villa[0])){ die('Error: Property not found'); }
		 
		$v=$villa[0];
		
		$busy=$link->see_occupancy_online_3($ha_arrival, $ha_departure, $ha_villa_id);
		if(empty($busy)){
			//echo "disponible"; die();
			$available_villa="true";
		}else{
			/*echo "ocupada";
			print_r($busy);
			die();*/
			$available_villa="false";
		}
		/*if($night_qty<2){
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
		}*/
		
		$response='{"units": [{"unitExternalId": "'.$v['id'].'","available": "'.$available_villa.'"}]}';
		echo $response;
		
	}else{
		 http_response_code(409);//Conflict
	}
		
}else{
	 http_response_code(400);//Bad Request
}

?>