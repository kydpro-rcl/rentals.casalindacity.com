<?php
session_start();
/*//$_GET['pasos']=1;
//$_SESSION['RCL']="rcladministraciones";*/
require_once('init.php');
	 /*---------------login form--------------------------*/
	if ($_POST['login']=="Login"){
		$_POST['mail']=trim($_POST['mail']);
		$_POST['pass']=trim($_POST['pass']);

		if (($_POST['mail']!="")&&($_POST['pass']!="")){
			if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){

			  	$_GET['e']['both']='E-mail is not valid';

			}else{
				  /*connet to db*/
				  $coneccion=new subDB;
				  /*vefiry */
				  $customer_id=$coneccion->authenticateCustomer($_POST['mail'],$_POST['pass']);

						if ($customer_id) {
							/*$_SESSION['customer_id']=$customer_id; */
							$customerinfo=$coneccion->customerDetails($customer_id);
                           /*$_SESSION['cust_online']=$customerinfo;*/
                            $_GET['logueado']=$customer_id;

                            $_POST['book']=trim($_POST['book']);
                            $_POST['book']=str_pad($_POST['book'], 9, "0", STR_PAD_LEFT);
                            $db=new getQueries();
                            $booking=$db->checkbook_client($cliente_id=$customer_id, $book_ref=$_POST['book']);
                            if($booking){

                            	if(strtotime($booking[0]['start'])>strtotime(date('Y-m-d'))){
									if(($booking[0]['status']==2)||($booking[0]['status']==3)){/*only short term confirm and not confirm*/
                            		$_SESSION['cust_online']=$customerinfo;
                            		$_SESSION['cust_book']=$booking[0];
                            		header('Location:excursions.php');
                            		die();
									}else{
									 $_GET['e']['both']="Please contact: <br/><a href=\"mailto:Reservations@CasaLindaCity.Com\">Reservations@CasaLindaCity.Com</a> to change this booking";
									}
                            	}else{
                                  $_GET['e']['both']="The time for the customer to change this booking is over";
                            	}
                            }else{
                             $_GET['e']['both']="client and booking do not match.<br/>Please use the link sent to your email to login.";
                            }

						}else{
				  			$_GET['e']['both']="Email and password do not match.";
						}
			}


		}else{

		 $_GET['e']['both']="Email or password is empty.";
		}

	}
	/*---------------------------------------------------- */
salida('login');
?>
<?php

?>
<?php

?>