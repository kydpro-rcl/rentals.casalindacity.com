<?php
require_once('init.php');
if ($_POST){
 $_POST['email_forgot']=trim($_POST['email_forgot']);

  if (!empty($_POST['email_forgot'])){
	if(!filter_var($_POST['email_forgot'], FILTER_VALIDATE_EMAIL)){
		$_GET['error']['email']='E-mail is not valid';

	}else{

		$db=new getQueries();

		$client=$db->show_any_data('customers', 'email', $_POST['email_forgot'], '=');

		if ($client){


		     if ($client[0]['active']==1){

		         if ($client[0]['pass']==""){		         	$new_pass = createRandomPassword();
					$clave=$new_pass;
					$link=new subDB;
					$changer=$link->change_client_pass($client[0]['id'],$new_pass);
					if($changer){					 //-------------sending email--------------------------------------------------
					 $body_client="";
					  $body_client.="<html><head></head><body>";
					  $body_client.="<p style=\"text-align:center;\"><a href=\"http://www.casalindacity.com\" alt=\"\"><img src=\"https://www.casalindacity.com/for_rent/images/booking-system.jpg\" alt=\"Residencial Casa Linda\" border=\"0\" width=\"820px;\" height=\"172px;\"></a></p>";
					  $body_client.="<p>Dear <b>".$client[0]['name']." ".$client[0]['lastname']."</b>,<br/> Thank you for choosing <b>Residencial Casa Linda</b><br/> Below are the information that you requested:</p>";
			    	  $body_client.="<p style=\"text-align:center;\">Your password is: <span style=\"color:red;\">".$clave."</span></p>";

					  $body_client.="</body></html>";
					 $envio=sendMail($body_client, $client[0]['email'], "Your password forgotten", RESERVATIONS_EMAIL, "Residencial Casa Linda");//send to client
					 //-------------sending email--------------------------------------------------
                     if ($envio){
			      	 $_GET['notification']="Dear, <span style=\"color:red;\">".utf8_decode($client[0]['name'])." ".utf8_decode($client[0]['lastname'])."</span> We had successfully sent your password to your email"; //nombre (querido nombrecliente su contrasena ha sido enviada a su email)
			      	 }else{
			      	  $_GET['notification']="Problems sending your password, please <a href=\"http://www.casalindacity.com/contact.php\" alt=\"\" target=\"_blank\">contact us</a>";
			      	    }

			      	}else{			      	 $_GET['notification']="Problems sending your password, please <a href=\"http://www.casalindacity.com/contact.php\" alt=\"\" target=\"_blank\">contact us</a>";
			      	}

			     }else{
                   $clave=$client[0]['pass'];
			      //envia email con su contrasena
			      //-------------sending email--------------------------------------------------
					 $body_client="";
					  $body_client.="<html><head></head><body>";
					  $body_client.="<p style=\"text-align:center;\"><a href=\"http://www.casalindacity.com\" alt=\"\"><img src=\"https://www.casalindacity.com/for_rent/images/booking-system.jpg\" alt=\"Residencial Casa Linda\" border=\"0\" width=\"820px;\" height=\"172px;\"></a></p>";
					  $body_client.="<p>Dear <b>".$client[0]['name']." ".$client[0]['lastname']."</b>,<br/> Thank you for choosing <b>Residencial Casa Linda</b><br/> Below are the information that you requested:</p>";
			    	  $body_client.="<p style=\"text-align:center;\">Your password is: <span style=\"color:red;\">".$clave."</span></p>";

					  $body_client.="</body></html>";

					$envio= sendMail($body_client, $client[0]['email'], "Your password forgotten", RESERVATIONS_EMAIL, "Residencial Casa Linda");//send to client
					 //-------------sending email--------------------------------------------------
                  if ($envio){
			      $_GET['notification']="Dear, <span style=\"color:red;\"> ".utf8_decode($client[0]['name'])." ".utf8_decode($client[0]['lastname'])."</span>  we had successfully sent your password to your email";
			      }else{

			      $_GET['notification']="Problems sending your password, please <a href=\"http://www.casalindacity.com/contact.php\" alt=\"\" target=\"_blank\">contact us</a>";
			      }

			     }

		     }else{

		     	$_GET['error']['email']="You had been disable form our system, please <a href=\"http://www.casalindacity.com/contact.php\" alt=\"\" target=\"_blank\">contact us</a> for more information";
		     }



		}else{

			$_GET['error']['email']="This email is not in our database";
		}

	}
  }else{ $_GET['error']['email']='E-mail is empty'; }
}

	//if ((!$_POST)||($_GET['error']['email'])){
		draw_clean('forgot_pass');
 	//}

?>