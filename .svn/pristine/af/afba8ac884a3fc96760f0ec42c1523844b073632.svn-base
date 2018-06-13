<?php
if ($_POST['ref']) $_GET['ref']=$_POST['ref'];
$_GET['ref']=trim($_GET['ref']);


   if ($_GET['ref']!=""){
	   	$db= new getQueries();

	   	$reference=$_GET['ref'];
		$reference=str_pad($reference, 9, "0", STR_PAD_LEFT);
		$book=$db->see_occupancy_ref($reference); //get reservation details
		$booking=$book[0];
        $servicios_reserva=$db->services_reserved($booking['reserveid']);
         $excursiones_reserva=$db->excrusiones_reserved($booking['reserveid']);
			$montoPagado=$db->amountRef($reference,'1');/*paid*/;
		if ($booking){
			$percent_fee="0.0495";/*4.95%*/
			$amt_fee="0.30";/*0.30 cents*/
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
            //==============INSERT A COMMENT AS A INFO SENT TO CLIENT IN A EDITION OF A BOOKING=========================
   				  $data=new subDB();
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$data->insert_comments($reference,'',$tipo='5'/*mean info sent to client*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='', $booking['villa'], $id_ocupacion_mod='');
		//=====================================================================================================
            $link_for_pictures="https://www.casalindacity.com/for_rent/tor_pics/gallery.php?no=".$vd['no'];

            $payment_mensage="Click here to pay now in full.";
            $pay50_msg="Click here to pay 50% to confirm your reservation.";
	//-----------------------------------------------------------------------------------------
		  $body_client="";
				  $body_client.="<html><head></head><body>";
				   $body_client.="<p style=\"text-align:center;\"><a href=\"http://www.casalindacity.com\" alt=\" Residencial Casa Linda\"><img src=\"https://www.casalindacity.com/for_rent/images/booking-system.jpg\" alt=\"Residencial Casa Linda\" border=\"0\" width=\"820px;\" height=\"172px;\"></a></p>";
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
						$short_term_book='true';
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

							$monto_restante=$general_amount-($booking['dep']+$montoPagado);
						   $body_client.="<tr>
									        <td align=\"right\" >
									        Non-Peak Season ".$LS_nights." nights x US$ ".number_format($booking['ppn'],2)." = <br/>
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

							 $body_client.="VAT-TAX ".TAX_PERCENT." =<br/>";
                               //----------services below------------------------------------------------------------------------------------------------------


							 if (!empty($servicios_reserva)){
								$total_services=0;
								foreach ($servicios_reserva as $s){
							   // echo $s['price']." ";
								   if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
									$body_client.="<span style=\"color:blue;\">".$s['name']." =</span><br/>"; $total_services+=$s['price'];
								   }else{
									$body_client.="<span style=\"color:blue;\">".ucfirst($s['type'])." (".$s['name'].")=</span><br/>"; $total_services+=$s['price'];
								   }

								}
					  		 $body_client.="<span style=\"color:blue;\"><strong>Total per Services =</strong></span><br/>"; //.number_format($total_services,2).""
							 }
                           //--------service above----------------------------------------------------------------------------------------------------------
                            //----------EXCURSIONES FOR THIS BOOKING START---------------------
                            if (!empty($excursiones_reserva)){
								//$total_excursion=0;
				                 foreach ($excursiones_reserva as $k){
				                	$body_client.="<span style='color:#cc1c0a; '>".$k['title']." (".$k['qty_a']." adults)(".$k['qty_c']." kids) = </span><br/>";
				               //  $total_excursion+=$k['total'];
				                 }
				                  	$body_client.="<span  style='color:#cc1c0a;'><strong>Total Excursions =</strong></span><br/>";
							}
                            //----------EXCURSIONES FOR THIS BOOKING END---------------------

							 $body_client.="<span style=\"font-weight:bold;\">TOTAL =</span>
									         <br/>Amount paid=
									         <br/>Grand Total Due=
											 <!--<br/>Credit Card fee=-->
									        </td>
									        <td align=\"right\" width=\"105px\">
									        ".number_format($total_ls,2)."<br/>
									        ".number_format($total_hs,2)."<br/>";
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


							 if (!empty($servicios_reserva)){
								//$total_services=0;
								foreach ($servicios_reserva as $s){
								  $body_client.="<span style=\"color:blue;\">".number_format($s['price'],2)."</span><br/>"; //$total_services+=$s['price'];
								}
					  		  $body_client.="<span style=\"color:blue;\"><strong>US$ ".number_format($total_services,2)."</strong></span><br/>";
							 }
                           //--------service above----------------------------------------------------------------------------------------------------------

                           //----------EXCURSIONES FOR THIS BOOKING START---------------------
        					 if (!empty($excursiones_reserva)){
								$total_excursion=0;
				                 foreach ($excursiones_reserva as $k){
				                	$body_client.="<span style='color:#cc1c0a;'>".$k['total']."</span><br/>";
				                 $total_excursion+=$k['total'];
				                 }
				                 	$body_client.="<span style='color:#cc1c0a;'><strong>US$ ".number_format($total_excursion,2)."</strong></span><br/>";
							}
                           //-------------EXCURSIONES FOR THIS BOOKING END---------------------
						   if(($general_amount-($booking['dep']+$montoPagado))>0){/*cargar service fee solo si debe*/
								/*$service_fee=(($general_amount-$booking['dep'])*$percent_fee)+$amt_fee;*/
							}else{
								$service_fee=0;
							}
								$body_client.="<span style=\"font-weight:bold;\">
									        US$ ".number_format($general_amount,2).
									        "</span><br/>
									        US$ ".number_format(($booking['dep']+$montoPagado),2).
									        "<br/>
											<span style=\"font-weight:bold;\">
									        US$ ".number_format($monto_restante,2).
									        "</span><!--<br/>
											<span style=\"font-weight:bold;\">
									        US$ ".number_format($service_fee,2).
									        "</span>-->
											
									        </td>
										</tr>";
										if ((($booking['dep']+$montoPagado)>0) && ($general_amount>($booking['dep']+$montoPagado))){ $payment_mensage="Click here to pay your remaining balance.";}

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
								$pago_paypal=$booking['PMV']; 
								/*$service_fee=($pago_paypal*$percent_fee)+$amt_fee;*/
								$payment_mensage="Click here to do your first payment now, if you could not do this before.<!-- (Credit Card fee: $service_fee)-->";
							}
							
						}
						$body_client.="</table>";
                          /*=====================================================info for new rental cars=====================================*/
                          $carros_rentados=$db->showTable_r($table='cars_rented', $field='ref', $value=$ref, $operator='=');

                          if($carros_rentados){
                          	$body_client.="<p>&nbsp;</p>";
                            $body_client.="<div style='padding-right:15px; margin-right:33px;border:2px solid #cccccc;'>";


							$gral_cars=0;
							$taxes_cars=0;
						   foreach($carros_rentados AS $k){
							 $this_car=$db->show_any_data_limit1("carros", "id", $k['id_car'], "=");
							$total_this_car=$k['qty_days']*$k['price']; $gral_cars+=$total_this_car; $taxes_cars+=$k['taxes'];

						   $body_client.="<p style=\"text-align:right; padding:0px; margin:0px; color:blue;\">";
						      $body_client.=substr($this_car[0]['name'], 0, 25).' '.$k['qty_days'].'  x  '.$k['price'].' = '.number_format($total_this_car,2);
						   $body_client.="</p>";
						   }
                            $body_client.="<p  style=\"text-align:right; padding:0px; margin:0px; font-weight:bold; color:blue; font-weight:bold; text-transform:uppercase;\">To be paid upon arrival: USD ".number_format($gral_cars+$taxes_cars,2)."</p>";
                            $body_client.="</div>";
						  }
                          /*==================================================================================================================*/
                        if($short_term_book=='true'){
                        	if (($booking['dep']+$montoPagado)==0){// solo mostrar 50% si no hay ningun deposito
                        	$pago_paypal2=($pago_paypal/2);
                        	$pago_paypal2=number_format($pago_paypal2,2);
		               		$body_client.="<p style='text-align:right; margin:0; padding:0;'><a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$ref&amount=$pago_paypal2&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Make payment for this booking\">$pay50_msg</a></p>";
		               		}
                         }
						$pago_paypal+=$service_fee;/*works for long term and short terms payments*/
						$pago_paypal=number_format($pago_paypal,2);
					   if (($booking['dep']+$montoPagado)<$general_amount){// solo pagar si el deposito menor que total
		               		$body_client.="<p><a href=\"https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=reservations@casalindacity.com&item_name=Booking No:$ref&amount=$pago_paypal&no_shipping=0&no_note=1&currency_code=USD&lc=US&bn=PP-BuyNowBF&charset=UTF-8\" alt=\"Payment for Booking\" title=\"Make payment for this booking\">$payment_mensage</a></p>";
		               }

	                   $body_client.="<p><a href=\"$link_for_pictures\" alt=\"See pictures of villa\" title=\"see pictures of villa\">Click here to see pictures for your villa booked.</a></p>";
	                   $body_client.="<hr/>";
	                   $body_client.="<p style=\"text-align:right; font-size:9px;\">INFORMATION SENT BY: ".$info_sent_by."<br>On ".date("Y-m-d G:i:s")."</a></p>";
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
