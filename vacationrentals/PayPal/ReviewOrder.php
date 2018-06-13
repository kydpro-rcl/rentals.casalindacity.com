<?php
error_reporting(E_ALL & ~E_NOTICE);// Report all errors except E_NOTICE
require_once('init.php');
/********************************************
ReviewOrder.php

This file is called after the user clicks on a button during
the checkout process to use PayPal's Express Checkout. The
user logs in to their PayPal account.

This file is called twice.

On the first pass, the code executes the if statement:

if (! isset ($token))

The code collects transaction parameters from the form
displayed by SetExpressCheckout.html then constructs and
sends a SetExpressCheckout request string to the PayPal
server. The paymentType variable becomes the PAYMENTACTION
parameter of the request string. The RETURNURL parameter
is set to this file; this is how ReviewOrder.php is called
twice.

On the second pass, the code executes the else statement.

On the first pass, the buyer completed the authorization in
their PayPal account; now the code gets the payer details
by sending a GetExpressCheckoutDetails request to the PayPal
server. Then the code calls GetExpressCheckoutDetails.php.

Note: Be sure to check the value of PAYPAL_URL. The buyer is
sent to this URL to authorize payment with their PayPal
account. For testing purposes, this should be set to the
PayPal sandbox.

Called by SetExpressCheckout.html.

Calls GetExpressCheckoutDetails.php, CallerService.php,
and APIError.php.

********************************************/

require_once 'CallerService.php';


session_start();
if (!$_SESSION['CLC']=="rcladminist123"){ /*header('Location:index.php');*/ die('Restricted area...');}


/* An express checkout transaction starts with a token, that
   identifies to PayPal your transaction
   In this example, when the script sees a token, the script
   knows that the buyer has already authorized payment through
   paypal.  If no token was found, the action is to send the buyer
   to PayPal to first authorize payment
   */

$token = $_REQUEST['token'];

