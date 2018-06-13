<?php
//print gmdate("Y-m-d\TH:i:s\Z");
   require_once('required/class.invoice.php');
   require_once('required/funct.php');
		
   //$executeMode=SYSTEMMETHOD;
	//$business = BUSSINESSEMAIL;
	 /*if((!$business)||(!$executeMode)){
	 die('Execution mode or bussiness email missing');
	 }*/

	//$ppInv = new PaypalInvoiceAPI($executeMode);       //pass 'live' for actual paypal account

    /**
     * Populate Data
     */
      //function below will get client and bussines details
	function  clientBusInfo($refNo, $aPagar=3){
	 //require_once('../init.php');
	 require_once('init.php');
	 $db=new getQueries (); 
	 $book=$db->see_occupancy_ref($refNo); //get reservation details
	 $cl=$db->customer($book[0]['client']);//get cliente details
	 
		$aryData=array();
          //========================================================================================================================
			$fecha=gmdate("Y-m-d\TH:i:s\Z");
			if($aPagar==0){/*due date is as invoices date*/
				
				$fechaPagar=gmdate('Y-m-d\TH:i:s\Z');
			}else{/*due date is in five days invoice date*/
				$fechaPagar=gmdate('Y-m-d\TH:i:s\Z', mktime(0, 0, 0, date('m'), date('d') + ($aPagar+1), date('Y')));
			}
			#$fechaPagar=gmdate('Y-m-d\TH:i:s\Z', mktime(0, 0, 0, date('m'), date('d') - 20, date('Y')));/*Failure:The due date occurs before the invoice date*/
           $aryData['language'] = "en_US";
		    $aryData['merchantEmail'] = BUSSINESSEMAIL;

		    $aryData['payerEmail'] = $cl['email'];
		    $aryData['currencyCode'] = "USD";
		    //$aryData['orderId'] = "0001";
		    $aryData['orderId'] = strtotime('now');
		    $aryData['invoiceDate'] =$fecha;/*date('Y-m-d').'T'.date("H:i:s");*/// date('Y-m-d');//"2011-12-31T05:38:48Z";//date('Y-m-d');
		    $aryData['dueDate'] =$fechaPagar;//date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 5, date('Y'))); //"2011-12-31T05:38:48Z";
		    $aryData['paymentTerms'] = "DueOnDateSpecified";   //[DueOnReceipt, DueOnDateSpecified, Net10, Net15, Net30, Net45]
		   

			$aryData['logoURL'] = LOGOURL;

		   /* $aryData['merchantFirstName'] = "Merchant First Name";
		    $aryData['merchantLastName'] = "Merchant Last Name";*/
		    $aryData['merchantBusinessName'] = "Residencial Casa Linda";
		    $aryData['merchantPhone'] = "1-809-571-1190";
		    $aryData['merchantFax'] = "1-809-571-1411";
		    $aryData['merchantWebsite'] = "www.CasaLidaCity.com";
		    $aryData['merchantCustomValue'] = "-quality homes-";

		    $aryData['merchantLine1'] = "Carretera Sosua-Cabarete, Entrada el Choco";
		    /*$aryData['merchantLine2'] = "Merchant Address Line 2";*/
		    $aryData['merchantCity'] = "Sosua";
		    $aryData['merchantState'] = "Puerto Plata";
		    $aryData['merchantPostalCode'] = "57000";
		    $aryData['merchantCountryCode'] = "DO";

		    $aryData['billingFirstName'] = $cl['name'];
		    $aryData['billingLastName'] = $cl['lastname'];
		    /*$aryData['billingBusinessName'] = "Billing Business Name";*/
		    $aryData['billingPhone'] = $cl['phone'];
		    /*$aryData['billingFax'] = "Billing Fax";*/
		    /*$aryData['billingWebsite'] = "Billing Website";*/
		    /*$aryData['billingCustomValue'] = "Billing Custom Value";*/
			if($cl['address']==''){$cl['address']='NA';}/* line 1 is required*/
		    $aryData['billingLine1'] = $cl['address'];/*REQUIRED*/
		   /* $aryData['billingLine2'] = "Billing Line 2";*/
		   if($cl['city']==''){$cl['city']='NA';}
		    $aryData['billingCity'] = $cl['city'];/*REQUIRED*/
		    $aryData['billingState'] = $cl['state'];
		    $aryData['billingPostalCode'] = $cl['zip'];
			if($cl['country']==''){$cl['country']='NA';}
		    $aryData['billingCountryCode'] = $cl['country'];/*REQUIRED*/
		
	  return $aryData;
	}
	
	function  referralBusInfo($refNo, $aPagar=3){
	 //require_once('../init.php');
	 require_once('init.php');
	 $db=new getQueries (); 
	 $book=$db->see_occupancy_ref($refNo); //get reservation details
	 $cl=$db->customer($book[0]['client']);//get referral details
	 
	 $get_referral_id=$db->show_any_data_limit1('bookingreferred', 'ref_book', $refNo, '=');  //get the id of this referral
	 $referral_details=$db->show_any_data_limit1('commission', 'id', $get_referral_id[0]['id_referal'], '=');  //get datails for this referral
	 
		$aryData=array();
          //========================================================================================================================
			$fecha=gmdate("Y-m-d\TH:i:s\Z");
			if($aPagar==0){/*due date is as invoices date*/
				
				$fechaPagar=gmdate('Y-m-d\TH:i:s\Z');
			}else{/*due date is in five days invoice date*/
				$fechaPagar=gmdate('Y-m-d\TH:i:s\Z', mktime(0, 0, 0, date('m'), date('d') + ($aPagar+1), date('Y')));
			}
			#$fechaPagar=gmdate('Y-m-d\TH:i:s\Z', mktime(0, 0, 0, date('m'), date('d') - 20, date('Y')));/*Failure:The due date occurs before the invoice date*/
           $aryData['language'] = "en_US";
		    $aryData['merchantEmail'] = BUSSINESSEMAIL;

		    $aryData['payerEmail'] = $referral_details[0]['email'];
		    $aryData['currencyCode'] = "USD";
		    //$aryData['orderId'] = "0001";
		    $aryData['orderId'] = strtotime('now');
		    $aryData['invoiceDate'] =$fecha;/*date('Y-m-d').'T'.date("H:i:s");*/// date('Y-m-d');//"2011-12-31T05:38:48Z";//date('Y-m-d');
		    $aryData['dueDate'] =$fechaPagar;//date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 5, date('Y'))); //"2011-12-31T05:38:48Z";
		    $aryData['paymentTerms'] = "DueOnDateSpecified";   //[DueOnReceipt, DueOnDateSpecified, Net10, Net15, Net30, Net45]
		   

			$aryData['logoURL'] = LOGOURL;

		   /* $aryData['merchantFirstName'] = "Merchant First Name";
		    $aryData['merchantLastName'] = "Merchant Last Name";*/
		    $aryData['merchantBusinessName'] = "Residencial Casa Linda";
		    $aryData['merchantPhone'] = "1-809-571-1190";
		    $aryData['merchantFax'] = "1-809-571-1411";
		    $aryData['merchantWebsite'] = "www.CasaLidaCity.com";
		    $aryData['merchantCustomValue'] = "-quality homes-";

		    $aryData['merchantLine1'] = "Carretera Sosua-Cabarete, Entrada el Choco";
		    /*$aryData['merchantLine2'] = "Merchant Address Line 2";*/
		    $aryData['merchantCity'] = "Sosua";
		    $aryData['merchantState'] = "Puerto Plata";
		    $aryData['merchantPostalCode'] = "57000";
		    $aryData['merchantCountryCode'] = "DO";

		    $aryData['billingFirstName'] = $referral_details[0]['name'];
		    $aryData['billingLastName'] = $referral_details[0]['lastname'];
		    /*$aryData['billingBusinessName'] = "Billing Business Name";*/
		    $aryData['billingPhone'] = $referral_details[0]['phone'];
		    /*$aryData['billingFax'] = "Billing Fax";*/
		    /*$aryData['billingWebsite'] = "Billing Website";*/
		    /*$aryData['billingCustomValue'] = "Billing Custom Value";*/
			if($cl['address']==''){$cl['address']='NA';}/* line 1 is required*/
		    $aryData['billingLine1'] = $cl['address'];/*REQUIRED*/
		   /* $aryData['billingLine2'] = "Billing Line 2";*/
		   if($cl['city']==''){$cl['city']='NA';}
		    $aryData['billingCity'] = $cl['city'];/*REQUIRED*/
		    $aryData['billingState'] = $cl['state'];
		    $aryData['billingPostalCode'] = $cl['zip'];
			if($cl['country']==''){$cl['country']='NA';}
		    $aryData['billingCountryCode'] = $cl['country'];/*REQUIRED*/
		
	  return $aryData;
	}
	 //function below will get item detils for the invoice
	function itemsDetails($tipo, $booking, $monto){
		//require_once('../init.php');
		//$db=new getQueries (); 
		
             switch($tipo){
             	case 1:/*amount equal one night*/
						$itemDet='First payment';
						//$monto='120'; 
             			//details for item here
             			break;
             	case 2: /*amount equal 50%*/
						$itemDet='50% payment';/*to complete 50% if one night paid or other amount; 50% if nathing paid*/
						//$monto='120';
             		//details for item here
             			break;
             	case 3: /*amount equal 100% balance*/
						$itemDet='100% payment';
						//$monto='120';
             		//details for item here
             			break;
             }
     		$aryItems[0]['name'] = "Booking: $booking";
		    $aryItems[0]['description'] = $itemDet;
		    $aryItems[0]['date'] = date('Y-m-d');//"2011-12-31T05:38:48Z";
		    $aryItems[0]['quantity'] ="1";
		    $aryItems[0]['unitprice'] = $monto;
		    $aryItems[0]['taxName'] = "VAT-TAX";//tax name
		    $aryItems[0]['taxRate'] = TAXPERCENT;//tax percent
	 return $aryItems;
	 }

    //function below will create and then send an invoice
	function createSendInvoice($aryData, $aryItems){
		/*echo API_USERNAME;
		echo "<br/>";
		echo API_PASSWORD;
		echo "<br/>";
		echo API_SIGNATURE;
		echo "<br/>";
		echo "<pre>";
		print_r($aryData);
		echo "</pre>";
		echo "<pre>";
		print_r($aryItems);
		echo "</pre>";*/
		$ppInv = new PaypalInvoiceAPI(SYSTEMMETHOD);  
        $res = $ppInv->doCreateInvoice($aryData, $aryItems);
	    if($res["responseEnvelope.ack"]== "Success")
	    {
	       // echo "<br />Success Creating Invoice: '{$res['invoiceID']}'";
	        $res_send = $ppInv->doSendInvoice($res['invoiceID']);
	        if($res_send["responseEnvelope.ack"]== "Success")
	        {/*si enviado exitosamente hacer lo de abajo*/
	           // echo "<br />Success Sending Invoice";
	        }
	        else
	        {/*si no enviado presentar el siguiente error*/
	            //Get Error String
	           $res_send = $ppInv->formatErrorMessages($res_send);/*return error sending*/
	        }
	    }
	    else
	    {/*si no creada presentar error de abajo*/
	        //Get Error String
	        $res_send = $ppInv->formatErrorMessages($res);
	    }
	 return $res_send;
	}
    //function below will create and send both at once
	function createAndSendInvoice($aryData, $aryItems){
		$ppInv = new PaypalInvoiceAPI(SYSTEMMETHOD);  
      $res = $ppInv->doCreateAndSendInvoice($aryData, $aryItems);
	    if($res["responseEnvelope.ack"]== "Success")
	    {
	      /* all is fine*/
	    }
	    else
	    {
	       $res = $ppInv->formatErrorMessages($res);
	    }
	return $res;
	}
	//function below will update an invoice
	function updateInvoice($aryData, $aryItems){/*OJO: invoice ID is inserted on parameters of first array*/
		$ppInv = new PaypalInvoiceAPI(SYSTEMMETHOD);  
       $res = $ppInv->doUpdateInvoice($aryData, $aryItems);
	    if($res["responseEnvelope.ack"]== "Success")
	    {
	       /* all is fine*/
	    }
	    else
	    {
	       $res =$ppInv->formatErrorMessages($res);
	    }
	 return $res;
	}
	//function below will remind an invoice
	function remindInvoice($invoiceId){
		$ppInv = new PaypalInvoiceAPI(SYSTEMMETHOD);  
       //$invoiceId = "INV2-4VVT-JH27-MEE7-5WBD";
	    $res = $ppInv->doGetInvoiceDetail($invoiceId);
	    if($res["responseEnvelope.ack"]== "Success")
	    {
	        $aryDataInvoice['name'] = $res['invoice.billingInfo.firstName']." ".$res['invoice.billingInfo.lastName'];
	        $aryDataInvoice['amount'] = $res['invoiceDetails.totalAmount'];
	        $aryDataInvoice['invoice_id'] = $invoiceId;
	        $aryDataInvoice['email'] = $res['invoice.payerEmail']; //customer Email
	        $aryDataInvoice['sender_name'] = "Residencial Casa Linda";
	        $aryDataInvoice['sender_email'] = BUSSINESSEMAIL;    //business email [client account
	        $aryDataInvoice['order_id'] = $res['invoice.number'];     //invoice number
	        $aryDataInvoice['due_date'] = date('d F, Y', strtotime($res['invoice.dueDate']));
	        $aryDataInvoice['reminder_msg'] = "It is Reminder you to Pay the invoice";
	        $body = $ppInv->invoiceReminderHTML($aryDataInvoice);

	        $headers = "MIME-Version: 1.0" . "\r\n";
	        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	        $headers .= 'From: <'.$aryDataInvoice['sender_email'].'>' . "\r\n";
	        mail( $aryDataInvoice['email'], "Reminder: Your payment for this invoice ({$aryDataInvoice['order_id']}) is due", $body, $headers );
	    }
	    else
	    {
	      $res = $ppInv->formatErrorMessages($res);
	    }
		return $res;
	}
	//function below will cancel an invoice
	function cancelInvoice($invoiceId){
		$ppInv = new PaypalInvoiceAPI(SYSTEMMETHOD);  
      	$aryData['response_invoice_id']  = $invoiceId;
	    $aryData['email_subject']  = "Cancel Invoice Subject";
	    $aryData['email_body']    = "Cancel Invoice Notes";
	    $res = $ppInv->doCancelInvoice($aryData);
	return $res;
	}
	//function below will get the details of an invoice
	function getDetailsInvoice($invoiceId){
		$ppInv = new PaypalInvoiceAPI(SYSTEMMETHOD);  
     	 $res = $ppInv->doGetInvoiceDetail($invoiceId);
	    if($res["responseEnvelope.ack"]== "Success")
	    {
		/*all is fine*/
	    }
	    else
	    {
	         $res = $ppInv->formatErrorMessages($res);
	    }
	 return $res;
	}
	//function below will mark an invoice as paid
	function markAsPaidInvoice($invoiceId){
		$ppInv = new PaypalInvoiceAPI(SYSTEMMETHOD);  
        $aryData['response_invoice_id']  = $invoiceId;
	    $aryData['payment_date'] = date("Y-m-d");
	    $aryData['payment_note'] = "Notes";
	    $aryData['payment'] = "Payment";
	    $aryData['method'] = "PayPal";

	    $res = $ppInv->doMarkAsPaid($aryData);
	return $res;
	}
	
	
	
	/*echo "<pre>";
	print_r($toSendToday);
	echo "</pre>";*/
	
		//guardar las facturas aqui
			/*echo "<pre>";
			print_r($resultado);
			echo "</pre>";
			
			echo "<pre>";
			print_r( $datos);
			echo "</pre>";
			
			echo "<pre>";
			print_r($detmonto);
			echo "</pre>";
			
			echo "<pre>";
			print_r($k);
			echo "</pre>";*/
			
			
