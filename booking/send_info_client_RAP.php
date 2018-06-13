<?php
 session_start();
if ($_SESSION['info']){
	//$_GET['p']='b'; $_GET['s']='b.n';
	require_once('init.php');
	//display_1('send_info_client');
	//display('send_info_client_RAP');

	?>

				<?php
			if ($_POST['ref']) $_GET['ref']=$_POST['ref'];
			$_GET['ref']=trim($_GET['ref']);


			   if ($_GET['ref']!=""){
				   	$db= new getQueries();
				   	$reference=$_GET['ref'];
					$reference=str_pad($reference, 9, "0", STR_PAD_LEFT);
					$book=$db->see_occupancy_ref($reference); //get reservation details
					$booking=$book[0];

					if ($booking){
				//============================================================================================
				     if(($booking['status']!=0)&&($booking['status']!=5)){
						$info_sent_by=ucfirst($_SESSION['info']['name'])." ".ucfirst($_SESSION['info']['lastname']);
						//client details
				 		if(($booking['status']!=7)&&($booking['status']!=19)&&($booking['status']!=20)&&($booking['status']!=21)&&($booking['status']!=22)&&($booking['status']!=23)&&($booking['status']!=24)&&($booking['status']!=25)){  //it is client
					 		$cl=$db->customer($booking['client']);//get cliente details
							$name=$cl['name'];
							$lastname=$cl['lastname'];
							$email=$cl['email'];
							$comming="CUSTOMER";
						}else{ //it is owner
							$owner=$db->show_id('owners', $booking['client']);
			                $cl=$owner[0];//get cliente details
							$name=$cl['name'];
							$lastname=$cl['lastname'];
							$email=$cl['email'];
							$comming="OWNER";
						}

					  if (filter_var($email,FILTER_VALIDATE_EMAIL)){
						$phone=$cl['phone'];
						$address=$cl['address'];
						//booking details
						$ref=$booking['ref'];
						$starting=$booking['start'];
						$ending=$booking['end'];
						$adults_qty=$booking['adults'];
						$children_qty=$booking['kids'];
						$LS_nights=$booking['NLS'];
						$HS_nights=$booking['NHS'];
						$ITBIS=$booking['itbis'];
						$general_amount=$booking['total'];
						//echo $booking['total'];
						//details for villa
						$villa=$db->villa($booking['villa']); //get villa details
						$vd=$villa[0];
						//--------------------
						$total_ls=$LS_nights*$booking['ppn'];
						$total_hs=$HS_nights*$booking['PHS'];
						$total_nights=$total_hs+$total_ls;
						//more details
						$link_for_pictures="https://www.casalindacity.com/for_rent/tor_pics/house".$vd['no'].".htm";
			            $payment_mensage="Click here to Pay now, if you could not pay this booking before.";
				//-----------------------------------------------------------------------------------------
					  $body_client="";
							  $body_client.="<html><head></head><body>";
							   $body_client.="<p style=\"text-align:center;\"><a href=\"http://www.casalindacity.com\" alt=\"\"><img src=\"https://www.casalindacity.com/for_rent/images/booking-system.jpg\" alt=\"Residencial Casa Linda\" border=\"0\" width=\"820px;\" height=\"172px;\"></a></p>";
							  $body_client.="<p>DEAR $comming,<br/> Thank you for choosing Residencial Casa Linda<br/> Below are the information for your booking:</p>";
							  $body_client.="<hr/>";
					    	  $body_client.="<table width=\"90%\" align=\"center\">
													<tr>
												        <td width=\"50%\">
												        <span style=\"font-weight:bold;\">$comming:</span><br/>".
												        $name." ".$lastname."<br/>".
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
												     </tr>";
									if(($booking['status']!=8)&&($booking['status']!=9)&&($booking['status']!=10)&&($booking['status']!=11)&&($booking['status']!=15)&&($booking['status']!=16)&&($booking['status']!=17)&&($booking['status']!=18)&&($booking['status']!=22)&&($booking['status']!=23)&&($booking['status']!=24)&&($booking['status']!=25)){ //if short term
										    //codigo para promotion code//-->
								                $this_disc=$db->show_any_data_limit1("discount", "reference", $ref, "=");
								                $disc_found=$this_disc[0];
									              if ($disc_found){
									                    $amount_nightsLS=($LS_nights*$booking['ppn']);
									                    $amount_nightsHS=($HS_nights*$booking['PHS']);
									                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

									                     if  ($disc_found['pro_type']=="2"){   //Amount
									                           $descuento=($disc_found['pro_qty']);
									                           $variable_descuento="US$ ".$disc_found['pro_qty']." ";
									                           $tipo_desc="monto";
									                           $promotion_code=$disc_found['pro_code'];

									                     }elseif($disc_found['pro_type']=="1"){
									                        $descuento=($amount_nights*($disc_found['pro_qty']/100));
									                         $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
									                         $tipo_desc="porcient";
									                         $promotion_code=$disc_found['pro_code'];
									                     }
									              }
											//codigo para promotion code//-->

										$monto_restante=$general_amount-$booking['dep'];
									   $body_client.="<tr>
												        <td align=\"right\" >
												        None-Peak Season ".$LS_nights." nights x US$ ".number_format($booking['ppn'],2)." = <br/>
												        Peak Season ".$HS_nights." nights x US$ ".number_format($booking['PHS'],2)." =<br/>";

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

										 $body_client.="VAT-TAX 16% =<br/>";
			                               //----------services below------------------------------------------------------------------------------------------------------
										if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0){
			                            $result= new getQueries();
			       							if ($_SESSION['massage']>0){
			       							  $massage_details=$result->additional_service($_SESSION['massage'], 'massage');
			                                  $body_client.="<span style=\"color:blue;\">Massage ".$massage_details['name']." =</span><br/>";
			                                  $amount_massage=$massage_details['price'];
											}
											 if ($_SESSION['pickup']>0){
											 	$pickup_details=$result->additional_service($_SESSION['pickup'], 'Airport Pick Up');
			                                    $body_client.="<span style=\"color:blue;\"><?=$pickup_details['name'];?> =</span><br/>";
			                                    $amount_pickup=$pickup_details['price'];
											}
											 if ($_SESSION['VIPpickup']>0){
											 	$VIPpickup_details=$result->additional_service($_SESSION['VIPpickup'], 'VIP Airport Pick Up');
			                                    $body_client.="<span style=\"color:blue;\"><?=$VIPpickup_details['name'];?> =</span><br/>";
											 	$amount_VIPpickup=$VIPpickup_details['price'];
											}
											 if ($_SESSION['chef']>0){
			                                  $chef_details=$result->additional_service($_SESSION['chef'], 'chef');
			                                  $body_client.="<span style=\"color:blue;\"> <?=$chef_details['name'];?> =</span><br/>";
			                                  $amount_chef=$chef_details['price'];
											}
											 if ($_SESSION['fridge']>0){
											 $fridge_details=$result->additional_service($_SESSION['fridge'], 'Filled Fridge');
			                                 $body_client.="<span style=\"color:blue;\">Filled Fridge <?=$fridge_details['name'];?> =</span><br/>";
			         						 $amount_fridge=$fridge_details['price'];
											}

											$sub_services=($amount_massage+$amount_fridge+$amount_chef+$amount_VIPpickup+$amount_pickup);
											$body_client.="Total additionals services=<br/>";

										}
			                           //--------service above----------------------------------------------------------------------------------------------------------
										 $body_client.="<span style=\"font-weight:bold;\">TOTAL =</span>
												         <br/>Deposit=
												         <br/>Amount to pay=
												        </td>
												        <td align=\"right\" width=\"105px\">
												        US$ ".number_format($total_ls,2)."<br/>
												        US$ ".number_format($total_hs,2)."<br/>";
												         //codigo promotion//-->
												       if ($descuento>0){
													   	$body_client.="<span  style=\"text-align:right; color:green;\"><u>US$ ".number_format($descuento,2)."</u></span><br/>";
									                    $body_client.="<span  style=\"font-weight:bold; text-align:right; color:green;\">USD ".number_format($booking['subtotal']-$booking['itbis'],2)."</span><br/>";
			                                           }else{
			                                            //fin codigo promotion//-->
												    	$body_client.="<span style=\"font-weight:bold;\">
												        US$ ".number_format($total_nights,2)."<br/>
												        </span>";
												        }
											$body_client.="US$ ".number_format($ITBIS,2)."<br/>";
			                                	 //----------services below------------------------------------------------------------------------------------------------------
										if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0){

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

			                              $body_client.="US$ ".number_format($sub_services,2)."<br/>";
										}
			                           //--------service above----------------------------------------------------------------------------------------------------------
											$body_client.="<span style=\"font-weight:bold;\">
												        US$ ".number_format($general_amount,2).
												        "</span><br/>
												        US$ ".number_format($booking['dep'],2).
												        "<br/>
														<span style=\"font-weight:bold;\">
												        US$ ".number_format($monto_restante,2).
												        "</span>
												        </td>
													</tr>";
													if ($booking['dep']>0) $payment_mensage="Click here to pay your remaining balance.";

													$pago_paypal=$monto_restante;
									}else{// if long term

			                         $body_client.="<tr>
												        <td align=\"right\" >";

			                 		if ($booking['EN']>0){ $pagos_enteros=($booking['PAYM']-1);}else{$pagos_enteros=$booking['PAYM'];}

				         			  $body_client.=" $pagos_enteros&nbsp;Monthly&nbsp;payments&nbsp;X&nbsp;<b>". number_format($booking['PMV'],2)."</b>&nbsp;=
				         			  					<br/>
			               							  ".$booking['EN']." Extra nights x <b>".$booking['ppn']."</b> =
			               							  	<br/>
												        <strong>GENERAL TOTAL =</strong>
												       </td>
												        <td align=\"right\" width=\"105px\">
			                                               USD ".number_format(($pagos_enteros*$booking['PMV']),2)."
			                                               <br/>
			                                               USD ".number_format(($booking['EN']*$booking['ppn']),2)."
												           <br/>
			                                               <strong>USD ".number_format($booking['total'],2)."</strong>
												        </td>
													</tr>";
													$pago_paypal=$general_amount;
										if (($pagos_enteros>1)||($pagos_enteros==1)&&($booking['EN']>0)){
											$pago_paypal=$booking['PMV']; $payment_mensage="Click here to do your first payment now, if you could not do this before.";
										}

									}
									$body_client.="</table>";

								   if ($booking['dep']<$general_amount){// solo pagar si el deposito menor que total
					               		$body_client.="<p><a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$ref&amount=$pago_paypal&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Make payment for this booking\">$payment_mensage</a></p>";
					               }

				                   $body_client.="<p><a href=\"$link_for_pictures\" alt=\"See pictures of villa\" title=\"see pictures of villa\">Click here to see pictures for your villa booked.</a></p>";
				                   $body_client.="<hr/>";
				                   $body_client.="<p style=\"text-align:right; font-size:9px;\">Infomation sent by: Refarral Agent (from RAP)<br>On ".date("Y-m-d G:i:s")."</a></p>";
							  $body_client.="</body></html>";
					          sendMail_copy_reservations($body_client, $email, "Information of your booking", RESERVATIONS_EMAIL, "RCL Booking System");//send to client
					          echo "<p style='color:green; text-align:center;'><b>The below infomation has been successfully sent to <span style='color:black;'>".$name." ".$lastname."</span> about booking <span style='color:black;'>No.:".$ref."</span></b></p>";

					          echo $body_client;

							//-------------- end send by email ------------------------------
					  }else{
						echo "<p style='color:red; text-align:center;'><b>Error:</b> Email is not valid for client ".$cl['id']."</p>";
					  }

					 }else{
						echo "<p style='color:red; text-align:center;'><b>Error:</b> It is impossible to send information for booking <span style='color:black;'>No.:".$reference."</span></p>";
					 }

					}else{
						echo "<p style='color:red; text-align:center;'><b>Error:</b> Booking not found in our system</p>";
					}
				}else{ echo "<p style='color:red; text-align:center;'>Missing reference number</p>"; }
			?>


	<?
}else{
	header('Location:login.php');
	die();
}
?>