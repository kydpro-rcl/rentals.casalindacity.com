<?php
function salida($page){  require_once('pages/template.header.php');
  require_once('pages/template.'.$page.'.php');
  require_once('pages/template.footer.php');}
function salida2($page){
  require_once('pages/template.header2.php');
  require_once('pages/template.'.$page.'.php');
  require_once('pages/template.footer2.php');
}
function createRandomPassword() {



    $chars = "abcdefghijkmnopqrstuvwxyz023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;



    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }



    return $pass;



}

function email2owner($ref, $villa_number, $qty_nights, $starting, $ending){
	$general_amount=0; $PAYMENT_DUE=0; $name_owner=0;
	$total_sin_impuestos=number_format(($general_amount/1.18),2);//RETURN QUANTITIES WITHOUT TAXES
	$impuestos=number_format(($total_sin_impuestos*0.18),2);

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
		<p>Dear owner,</p>

		<p>Thank you for booking with Residencial Casa Linda,
		<p><strong>BOOKING CONFIRMATION: $ref
		  
		  </strong>
		<p><strong>To stay in villa $villa_number for $qty_nights nights<br>
		  Check-In $starting Check-in time: 3.00 PM<br>
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
		  
		</p>
		<p>Our office is located on the first gate to the left on El Choco Road.  </p>
		<p>  Upon arrival you will recieve all controls and keys for the villa.
		  
		  
		 
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
	return $body;
}	

function email2rcl($booking, $villaNo){
	
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
		<p>Dear Reservations Department,</p>

		<p>Owner has created booking No. ".$booking." on villa No. ".$villaNo." from to at Residencial Casa Linda<br/>
		</p>
		
		<p>Please, login to the system to see more details about this booking.</p>
		
		
		<p>Best wishes,
		  The Casa Linda team!</p>
		<p><br>
		  Residencial Casa Linda <br>
		  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
		  Tel: +1 809 571 1190 <br>
		  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
		  <a href=\"mailto:reception@casalindacity.com\">reception@casalindacity.com</a></p>
		</div>
		</body>
		</html>";
	return $body;
}	

/*
function ftp_mkdir_recursive($conn_id, $mode=0777, $path){//creación de un árbol de directorios
	if(substr($path,0,1)=="/"){$path=substr($path,1);}
	if(substr($path,-1)=="/"){$path=substr($path,0,-1);}
$dir=explode("/", $path);
$path="";
$ret=true;
	if(!is_resource($conn_id)){return "no FTP";}
$original_directory=ftp_pwd($conn_id);
	if(!$original_directory){return false;}
	for ($i=0;$i<count($dir);$i++){
	$path.="/".$dir[$i];
		if(!@ftp_chdir($conn_id,$path)){
		ftp_chdir($conn_id, $original_directory );
			if(!@ftp_mkdir($conn_id,$path)){
			$ret=false;
			break;
			}else{
			@ftp_chmod($conn_id, 0777, $path);
			}
		}
	}
return $ret;
}

function connect_ftp($server,$user_ftp, $pass_ftp){
//$server=str_replace("ftp.","",$server);
//$server="ftp.".$server;
$io=ftp_connect($server);
	if($io==false){return false;}
ftp_login($io, $user_ftp, $pass_ftp);
ftp_pasv($io, true);
return $io;
}

function sendMail_to_owner($body, $address, $subject, $from_add, $from_name) {

		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "X-MSMail-Priority: Normal\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";
		$extra_header  .= "CC: ".MANAGING_EMAIL."\n";


		$mailsend = mail($address, $subject, $body, $extra_header);

		return true;

}  */
?>