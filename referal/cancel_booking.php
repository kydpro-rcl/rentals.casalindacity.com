<? session_start();
if ($_SESSION['referal']){
  $_GET['main']=2;   $_GET['secund']=2.3;
  require_once('init.php');

  if ($_POST){

		 	if (trim($_POST['ref'])=="") $_GET['error']['ref']='Invalid Reference Number';//validate caracteres trim
			
			if (trim($_POST['info'])=="") $_GET['error']['reasons']='Reasons are required';//validate caracteres trim
			
		 	 if (!$_GET['error']){

		 	    $body_cancellation="<html><head></head><body>";
		 	    $body_cancellation.="<p>Hello, <b>".$_SESSION['referal']['name']." ".$_SESSION['referal']['lastname']."</b> wants to cancel a booking with the following details:</p>";
                $body_cancellation.="<p><b>Reference No.:</b> ".$_POST['ref']."</p>";
                $body_cancellation.="<p><b>Cancellation From:</b> ".$_POST['from']."</p>";
                $body_cancellation.="<p><b>Reason for Cancellation:</b> ".$_POST['reason']."</p>";
                $body_cancellation.="<p><b>Comments:</b> ".$_POST['info']."</p>";
                $body_cancellation.="</body></html>";


                sendMail($body_cancellation, RESERVATIONS_EMAIL, " Cancellation of Booking N.: ".$_POST['ref'], $_SESSION['referal']['email'], "RCL-Referal Agents Portal (RAP)");//send to referal
	           $_GET['main']=2;   $_GET['secund']=2.3;
	            $_GET['op']['name']='Cancel Request';//new client
	            $_GET['op']['done']='Sent,<br/> Expect a cancelation confirmation within 48 hours.';//view client
	            dibujar('success');//succeful
		     	die();


			 }else{
			     dibujar('cancel_booking');

			     die();

	         }
	}

  dibujar('cancel_booking');
}else{
	header('Location:login.php');
	die();
}
?>