<?
//============================START ACCESS RESTRICTED======================================================================
require_once('../core/config.php');
$db= new Basededatos();

//$vi = $db->checkUser($username='juan',$password='test');
$vi = $db->checkToken($token=$_POST['token']);
if(!$vi){
	die('Access denied: restricted access');
}else{
	require_once('../../booking/init.php');
	
	
		function validateDate($date, $format = 'Y-m-d H:i:s')
		{
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}
		//$ckin=var_dump(validateDate('2012-02-28', 'Y-m-d')); # true
		/*$ckin=validateDate('2018-30-16', 'Y-m-d'); # true
		if(!$ckin==1){
			echo "FEcha invalida";
		}else{
			echo "FEcha valida";	
		}
		echo $ckin;
		die();*/
		$ckin=validateDate($_POST['checkin_date'], 'Y-m-d'); # true
		if(!$ckin==1){
			die('Error: invalid checkin date');
		}
		
		$ckout=validateDate($_POST['checkout_date'], 'Y-m-d'); # true
		if(!$ckout==1){
			die('Error: invalid checkout date');
		}
	
	$night_qty=daysDifference2($fecha_de_termino=$_POST['checkout_date'], $fecha_de_inicio=$_POST['checkin_date']);
	//print_r($vi);
	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$info=array('ipaddress'=>$_SERVER['REMOTE_ADDR'],
				'url_access'=>$actual_link,
				'iduser'=>$vi[0]['id'],
				'date'=>time());
	$saveVisit = $db->insert_id($info, $table='api_access');
	
	if($night_qty>=2){/*validate quantity of nights*/
		//echo $night_qty;
	 //verify that this villa is available if real booking and not send the info to reception.
	
		if($vi[0]['booking_mode']!=2){ /*2 is when it is not allow to book*/
		 $ITBIS=($_POST['total_amount']-($_POST['total_amount']/1.18));
			$info2=array('token'=>$_POST['token'],
						'api_user_id'=>$vi[0]['id'],
						'ip'=>$_SERVER['REMOTE_ADDR'],
						'date'=>time(),
						'client_fname'=>$_POST['client_fname'],
						'client_lname'=>$_POST['client_lname'],
						'client_email'=>$_POST['client_email'],
						'client_phone'=>$_POST['client_phone'],
						'client_id'=>'',
						'property_id'=>$_POST['property_id'],
						'qty_adults'=>$_POST['qty_adults'],
						'qty_kids'=>$_POST['qty_kids'],
						'checkin_date'=>$_POST['checkin_date'],
						'checkout_date'=>$_POST['checkout_date'],
						'unit_price'=>$_POST['unit_price'],
						'total_amount'=>$_POST['total_amount'],
						'qty_nights'=>$night_qty,
						'tax'=>$ITBIS,
						'online'=>'16',
						'status'=>'2',
						'ref'=>'',
						'id_occupancy'=>'',
						'amount_paid'=>$_POST['amount_paid'],
						'pp_transc_id'=>$_POST['pp_transc_id'],
						'booking_mode'=>$vi[0]['booking_mode'],
						'promotion_code'=>$_POST['promotion_code']);/*booking mode: 0= test ; 1=live ; 2= no allow [no save this table if so]*/
						
			$saveBooking = $db->insert_id($info2, $table='api_bookings');
		}
		
		if($vi[0]['booking_mode']==1){ /*1 means it's a live user mode*/
		
			if((trim($_POST['property_id'])=='')||(!$_POST['property_id']>0)){
				die('Error: villa id is missing');
			}
			if(trim($_POST['checkin_date'])==''){
				die('Error: checkin date is missing');
			}
			if(trim($_POST['checkout_date'])==''){
				die('Error: checkout data is missing');
			}
			if(trim($_POST['client_email'])==''){
				die('Error: email address is missing');
			}
			if(trim($_POST['client_fname'])==''){
				die('Error: please, verify first name');
			}
			if(trim($_POST['client_lname'])==''){
				die('Error: last name is missing');
			}
			if(trim($_POST['client_phone'])==''){
				die('Error: missing phone number');
			}
			if((trim($_POST['qty_adults'])=='')||(!$_POST['qty_adults']>0)){
				die('Error: please, verify the adult quantity');
			}
			if((trim($_POST['total_amount'])=='')||(!$_POST['total_amount']>0)){
				die('Error: total amount is not valid');
			}
			if((trim($_POST['amount_paid'])=='')||(!$_POST['amount_paid']>0)){
				die('Error: please, verify the amount paid');
			}
			if(trim($_POST['pp_transc_id'])==''){
				die('Error: invalid transaction ID');
			}
			if((trim($_POST['unit_price'])=='')||(!$_POST['unit_price']>0)){
				die('Error: nightly price per this unit is missing');
			}
			
			
			
			$new_busy=check_villa_new($_POST['property_id'], $_POST['checkin_date'], $_POST['checkout_date']);/*check if this villa is available*/
			 $cant_new=count($new_busy);
			if(!$cant_new>0){/*if villa is available*/
				$data= new subDB();
				//created booking in the system
					if (!filter_var($_POST['client_email'], FILTER_VALIDATE_EMAIL)){
						$error['email1']='Email is not valid';
					}else{
					//search for email in db
						$link= new getQueries();
						$result=$link->checkEmail($_POST['client_email']);
						if ($result[0]['email']==$_POST['client_email']){// $_GET['error']['email']='Email already registered:'.$result[0]['id'];
							$id_customer=$result[0]['id'];
							//CHECK THAT CLIENT IS NOT BLACKLISTED
							if($result[0]['active']==0){/*CLIENT IS BLACKLISTED*/
								//$error['blacklisted']=true;
							}
							//$_SESSION['error']['email']='Email already registered,<br/> Please login to book';
						}
					}
					if (!$id_customer){//insert client if not found in database
						$intermediario='';
						$password='';
						$name_client=$_POST['client_fname'];
						$lastname_client=$_POST['client_lname'];
						$email=$_POST['client_email'];
						$phone=$_POST['client_phone'];
						$phone2='';
						$fax='';
						$cedula='';
						$passport='';
						$language='';
						$zip='';
						$address='';
						$country='';
						$state='';
						$city='';
						$photo="";
						$comentario.="Booking received via API (IP:".$_SERVER['REMOTE_ADDR'].")";
						$active="1";
						$class="0";
						$id_adm="0";
						$ename='';
						$ephone='';

						//-----------terminan variales del cliente----------//
						$id_customer=$data->newCustomer_online($intermediario, $password, '1', $name_client, $lastname_client, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $id_adm, '0', $ename, $ephone, $_SESSION['buy']); //save new client				
					}
					
				   $id_ocupacion=$data->insert_ocupacion_short_reserve($starting=$_POST['checkin_date'], $ending=$_POST['checkout_date'], $id_villa=$_POST['property_id'], $id_adm=0); //insert occupation and return id of insertion
				   $ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
				   
				   $source=7;//user from API
				   
				   $price_per_night=$_POST['unit_price'];
				  
				   $sub_total_rent=($_POST['total_amount']-$ITBIS);
				   
					//=================INSERT RESERVATION=================================
				   $info3=array('ref'=>$ref,
						'id_occupancy'=>$id_ocupacion,
						'id_client'=>$id_customer,
						'adults'=>$_POST['qty_adults'],
						'children'=>$_POST['qty_kids'],
						'vehicles'=>'',
						'id_interm'=>'',
						'qty_nights'=>$night_qty,
						'nightsHS'=>0,
						'nightsLS'=>$night_qty,
						'price_per_night'=>$price_per_night,
						'priceHS'=>0,
						'commision'=>'',
						'amount'=>$sub_total_rent,
						'tax'=>$ITBIS,
						'services_amount'=>'',
						'deposit'=>'',
						'total'=>$_POST['total_amount'],
						'status'=>2,
						'comment'=>'Booking made via API connection',
						'pagos_qty'=>'',
						'pagos_monto'=>'',
						'price_long'=>'',
						'extra_nights'=>'',
						'online'=>$source,
						'ip'=>$_SERVER['REMOTE_ADDR'],
						'hearabout'=>'',
						'paid'=>'',
						'api_bookings_id'=>$saveBooking);	
						
					$data->insert($info3, $table='reserves');
				   #$id_reserve=$data->insert_short_reserva($ref, $id_ocupacion, $id_customer, $adults_qty=$_POST['qty_adults'], $children_qty=$_POST['qty_kids'], $interm_id, $night_qty, $HS_nights=0, $LS_nights=$night_qty, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount=$_POST['total_amount'], $status=2, $source);  //INSERT RESERVE AND TAKE IT ID
				   
				   //=================INSERT PAYMENT=================================
				   $info0=array('ref'=>$ref,
						'type'=>'3',
						'class'=>'1',
						'amount'=>$_POST['amount_paid'],
						'transid'=>$_POST['pp_transc_id'],
						'notes'=>'',
						'user'=>$_POST['id_adm'],
						'fecha'=>date("Y-m-d G:i:s"));				
					$data->insert($info0, $table='payments');
				   
				   #insert payments
				   
				//Email to Rental manager and reception
				
					//$general_amount=number_format($general_amount,2);/*to avoid shows , separators on thousands on analytics ecomerce*/

					/*$body="<!doctype html>
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
					<p>Dear $name_client $lastname_client,</p>

					<p>Thank you for booking with Residencial Casa Linda,
					<p><strong>BOOKING CONFIRMATION: $ref.
					  
					  </strong>
					<p><strong>To stay in villa $villa_number for $qty_nights nights<br>
					  Check-In $starting		 Check-in time: 3.00 PM<br>
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
					  We will ask for a security deposit of 75USD per room, this can be in cash or 
					  CC slip.<br>
					</p>
					<p>Our office is located on the first gate to the left on El Choco Road.  </p>
					<p>  Upon arrival you will recieve all controls and keys for the villa, when you come to the villa there will be a free water 5-gallon.
					  <br>
					  If you need any more come by the office with the empty one and for a small fee we will replace it for a full one.
					  <br>
					  There will also be an inventory list of what was there upon check-in from our staff, 
					  please go through this as you are responsible for any breakage in the villa during your stay. <br>
					  <br>
					 You will recieve a one time welcome package in the villa:</p>
					<ul>
					  <li>Coffee</li>
					  <li>Shampoo</li>
					  <li>Bodywash</li>
					  <li>Dish Soap</li>
					  <li>Sponge</li>
					</ul>
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
					</html>";*/

					#sendMail_copy_reservations($body, $address=$email, $subject="Confirmation booking no:$ref", $from_add='reservations@casalindacity.com', $from_name='Residencial Casa Linda');
					//save email sent for records
					/*echo $body;*/
					//-------SI EL CLIENTE YA EXISTE ENTONCES SE ACTUALIZA CON LOS NUEVOS DATOS------/
					 #$info5=array('email'=>$email, 'ref'=>$ref, 'msg'=>utf8_encode($body), 'date'=>time());
					 #$datos=$db->insert($info5, 'confirmation_sent'); 
					//------------FINALIZO ACTULIZANDO CLIENTE------------------------------------/
			
			//notification of booking creation	
			}else{
				die('Error: villa occupied in the selected dates');
			}
		}
		
		if($saveBooking){
			//============================END ACCESS RESTRICTED======================================================================
			 if ($_POST['property_id']){
				header("Content-type: text/xml");
				echo '<?xml version="1.0"?>'; 
				
				$link= new getQueries();
				$villas = $link->villa_forent($_GET['property_id']);
				$villa=$villas[0];
				$season=$link->seasons3(); //temporadas informations
				//$temporada=$season[0];
				$fecha=date('Y-m-d');
				
				echo '<Reservation created="'.$fecha.'">';
						echo '<ConfirmationNumber>0000'.$saveBooking.'</ConfirmationNumber>';
						echo '<BookingDetails>';
							echo '<VillaNumber>'.$_POST['property_id'].'</VillaNumber>';
							echo '<Checkin>'.$_POST['checkin_date'].'</Checkin>';
							echo '<Checkout>'.$_POST['checkout_date'].'</Checkout>';
							echo '<Nights>'.$night_qty.'</Nights>';
							echo '<Total>$'.$_POST['total_amount'].'</Total>';
							//echo '<Clientid>50</Clientid>';
							echo '<Adults>'.$_POST['qty_adults'].'</Adults>';
							echo '<Children>'.$_POST['qty_kids'].'</Children>';
						echo '</BookingDetails>';
				echo '</Reservation>';
			 }
		}else{
			die('Error: we couldn\'t make the booking');
		}
	}else{
		die('Error: night quantity');
	}
}
?>