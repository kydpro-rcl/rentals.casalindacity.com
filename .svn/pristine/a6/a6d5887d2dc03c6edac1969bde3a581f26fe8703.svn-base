<? session_start();
	if ($_SESSION['referal']){

	  require_once('init.php');
	  $_GET['main']=2;   $_GET['secund']=2.1;
	  $_SESSION['RCL']="rcladministraciones";
		 if ($_POST['client_id']>0){
			 $coneccion=new subDB;
			 $customerinfo=$coneccion->customerDetails($_POST['client_id']);
			 $_SESSION['customer'] = $customerinfo;
		}else{
			if ($_POST['new_client']=="Continue booking"){
				unset ($_SESSION['customer']);
			}
		}
	///---------validating field for details------------
	 if ($_POST['new_client']=="Continue"){ //if booking details have been post
		if (!$_SESSION['customer']){
			$_POST['name']=trim($_POST['name']);
			if ($_POST['name']=="") $_GET['error']['name']="Empty name";

			$_POST['lastname']=trim($_POST['lastname']);
			if ($_POST['lastname']=="") $_GET['error']['lastname']="Last name required";

			$_POST['email']=trim($_POST['email']);
			if ($_POST['email']=="") $_GET['error']['email']="Email required";

			$_POST['phone']=trim($_POST['phone']);
			if ($_POST['phone']=="") $_GET['error']['phone']="Phone required";

		   		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
				  {
				  	$_GET['error']['email']='E-mail is not valid';
				  }else{
		            $db= new getQueries();
		            $result=$db->checkEmail($_POST['email']);
		           if ($result[0]['email']==$_POST['email']){// $_GET['error']['email']='Email already registered:'.$result[0]['id'];
		             $_GET['error']['email']='Email already registered,<br> Please login to book';
		           }
				  }
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
     }

	 if ($_GET['error']){
	 dibujar('page.create_booking3');

	 }else{
		//AQUI DE NUEVO BUSCAR QUE LA OCUPACION ESTA DISPONIBLE OTRA VEZ
		//SECCION QUE NO PERMITE POST ESTA PAGINA DOS VECES.
		 if ($_POST['confirm']=="Make the Booking"){ //ONLY IF CONFIRM HAVE BEEN PRESSED
		 	$db= new subDB();
		//------varibles para el cliente----//
			if (!$_SESSION['customer']){
				//$intermediario="0";
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
				//$comentario="How did you hear about us? ".$_SESSION['C']['ha'];unset($_SESSION['C']['ha']);
				if ($_SESSION['C']['rn']!=""){$comentario.=": ".$_SESSION['C']['rn'];unset($_SESSION['C']['rn']); }
				$comentario.=" (IP:".$_SERVER['REMOTE_ADDR'].")";
				if ($_SESSION['buy']==1){$comentario.="<br/> This client is interested in purchase information"; }

				$active="1";
				$class="0";
				$id_adm="0";
				$ename=$_SESSION['C']['ne']; unset($_SESSION['C']['ne']);
				$ephone=$_SESSION['C']['phe'];unset($_SESSION['C']['phe']);

				//-----------terminan variales del cliente----------//
				$id_client=$db->newCustomer_online($_SESSION['referal']['id'], $password, '1', $name_client, $lastname_client, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $id_adm, '0', $ename, $ephone, $_SESSION['buy']); //save new client
			}else{//if the client already exist
				$id_client=$_SESSION['customer']['id'];
				//echo $id_client." cliente";
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
			
			$link= new getQueries ();
			$price_settings=$link->show1_active('price_settings');  //get the price settings details
			if ($qty_nights>=$price_settings['mid_m_night']){ 
				$status="35";//mid term no confirmed
			}else{
				$status="3"; //short term no confirmed
			}
			
			
			
			if($HS_nights>0){
				$price_one_night_without_taxes=$priceHS;
			}else{
				$price_one_night_without_taxes=$price_per_night;
			}
			
			$vd=$_SESSION['villa_details'];
			unset($_SESSION['villa_details']); //QUITAR ESTA VILLA
			//-----varialbles para la reserva-----//
			if (isset($_POST['sendclient'])) {/*is selected sent to client*/
				$booking_type_online='2';/*Referral and send info to client*/
			}else{
				$booking_type_online='4';/*Referral and do not send info to client*/
			}
			$id_reserve=$db->insert_short_reserva_online($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment, $booking_type_online);  //INSERT RESERVE AND TAKE IT ID
			
			$time=time();
			$time_end=strtotime('+1 day', $time);
			
			$db->autoCancel($ref, $created=$time, $duedate=$time_end, $timetype='1', $timeframe='24', $status);

			//--------------- INSERT SERVICES BELOW----------------------------------------------------------------------------------

			if ($_SESSION['massage']>0) $db->insert_additional_services($_SESSION['massage'], $id_reserve, 	$_POST['massage_amount'], " ");
			if ($_SESSION['pickup']>0) $db->insert_additional_services($_SESSION['pickup'], $id_reserve, $_POST['pickup_amount'], " ");
			if ($_SESSION['VIPpickup']>0) $db->insert_additional_services($_SESSION['VIPpickup'], $id_reserve, $_POST['VIPpickup_amount'], " ");
			if ($_SESSION['chef']>0) $db->insert_additional_services($_SESSION['chef'], $id_reserve, $_POST['chef_amount'], " ");
			if ($_SESSION['fridge']>0) $db->insert_additional_services($_SESSION['fridge'], $id_reserve, $_POST['fridge_amount'], " ");
			//------------------END INSERTING SERVICES--------------------------------------------------------------------------------
			$adults_qty=$_SESSION['C']['a']; unset($_SESSION['C']['a']);
			$children_qty=$_SESSION['C']['k']; unset($_SESSION['C']['k']);

				if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
				  for ($x=1;$x<=$adults_qty; $x++){
				  	 $a_name="a_name$x"; $a_lastname="a_lastname$x";
				  	 $name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];
				   # $db->insert_adults($id_reserve, $name, $lastname);
				  	}
				}

				if ($children_qty>0){    //si la cantidad de niños sobrepasa 1 entonces son insertado en la base de datos
				  for ($c=1;$c<=$children_qty; $c++){
				  	$c_name="c_name$c"; $c_lastname="c_lastname$c";
				  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname];
				    $db->insert_children($id_reserve, $name, $lastname);
				  	}
				}
				
								 //----------------------- NEW WAY DISCOUNT-------------------------------------------------------------------------------------
				   if ($_SESSION['amount_discounted']>0){
				     $link= new getQueries();
				     $descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');//details discount before saved as discount
				     $desc=$descuento_anterior[0];
			     	 $this_pro=$link->show_active_limit1("promotion", "id", $_SESSION['id_promotion'], "=");//details for this promotion
			     	   $pro=$this_pro[0];
					if ($descuento_anterior){
					  /*	$id_upd_d=$db->insert_discount_modified(
																	$desc['fecha'],
																	$desc['reference'],
																	$desc['pro_code'],
																	$desc['pro_id'],
																	$desc['pro_from'],
																	$desc['pro_to'],
																	$desc['pro_type'],
																	$desc['pro_qty'], 
																	$desc['id_adm']);
					   
					   $actualizarlo=$db->update_discount($desc['id'],
															   $ref,
															   $pro['code'],
															   $pro['id'],
															   $pro['desde'],
															   $pro['hasta'],
															   $pro['tipo'],
															   $pro['cant_porc'], 
															   $id_adm,$id_upd_d);*/
					  }else{

						$result=$db->insert_discount($ref,
													$pro['code'],
													$pro['id'],
													$pro['desde'],
													$pro['hasta'],
													$pro['tipo'],
													$pro['qty'], 
													$pro['min_days'],
													$pro['max_days'],
													$pro['bookingfrom'],
													$pro['bookingto'],
													$_SESSION['amount_discounted'],
													$id_adm='',
													$new=1);
						//insert_discount($ref,$pro_code,$pro_id,$pro_from,$pro_to,$pro_type,$pro_qty,$min_days,$qty_days, $id_adm)
					  }
					 // unset($_SESSION['promotion_id']);
				    }
			   //----------------------- END NEW WAY DISCOUNT ----------------------------------------------------------------------------
				
			 //-----------------------DISCOUNT FOR THIS BOOKING-------------------------------------------------------------------------------------
			   if ($_SESSION['promotion_id']>0){
			    $link= new getQueries();
			    $descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');//details discount before saved as discount
			    $desc=$descuento_anterior[0];
		     	$this_pro=$link->show_active_limit1("promotion", "id", $_SESSION['promotion_id'], "=");//details for this promotion
		     	   $pro=$this_pro[0];
				  if ($descuento_anterior){
				  	$id_upd_d=$db->insert_discount_modified($desc['fecha'],$desc['reference'],$desc['pro_code'],$desc['pro_id'],$desc['pro_from'],$desc['pro_to'],$desc['pro_type'],$desc['pro_qty'], $desc['id_adm']);
				   $actualizarlo=$db->update_discount($desc['id'],$ref,$pro['code'],$pro['id'],$pro['desde'],$pro['hasta'],$pro['tipo'],$pro['cant_porc'], $id_adm,$id_upd_d);
				  }else{

					$result=$db->insert_discount($ref,$pro['code'],$pro['id'],$pro['desde'],$pro['hasta'],$pro['tipo'],$pro['cant_porc'], $id_adm);
				  }
				 // unset($_SESSION['promotion_id']);
			    }
		   //----------------------- TERMINA DISCOUNT FOR THIS BOOKING ----------------------------------------------------------------------------


		    	if ($_SESSION['WEBSITE']){
	                  $result=$db->in_webpage($ref, $_SESSION['WEBSITE']);
	           }  //END WEBPAGE  URL
				 unset($_SESSION['RCL2']);//kill this page - PARA EVITAR REFRESCAR LA PAGINA CON POST;
				 unset($_SESSION['RCL1']);// kill page services session
				 unset($_SESSION['RCL1B']);// kill page client details session
				 //--------------- INSERT referal for this booking----------------------------------------------------------------------------------
     			 if ($_SESSION['referal']['id']>0){
				    $link= new getQueries();
				    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');

					  if ($referido_anterior){
					  	#echo "actualizar";
					  	$id_update=$db->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
					  	//echo $referido_anterior[0]['id_referal'];
					    $actualizado=$db->update_assign($referido_anterior[0]['id'], $ref, $_SESSION['referal']['id'], $id_adm, $id_update);
					  }else{
						$result=$db->Assign_a_booking($ref, $_SESSION['referal']['id'], $id_adm, $amountdiscounted=$_SESSION['descuento_comision']);
					  }
				 }
				 //-- fin inserting referal for this booking---------------------------------------------------------------------------------------
				
					//NUEVO CODIGO PARA INSERTAR LOS SERVICIOS
					$link= new getQueries();
					$required_fee=$link->shows_required_fee($beds=$vd['bed']);
					if($required_fee){
					$total_fee_gral=0;
					  foreach($required_fee AS $f){
						  $total_fee=$f['price']*(1+$f['tax']);
						 $db->insert_additional_services($f['id'],
														 $id_ocupacion,
														 $qty=1,
														 $total_fee,
														 $f['descrip'],
														 $f['tax'],
														 $tipo=2,
														 $unit=$f['price']);
						$total_fee_gral+=$total_fee;
					  }
					}
					//TERMINA NUEVO CODIGO PARA INSERTAR LOS SERVICIOS
				
				
				if ($_SESSION['customer']){
	                $name_client=utf8_decode($_SESSION['customer']['name']);
	                $lastname_client=utf8_decode($_SESSION['customer']['lastname']);
	                $email=$_SESSION['customer']['email'];
	                $phone=$_SESSION['customer']['phone'];
				}
				$villa_number=$vd['no'];
				
				$data=new subDB();
				$daysToStart=$data->daysDifference(date('Y-m-d',strtotime($starting)),date('Y-m-d'));
				
				$general_amount+=$total_fee_gral;
				
				
				$total_amoun_without_taxes=($general_amount/1.18);
				/*echo $daysToStart;
				echo "<br/>";
				echo $starting;
				echo "<br/>";*/
				$general_amount-=$_SESSION['amount_discounted'];
				//echo $_SESSION['desde'];
				//die();
				if($daysToStart>30){
					//CHARTE ONE NIGHT
					$payment_type=1;
					$amount_2_b_paid=number_format($price_one_night_without_taxes,2);
				}elseif(($daysToStart<=30)&&($daysToStart>8)){
					//CHARGE 50 PERCENT
					$payment_type=2;
					$amount_2_b_paid=number_format(($total_amoun_without_taxes/2),2);
				}elseif(($daysToStart>=0)&&($daysToStart<=7)){
					//CHARGE 100 PERCENT
					$payment_type=3;
					$amount_2_b_paid=number_format($total_amoun_without_taxes,2);
				}else{
					//CHARGE 100 PERCENT
					$payment_type=3;
					$amount_2_b_paid=number_format($total_amoun_without_taxes,2);
				}	
				if (isset($_POST['sendclient'])) {/*is selected sent to client*/
					//SEND INVOICE ACCORDING TO CANCELATION POLICY TO CLIENT WITH API INVOICE
					require_once('../booking/invoiceAPI/InvoiceAPI.php');
					$invoice_result=send_single_invoice($ref,$payment_type,$amount_2_b_paid,$sent_to=1);
					//sent confirmation to client ---COPY TO RENTALS-------------
					$full_name=$name_client.' '.$lastname_client;
					$body=email_body($ref, $full_name, $general_amount, $villa_number,$qty_nights,$starting,$ending);
					sendMail_copy_reservations($body, $address=$email, $subject="BOOKING RESERVATION:$ref", $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');
					$db= new subDB();
					$info5=array('email'=>$email, 'ref'=>$ref, 'msg'=>utf8_encode($body), 'date'=>time());		  
					$datos=$db->insert($info5, 'confirmation_sent'); 
					//sent tiny details to referral about the booking
					$full_namer=$_SESSION['referal']['name'].' '.$_SESSION['referal']['lastname'];
					$emailr=$_SESSION['referal']['email'];
					$body2=email_body_referral($ref, $full_namer, $general_amount, $villa_number,$qty_nights,$starting,$ending);
					sendMail_copy_reservations($body2, $address=$emailr, $subject="BOOKING RESERVATION:$ref", $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');
					
				}else{/*decide not to sent to the client*/
					//save decision to the system so knows to who sent info in the future
					/*ABOVE IS ALREADY DONE WHEN SAVING RESERVATIONS ON THE TOP*/
					//SEND INVOICE ACCORDING TO CANCELATION POLICY TO REFERRAL WITH API INVOICE
					require_once('../booking/invoiceAPI/InvoiceAPI.php');
					/*$invoice_API= new PaypalInvoiceAPI;
					$header_API=$invoice_API->getInvoiceAPIHeader();*/
					/*echo "<pre>";
					print_r($header_API);
					echo "</pre>";*/
				
					$invoice_result=send_single_invoice($ref,$payment_type,$amount_2_b_paid,$sent_to=2);
					//sent confirmation to Referral ---COPY TO RENTALS-------------
					/*print_r($invoice_result);*/
					$full_name=$_SESSION['referal']['name'].' '.$_SESSION['referal']['lastname'];	
					$email=$_SESSION['referal']['email'];
					$body=email_body($ref, $full_name, $general_amount, $villa_number,$qty_nights,$starting,$ending);
					sendMail_copy_reservations($body, $address=$email, $subject="BOOKING RESERVATION:$ref", $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');
					$db= new subDB();
					$info5=array('email'=>$email, 'ref'=>$ref, 'msg'=>utf8_encode($body), 'date'=>time());		  
					$datos=$db->insert($info5, 'confirmation_sent'); 
				}
				
				?>
				
				<?
				echo("<meta http-equiv=\"refresh\" content=\"0;url=home_overview.php\">");
				//echo "listo";
				//die();

		 }else{  //if not post
		 // draw('booking_confirm'); //presenta el formulario y detalles
		// if (!$id_client>0){ dibujar('create_booking3');die();}
	      dibujar('page.create_booking4');
		 }
	  }// if not get error
	  //dibujar('create_booking4');
	}else{
		header('Location:login.php');
		die();
	}

?>