function sendInvoiceReservations(){	
 $toSendToday=InvoicingToday();
	//require_once('../init.php');
	require_once('init.php');
	$contador=0;
	if($toSendToday){
		$db = new DB();
		foreach($toSendToday AS $k){
			if($k['online']==4){
				$datos=referralBusInfo($k['booking']);
			}else{
				$datos=clientBusInfo($k['booking']);
			}
			
			$detmonto=itemsDetails($k['type'], $k['booking'], $k['amount']);
			$resultado=createSendInvoice($datos, $detmonto);
		
			if(@$resultado["responseEnvelope.ack"]=="Success"){
				if($k['dueDays']==0){
					$fechaDue=date('Y-m-d');
				}else{		
					$fechaDue=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + ($k['dueDays']+1), date('Y')));
				}
				$invoiceAmount=$k['amount']+($k['amount']*0.18);
				
				$info=array('invoiceID'=>$resultado['invoiceID'],
							'ref'=>$k['booking'],
							'tipopago'=>$k['type'],
							'amount'=>$invoiceAmount,
							'invoicedate'=>date('Y-m-d'),
							'duedate'=>$fechaDue,
							'status'=>'Sent',
							'user'=>$_SESSION['info']['id'],
							'url'=>$resultado['payerViewURL'],
							'manual'=>'2');
				$db->insert($info, $table='ppinvoices');
				$contador++;
			}
		}
	}
	//return $contador;
	return $resultado;
}	

