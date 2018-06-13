<?php
session_start();
 if ($_SESSION['referal']){
	if (!$_SESSION['RCL1']=="rcladministraciones") die('Restrinted area...');

	$_SESSION['RCL2']="rcladministraciones";
	require_once('init.php');

	//---------------login form--------------------------
	if ($_POST['login']=="login"){
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
							$_SESSION['customer_id']=$customer_id;
							$customerinfo=$coneccion->customerDetails($customer_id);
							$_SESSION['customer'] = $customerinfo;
							//echo("<meta http-equiv=\"refresh\" content=\"0;url=home-welcome.php\">");
						}else{
				  			$_GET['e']['both']="Email and password do not match.";
						}
				}


		}else{

		$_GET['e']['both']="Email or password is empty.";
		}

		}
	//----------------------------------------------------

	dibujar('client_details');
 }else{
	header('Location:login.php');
	die();
 }
?>