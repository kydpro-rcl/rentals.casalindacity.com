<?php
/*function email_edit_services_client(){
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
						  $body_client.="</body></html>";
				         #sendMail($body_client, $email, "Booking No: ".$ref, RESERVATIONS_EMAIL, "Residencial Casa Linda");//send to client
	echo $body_client;
}*/
//-------------- end send by email to customer ------------------------------
/*function email_edit_services_admin(){
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
										if ($_SESSION['massage']>0 || $_SESSION['pickup']>0 || $_SESSION['VIPpickup']>0 || $_SESSION['chef']>0 || $_SESSION['fridge']>0 || $_POST['cars_id']>0 || $_POST['chofer_id']>0 || $_POST['laundry_id']>0 || $_POST['dish_id']>0){
			                            $result= new getQueries();
			       							if ($_SESSION['massage']>0){
			       							  $massage_details=$result->additional_service($_SESSION['massage'], 'massage');
			                                  $body_reservation.="<span style=\"color:blue;\">Massage ".$massage_details['name']." =</span><br/>";
			                                  $amount_massage=$massage_details['price'];
											}
											 if ($_SESSION['pickup']>0){
											 	$pickup_details=$result->additional_service($_SESSION['pickup'], 'Airport Pick Up');
			                                    $body_reservation.="<span style=\"color:blue;\">".$pickup_details['name']."=</span><br/>";
			                                    $amount_pickup=$pickup_details['price'];
											}
											 if ($_SESSION['VIPpickup']>0){
											 	$VIPpickup_details=$result->additional_service($_SESSION['VIPpickup'], 'VIP Airport Pick Up');
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

				          $body_reservation.="</body></html>";
 #sendMail($body_reservation, RESERVATIONS_EMAIL, "Booking No: ".$ref, "online.booking@casalindacity.com", "RCL Booking System");//send to reservations
 echo $body_reservation;
} */

function logout(){	unset($_SESSION['cust_online']); /*cliente*/
	unset($_SESSION['cust_book']);/*booking*/
	unset($_SESSION['servicios_selected']);/*services*/
	unset($_SESSION['excursions']); /*excursions*/
	unset($_SESSION['all_info']);
	session_destroy();}

function paypal($amount, $ref){?>
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
							    <input type="hidden" name="amount" value="<?=$amount?>">
							    <input type="hidden" name="return" value="http://www.CasaLindaCity.com/" />  <!--http://www.CasaLindaCity.com/thanks.html-->
							    <input type="hidden" name="currency_code" value="USD">
							 </form>
				            <p><img src="images/loading.gif" alt="Wait..." width="16px" height="16px;" border="0" style="float:left;">&nbsp;Please, wait...<?=$ref?> </p>

							<script language="JavaScript" type="text/javascript">
							<!--
							document.payp.submit();
							//-->
							</script>
							<!--//FOOTER AQUI //-->
			</body>
		</html>
<?}

function accounting_info($array_accounting){	$k=$array_accounting;

     $cuerpo="None-Peak Season ".$k['book']['LSnight']." nights x US$ ".$k['book']['LSprice']." = US$ ".number_format($k['book']['LSnight']*$k['book']['LSprice'],2)."<br/>
	  Peak Season ".$k['book']['HSnight']." nights x US$ ".$k['book']['HSprice']." = US$ ".number_format($k['book']['HSnight']*$k['book']['HSprice'],2)."<br/>
	  Sub-Total= US$ ".$k['book']['sub-total']."<br/>";



      if($k['service']){      	$total_s=0;
	      foreach( $k['service'] AS $s){	      	$total_s+=$s['total'];
	          $cuerpo.='<span style="font-size:10px;">   '.$s['title'].' = US$ '.number_format($s['total'],2).'</span><br/>';

	      }

	      $cuerpo.='<span style="font-size:10px;text-transform:uppercase;">Total Services = US$ '.number_format($total_s,2).'</span><br/>';
	  }

      if($k['excursion']){      	   $total_e=0;
		   foreach( $k['excursion'] AS $e){		   	$total_e+=$e['total'];

	         $cuerpo.='<span style="font-size:10px;"> '.$e['title'].' = US$ '.number_format($e['total'],2).'</span><br/>';

	       }

           $cuerpo.='<span style="font-size:10px;text-transform:uppercase;">Total Excursions = US$ '.number_format($total_e,2).'</span><br/>';

      }


	  $cuerpo.='<span style="text-decoration:underline;">VAT-TAX 18 % = US$ '.number_format($k['book']['itbis'],2).'</span> <br/>';
	 $cuerpo.='<span style="font-weight:bold;"> TOTAL = US$ '.number_format($k['book']['total_geral'],2).'</span> <br/>';
	  if($k['book']['deposited']>0){
	  	$cuerpo.='Amount paid= US$ '.$k['book']['deposited'].' <br/>';
	 	$cuerpo.='Remaining to pay= US$ '.($k['book']['total_geral']-$k['book']['deposited']);
	 }

	return $cuerpo; }