function callAPI_toCheckInvoices(){
	$invoices=invoicesDue();
	
	if($invoices){
		foreach($invoices AS $k){
		 $invoiceDetails=getDetailsInvoice($k['invoiceID']); //call API to see if paid or other status of invoice
		// print_r($invoiceDetails);
			if(isset($invoiceDetails['responseEnvelope.ack']) && ($invoiceDetails['responseEnvelope.ack']=='Success')){
				switch($invoiceDetails['invoiceDetails.status']){
					case 'Sent': //remind and save info, change status to Reminded.
						//send reminder
						$remResult=remindInvoice($k['invoiceID']);
						//si tuvo exito guardar en table reminded
						if($remResult["responseEnvelope.ack"]== "Success"){
							changeStatus($k['id'], $status='Reminded');
							saveReminded($k['invoiceID'], $manual=2);
						}
						break;
					case 'Paid'://save payments and change status
						//save payment for booking
						savePayment($k['ref'], $k['amount'], $k['invoiceID']);
						//change status  TO BOOKING is no esta confirmado
						changeStatus($k['id'], $status='Paid');//invoice
						break;
					default: //change de status to any other status of details.
						changeStatus($k['id'], $status=$invoiceDetails['invoiceDetails.status']);
				}
			}
		}
	}
	return $invoices;	
}

