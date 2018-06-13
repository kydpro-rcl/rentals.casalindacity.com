<?php

// STEP 1: read POST data

// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
// Instead, read raw POST data from the input stream.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}


// Step 2: POST IPN data back to PayPal to validate

$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
/*$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');*/
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set
// the directory path of the certificate as shown below:
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);

// inspect IPN validation result and act accordingly
 /*
if (strcmp ($res, "VERIFIED") == 0) {
    // The IPN is verified, process it
} else if (strcmp ($res, "INVALID") == 0) {
    // IPN invalid, log for manual investigation
}    */

// inspect IPN validation result and act accordingly

/*======================================================================================================================*/
/*$notify_email =  "ing.joseluis@msn.com";*/         //email address to which debug emails are sent to
$DB_Server = "localhost"; //your MySQL Server
$DB_Username = "casalindacity"; //your MySQL User Name
$DB_Password = "Casa0508"; //your MySQL Password
$DB_DBName = "reservations"; //your MySQL Database Name
/*========================================================================================================================*/

 if (strcmp ($res, "VERIFIED") == 0) {
    // The IPN is verified, process it:
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process the notification

    /*==========================================================================================*/

	// assign posted variables to local variables
	$item_name = $_POST['item_name'];
	$business = $_POST['business'];
	$item_number = $_POST['item_number'];
	$payment_status = $_POST['payment_status'];
	$mc_gross = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$receiver_id = $_POST['receiver_id'];
	$quantity = $_POST['quantity'];
	$num_cart_items = $_POST['num_cart_items'];
	$payment_date = $_POST['payment_date'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$payment_type = $_POST['payment_type'];
	$payment_status = $_POST['payment_status'];
	$payment_gross = $_POST['payment_gross'];
	$payment_fee = $_POST['payment_fee'];
	$settle_amount = $_POST['settle_amount'];
	$memo = $_POST['memo'];
	$payer_email = $_POST['payer_email'];
	$txn_type = $_POST['txn_type'];
	$payer_status = $_POST['payer_status'];
	$address_street = $_POST['address_street'];
	$address_city = $_POST['address_city'];
	$address_state = $_POST['address_state'];
	$address_zip = $_POST['address_zip'];
	$address_country = $_POST['address_country'];
	$address_status = $_POST['address_status'];
	$item_number = $_POST['item_number'];
	$tax = $_POST['tax'];
	$option_name1 = $_POST['option_name1'];
	$option_selection1 = $_POST['option_selection1'];
	$option_name2 = $_POST['option_name2'];
	$option_selection2 = $_POST['option_selection2'];
	$for_auction = $_POST['for_auction'];
	$invoice = $_POST['invoice'];
	$custom = $_POST['custom'];
	$notify_version = $_POST['notify_version'];
	$verify_sign = $_POST['verify_sign'];
	$payer_business_name = $_POST['payer_business_name'];
	$payer_id =$_POST['payer_id'];
	$mc_currency = $_POST['mc_currency'];
	$mc_fee = $_POST['mc_fee'];
	$exchange_rate = $_POST['exchange_rate'];
	$settle_currency  = $_POST['settle_currency'];
	$parent_txn_id  = $_POST['parent_txn_id'];
	$pending_reason = $_POST['pending_reason'];
	$reason_code = $_POST['reason_code'];


	// subscription specific vars

	$subscr_id = $_POST['subscr_id'];
	$subscr_date = $_POST['subscr_date'];
	$subscr_effective  = $_POST['subscr_effective'];
	$period1 = $_POST['period1'];
	$period2 = $_POST['period2'];
	$period3 = $_POST['period3'];
	$amount1 = $_POST['amount1'];
	$amount2 = $_POST['amount2'];
	$amount3 = $_POST['amount3'];
	$mc_amount1 = $_POST['mc_amount1'];
	$mc_amount2 = $_POST['mc_amount2'];
	$mc_amount3 = $_POST['mcamount3'];
	$recurring = $_POST['recurring'];
	$reattempt = $_POST['reattempt'];
	$retry_at = $_POST['retry_at'];
	$recur_times = $_POST['recur_times'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	//auction specific vars

	$for_auction = $_POST['for_auction'];
	$auction_closing_date  = $_POST['auction_closing_date'];
	$auction_multi_item  = $_POST['auction_multi_item'];
	$auction_buyer_id  = $_POST['auction_buyer_id'];

    //create MySQL connection
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password)
	or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
	//select database
	$Db = @mysql_select_db($DB_DBName, $Connect)
	or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());
	$fecha = date("m")."/".date("d")."/".date("Y");
	$fecha = date("Y").date("m").date("d");
	//check if transaction ID has been processed before
	$checkquery = "select txnid from paypal_payment_info where txnid='".$txn_id."'";
	$sihay = mysql_query($checkquery) or die("Duplicate txn id check query failed:<br>" . mysql_error() . "<br>" . mysql_errno());
	$nm = mysql_num_rows($sihay);
  if ($nm == 0){

//execute query
    if ($txn_type == "cart"){
    $strQuery = "insert into paypal_payment_info(paymentstatus,buyer_email,firstname,lastname,street,city,state,zipcode,country,mc_gross,mc_fee,memo,paymenttype,paymentdate,txnid,pendingreason,reasoncode,tax,datecreation) values ('".$payment_status."','".$payer_email."','".$first_name."','".$last_name."','".$address_street."','".$address_city."','".$address_state."','".$address_zip."','".$address_country."','".$mc_gross."','".$mc_fee."','".$memo."','".$payment_type."','".$payment_date."','".$txn_id."','".$pending_reason."','".$reason_code."','".$tax."','".$fecha."')";
	     $result = mysql_query($strQuery) or die("Cart - paypal_payment_info, Query failed:<br>" . mysql_error() . "<br>" . mysql_errno());
	     for ($i = 1; $i <= $num_cart_items; $i++) {
	         $itemname = "item_name".$i;
	         $itemnumber = "item_number".$i;
	         $on0 = "option_name1_".$i;
	         $os0 = "option_selection1_".$i;
	         $on1 = "option_name2_".$i;
	         $os1 = "option_selection2_".$i;
	         $quantity = "quantity".$i;

	         $struery = "insert into paypal_cart_info(txnid,itemnumber,itemname,os0,on0,os1,on1,quantity,invoice,custom) values ('".$txn_id."','".$_POST[$itemnumber]."','".$_POST[$itemname]."','".$_POST[$on0]."','".$_POST[$os0]."','".$_POST[$on1]."','".$_POST[$os1]."','".$_POST[$quantity]."','".$invoice."','".$custom."')";
	         $result = mysql_query($struery) or die("Cart - paypal_cart_info, Query failed:<br>" . mysql_error() . "<br>" . mysql_errno());

	     }
    }else{
     $strQuery = "insert into paypal_payment_info(paymentstatus,buyer_email,firstname,lastname,street,city,state,zipcode,country,mc_gross,mc_fee,itemnumber,itemname,os0,on0,os1,on1,quantity,memo,paymenttype,paymentdate,txnid,pendingreason,reasoncode,tax,datecreation) values ('".$payment_status."','".$payer_email."','".$first_name."','".$last_name."','".$address_street."','".$address_city."','".$address_state."','".$address_zip."','".$address_country."','".$mc_gross."','".$mc_fee."','".$item_number."','".$item_name."','".$option_name1."','".$option_selection1."','".$option_name2."','".$option_selection2."','".$quantity."','".$memo."','".$payment_type."','".$payment_date."','".$txn_id."','".$pending_reason."','".$reason_code."','".$tax."','".$fecha."')";
     $result = mysql_query("insert into paypal_payment_info(paymentstatus,buyer_email,firstname,lastname,street,city,state,zipcode,country,mc_gross,mc_fee,itemnumber,itemname,os0,on0,os1,on1,quantity,memo,paymenttype,paymentdate,txnid,pendingreason,reasoncode,tax,datecreation) values ('".$payment_status."','".$payer_email."','".$first_name."','".$last_name."','".$address_street."','".$address_city."','".$address_state."','".$address_zip."','".$address_country."','".$mc_gross."','".$mc_fee."','".$item_number."','".$item_name."','".$option_name1."','".$option_selection1."','".$option_name2."','".$option_selection2."','".$quantity."','".$memo."','".$payment_type."','".$payment_date."','".$txn_id."','".$pending_reason."','".$reason_code."','".$tax."','".$fecha."')") or die("Default - paypal_payment_info, Query failed:<br>" . mysql_error() . "<br>" . mysql_errno());
    }

  }
    /*=========================================================================================================*/

    // assign posted variables to local variables
    /*$item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email']; */

    // IPN message values depend upon the type of notification sent.
    // To loop through the &_POST array and print the NV pairs to the screen:
    foreach($_POST as $key => $value) {
      echo $key." = ". $value."<br>";
    }

     // Send an email announcing the IPN message is VERIFIED
      $mail_From    = "IPN@example.com";
      $mail_To      = "webmaster@casalindacity.com";
      $mail_Subject = "VERIFIED IPN";
      $mail_Body    = $req;
      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);

 } else if (strcmp ($res, "INVALID") == 0) {
    // IPN invalid, log for manual investigation

     // Send an email announcing the IPN message is INVALID
      $mail_From    = "IPN@example.com";
      $mail_To      = "webmaster@casalindacity.com";
      $mail_Subject = "INVALID IPN";
      $mail_Body    = $req;

      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);

    echo "The response from IPN was: <b>" .$res ."</b>";
 }