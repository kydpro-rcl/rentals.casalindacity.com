<?php
 require_once('inc/session.php');
if ($_SESSION['info']){
	if ($_SESSION['info']['cancelbooking']==1){
		$_GET['p']='b'; $_GET['s']='b.c';
		require_once('init.php');
		if ($_POST['cancel']){
			//	echo 'Editado';
			$data=new subDB ();
			$data->goto_insert_cancelled($_POST['ref'], $_POST['why'], $_POST['id_adm']); //this function is on class subDB
			$data->cancel_reserve($_POST['reserveid']); //this function is on class DB, but same object can be used
			$_GET['p']='b'; $_GET['s']='b.c';
			$_GET['op']['name']='Booking <span style="color:black;">'.$_POST['ref'].'</span>';//new client
	        $_GET['op']['done']='Cancelled';//view client
			/*============IF SENT INFO TO CLIENT CHECKED=====================*/
			if (isset($_POST['sendclient'])) {/*is selected sent to client*/
			   //------------SEND EMAIL TO CLIENT OR REFERAL HERE------------
			   $ref=$_POST['ref']; 
			   $general_amount=$_POST['gralamount']; 
			   $cancellation_fee=$_POST['can_fee']; 
			   $name_referral_client=$_POST['name_lastname'];
			   $villa_number=$_POST['villa_no'];
			   $qty_nights=$_POST['qty_nights']; 
			   $starting=$_POST['start']; 
			   $ending=$_POST['ending'];
			   $email_to_send=$_POST['email'];
			   
				$body=cancellation_email($ref, $general_amount, $cancellation_fee, $name_referral_client, $villa_number, $qty_nights, $starting, $ending);
				sendMail_copy_reservations($body, $email_to_send, $subject="BOOKING CANCELLATION:$ref", $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');	
				//SAVE EMAIL SENT IN DB	
				$info5=array('email'=>$email_to_send, 'ref'=>$ref, 'msg'=>utf8_encode($body), 'date'=>time());		  
				$datos=$data->insert($info5, 'confirmation_sent'); 
			//------------END SENDING EMAIL TO REFERRAL OR CLIENT---------
			}
	        display('succefully'); //succeful
		    die();
		}
		display('cancel-booking');
	}else{
		header('Location:home-welcome.php');
		die();
	}
}else{
	header('Location:login.php');
	die();
}
?>