function call_API_to_check_payments(){
	$inv=invoices_sent_reminded();//sent and reminded
	if($inv){
		$result['checked']=count($inv);
		$pagos=0;
		foreach($inv AS $k){
			 $invoiceDetails=getDetailsInvoice($k['invoiceID']); //call API to see if paid or other status of invoice
			 //print_r($invoiceDetails);
				if(isset($invoiceDetails['responseEnvelope.ack']) && ($invoiceDetails['responseEnvelope.ack']=='Success')){
					switch($invoiceDetails['invoiceDetails.status']){
						case 'Sent': //'EN PAYPAL' NO EN EL SISTEMA DE RCL en el cual PODRIA SER TAMBIEN REMINDED
							//Leave it sent or reminded (should be the same on PayPal)
							//NO HACE NADA
							break;
						case 'Paid'://save payments and change status
							//save payment for booking
							savePayment($k['ref'], $k['amount'], $k['invoiceID']);
							//change status  TO BOOKING is no esta confirmado
							changeStatus($k['id'], $status='Paid');//invoice
							$pagos++;$result['paid']=$pagos;
							break;
						default: //change de status to any other status of details.
							changeStatus($k['id'], $status=$invoiceDetails['invoiceDetails.status']);
					}
				}
		}
		
		
	}
	//$invoiceDetails=getDetailsInvoice('INV2-7DEA-CKJ9-PUMQ-G7VZ');
	
	return $result;
}

