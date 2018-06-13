<?php
session_start();
$_GET['pasos']=5;
// Report all PHP errors
//error_reporting(-1);
if (!$_SESSION['RCL2']=="rcladministraciones") die('Restricted area...');
$_SESSION['RCL3']="rcladministraciones";

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
				if ($_POST['agree']!="on") $_GET['error']['agree']="You must be agree to our Terms and Conditions to continue";

				if(!empty($_POST['password'])){
				 //validar pass
				 if (!isLength($_POST['password'],6,18))$_GET['error']['pass']='Length Min 6 - Max 18';
				}
			   //----------------------------------------------------------
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

		 }else{ //if nothing is coming from booking details
		   if (!$_SESSION['C']['a']>=1){ //los adultos no son ni mayor ni igual a uno
		     //echo $_SESSION['C']['a']." adultos";
		     $_GET['pasos']=4;
		     draw('booking_details');
			 die();
		   }

		 }
		//------------------------------------------------------
 if ($_GET['error']){
  $_GET['pasos']=4;
  draw('booking_details');
 }else{

	//SECCION QUE NO PERMITE POST ESTA PAGINA DOS VECES.
	 if ($_POST['confirm']=="Check Out"){ //ONLY IF CONFIRM HAVE BEEN PRESSED

	      //AQUI DE NUEVO BUSCAR QUE LA OCUPACION ESTA DISPONIBLE OTRA VEZ
	       //----------------------------------------------------------------------
	     $new_busy=check_villa_new($_SESSION['villa_details']['id'], $_SESSION['desde'], $_SESSION['hasta']);
		 $cant_new=count($new_busy);
		 if(!$cant_new>0){
	     //-----------------------------------------------------------------------
			 	$db= new subDB();
			//------varibles para el cliente----//
				if (!$_SESSION['customer']){
					$intermediario=$_SESSION['agent_id'];
					$password=$_SESSION['C']['pa'];
					$name_client=$_SESSION['C']['n'];
					$lastname_client=$_SESSION['C']['ln'];
					$email=$_SESSION['C']['el'];
					$phone=$_SESSION['C']['ph'];
					$phone2=$_SESSION['C']['ph2'];
					$fax=$_SESSION['C']['fx'];
					$cedula=$_SESSION['C']['c'];
					$passport=$_SESSION['C']['p'];
					$language=$_SESSION['C']['lg'];
					$zip=$_SESSION['C']['zp'];
					$address=$_SESSION['C']['ad'];
					$country=$_SESSION['C']['cy'];
					$state=$_SESSION['C']['state'];
					$city=$_SESSION['C']['city'];
					$photo="";
					$comentario="How did you hear about us? ".$_SESSION['C']['ha'];
					if ($_SESSION['C']['rn']!=""){$comentario.=": ".$_SESSION['C']['rn']; }
					$comentario.=" (IP:".$_SERVER['REMOTE_ADDR'].")";
					if ($_SESSION['buy']==1){$comentario.="<br/> This client is interested in purchase information"; }

					$active="1";
					$class="0";
					$id_adm="0";
					$ename=$_SESSION['C']['ne'];
					$ephone=$_SESSION['C']['phe'];

					//-----------terminan variales del cliente----------//
					$id_client=$db->newCustomer_online($intermediario, $password, '1', $name_client, $lastname_client, $email, $phone, $phone2, $fax, $cedula, $passport, $language, $zip, $address, $country, $state, $city, $photo, $comentario,  $active, $class, $id_adm, '0', $ename, $ephone, $_SESSION['buy']); //save new client
				}else{//if the client already exist
					$id_client=$_SESSION['customer']['id'];

				}
				//--variables para la ocupacion----//
				$starting=$_SESSION['desde'];
				$ending=$_SESSION['hasta'];
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
				$qty_nights=$_SESSION['total_noches'];
				$HS_nights=$_SESSION['noches_HS'];
				$LS_nights=$_SESSION['noches_LS'];
				$price_per_night=$_SESSION['villa_details']['p_low'];
				$priceHS=$_SESSION['villa_details']['p_high'];
				$amount_commision="0";
				$sub_total_rent=(($_SESSION['total'])-($_SESSION['itbis']));
				$ITBIS=$_SESSION['itbis'];
				$services_amount="0";
				$deposit="0";
				$general_amount=$_SESSION['total'];
				/*$status="50"; */ /*temporary status no booked, only to save the info until received the payment[Invalid-no paid]*/
				$status="3"; /*---not confirmed*/
				if ($_SESSION['buy']==1){$reserve_comment.="<br/> This client is interested in purchase information"; }
				/*if (trim($_SESSION['comment'])!=""){$reserve_comment.="<br/> NOTE: ".$_SESSION['comment']; }
				if (trim($_SESSION['airline'])!=""){$reserve_comment.="<br/> AIRLINE: ".$_SESSION['airline']; }
				if (trim($_SESSION['datetime'])!=""){$reserve_comment.=" DATE/TIME: ".$_SESSION['datetime']; }*/

				//$reserve_comment="";
				$vd=$_SESSION['villa_details'];

				//-----variables para la reserva-----//
				$id_reserve=$db->insert_short_reserva_online($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment, "1");  //INSERT RESERVE AND TAKE IT ID

				//--------------- INSERT SERVICES BELOW----------------------------------------------------------------------------------
                $all_services_booked=array();
				if ($_SESSION['massage']>0){ $db->insert_additional_services($_SESSION['massage'], $id_reserve, $qty=1, $_POST['massage_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['massage']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['massage_amount']));
				}
				if ($_SESSION['pickup']>0){ $db->insert_additional_services($_SESSION['pickup'], $id_reserve, $qty=1, $_POST['pickup_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['pickup']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['pickup_amount']));
				}
				if ($_SESSION['VIPpickup']>0){ $db->insert_additional_services($_SESSION['VIPpickup'], $id_reserve, $qty=1, $_POST['VIPpickup_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['VIPpickup']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['VIPpickup_amount']));
				}
				if ($_SESSION['chef']>0){ $db->insert_additional_services($_SESSION['chef'], $id_reserve, $qty=1, $_POST['chef_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['chef']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['chef_amount']));
				}
				if ($_SESSION['fridge']>0){ $db->insert_additional_services($_SESSION['fridge'], $id_reserve, $qty=1, $_POST['fridge_amount'], " ");
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['fridge']['title'], 'qty'=>'1', 'price'=>'', 'total'=>$_POST['fridge_amount']));
				}
				/*if ($_POST['cars_id']>0){ $db->insert_additional_services($_POST['cars_id'], $id_reserve,$_POST['cars_days'], $_POST['cars_amount'], $comment="");    //INSERT RENTAL CARS
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['carros']['title'], 'qty'=>$_POST['cars_days'], 'price'=>'', 'total'=>$_POST['cars_amount']));
				} */
				if ($_POST['chofer_id']>0){ $db->insert_additional_services($_POST['chofer_id'], $id_reserve,$_POST['chofer_days'], $_POST['chofer_amount'], $comment="");    //INSERT CHOFER SERVICES
				      array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['chofer']['title'], 'qty'=>$_POST['chofer_days'], 'price'=>'', 'total'=>$_POST['chofer_amount']));
				}

				if ($_POST['laundry_id']>0){ $db->insert_additional_services($_POST['laundry_id'], $id_reserve,$qty=1, $_POST['laundry_amount'], $comment="");    //laundry
				     array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['laundry']['title'], 'qty'=>'', 'price'=>'', 'total'=>$_POST['laundry_amount']));
				}
				if ($_POST['dish_id']>0){ $db->insert_additional_services($_POST['dish_id'], $id_reserve,$_POST['dish_days'], $_POST['dish_amount'], $comment="");    //dish washing
				    array_push($all_services_booked,  array('title'=>$_SESSION['info_servicios']['dish']['title'], 'qty'=>$_POST['dish_days'], 'price'=>'', 'total'=>$_POST['dish_amount']));
				}
				$_SESSION['servicios_selected']=$all_services_booked;

				/*===================================insert cars no charge them to RCL=======================================*/
				if($_SESSION['cars']){ /*si hay carros seleccionados*/                 //insertarlos en la base de datos .
                  foreach($_SESSION['cars'] AS $k){                  	$total4thiscar=$_SESSION['cars_qty'][$k]*$_SESSION['car_price'][$k];
                  	$car_taxes=$total4thiscar*0.18;
	                 $inf_data=array('ref'=>$ref,
					                 'date'=>date("Y-m-d G:i:s"),
					                 'qty_days'=>$_SESSION['cars_qty'][$k],
					                 'id_car'=>$k,
					                 'price'=>$_SESSION['car_price'][$k],
					                 'taxes'=>$car_taxes,
					                 'status'=>'1',
					                 'ip_address'=>$_SERVER['REMOTE_ADDR'],
					                 'user_id'=>'0');

				  	$in_cars=$db->insert_gral($inf_data, $table='cars_rented');
				  }				}
				/*============================================================================================================*/
				//------------------END INSERTING SERVICES--------------------------------------------------------------------------------
				$adults_qty=$_SESSION['C']['a'];
				$children_qty=$_SESSION['C']['k'];

					if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
					  for ($x=1;$x<=$adults_qty; $x++){
					  	$a_name="a_name$x"; $a_lastname="a_lastname$x";
					  	$name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];
					    $db->insert_adults($id_reserve, $name, $lastname, $cedula="");
					  }
					}

					if ($children_qty>0){    //si la cantidad de niños sobrepasa 1 entonces son insertado en la base de datos
					  for ($c=1;$c<=$children_qty; $c++){
					  	$c_name="c_name$c"; $c_lastname="c_lastname$c";
					  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname];
					    $db->insert_children($id_reserve, $name, $lastname, $passport="");
					  	}
					}
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

				    if($_SESSION['evento']){ /* GUARDAR EVENTO SI HAY EN LA SESSION*/
				     //print_r($_SESSION['evento']);
				     $fecha=date("Y-m-d G:i:s");
				     $result=$db->insert_events_saved($fecha,$ref,$_SESSION['evento']['name'],$_SESSION['evento']['from_date'],$_SESSION['evento']['to_date'],$_SESSION['evento']['qty'],$_SESSION['evento']['type'],$_SESSION['evento']['increase'], $id_adm, $_SESSION['evento']['id']);

				    }
				   /* TERMINO DE GUARDAR LOS EVENTOS*/

			    	if ($_SESSION['WEBSITE']){
		                  $result=$db->in_webpage($ref, $_SESSION['WEBSITE']);
		            }  //END WEBPAGE  URL
		      //----------------- save this website as a referral------------------------------------------------
                    $_SESSION['REFERRALID']=$_SESSION['agent_id'];

		            if ($_SESSION['REFERRALID']>0){
						    $link= new getQueries();
						    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');

							  if ($referido_anterior){
							  	$id_update=$db->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
							    $actualizado=$db->update_assign($referido_anterior[0]['id'], $ref, $_SESSION['REFERRALID'], $id_adm, $id_update);
							  }else{

								$result=$db->Assign_a_booking($ref, $_SESSION['REFERRALID'], $id_adm);
							  }
				    }
		      //--------------------------------------------------------*--------
		     //INSERTAR EXCURSIONES MAS ABAJOS
		      if ($_SESSION['excursions']){
		       $all_excur_booked=array();
		      	foreach($_SESSION['excursions'] AS $k){
					$id_excursion=$k;
					$id_reserva=$id_reserve;
					$qty_adult=$_SESSION['excur'][$k]['adults'];
					$qty_child=$_SESSION['excur'][$k]['kids'];
					$precio_a=$_SESSION['excur'][$k]['pa'];
					$precio_c=$_SESSION['excur'][$k]['pc'];
					$total_excursion=(($qty_adult*$precio_a)+($qty_child*$precio_c));		         	$excursiones=$db->in_excur_booked($id_excursion, $id_reserva, $qty_adult, $qty_child, $precio_a, $precio_c, $total_excursion); //insert ocupation and returm id of insertion
		         	array_push($all_excur_booked, array('title'=>$_SESSION['excur'][$k]['title'], 'adult'=>$qty_adult, 'kid'=>$qty_child, 'Pa'=>$precio_a, 'Pk'=>$precio_c, 'total'=>$total_excursion));
		      	}
		      	 $_SESSION['all_info']['excursion']=$all_excur_booked;		      }
		      //INSERTAR EXCURIONES MAS ARRIBAS


					//--------------send by emails to reservations and client-----------
                  /*
					if ($_SESSION['customer']){
		                $name_client=utf8_decode($_SESSION['customer']['name']);
		                $lastname_client=utf8_decode($_SESSION['customer']['lastname']);
		                $email=$_SESSION['customer']['email'];
		                $phone=$_SESSION['customer']['phone'];
		                $address=utf8_decode($_SESSION['customer']['address']);
					}

								 //codigo para promotion code//-->

							                $disc_found=$this_pro[0];
								              if ($disc_found){
								                    $amount_nightsLS=($LS_nights*$vd['p_low']);
								                    $amount_nightsHS=($HS_nights*$vd['p_high']);
								                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

								                     if  ($disc_found['tipo']=="2"){   //Amount
								                           $descuento=($disc_found['cant_porc']);
								                           $variable_descuento="US$ ".$disc_found['cant_porc']." ";
								                           $tipo_desc="monto";
								                           $promotion_code=$disc_found['code'];

								                     }elseif($disc_found['tipo']=="1"){
								                        $descuento=($amount_nights*($disc_found['cant_porc']/100));
								                         $variable_descuento=number_format($disc_found['cant_porc'],0)." % ";
								                         $tipo_desc="porcient";
								                         $promotion_code=$disc_found['code'];
								                     }
								              } */
								//codigo para promotion code//-->
          /*======================================START ACCOUNTING INFO=============================================================*/
          if (!$_SESSION['customer']['name']){
		                $_SESSION['customer']['name']=$name_client;
		                $_SESSION['customer']['lastname']=$lastname_client;
		                $_SESSION['customer']['email']=$email;
		                $_SESSION['customer']['phone']=$phone;
		                $_SESSION['customer']['address']=$address;
		  }
									 $_SESSION['all_info']['client']=$_SESSION['customer'];
									 $_SESSION['all_info']['villa']=$_SESSION['villa_details'];
									  $_SESSION['all_info']['book']['ref']=$ref;
									  $_SESSION['all_info']['book']['from']=date('m/d/Y',strtotime($_SESSION['desde']));
									  $_SESSION['all_info']['book']['to']=date('m/d/Y',strtotime($_SESSION['hasta']));
									  $_SESSION['all_info']['book']['LSnight']=$_SESSION['noches_LS'];
									  $_SESSION['all_info']['book']['LSprice']=$price_per_night;/*$_SESSION['cust_book']['ppn']; */
									  $_SESSION['all_info']['book']['HSnight']=$_SESSION['noches_HS'];
									  $_SESSION['all_info']['book']['HSprice']=$priceHS;/*$_SESSION['cust_book']['PHS']; */
									  $_SESSION['all_info']['book']['sub-total']=$sub_total_rent;
									  $_SESSION['all_info']['book']['itbis']=$_SESSION['itbis'];
									  $_SESSION['all_info']['book']['total_geral']=$general_amount;/*$_SESSION['total']*/;
									  $_SESSION['all_info']['book']['deposited']='';
									  if($_SESSION['excursions']){
										foreach($_SESSION['excursions'] AS $k){
										$total_excur=($k['qty_adult']*$k['price_a']+$k['price_k']*$k['qty_kid']);
										}
									  }
									/* $_SESSION['all_info']['excursion']=$all_excur_booked;  */
									 if($_SESSION['servicios_selected']){
										 $_SESSION['all_info']['service']=$_SESSION['servicios_selected'];
									 }


		  /*===========================================END ACCOUNTING INFO=============================================================================================*/
					 /* $servidor_destino=$_SERVER['REMOTE_ADDR'];*/
			         /* $body_reservation="";
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
										        None-Peak Season ".$LS_nights." nights x US$ ".number_format($vd['p_low'],2)." = <br/>
										        Peak Season ".$HS_nights." nights x US$ ".number_format($vd['p_high'],2)." =<br/>";
										         //codigo promotion//-->

												   if (($descuento>0)&&($tipo_desc=="monto")){

												     $body_reservation.="<span style=\"text-align:right; color:green;\">
												    	($promotion_code)	Discount =</span><br/>";
		                                             $body_reservation.="<span style=\"font-weight:bold; color:green;\">Amount after discount =</span><br/>";
												    }

												     if (($descuento>0)&&($tipo_desc=="porcient")){
												    	$body_reservation.="<span  style=\"text-align:right; color:green;\">
												    		($promotion_code) $variable_descuento Discount of ".number_format($amount_nights,2)." =</span><br/>";
		                                                $body_reservation.="<span style=\"font-weight:bold; color:green;\">Amount after discount =</span><br/>";
												    }


											     //fin codigo promotion//-->
		                            if ($descuento==0) $body_reservation.="<span style=\"font-weight:bold;\">Sub-Total=</span><br/>";

		                            //----------services below------------------------------------------------------------------------------------------------------
									if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_POST['cars_id']>0 || $_POST['chofer_id']>0 || $_POST['laundry_id']>0 || $_POST['dish_id']>0){		                            $result= new getQueries();
		       							if ($_SESSION['massage']>0){		       							  $massage_details=$result->additional_service($_SESSION['massage'], 'massage');
		                                  $body_reservation.="<span style=\"color:blue;\">Massage ".$massage_details['name']." =</span><br/>";
		                                  $amount_massage=$massage_details['price'];
										}
										 if ($_SESSION['pickup']>0){										 	$pickup_details=$result->additional_service($_SESSION['pickup'], 'Airport Pick Up');
		                                    $body_reservation.="<span style=\"color:blue;\">".$pickup_details['name']."=</span><br/>";
		                                    $amount_pickup=$pickup_details['price'];
										}
										 if ($_SESSION['VIPpickup']>0){										 	$VIPpickup_details=$result->additional_service($_SESSION['VIPpickup'], 'VIP Airport Pick Up');
		                                    $body_reservation.="<span style=\"color:blue;\">".$VIPpickup_details['name']."=</span><br/>";
										 	$amount_VIPpickup=$VIPpickup_details['price'];
										}
										 if ($_SESSION['chef']>0){
		                                  $chef_details=$result->additional_service($_SESSION['chef'], 'chef');
		                                  $body_reservation.="<span style=\"color:blue;\"> ".$chef_details['name']."=</span><br/>";
		                                  $amount_chef=$chef_details['price'];
										}
										 if ($_SESSION['fridge']>0){
										 $fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
		                                 $body_reservation.="<span style=\"color:blue;\">Filled Fridge ".$fridge_details['name']."=</span><br/>";
		         						 $amount_fridge=$fridge_details['price'];
										}

										if ($_POST['cars_id']>0){
										 //$fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
		                                 $body_reservation.="<span style=\"color:blue;\">".$_POST['carros_online']."=</span><br/>";
		         						 //$amount_fridge=$fridge_details['price'];
										}
										if ($_POST['chofer_id']>0){
										 //$fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
		                                 $body_reservation.="<span style=\"color:blue;\">".$_POST['chofer_online']."=</span><br/>";
		         						 //$amount_fridge=$fridge_details['price'];
										}

         	                            if ($_SESSION['laundry']>0){
		                                  $chef_details=$result->additional_service($_SESSION['laundry'], 'Laundry');
		                                  $body_reservation.="<span style=\"color:blue;\"> ".$chef_details['name']."=</span><br/>";
		                                  $amount_laundry=$_POST['laundry_amount'];
										}
										 if ($_SESSION['dish']>0){
										 $fridge_details=$result->additional_service($_SESSION['dish'], 'Dish Washing Service');
		                                 $body_reservation.="<span style=\"color:blue;\">".$fridge_details['name']."=</span><br/>";
		         						 $amount_dish=$_POST['dish_amount'];
										}

										$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup+$_POST['cars_amount']+$_POST['chofer_amount']+$amount_laundry+$amount_dish);
										$body_reservation.="Total additionals services=<br/>";

									}
		                           //--------service above----------------------------------------------------------------------------------------------------------

		                            //----------EXCURSIONES BELOW----------------------------
		                            if($_SESSION['excursions']){
						                foreach($_SESSION['excursions'] AS $k){
						                   $body_reservation.="<span style=\"color:#cc1c0a;\">".substr($_SESSION['excur'][$k]['title'],0,30)." (".$_SESSION['excur'][$k]['adults']." adults) (".$_SESSION['excur'][$k]['kids']." kids)</span><br/>";
						                }
						             }
		                            //----------EXCRUSIONES ABOVE---------------------------
		                           $body_reservation.="VAT-TAX ".TAX_PERCENT." =<br/>";

									$body_reservation.="<span style=\"font-weight:bold;\">TOTAL =</span>
										        </td>
										        <td align=\"right\" width=\"105px\">
										        US$ ".number_format($total_ls,2)."<br/>
										        US$ ".number_format($total_hs,2)."<br/>";
										         //codigo promotion//-->
											       if ($descuento>0){
												   	$body_reservation.="<span  style=\"text-align:right; color:green;\"><u>US$ ".number_format($descuento,2)."</u></span><br/>";
								                    $body_reservation.="<span  style=\"font-weight:bold; text-align:right; color:green;\">USD ".number_format(($total_ls+$total_hs)-($descuento),2)."</span><br/>";
		                                           }else{
		                                            //fin codigo promotion//-->
											    	$body_reservation.="<span style=\"font-weight:bold;\">
											        US$ ".number_format(($total_ls+$total_hs),2)."<br/>
											        </span>";
											        }

									 //----------services below------------------------------------------------------------------------------------------------------
									if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_POST['cars_id']>0 || $_POST['chofer_id']>0 || $_POST['laundry_id']>0 || $_POST['dish_id']>0){

		       							if ($_SESSION['massage']>0){
		                                  $body_reservation.="US$ ".number_format($amount_massage,2)."<br/>";
										}
										 if ($_SESSION['pickup']>0){
		                                  $body_reservation.="US$ ".number_format($amount_pickup,2)."<br/>";
										}
										 if ($_SESSION['VIPpickup']>0){
		                                  $body_reservation.="US$ ".number_format($amount_VIPpickup,2)."<br/>";
										}
										 if ($_SESSION['chef']>0){
		                                  $body_reservation.="US$ ".number_format($amount_chef,2)."<br/>";
										}
										 if ($_SESSION['fridge']>0){
		                                  $body_reservation.="US$ ".number_format($amount_fridge,2)."<br/>";
										}
										 if ($_POST['cars_id']>0){
		                                  $body_reservation.="US$ ".number_format($_POST['cars_amount'],2)."<br/>";
										}
										 if ($_POST['chofer_id']>0){
		                                  $body_reservation.="US$ ".number_format($_POST['chofer_amount'],2)."<br/>";
										}
										 if ($_POST['laundry_id']>0){
		                                  $body_reservation.="US$ ".number_format($_POST['laundry_amount'],2)."<br/>";
										}
										 if ($_POST['dish_id']>0){
		                                  $body_reservation.="US$ ".number_format($_POST['dish_amount'],2)."<br/>";
										}

		                              $body_reservation.="US$ ".number_format($sub_services,2)."<br/>";
									}
		                           //--------service above----------------------------------------------------------------------------------------------------------

		                           //----------EXCURSIONES BELOW----------------------------
		                             if($_SESSION['excursions']){
						                  $total_excursions=0;
						                 foreach($_SESSION['excursions'] AS $k){
						                 $total_esta_excursion=($_SESSION['excur'][$k]['adults']*$_SESSION['excur'][$k]['pa'])+($_SESSION['excur'][$k]['kids']*$_SESSION['excur'][$k]['pc']); $total_excursions+=$total_esta_excursion;
						                   $body_reservation.="<span style=\"color:#cc1c0a;\">US$ ".number_format($total_esta_excursion,2)."</span><br/>";
						                }
						             }
		                            //----------EXCRUSIONES ABOVE---------------------------
		                           	$body_reservation.="US$ ".number_format($ITBIS,2)."<br/>";

									$body_reservation.="<span style=\"font-weight:bold;\">
										        US$ ".number_format($general_amount,2).
										        "</span>
										        </td>
											</tr>
										</table>";
										$body_reservation.="<hr/>";
										$body_reservation.="<p>Payment Link for client (It has been sent to client): <a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$ref&amount=$general_amount&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Payment link\">Link for payment Booking No:$ref</a></p>";

		        	 if ($_SESSION['customer']){
		                $body_reservation.="<p>Note: <u>This client is coming back</u></p>";
						unset($_SESSION['customer']);
		          	}

			          $body_reservation.="</body></html>"; */
			          #sendMail($body_reservation, RESERVATIONS_EMAIL, "Booking No: ".$ref, "online.booking@casalindacity.com", "RCL Booking System");//send to reservations
			          //============================================================================================
					  /*
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
										        None-Peak Season ".$LS_nights." nights x US$ ".number_format($vd['p_low'],2)." = <br/>
										        Peak Season ".$HS_nights." nights x US$ ".number_format($vd['p_high'],2)." =<br/>";
										        //codigo promotion//-->

												   if (($descuento>0)&&($tipo_desc=="monto")){

												     $body_client.="<span style=\"text-align:right; color:green;\">
												    	($promotion_code)	Discount =</span><br/>";
		                                             $body_client.="<span style=\"font-weight:bold; color:green;\">Amount after discount =</span><br/>";
												   }

												     if (($descuento>0)&&($tipo_desc=="porcient")){
												    	$body_client.="<span  style=\"text-align:right; color:green;\">
												    		($promotion_code) $variable_descuento Discount of ".number_format($amount_nights,2)." =</span><br/>";
		                                                $body_client.="<span style=\"font-weight:bold; color:green;\">Amount after discount =</span><br/>";
												    }


											     //fin codigo promotion//-->
		                                       if ($descuento==0) $body_client.="<span style=\"font-weight:bold;\">Sub-Total=</span><br/>";

		                                      //----------services below------------------------------------------------------------------------------------------------------
									if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_POST['cars_id']>0 || $_POST['chofer_id']>0 || $_POST['laundry_id']>0 || $_POST['dish_id']>0){
		                            $result= new getQueries();
		       							if ($_SESSION['massage']>0){
		       							  $massage_details=$result->additional_service($_SESSION['massage'], 'massage');
		                                  $body_client.="<span style=\"color:blue;\">Massage ".$massage_details['name']." =</span><br/>";
		                                  $amount_massage=$massage_details['price'];
										}
										 if ($_SESSION['pickup']>0){
										 	$pickup_details=$result->additional_service($_SESSION['pickup'], 'Airport Pick Up');
		                                    $body_client.="<span style=\"color:blue;\">".$pickup_details['name']." =</span><br/>";
		                                    $amount_pickup=$pickup_details['price'];
										}
										 if ($_SESSION['VIPpickup']>0){
										 	$VIPpickup_details=$result->additional_service($_SESSION['VIPpickup'], 'VIP Airport Pick Up');
		                                    $body_client.="<span style=\"color:blue;\">".$VIPpickup_details['name']." =</span><br/>";
										 	$amount_VIPpickup=$VIPpickup_details['price'];
										}
										 if ($_SESSION['chef']>0){
		                                  $chef_details=$result->additional_service($_SESSION['chef'], 'chef');
		                                  $body_client.="<span style=\"color:blue;\"> ".$chef_details['name']." =</span><br/>";
		                                  $amount_chef=$chef_details['price'];
										}
										 if ($_SESSION['fridge']>0){
										 $fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
		                                 $body_client.="<span style=\"color:blue;\">Filled Fridge ".$fridge_details['name']." =</span><br/>";
		         						 $amount_fridge=$fridge_details['price'];
										}
		                                if ($_POST['cars_id']>0){
										 //$fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
		                                 $body_client.="<span style=\"color:blue;\">".$_POST['carros_online']."=</span><br/>";
		         						 //$amount_fridge=$fridge_details['price'];
										}
										if ($_POST['chofer_id']>0){
										 //$fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
		                                 $body_client.="<span style=\"color:blue;\">".$_POST['chofer_online']."=</span><br/>";
		         						 //$amount_fridge=$fridge_details['price'];
										}
										if ($_SESSION['laundry']>0){
		                                  $chef_details=$result->additional_service($_SESSION['laundry'], 'Laundry');
		                                  $body_reservation.="<span style=\"color:blue;\"> ".$chef_details['name']."=</span><br/>";
		                                  $amount_laundry=$_POST['laundry_amount'];
										}
										 if ($_SESSION['dish']>0){
										 $fridge_details=$result->additional_service($_SESSION['dish'], 'Dish Washing Service');
		                                 $body_reservation.="<span style=\"color:blue;\">".$fridge_details['name']."=</span><br/>";
		         						 $amount_dish=$_POST['dish_amount'];
										}
										$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup+$_POST['cars_amount']+$_POST['chofer_amount']+$amount_laundry+$amount_dish);
										$body_client.="Total additionals services=<br/>";

									}
		                           //--------service above----------------------------------------------------------------------------------------------------------
		                              //----------EXCURSIONES BELOW----------------------------
		                                if($_SESSION['excursions']){
							               foreach($_SESSION['excursions'] AS $k){
							                 $body_client.="<span style=\"color:#cc1c0a;\">".substr($_SESSION['excur'][$k]['title'],0,30)." (".$_SESSION['excur'][$k]['adults']." adults) (".$_SESSION['excur'][$k]['kids']." kids)</span><br/>";
							               }
							            }
		                            //----------EXCRUSIONES ABOVE---------------------------

		                            $body_client.=" VAT-TAX ".TAX_PERCENT." =<br/>";

										 $body_client.="<span style=\"font-weight:bold;\">TOTAL =</span>
										        </td>
										        <td align=\"right\" width=\"105px\">
										        US$ ".number_format($total_ls,2)."<br/>
										        US$ ".number_format($total_hs,2)."<br/>";
										         //codigo promotion//-->
											       if ($descuento>0){
												   	$body_client.="<span  style=\"text-align:right; color:green;\"><u>US$ ".number_format($descuento,2)."</u></span><br/>";
								                    $body_client.="<span  style=\"font-weight:bold; text-align:right; color:green;\">USD ".number_format(($total_ls+$total_hs)-($descuento),2)."</span><br/>";
		                                           }else{
		                                            //fin codigo promotion//-->
											    	$body_client.="<span style=\"font-weight:bold;\">
											        US$ ".number_format(($total_ls+$total_hs),2)."<br/>
											        </span>";
											        }

										          	 //----------services below------------------------------------------------------------------------------------------------------
									if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_POST['cars_id']>0 || $_POST['chofer_id']>0 || $_POST['laundry_id']>0 || $_POST['dish_id']>0){

		       							if ($_SESSION['massage']>0){
		                                  $body_client.="US$ ".number_format($amount_massage,2)."<br/>";
										}
										 if ($_SESSION['pickup']>0){
		                                  $body_client.="US$ ".number_format($amount_pickup,2)."<br/>";
										}
										 if ($_SESSION['VIPpickup']>0){
		                                  $body_client.="US$ ".number_format($amount_VIPpickup,2)."<br/>";
										}
										 if ($_SESSION['chef']>0){
		                                  $body_client.="US$ ".number_format($amount_chef,2)."<br/>";
										}
										if ($_SESSION['fridge']>0){
		                                  $body_client.="US$ ".number_format($amount_fridge,2)."<br/>";
										}
		                                if ($_POST['cars_id']>0){
		                                  $body_client.="US$ ".number_format($_POST['cars_amount'],2)."<br/>";
										}
										if ($_POST['chofer_id']>0){
		                                  $body_client.="US$ ".number_format($_POST['chofer_amount'],2)."<br/>";
										}
										if ($_POST['laundry_id']>0){
		                                  $body_reservation.="US$ ".number_format($_POST['laundry_amount'],2)."<br/>";
										}
										 if ($_POST['dish_id']>0){
		                                  $body_reservation.="US$ ".number_format($_POST['dish_amount'],2)."<br/>";
										}
		                              $body_client.="US$ ".number_format($sub_services,2)."<br/>";
									}
		                           //--------service above----------------------------------------------------------------------------------------------------------

		                             //----------EXCURSIONES BELOW----------------------------
		                              if($_SESSION['excursions']){
						                  $total_excursions=0;
						                foreach($_SESSION['excursions'] AS $k){
						                 $total_esta_excursion=($_SESSION['excur'][$k]['adults']*$_SESSION['excur'][$k]['pa'])+($_SESSION['excur'][$k]['kids']*$_SESSION['excur'][$k]['pc']); $total_excursions+=$total_esta_excursion;
						                   $body_client.="<span style=\"color:#cc1c0a;\">US$ ".number_format($total_esta_excursion,2)."</span><br/>";
						                }
						             }
		                            //----------EXCRUSIONES ABOVE---------------------------
		                             $body_client.="US$ ".number_format($ITBIS,2)."<br/>";

										$body_client.="<span style=\"font-weight:bold;\">
										        US$ ".number_format($general_amount,2).
										        "</span>
										        </td>
											</tr>
										</table>";
		               $body_client.="<p><a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$ref&amount=$general_amount&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Pay this booking\">Pay now, if you could not pay this booking before.</a></p>";
					$body_client.="</body></html>";*/


					require_once('../clients_online/inc/functs.php');

				#$body1=email_template($email_client=$_SESSION['all_info']['client']['email'], $booking_no=$_SESSION['all_info']['book']['ref'], $array_info=$_SESSION['all_info'], $ip=$_SERVER['REMOTE_ADDR']);
                #$body2=email_template($email_client=$_SESSION['all_info']['client']['email'], $booking_no=$_SESSION['all_info']['book']['ref'], $array_info=$_SESSION['all_info'], $ip='');

				# sendMail($body1, RESERVATIONS_EMAIL, "Booking No: ".$ref, "online.booking@casalindacity.com", "RCL Booking System");//send to reservations
			     #sendMail($body2, $email=$_SESSION['all_info']['client']['email'], "Booking No: ".$ref, RESERVATIONS_EMAIL, "Residencial Casa Linda");//send to client
                 /*echo $body2;
                 echo "</br>";
				 echo $body1;*/


			        unset($_SESSION['RCL2']);//kill this page - PARA EVITAR REFRESCAR LA PAGINA CON POST;
					unset($_SESSION['RCL1']);// kill page booking details session
					unset($_SESSION['villa_details']); //QUITAR ESTA VILLA
					unset($_SESSION['desde']);
					unset($_SESSION['hasta']);
					unset($_SESSION['C']);
					unset($_SESSION['total_noches']);
					unset($_SESSION['noches_HS']);
					unset($_SESSION['noches_LS']);
					unset($_SESSION['itbis']);
					unset($_SESSION['total']);
					session_destroy(); /*destruir todas las sesiones*/

					if($_POST['payment_option']==50){                     $monto_monto_a_pagar=number_format(($general_amount/2),2);					}else{					 $monto_monto_a_pagar=$general_amount;					}

					//-------------- end send by email ------------------------------
		            /* echo $body_reservation; echo "<br/>"; echo $body_client; */
					//--------------pay the amount through paypal----------------
					?>
					<!--//HEADER AQUI //-->
					<? /* include_once('plantillas/cabeza_nocol.php');*/?>
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
						    <input type="hidden" name="item_name" value="Iten Number - <?=$ref?>">
						    <input type="hidden" name="amount" value="<?=$monto_monto_a_pagar?>">
						    <input type="hidden" name="return" value="http://www.CasaLindaCity.com/" />  <!--http://www.CasaLindaCity.com/thanks.html-->
						    <input type="hidden" name="currency_code" value="USD">
						   <!-- Display the payment button. -->
							   <!--<input type="image" name="submit" border="0" src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
							    <img alt="" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" >-->
						 </form>
						 <?/*=$_POST['payment_option']*/?>  <!--//pago<br/>//-->
			            <p><img src="images/loading.gif" alt="" width="16px" height="16px;" border="0" style="float:left;">&nbsp;Please, wait... </p>

						<script language="JavaScript" type="text/javascript">
						<!--
						document.payp.submit();
						//-->
						</script>

						<!--//FOOTER AQUI //-->
				 </body>
				</html>
					<?
					//---------------end payment---------------------------------
		           //  echo  $_SESSION['promotion_id']." promotion ID";
		         //include_once('plantillas/pie.php');
	     }else{	     	//header
	      include_once('plantillas/cabeza_nocol.php');
      	  new_booking_busy_error($_SESSION['desde'], $_SESSION['hasta'], $link="availability_result.php");
      	  include_once('plantillas/pie.php');
      	  //footer
    	 }

	 }else{  //if not post
	  draw('booking_confirm'); //presenta el formulario y detalles

	 }
 }// if not get error


		?>