if(! isset($token)) {
//echo $token; die();
//validate fields
	unset($_SESSION['error']); //clear old errors
	//if(!$_SESSION['customer']){/*validate clientes if not logedin*/
		if(trim($_REQUEST['name'])==''){ $_SESSION['error']['name']='Name is required'; }
		if(trim($_REQUEST['lastname'])==''){ $_SESSION['error']['lastname']='Last name is required'; }
		if(trim($_REQUEST['email1'])==''){ $_SESSION['error']['email1']='Email is required'; }else{
			if (!filter_var($_REQUEST['email1'], FILTER_VALIDATE_EMAIL)){
				$_SESSION['error']['email1']='Email is not valid';
			}else{
			//search for email in db
				 $db= new getQueries();
			    $result=$db->checkEmail($_POST['email1']);
			    if ($result[0]['email']==$_REQUEST['email1']){// $_GET['error']['email']='Email already registered:'.$result[0]['id'];
					$_SESSION['customer_id']=$result[0]['id'];
					//CHECK THAT CLIENT IS NOT BLACKLISTED
					if($result[0]['active']==0){/*CLIENT IS BLACKLISTED*/
						$_SESSION['error']['blacklisted']=$result[0]['id'];
					}
					//$_SESSION['error']['email']='Email already registered,<br/> Please login to book';
			    }
			}
		}
		if(trim($_REQUEST['email2'])==''){ $_SESSION['error']['email2']='Confirm email'; }else{
			if(trim($_REQUEST['email2'])!=$_REQUEST['email1']){$_SESSION['error']['email2']='Email mismatch';}
		}
		if(trim($_REQUEST['phone'])==''){ $_SESSION['error']['phone']='Phone is required'; }
		//if(trim($_REQUEST['password'])==''){ $_SESSION['error']['pass']='Password is required'; }
					
		//unset($_SESSION['C'])			
		$_SESSION['C']['n']=$_REQUEST['name'];
		$_SESSION['C']['ln']=$_REQUEST['lastname'];
		$_SESSION['C']['el']=$_REQUEST['email1'];
		$_SESSION['C']['el2']=$_REQUEST['email2'];
		$_SESSION['C']['ph']=$_REQUEST['phone'];
					
		$_SESSION['C']['ph2']=$_REQUEST['phone2'];
		$_SESSION['C']['fx']=$_REQUEST['fax'];
		$_SESSION['C']['c']=$_REQUEST['cedula'];
		$_SESSION['C']['p']=$_REQUEST['passport'];
		$_SESSION['C']['lg']=$_REQUEST['language'];
		$_SESSION['C']['zp']=$_REQUEST['zip'];
		$_SESSION['C']['ad']=$_REQUEST['address'];
		$_SESSION['C']['cy']=$_REQUEST['country'];
		$_SESSION['C']['state']=$_REQUEST['state'];
		$_SESSION['C']['city']=$_REQUEST['city'];
					
		$_SESSION['C']['pa']=$_REQUEST['password'];
					
		$_SESSION['C']['ne']=$_REQUEST['name_emerg'];
		$_SESSION['C']['phe']=$_REQUEST['phone_emerg'];
	
	//}
	 if($_REQUEST['agree']!='Iagree'){$_SESSION['error']['agree']='In order do proceed you must agree to the terms and conditions'; }

		$_SESSION['C']['a']=$_REQUEST['adults'];
		$_SESSION['C']['k']=$_REQUEST['kids'];
		$_SESSION['C']['paynow']=$_REQUEST['paynow']; 		

		$_SESSION['C']['ha']=$_REQUEST['hear_about']; 		
		
		if($_SESSION['C']['a']){
			for($i=1; $i<=$_SESSION['C']['a']; $i++){
				$name_ad="a$i";
				$_SESSION['a'][$i]=$_REQUEST[$name_ad]; 	
			}
		}
		if($_SESSION['C']['k']>0){
			for($i=1; $i<=$_SESSION['C']['k']; $i++){
				$name_ki="k$i";
				$name_ka="ka$i";
				$_SESSION['k'][$i]=$_REQUEST[$name_ki]; 
				$_SESSION['ka'][$i]=$_REQUEST[$name_ka]; 
			}
		}
	if($_SESSION['error']){//send back to correct errors
		$location='../client-details.php#content_starts';
		header("Location: $location"); die();
	}
	/*====================== START CODE FOR CHECKOUT FEE ==============================*/
	$_SESSION['C']['ne']=$_REQUEST['name_emerg'];
	
	/*====================== END CODE FOR CHECKOUT FEE ==============================*/
	
	
		/* The servername and serverport tells PayPal where the buyer
		   should be directed back to after authorizing payment.
		   In this case, its the local webserver that is running this script
		   Using the servername and serverport, the return URL is the first
		   portion of the URL that buyers will return to after authorizing payment
		   */
		   
		   $serverName = $_SERVER['SERVER_NAME'];
		   $serverPort = $_SERVER['SERVER_PORT'];
		  //$url=dirname('https://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);/*online SSL*/
		  $url=dirname("http://".$serverName.":".$serverPort.$_SERVER['REQUEST_URI']);

		   $currencyCodeType=$_REQUEST['currencyCodeType'];
		   $paymentType=$_REQUEST['paymentType'];
			
			/*if($_REQUEST['servicesLR']){//required checkout cleaning fee
				
				//print_r($_REQUEST['servicesLR']);
				//exit('fin del programa');
				
				foreach($_REQUEST['servicesLR'] AS $serv){
					
				}
			}*/
		  /*
          $personName       = $_REQUEST['PERSONNAME'];
		   $SHIPTOSTREET      = $_REQUEST['SHIPTOSTREET'];
		   $SHIPTOCITY        = $_REQUEST['SHIPTOCITY'];
		   $SHIPTOSTATE	      = $_REQUEST['SHIPTOSTATE'];
		   $SHIPTOCOUNTRYCODE = $_REQUEST['SHIPTOCOUNTRYCODE'];
		   $SHIPTOZIP        = $_REQUEST['SHIPTOZIP'];
		   */
		   $total_for_items=0;
		   $detail_items='';
		   $numb_desc='';
		   $booking=nextId($table='occupancy');
		   $ref=str_pad($booking, 9, "0", STR_PAD_LEFT);
		 
		 if($_SESSION['C']['paynow']!='1'){/*if not one night*/  
		   for($x=0; $x<$_SESSION['qty_item']; $x++){
				$name_it="L_NAME$x";
				$qty_it="L_QTY$x";
				$desc_it="L_DESC$x";
				$num_it="L_NUMBER$x";
				$amt_it="L_AMT$x";
				
			   $$name_it          = $_REQUEST[$name_it];
			   $$qty_it           = $_REQUEST[$qty_it];
			   $$desc_it         = $_REQUEST[$desc_it];
			   $$num_it=$ref;
			  /* $$amt_it=$_REQUEST[$amt_it];*/
			   
			  if($_SESSION['C']['paynow']=='50'){
			    $$amt_it = ($_REQUEST[$amt_it]*0.50);/*price of the article*/
			   }else{/*charge 100 percent*/
				 $$amt_it=$_REQUEST[$amt_it];/*charge 100% price of the article*/
			   }
			   $monto_por_item=${$amt_it};
			   $detail_items.="&$name_it=".${$name_it}."&$amt_it=".number_format($monto_por_item,2)."&$qty_it=".${$qty_it};
			   $numb_desc.="&$num_it=".${$num_it}."&$desc_it=".${$desc_it};
			   
			   $qty_this_item=${$qty_it};
			   $amt_this_item=${$amt_it};
			   //echo $amt_this_item;
			   //echo "<br/>";
			   //$amt_this_item=round($amt_this_item);//round price of items
			   $amt_this_item=number_format($amt_this_item,2);//remove decimal of items
			   $total_for_items+=($qty_this_item*$amt_this_item);
		   }
		   
		 }else{/*----------START ONE NIGHT----------------*/
				   $qtyReal=$_REQUEST['L_QTY0'];/*need it to calculate taxes*/
				   
				   $L_NAME0=$_REQUEST['L_NAME0'];
				   $L_QTY0=1;
				   $L_DESC0=$_REQUEST['L_DESC0'];
				   $L_NUMBER0=$ref;
				   $L_AMT0=$_REQUEST['L_AMT0'];
						
				   $detail_items.="&L_NAME0=".$L_NAME0."&L_AMT0=".$L_AMT0."&L_QTY0=".$L_QTY0;
				   $numb_desc.="&L_NUMBER0=".$L_NUMBER0."&L_DESC0=".$L_DESC0;
				   
				   $qty_this_item=$L_QTY0;
				   $amt_this_item=$L_AMT0;
				   
				   $total_for_items+=($qty_this_item*$amt_this_item);
		 }/*----------END ONE NIGHT----------------*/
		   /*********************TAXES**************/
			  if($_SESSION['C']['paynow']=='50'){
			    $L_TAXAMT = number_format(($_REQUEST['TAXAMT']*0.50),2);/*price of the article*/
			   }elseif($_SESSION['C']['paynow']=='1'){
			   //only charge one night
			     $L_TAXAMT =number_format(($amt_this_item*0.18),2);
			   }else{/*charge 100 percent*/
				  $L_TAXAMT =$_REQUEST['TAXAMT'];/*charge 100% price of the article*/
			   }
			 /*********************TAXES**************/
			/*********************SERVICE FEE**************/
			
		   $itemamt = 0.00;
          /*$itemamt = $L_QTY0*$L_AMT0+$L_AMT1*$L_QTY1; *///this is the total amount for items without taxes
          $itemamt =number_format($total_for_items,2, '.', ''); //this is the total amount for items without taxes
		  // $itemamt =$total_for_items;
		   $amt = number_format($itemamt+$L_TAXAMT,2, '.', '');//TOTAL AMOUNT FOR THIS ORDER
			 

		   $returnURL =urlencode($url.'/ReviewOrder.php?currencyCodeType='.$currencyCodeType.'&paymentType='.$paymentType);
		   /*$cancelURL =urlencode("$url/SetExpressCheckout.php?paymentType=$paymentType" );*/
			$cancelURL =urlencode("$url/SetExpressCheckout.php" );
			
           $nvpstr="";
		   
		   if($_REQUEST['PaymentType']=='CC'){
		   
				$paymentOption="&LANDINGPAGE=Billing";
				$paymentOption.="&LOCALECODE=US";
				
				$paymentShipContact="&SHIPTOSTREET=".$_SESSION['C']['ad'];
				$paymentShipContact.="&SHIPTOCITY=".$_SESSION['C']['city'];
				$paymentShipContact.="&SHIPTOSTATE=".$_SESSION['C']['state'];
				$paymentShipContact.="&SHIPTOCOUNTRYCODE=".$_SESSION['C']['cy'];
				$paymentShipContact.="&SHIPTOZIP=".$_SESSION['C']['zp'];
				$paymentShipContact.="&SHIPTOPHONENUM=".$_SESSION['C']['ph'];
				$paymentShipContact.="&EMAIL=".$_SESSION['C']['el'];
				$paymentShipContact.="&SHIPTONAME=".$_SESSION['C']['n']." ".$_SESSION['C']['ln'];
		   
		   }else{$paymentOption="&LANDINGPAGE=Login";}
		   
			$nvpstr="&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=US&ADDRESSOVERRIDE=0".$detail_items."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&NOSHIPPING=1&TAXAMT=".$L_TAXAMT.$numb_desc.$paymentOption.$paymentShipContact."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType;
		   
           $nvpstr = $nvpHeader.$nvpstr;
		    //echo $_SESSION['qty_item'];
           #echo $nvpstr; die();
		 	/* Make the call to PayPal to set the Express Checkout token
			If the API call succeded, then redirect the buyer to PayPal
			to begin to authorize payment.  If an error occured, show the
			resulting errors
			*/
		   $resArray=hash_call("SetExpressCheckout",$nvpstr);
		   $_SESSION['reshash']=$resArray;

		   $ack = strtoupper($resArray["ACK"]);

		   if($ack=="SUCCESS"){
					// Redirect to paypal.com here
					$token = urldecode($resArray["TOKEN"]);
					$payPalURL = PAYPAL_URL.$token;
					header("Location: ".$payPalURL);
				  } else  {
					 //Redirecting to APIError.php to display errors.
						$location = "APIError.php";
						header("Location: $location");
					}
} else {
		 /* At this point, the buyer has completed in authorizing payment
			at PayPal.  The script will now call PayPal with the details
			of the authorization, incuding any shipping information of the
			buyer.  Remember, the authorization is not a completed transaction
			at this state - the buyer still needs an additional step to finalize
			the transaction
			*/

		   $token =urlencode( $_REQUEST['token']);

		 /* Build a second API request to PayPal, using the token as the
			ID to get the details on the payment authorization
			*/
		   $nvpstr="&TOKEN=".$token;

		   $nvpstr = $nvpHeader.$nvpstr;
		 /* Make the API call and store the results in an array.  If the
			call was a success, show the authorization details, and provide
			an action to complete the payment.  If failed, show the error
			*/
		   $resArray=hash_call("GetExpressCheckoutDetails",$nvpstr);
		   $_SESSION['reshash']=$resArray;
		   $ack = strtoupper($resArray["ACK"]);

		   if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
					require_once "GetExpressCheckoutDetails.php";
			  } else  {
				//Redirecting to APIError.php to display errors.
				$location = "APIError.php";
				header("Location: $location");
			}
}
?>