function call_API_to_cancel_paid(){
	$inv=invoices_sent_reminded();//sent and reminded
	if($inv){
		//$result['checked']=count($inv);
		//$pagos=0;
		$bookings_numbers=array();
		foreach($inv AS $k){
			if (!in_array($k['ref'],$bookings_numbers)){
				array_push($bookings_numbers, $k['ref']);
			}			 
		}
	}
	return $bookings_numbers;
}

function send_single_invoice($ref,$payment_type,$amount,$sent_to=1,$manual='2', $user='auto'){	
	require_once('init.php');
		$db = new DB();
		if($sent_to==1){/*es para un cliente agent*/
			$datos=clientBusInfo($ref);
		}elseif($sent_to==2){/*es para un referral agent*/
			$datos=referralBusInfo($ref);
		}
			$detmonto=itemsDetails($payment_type, $ref, $amount);
			$resultado=createSendInvoice($datos, $detmonto);
			if($resultado["responseEnvelope.ack"]== "Success"){
				if($k['dueDays']==0){
					$fechaDue=date('Y-m-d');
				}else{		
					$fechaDue=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + ($k['dueDays']+1), date('Y')));
				}
				$invoiceAmount=$amount+($amount*0.18);
				if($user=='auto'){ $createdby=47;}else{$createdby=$_SESSION['info']['id'];}
				$info=array('invoiceID'=>$resultado['invoiceID'],
							'ref'=>$ref,
							'tipopago'=>$payment_type,
							'amount'=>$invoiceAmount,
							'invoicedate'=>date('Y-m-d'),
							'duedate'=>$fechaDue,
							'status'=>'Sent',
							'user'=>$createdby,
							'url'=>$resultado['payerViewURL'],
							'manual'=>$manual);
				$db->insert($info, $table='ppinvoices');
				$contador++;
			}
	return $resultado;
}
function send_single_invoice2($ref,$payment_type,$amount,$sent_to=1,$manual='2', $user='auto', $email){	
	require_once('init.php');
		$db = new DB();
		if($sent_to==1){/*es para un cliente agent*/
			$datos=clientBusInfo($ref);
		}elseif($sent_to==2){/*es para un referral agent*/
			$datos=referralBusInfo($ref);
		}
		
		if($email!=''){
			$datos['payerEmail']=$email;
		}
		
			$detmonto=itemsDetails($payment_type, $ref, $amount);
			$resultado=createSendInvoice($datos, $detmonto);
			if($resultado["responseEnvelope.ack"]== "Success"){
				if($k['dueDays']==0){
					$fechaDue=date('Y-m-d');
				}else{		
					$fechaDue=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + ($k['dueDays']+1), date('Y')));
				}
				$invoiceAmount=$amount+($amount*0.18);
				if($user=='auto'){ $createdby=47;}else{$createdby=$_SESSION['info']['id'];}
				$info=array('invoiceID'=>$resultado['invoiceID'],
							'ref'=>$ref,
							'tipopago'=>$payment_type,
							'amount'=>$invoiceAmount,
							'invoicedate'=>date('Y-m-d'),
							'duedate'=>$fechaDue,
							'status'=>'Sent',
							'user'=>$createdby,
							'url'=>$resultado['payerViewURL'],
							'manual'=>$manual);
				$db->insert($info, $table='ppinvoices');
				$contador++;
			}
	return $resultado;
}		
/*
$test=call_API_to_check_payments();

echo "<pre>";
print_r($test);
echo "</pre>";*/

