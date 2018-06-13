<?php
session_start();
 if ($_SESSION['referal']){
	if (!$_SESSION['RCL2']=="rcladministraciones") die('Restrinted area...');
	require_once('init.php');
	///---------validating field for details------------
	 if ($_POST['new_client']=="Continue booking"){ //if booking details have been post
		if (!$_SESSION['customer']){
			$_POST['name']=trim($_POST['name']);
			if ($_POST['name']=="") $_GET['error']['name']="Empty name";

			$_POST['lastname']=trim($_POST['lastname']);
			if ($_POST['lastname']=="") $_GET['error']['lastname']="Last name required";

			$_POST['email']=trim($_POST['email']);
			if ($_POST['email']=="") $_GET['error']['email']="Email required";

			$_POST['phone']=trim($_POST['phone']);
			if ($_POST['phone']=="") $_GET['error']['phone']="Phone required";

			$_POST['password']=trim($_POST['password']);
			if ($_POST['password']=="") $_GET['error']['pass']="Password required";

			if(!empty($_POST['password'])){
			 //validar pass
			 if (!isLength($_POST['password'],6,18))$_GET['error']['pass']='Length Min 6 - Max 18';
			}
		   //----------------------------------------------------------
		   		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
				  {
				  	$_GET['error']['email']='E-mail is not valid';
				  //echo "E-mail is not valid";
				  // display('new-client');    //returs to the form
				 //  die();
				  }else{
		            $db= new getQueries();
		            $result=$db->checkEmail($_POST['email']);
		           if ($result[0]['email']==$_POST['email']){// $_GET['error']['email']='Email already registered:'.$result[0]['id'];
		             $_GET['error']['email']='Email already registered,<br> Please login to book';
		           }


				  }

		   //	if (!validate_telephone_number($_POST['phone'])) $_GET['error']['phone']='Wrong phone number';

		   	if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($_POST['name']))) $_GET['error']['name']='Invalid name';

			if(!preg_match("#^[-A-Za-z' 'ñíÑáéóúÁÉÍÓÚ]*$#",utf8_decode($_POST['lastname']))) $_GET['error']['lastname']='Invalid Last name';

					if ($_POST['cedula']!=''){
						if (!validate_cedula($_POST['cedula'])){
						$_GET['error']['cedula']='Invalid Cedula';
						}else{

							$db= new getQueries();	$result=$db->checkCedula($_POST['cedula']);  if ($result[0]['cedula']==$_POST['cedula']){ $_GET['error']['cedula']='Cedula already registered:'.$result[0]['id'];}
							}
					}

					if ($_POST['passport']!=''){
					$db= new getQueries();	$result=$db->checkPassport($_POST['passport']);  if ($result[0]['passport']==$_POST['passport']){ $_GET['error']['passport']='already registered:'.$result[0]['id'];}
					}
		} //only if not session customer information
	    //----------------------------------------------------------
		$_POST['code']=trim($_POST['code']);
		if ($_POST['code']=="") $_GET['error']['captcha']="Captcha required";


			if ($_POST['code']!=""){
				require_once("captchas/securimage.php");
				  $img = new Securimage();
				  $valid = $img->check($_POST['code']);

				   if($valid == true) {
					unset($_GET['error']['captcha']);
				  } else {
					$_GET['error']['captcha']="Invalid Captcha";
				  }
			}

	 }else{ //if nothing is coming from booking details	   if (!$_SESSION['C']['a']>=1){ //los adultos no son ni mayor ni igual a uno
	     //echo $_SESSION['C']['a']." adultos";	     dibujar('client_details');
		 die();
	   }

	 }
	//------------------------------------------------------
	if ($_GET['error']){

	 dibujar('client_details');

	}else{
		//AQUI DE NUEVO BUSCAR QUE LA OCUPACION ESTA DISPONIBLE OTRA VEZ
		//SECCION QUE NO PERMITE POST ESTA PAGINA DOS VECES.
		 if ($_POST['confirm']=="Confirm Booking"){ //ONLY IF CONFIRM HAVE BEEN PRESSED
		 	$db= new subDB();
		//------varibles para el cliente----//
			if (!$_SESSION['customer']){
				$intermediario="0";
				$password=$_SESSION['C']['pa']; unset($_SESSION['C']['pa']);
				$name_client=$_SESSION['C']['n'];  unset($_SESSION['C']['n']);
				$lastname_client=$_SESSION['C']['ln'];unset($_SESSION['C']['ln']);
				$email=$_SESSION['C']['el']; unset($_SESSION['C']['el']);
				$phone=$_SESSION['C']['ph'];unset($_SESSION['C']['ph']);
				$phone2=$_SESSION['C']['ph2']; unset($_SESSION['C']['ph2']);
				$fax=$_SESSION['C']['fx'];unset($_SESSION['C']['fx']);
				$cedula=$_SESSION['C']['c']; unset($_SESSION['C']['c']);
				$passport=$_SESSION['C']['p'];unset($_SESSION['C']['p']);
				$language=$_SESSION['C']['lg']; unset($_SESSION['C']['lg']);
				$zip=$_SESSION['C']['zp'];unset($_SESSION['C']['zp']);
				$address=$_SESSION['C']['ad'];  unset($_SESSION['C']['ad']);
				$country=$_SESSION['C']['cy']; unset($_SESSION['C']['cy']);
				$state=$_SESSION['C']['state']; unset($_SESSION['C']['state']);
				$city=$_SESSION['C']['city']; unset($_SESSION['C']['city']);
				$photo="";
				$comentario="How did you hear about us? ".$_SESSION['C']['ha'];unset($_SESSION['C']['ha']);
				if ($_SESSION['C']['rn']!=""){$comentario.=": ".$_SESSION['C']['rn'];unset($_SESSION['C']['rn']); }
				$comentario.=" (IP:".$_SERVER['REMOTE_ADDR'].")";
				$active="1";
				$class="0";
				$id_adm="0";
				$ename=$_SESSION['C']['ne']; unset($_SESSION['C']['ne']);
				$ephone=$_SESSION['C']['phe'];unset($_SESSION['C']['phe']);

				//-----------terminan variales del cliente----------//
				$id_client=$db->newCustomers($intermediario, $password, '1', $name_client, $lastname_client, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $id_adm, '0', $ename, $ephone); //save new client
			}else{//if the client already exist
				$id_client=$_SESSION['customer']['id'];

			}
			//--variables para la ocupacion----//
			$starting=$_SESSION['desde']; unset($_SESSION['desde']);
			$ending=$_SESSION['hasta']; unset($_SESSION['hasta']);
			$id_villa=$_SESSION['villa_details']['id'];
			$id_adm="0";
			//--variables para la ocupacion----//
			$id_ocupacion=$db->insert_ocupacion_short_reserve($starting, $ending, $id_villa, $id_adm); //insert ocupation and returm id of insertion
			//-----varialbles para la reserva-----//
			$ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
			$id_customer=$id_client;
			$adults_qty=$_SESSION['C']['a'];   //no quitar todavia estos valores
			$children_qty=$_SESSION['C']['k']; //no quitar todavia estos valores
			$interm_id="0";
			$qty_nights=$_SESSION['total_noches'];  unset($_SESSION['total_noches']);
			$HS_nights=$_SESSION['noches_HS'];  unset($_SESSION['noches_HS']);
			$LS_nights=$_SESSION['noches_LS'];  unset($_SESSION['noches_LS']);
			$price_per_night=$_SESSION['villa_details']['p_low'];
			$priceHS=$_SESSION['villa_details']['p_high'];
			$amount_commision="0";
			$sub_total_rent=(($_SESSION['total'])-($_SESSION['itbis']));
			$ITBIS=$_SESSION['itbis'];  unset($_SESSION['itbis']);
			$services_amount="0";
			$deposit="0";
			$general_amount=$_SESSION['total'];  unset($_SESSION['total']);
			$status="3";
			$reserve_comment="";
			$vd=$_SESSION['villa_details'];
			unset($_SESSION['villa_details']); //QUITAR ESTA VILLA
			//-----varialbles para la reserva-----//
			$id_reserve=$db->insert_short_reserva_online($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment, "1");  //INSERT RESERVE AND TAKE IT ID

			$adults_qty=$_SESSION['C']['a']; unset($_SESSION['C']['a']);
			$children_qty=$_SESSION['C']['k']; unset($_SESSION['C']['k']);

				if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
				  for ($x=1;$x<=$adults_qty; $x++){
				  	 $a_name="a_name$x"; $a_lastname="a_lastname$x";
				  	 $name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];
				    $db->insert_adults($id_reserve, $name, $lastname);
				  	}
				}

				if ($children_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
				  for ($c=1;$c<=$children_qty; $c++){
				  	$c_name="c_name$c"; $c_lastname="c_lastname$c";
				  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname];
				    $db->insert_children($id_reserve, $name, $lastname);
				  	}
				}
				 unset($_SESSION['RCL2']);//kill this page - PARA EVITAR REFRESCAR LA PAGINA CON POST;
				 unset($_SESSION['RCL1']);// kill page booking details session
				//--------------send by emails to reservations and client-----------
				if ($_SESSION['customer']){
	                $name_client=utf8_decode($_SESSION['customer']['name']);
	                $lastname_client=utf8_decode($_SESSION['customer']['lastname']);
	                $email=$_SESSION['customer']['email'];
	                $phone=$_SESSION['customer']['phone'];
	                $address=utf8_decode($_SESSION['customer']['address']);
					unset($_SESSION['customer']);
				}
				  $servidor_destino=$_SERVER['REMOTE_ADDR'];
		          $body_reservation="";
		          $body_reservation.="<html><head></head><body>";
			          $total_ls=($LS_nights*$vd['p_low']);
					  $total_hs=($HS_nights*$vd['p_high']);
		          $body_reservation.="<p>THE FOLLOWING BOOKING HAVE BEEN MADE ONLINE:</p>";
		          $body_reservation.="<table width=\"90%\" align=\"center\">
										<tr>
									        <td width=\"50%\">
									        <span style=\"font-weight:bold;\">CUSTOMER:</span><br/>".
									        "No: ".$id_client."<br/>".
									        $name_client." ".$lastname_client."<br/>".
									        $email."<br/>".
									        $phone."<br/>".
									        $address."<br/>".
									        "ip:".$servidor_destino."<br/>".
									        "</td>
									        <td>
									        <span style=\"font-weight:bold;\">BOOKING DETAILS:</span><br/>
									        Reference: ".$ref."<br/>".
									        "Villa No: ".$vd['no']."<br/>".
									        "From: ".formatear_fecha($starting)."<br/>".
									        "To: ".formatear_fecha($ending)."<br/>".
									        $adults_qty." adults <br/>".
									        $children_qty." children<br/>
									        </td>
										</tr>
									</table>
									<p>&nbsp;</p>
									<table width=\"90%\" align=\"center\">
										<tr>
									        <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\">
									        <span style=\"color:#06F; font-weight:bold;\">ORDER DETAILS:</span>
									        </td>
									     </tr>
									     <tr>
									        <td align=\"right\" >
									        Low Season nights ".$LS_nights." x US$ ".number_format($vd['p_low'],2)." = <br/>
									        High Season nights ".$HS_nights." x US$ ".number_format($vd['p_high'],2)." =<br/>
									        <span style=\"font-weight:bold;\">Sub-Total=</span><br/>
									        VAT-TAX 16% =<br/>
									         <span style=\"font-weight:bold;\">TOTAL =</span>
									        </td>
									        <td align=\"right\" width=\"105px\">
									        US$ ".number_format($total_ls,2)."<br/>
									        US$ ".number_format($total_hs,2)."<br/>
									        <span style=\"font-weight:bold;\">
									        US$ ".number_format(($total_ls+$total_hs),2)."<br/>
									        </span>
											US$ ".number_format($ITBIS,2)."<br/>
											<span style=\"font-weight:bold;\">
									        US$ ".number_format($general_amount,2).
									        "</span>
									        </td>
										</tr>
									</table>";
									$body_reservation.="<hr/>";
									$body_reservation.="<p>Payment Link for client (It has been sent to client): <a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$ref&amount=$general_amount&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Payment link\">Link for payment Booking No:$ref</a></p>";

	        	 if ($_SESSION['customer']){
	                $body_reservation.="<p>Note: <u>This client is coming back</u></p>";
	          	}

		          $body_reservation.="</body></html>";
		          sendMail($body_reservation, RESERVATIONS_EMAIL, "Booking No: ".$ref, "online.booking@casalindacity.com", "RCL Booking System");//send to reservations
		          //============================================================================================
				  $body_client="";
				  $body_client.="<html><head></head><body>";
				  $body_client.="<p style=\"text-align:center;\"><a href=\"http://www.casalindacity.com\" alt=\"\"><img src=\"https://www.casalindacity.com/for_rent/images/booking-system.jpg\" alt=\"Residencial Casa Linda\" border=\"0\" width=\"820px;\" height=\"172px;\"></a></p>";
				  $body_client.="<p>DEAR CUSTOMER,<br/> Thank you for choosing Residencial Casa Linda<br/> Below are the information for your booking:</p>";
		    	  $body_client.="<table width=\"90%\" align=\"center\">
										<tr>
									        <td width=\"50%\">
									        <span style=\"font-weight:bold;\">CUSTOMER:</span><br/>".
									        $name_client." ".$lastname_client."<br/>".
									        $email."<br/>".
									        $phone."<br/>".
									        $address."<br/>".
									        "</td>
									        <td>
									        <span style=\"font-weight:bold;\">BOOKING DETAILS:</span><br/>
									        Reference: ".$ref."<br/>".
									        "Villa No: ".$vd['no']."<br/>".
									        "From: ".formatear_fecha($starting)."<br/>".
									        "To: ".formatear_fecha($ending)."<br/>".
									        $adults_qty." adults <br/>".
									        $children_qty." children<br/>
									        </td>
										</tr>
									</table>
									<p>&nbsp;</p>
									<table width=\"90%\" align=\"center\">
										<tr>
									        <td colspan=\"2\" align=\"center\" bgcolor=\"#CCCCCC\">
									        <span style=\"color:#06F; font-weight:bold;\">ORDER DETAILS:</span>
									        </td>
									     </tr>
									     <tr>
									        <td align=\"right\" >
									        Low Season nights ".$LS_nights." x US$ ".number_format($vd['p_low'],2)." = <br/>
									        High Season nights ".$HS_nights." x US$ ".number_format($vd['p_high'],2)." =<br/>
									        <span style=\"font-weight:bold;\">Sub-Total =</span><br/>
									        VAT-TAX 16% =<br/>
									         <span style=\"font-weight:bold;\">TOTAL =</span>
									        </td>
									        <td align=\"right\" width=\"105px\">
									        US$ ".number_format($total_ls,2)."<br/>
									        US$ ".number_format($total_hs,2)."<br/>
									        <span style=\"font-weight:bold;\">
									        US$ ".number_format(($total_ls+$total_hs),2)."<br/>
									        </span>
											US$ ".number_format($ITBIS,2)."<br/>
											<span style=\"font-weight:bold;\">
									        US$ ".number_format($general_amount,2).
									        "</span>
									        </td>
										</tr>
									</table>";
	               $body_client.="<p><a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$ref&amount=$general_amount&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Pay this booking\">Pay now, if you could not pay this booking before.</a></p>";
				  $body_client.="</body></html>";
		          sendMail($body_client, $email, "Booking No: ".$ref, RESERVATIONS_EMAIL, "Residencial Casa Linda");//send to client
				//-------------- end send by email ------------------------------

				//--------------pay the amount through paypal----------------
				?>
				<html>
				<head>
				</head>
				<body>
		          <form name="payp" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalProcessor">
					 <!-- Identify your business so that you can collect the payments. -->
					 <input type="hidden" name="business" value="reservations@casalindacity.com">
					  <!-- Specify a Buy Now button. -->
					  <input type="hidden" name="cmd" value="_xclick">
					  <!-- Specify details about the item that buyers will purchase. -->
					    <input type="hidden" name="item_name" value="Booking reference - <?=$ref?>">
					    <input type="hidden" name="amount" value="<?=$general_amount?>">
					    <input type="hidden" name="return" value="http://www.CasaLindaCity.com/" />  <!--http://www.CasaLindaCity.com/thanks.html-->
					    <input type="hidden" name="currency_code" value="USD">
					   <!-- Display the payment button. -->
						   <!--<input type="image" name="submit" border="0" src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
						    <img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" >-->
					 </form>
		            <p><img src="images/loading.gif" alt="" border="0" style="float:left;">&nbsp;Please, wait... </p>

					<script language="JavaScript" type="text/javascript">
					<!--
					  document.payp.submit();
					//document.getElementById('paypalProcessor').submit();
					//-->
					</script>
			</body>
			</html>
				<?
				//---------------end payment---------------------------------


		 }else{  //if not post
		  dibujar('guests_confirm'); //presenta el formulario y detalles

		 }
	 }// get error
 }else{
	header('Location:login.php');
	die();
 }
		?>