function email_template ($email_client, $booking_no, $array_info, $ip){

$cuerpo_correo='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Residencial Casa Linda - http://www.CasaLindaCity.com/</title>
</head>

<body>
<table width="842" bgcolor="#FFFFFF" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="516"><a href="http://www.casalindacity.com" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen1.jpg" alt="Residencial Casa Linda" width="442" height="82" style="margin-bottom:15px;" border="0" /></a></td>
    <td width="384"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen2.jpg" alt="Now complete your trip" width="319" height="39" /></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><a href="http://www.casalindacity.com" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen3.jpg" alt="Home" width="110" height="50" border="0"/></a></td>
        <td valign="top"><a href="http://casalindacity.com/PAGES/Renting/newexcursionspage.php" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen4.jpg" alt="Tours/Excursions" width="166" height="50" border="0"/></a></td>
        <td valign="top"><a href="http://casalindacity.com/PAGES/Renting/Onsite%20Services/Rental%20Vehicles.php" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen5.jpg" alt="Vehicle Rental" width="152" height="50" border="0" /></a></td>
        <td valign="top"><a href="http://casalindacity.com/PAGES/Renting/Onsite_services3.php" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen6.jpg" alt="Services" width="156" height="50" style="margin-bottom:15px;" border="0" /></a></td>
        <td valign="top" ><a href="http://casalindacity.com/PAGES/Contact%20Us/Contact%20Us.php" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen7.jpg" alt="Contact us!" width="153" height="50" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#014691"><table width="100%" border="0" cellspacing="3" cellpadding="3" style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tr>
        <td valign="top" width="50%"><span style="font-size:14px;text-transform:uppercase;">Dear '.$array_info['client']['name'].', your villa was booked.</span><br/>
         Arrival: '.$array_info['book']['from'].'<br/> Departure: '.$array_info['book']['to'].'<br/>
         Villa No.: '.$array_info['villa']['no'].'<br/>
         Reference #: '.$booking_no.'<br/>';
          if($ip!=''){          $cuerpo_correo.='<br/>From IP: <a style="color:yellow" href="http://en.utrace.de/ip-address/'.$ip.'" target="_blank">'.$ip.'</a>';         }

         if($ip==''){          if($array_info['book']['total_geral']-$array_info['book']['deposited']>0){
           $amont_to_pay=$array_info['book']['total_geral']-$array_info['book']['deposited'];
           $cuerpo_correo.='<br/><br/>';           $cuerpo_correo.="<a style=\"color:yellow\" href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$booking_no&amount=$amont_to_pay&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Pay this booking\" target=\"_blank\">If you have an outstanding balance on this booking, please click here to pay now</a>";          }
         }
$cuerpo_correo.=' </td>
        <td>
          <p style="text-align:right; color:white;">'.accounting_info($array_info).'</p>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen9.jpg" alt="Add a slice of Adventure" width="842" height="404" /></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="787" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen10.jpg" alt="Tours &amp; Excursions" width="272" height="61" /></td>
        <td colspan="2"><img style="margin-left:29px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen11.jpg" alt="Vehicle Rentals" width="257" height="61" /></td>
        <td colspan="2"><img style="margin-left:36px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen12.jpg" alt="On-site Services" width="253" height="61" /></td>
      </tr>
      <tr>
        <td colspan="2"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen13.jpg" alt="Book now and take advantage of our discounts!" width="273" height="327" /></td>
        <td colspan="2" align="center"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen14.jpg" alt="We offer the best pricing that includes insurance on the North Coast!" width="239" height="330" /></td>
        <td colspan="2" align="center"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen15.jpg" alt="Sit back, Relax, and put us to work with..." width="237" height="332" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen16.jpg" alt="Tours &amp; Excursions" width="225" height="223" /></td>
        <td colspan="2" align="center"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen17.jpg" alt="Vehicle Rentals" width="222" height="221" /></td>
        <td colspan="2" align="center"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen18.jpg" alt="On-site Services" width="220" height="223" /></td>
      </tr>
      <tr>
        <td colspan="2"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen19.jpg" alt="from" width="41" height="17" /></td>
        <td colspan="2"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen19.jpg" alt="from" width="41" height="17" /></td>
        <td colspan="2"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen19.jpg" alt="from" width="41" height="17" /></td>
      </tr>
      <tr>
        <td width="138"><img style="margin-left:29px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen20.jpg" alt="$25" width="62" height="41" /></td>
        <td width="135" align="right"><a href="https://www.casalindacity.com/clients_online/login.php?em='.$email_client.'&amp;bk='.$booking_no.'" target="_blank"><img style="margin-right:20px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen21.jpg" alt="Let\'s go" width="112" height="31" border="0" /></a></td>
        <td width="111"><img style="margin-left:29px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen22.jpg" alt="$29" width="66" height="36" /></td>
        <td width="175" align="right"><a href="https://www.casalindacity.com/clients_online/login.php?em='.$email_client.'&amp;bk='.$booking_no.'" target="_blank"><img style="margin-right:20px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen21.jpg" alt="Let\'s go" width="112" height="31" border="0" /></a></td>
        <td width="103"><img style="margin-left:29px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen23.jpg" alt="$30" width="62" height="42" /></td>
        <td width="186" align="right"><a href="https://www.casalindacity.com/clients_online/login.php?em='.$email_client.'&amp;bk='.$booking_no.'" target="_blank"><img style="margin-right:25px;" src="https://www.casalindacity.com/clients_online/email_content/images/imagen21.jpg" alt="Let\'s go" width="112" height="31" border="0"/></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><img src="https://www.casalindacity.com/clients_online/email_content/images/imagen24.jpg" alt="Experience the wonder of the Caribbean" width="816" height="110" /></td>
  </tr>
  <tr>
    <td colspan="3"><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><a href="https://www.facebook.com/CasaLindaDR?v=wall" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/facebook_logo.jpg" alt="FaceBook" width="100" height="38" border="0" /></a></td>
        <td><a href="http://www.youtube.com/user/CasaLindaDR" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/youtube.jpg" alt="YouTube" width="68" height="38" border="0"/></a></td>
        <td><a href="https://twitter.com/CasaLinda_DR" target="_blank"><img src="https://www.casalindacity.com/clients_online/email_content/images/twitter 2.png" alt="Twitter" width="66" height="38" border="0"/></a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>';

return $cuerpo_correo;}

?>