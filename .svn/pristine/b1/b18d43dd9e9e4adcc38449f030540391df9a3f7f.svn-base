<?php
require_once('init.php');
 if ($_POST){
 $_POST['email_forgot']=trim($_POST['email_forgot']);

  if (!empty($_POST['email_forgot'])){
	if(!filter_var($_POST['email_forgot'], FILTER_VALIDATE_EMAIL)){
		$_GET['error']['email']='E-mail is not valid';

	}else{

		$db=new getQueries();

		$client=$db->show_any_data('owners', 'email', $_POST['email_forgot'], '=');

		if ($client){


		     if ($client[0]['active']==1){

		         if ((trim($client[0]['pass'])=="")||(trim($client[0]['user'])=="")){ /*///HACER ESTO SOLO SI NO TIENE CONTRASEÑA O USUARIO*/
		          $link=new subDB;  /*//conectar a database*/                   if ($client[0]['pass']==""){ /*//if password is empty*/
		         	$new_pass = createRandomPassword();
					$clave=$new_pass; /*//variable con la clave*/
					/*//actualizar la clave en la base de datos*/
					$link->change_owner_pass($client[0]['id'],$new_pass); /*//change the password for this owner*/
				   }else{				   	 $clave=$client[0]['pass'];				   }

				   if ($client[0]['user']==""){ /*//if username is empty*/
		         	$new_username=$client[0]['name'].$client[0]['lastname'];
					$usuario=$new_username;  /*//variable con el nombre de usuario*/
					/*//actualizar el nombre de usuario en la base de datos
					//echo $usuario;  //die();*/
					$link->change_owner_user($client[0]['id'],$usuario); //change the username for this owner
				   }else{				   	$usuario=$client[0]['user'];				   }


			     }else{ /*//HACER ESTO SI EL NOMBRE DE USUARIO Y CONTRASEÑA ESTAN COMPLETO EN LA BASE DE DATOS*/
                   $clave=$client[0]['pass'];
                   $usuario=$client[0]['user'];  /*//variable con el nombre de usuario*/

			     }

			 /*//=========================================================================================================================================================*/
			     /*//-------------sending email--------------------------------------------------*/
					 $body_client="";
					  $body_client.="<html><head></head><body>";
					  $body_client.="<p style=\"text-align:center;\"><a href=\"http://www.casalindacity.com\" alt=\"\"><img src=\"https://rentals.casalindacity.com/owners_portal/images/owners-system.jpg\" alt=\"Residencial Casa Linda\" border=\"0\" width=\"820px;\" height=\"172px;\"></a></p>";
					  $body_client.="<p>Dear <b>".$client[0]['name']." ".$client[0]['lastname']."</b>,<br/> Thank you for choosing <b>Residencial Casa Linda</b><br/> Below is the information that you requested:</p>";
					  $body_client.="<p style=\"text-align:center;\">Your username is: <span style=\"color:red;\">".$usuario."</span></p>";
			    	  $body_client.="<p style=\"text-align:center;\">Your password is: <span style=\"color:red;\">".$clave."</span></p>";
			    	  $body_client.="<p>&nbsp;</p>";
			    	  $body_client.="<hr/>";
                      $body_client.="<p style=\"text-align:left;\">Please, visit our website: <a href='www.casalindacity.com' target='_blank'>www.CasaLindaCity.com</a></p>";
					  $body_client.="</body></html>";


                      $email_dueno=$client[0]['email'];  /*//get the email address for this owner*/
                    /*// $email_dueno='ing.joseluis@msn.com';//para probar con este email*/

					 $envio=sendMail($body_client, $email_dueno, "Your forgotten login details", MANAGING_EMAIL, "Residencial Casa Linda");/*//send to owner from (MANAGING EMAIL)*/
					 /*sending email--------------------------------------------------*/
                     if ($envio){
			      	 $_GET['notification']="Dear, <span style=\"color:red;\">".utf8_decode($client[0]['name'])." ".utf8_decode($client[0]['lastname'])."</span> We had successfully sent your login details to your email"; /*//nombre (querido nombrecliente su contrasena ha sido enviada a su email)*/
			      	}else{
			      	  $_GET['notification']="Problems sending your login details, please <a href=\"http://www.casalindacity.com\" alt=\"\" target=\"_blank\">contact us</a>";
			      	}
			  /*//==========================================================================================================================================================*/

		     }else{

		     	$_GET['error']['email']="You had been disable form our system, please <a href=\"http://www.casalindacity.com\" alt=\"\" target=\"_blank\">contact us</a> for more information";
		     }



		}else{

			$_GET['error']['email']="This email is not in our system or database";
		}

	}
  }else{ $_GET['error']['email']='E-mail is empty'; }
 }

 salida2('forgot_pass');   /*//PRESENTAR PLANTILLA DE LA PAGINA FORGOT PASSWORD*/

?>