/*
$test=getDetailsInvoice($invoiceId='INV2-7DEA-CKJ9-PUMQ-G7VZ');

echo "<pre>";
print_r($test);
echo "</pre>";*/
/*
$cancelada=cancelInvoice($invoiceId='INV2-WGCG-DPVG-HP95-M29K');
echo "<pre>";
	print_r($cancelada);
	echo "</pre>";*/
	
	//$details=getDetailsInvoice($invoiceId='INV2-QAL5-XTDN-X5CG-YARH');//Canceled
	//$details=getDetailsInvoice($invoiceId='INV2-WGCG-DPVG-HP95-M29K');//Paid
	/*$details=getDetailsInvoice($invoiceId='INV2-GQ9V-C35R-V585-W9BB');//Sent
	echo "<pre>";
	print_r($details);
	echo "</pre>";*/
	
	/*$link = new getQueries();
	$facturaEnviada=$link->showTable_restrinted($table='ppinvoices', $condition='ref=000006885 AND tipopago=1', $order='id');
	
	echo "<pre>";
	print_r($facturaEnviada);
	echo "</pre>";
	
	if($facturaEnviada){ echo "Si"; }else{ echo "no enviada";}*/
	/*$db = new DB();
	insert($info, $table)*/
	
	
	
	/*require_once('../init.php');
	$link = new getQueries();
	$resultado=$link->getUnpaidShorTerm(2);//2 confirmed / 3 no confirmed
	
	echo "<pre>";
	print_r($resultado);
	echo "</pre>";*/
	
	/*$today=date('Y-m-d');
	$k['start']='2015-03-03';
	$daysToStart=days_dates($start=$today, $end=$k['start']);
	echo $daysToStart;*/
	#$datos=clientBusInfo($refNo='000006713');
	/*echo "<pre>";
	print_r($datos);
	echo "</pre>";*/
	#$detmonto=itemsDetails($tipo=4, $booking='000006713', $monto='300');
	/*echo "<pre>";
	print_r($detmonto);
	echo "</pre>";*/
	#$resultado=createSendInvoice($datos, $detmonto);
	
	/*echo "<pre>";
	print_r($resultado);
	echo "</pre>";*/
	
	/*$resultado2=getDetailsInvoice('INV2-B5RG-8RCJ-4UBM-FV36');
	
	echo "<pre>";
	print_r($resultado2);
	echo "</pre>";*/
?>