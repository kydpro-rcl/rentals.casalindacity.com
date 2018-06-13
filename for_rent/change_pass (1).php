<?php
session_start();
require_once('init.php');

	 //---------------login form--------------------------
	if ($_POST['login']=="go"){
		$_POST['mail']=trim($_POST['mail']);
		$_POST['pass']=trim($_POST['pass']);

		if (($_POST['mail']!="")&&($_POST['pass']!="")){
			if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
			  {
			  	$_GET['e']['both']='E-mail is not valid';

			  }else{
				  //connet to db
				  $coneccion=new subDB;
				  //vefiry
				  $customer_id=$coneccion->authenticateCustomer($_POST['mail'],$_POST['pass']);

						if ($customer_id) {
							//$_SESSION['customer_id']=$customer_id;
							$customerinfo=$coneccion->customerDetails($customer_id);
                            $_SESSION['clientes']=$customerinfo;
                            $_GET['logueado']=$customer_id;

						}else{
				  			$_GET['e']['both']="Email and password do not match.";
						}
				}


		}else{

		 $_GET['e']['both']="Email or password is empty.";
		}

	}
	//----------------------------------------------------

	//----------------CHANGING PASSWORT-------------------------

		if ($_POST['cambiar']=="Change"){
              //validate data
          $_GET['logueado']=$_POST['client_id'];
          $old_pass=$_POST['old_pass']; $new_pass=$_POST['n_pass']; $verify_pass=$_POST['v_n_pass'];

          if  ($old_pass!=$_SESSION['clientes']['pass']) $_GET['error']['old_pass']='Old password do not match';

  		  if (($new_pass!='')&&($verify_pass!='')){ //verify new pass
           if  ( $new_pass!=$verify_pass) $_GET['error']['v_new_pass']='Incorrect to verify new password';

		 	if (!isLength($new_pass,6,18))$_GET['error']['new_pass']='Length Min 6 - Max 18';
		 	if (!isLength($verify_pass,6,18))$_GET['error']['v_new_pass']='Length Min 6 - Max 18';

          }else{
          	if ($new_pass=='') $_GET['error']['new_pass']='Empty new password';
          	if ($verify_pass=='') $_GET['error']['v_new_pass']='Empty verify new password';
          }

          if (!$_GET['error']){
			$db=new DB();
			$change_pas=$db->change_client_pass($_GET['logueado'],$new_pass);

			if ($change_pas){
				$_GET['changed']="Your password had been changed";
                 //-------------sending email to admin--------------------------------------------------
				$body_adm="";
				$body_adm.="<html><head></head><body>";
				$body_adm.="<p>THE FOLLOWING CLIENT HAVE CHANGED HIS/HER PASSWORD:<BR/><b>".$_SESSION['clientes']['name']." ".$_SESSION['clientes']['lastname']."</b>,<br/> <b>Client No: ".$_SESSION['clientes']['id']."</b><br/> </p>";
			    $body_adm.="</body></html>";
				sendMail($body_adm, RESERVATIONS_EMAIL, "A client change his/her password", "online.booking@casalindacity.com", "RCL Booking System");//send to adm
				//-------------sending email--------------------------------------------------
				unset($_SESSION['clientes']);
				unset($_GET['logueado']);
			 }else{ $_GET['changed']="We sorry, There was a problem changing your password"; }
		  }
		}
	//--------------------------------------------------------

draw_clean('change_pass');

?>