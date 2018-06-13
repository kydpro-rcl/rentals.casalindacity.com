<?
 if ($_SESSION['info']){
   if (!$_SESSION['NO_REFRESH']) die('Impossible send info again');

     //----------------------------------------------------------------------
     $new_busy=check_villa_new($_POST['id_villa'], $_POST['starting_date'], $_POST['ending_date']);
	 $cant_new=count($new_busy);
	 if(!$cant_new>0){
	 //-----------------------------------------------------------------------
				//VARIABLES START
			   if ($_POST){
			     $id_villa=$_POST['id_villa'];  $id_customer=$_POST['id_customer'];   $id_adm=$_POST['id_adm'];
			     $starting_date=$_POST['starting_date']; $ending_date=$_POST['ending_date']; $qty_nights=$_POST['qty_nights'];
			     $price_per_night=$_POST['price_per_night'];$amount_per_nights=$_POST['amount_per_nights'];$ITBIS=$_POST['ITBIS'];
			     $sub_total_rent=$_POST['sub_total_rent'];  $general_amount=$_POST['general_amount'];  // $id_ocupacion=$_POST['id_ocupacion'];
			     /*$id_reserve=$_POST['id_reserve']; */$massage_id=$_POST['massage_id']; $massage_amount=$_POST['massage_amount'];
			     $massage_comment=$_POST['massage_comment']; $pickup_id=$_POST['pickup_id']; $pickup_amount=$_POST['pickup_amount'];
			     $pickup_comment=$_POST['pickup_comment'] ; $VIPpickup_id=$_POST['VIPpickup_id'];$VIPpickup_amount=$_POST['VIPpickup_amount'];
			     $VIPpickup_comment=$_POST['VIPpickup_comment'];$chef_id=$_POST['chef_id'];$chef_amount=$_POST['chef_amount'];
			     $chef_comment=$_POST['chef_comment'];$fridge_id=$_POST['fridge_id'];$fridge_amount=$_POST['fridge_amount'];
			     $fridge_comment=$_POST['fridge_comment']; $services_amount=$_POST['services_amount']; $interm_id=$_POST['interm_id'];
			     $reserve_comment=$_POST['reserve_comment'];$status=$_POST['status'];$children_qty=$_POST['children_qty'];
			     $adults_qty=$_POST['adults_qty'];$deposit=$_POST['deposit'];

				 //---------------------------------------------------------------------------------------------
					$priceHS=$_POST['priceHS']; $LS_nights=$_POST['LS_nights']; $HS_nights=$_POST['HS_nights'];
				 //---------------------------------------------------------------------------------------------
			      //VARIABLES END
				$db= new subDB (); //CONNECT TO DATABASE

				$starting=date_to_insert($starting_date);
				$ending=date_to_insert($ending_date);
				$id_ocupacion=$db->insert_ocupacion_short_reserve($starting, $ending, $id_villa, $id_adm); //insert ocupation and returm id of insertion
			    $ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
				#$ref=$id_ocupacion.$id_customer.$id_villa; //id ocupacion + id cliente + id villa  to make the reservation reference number
				 // factura no.02201015031401  hora_ano_minutos_mes_segundos_dias   2010 03 01 02:15:14 YYYY MM DD HH:MM:SS

				@$id_reserve=$db->insert_short_reserva($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status);  //INSERT RESERVE AND TAKE IT ID
			   }else{
				   echo ("<meta http-equiv=\"refresh\" content=\"0;url=booking-calendar.php\">"); //send people to calendar
				   die();
			   }

			   //-----------------------REFERAL FOR THIS BOOKING-------------------------------------------------------------------------------------
				   if ($_POST['id_referal']>0){
				    $link= new getQueries();
				    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');

					  if ($referido_anterior){
					  	#echo "actualizar";
					  	$id_update=$db->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
					  	//echo $referido_anterior[0]['id_referal'];
					    $actualizado=$db->update_assign($referido_anterior[0]['id'], $ref, $_POST['id_referal'], $id_adm, $id_update);

					  	//echo "<p>&nbsp;</p><p style='color:red; font-size:16px; text-align:center;'>Booking successfully reassigned</p>";

					  }else{

						$result=$db->Assign_a_booking($ref, $_POST['id_referal'], $id_adm);
						 if ($result){
						// echo "<p>&nbsp;</p><p style='color:blue; font-size:16px; text-align:center;'>Booking successfully assigned</p>";

						 }
					    #echo "insertar";
					  }
				    }
			   //----------------------- TERMINA REFERAL FOR THIS BOOKING ----------------------------------------------------------------------------

				if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
				  for ($x=1;$x<=$adults_qty; $x++){
				  	//$name=${"_POST['a_name{$x}'"}; $lastname=${"a_lastname{$x}"};
				  	# $name=${"a_name{$x}"}; $lastname=${"a_lastname{$x}"};
				  	 $a_name="a_name$x"; $a_lastname="a_lastname$x"; $a_cedula="cedula$x";
				  	 $name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];$cedula=$_POST[$a_cedula];

				    $db->insert_adults($id_reserve, $name, $lastname, $cedula);
				  	}
				}

				if ($children_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
				  for ($c=1;$c<=$children_qty; $c++){
				  	//$name=${"c_name{$c}"}; $lastname=${"c_lastname{$c}"};
				  	$c_name="c_name$c"; $c_lastname="c_lastname$c"; $c_passport="passport$c";
				  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname];$passport=$_POST[$c_passport];
				    $db->insert_children($id_reserve, $name, $lastname, $passport);
				  	}
				}
				if ($massage_id>0) $db->insert_additional_services($massage_id, $id_reserve, $massage_amount, $massage_comment);
				if ($pickup_id>0) $db->insert_additional_services($pickup_id, $id_reserve, $pickup_amount, $pickup_comment);
				if ($VIPpickup_id>0) $db->insert_additional_services($VIPpickup_id, $id_reserve, $VIPpickup_amount, $VIPpickup_comment);
				if ($chef_id>0) $db->insert_additional_services($chef_id, $id_reserve, $chef_amount, $chef_comment);
				if ($fridge_id>0) $db->insert_additional_services($fridge_id, $id_reserve, $fridge_amount, $fridge_comment);
			     if ($_POST['cars_id']>0) $db->insert_additional_services($_POST['cars_id'], $id_reserve,$_POST['cars_days'], $_POST['cars_amount'], $comment="");    //INSERT RENTAL CARS

				 unset($_SESSION['NO_REFRESH']);

				//IF IT IS CHECK IN YOU CAN PRINT ITS INVOICE AND REGISTER SHEET SHOW REF. NUMBER
			     $data=new getQueries ();
			 	 $villa_details=$data->villa($id_villa);
				?>
			     <p class="header">Book inserted</p><hr />
				 <div class="book_inserted1">
				 	<p class="bloques">Villa No.:<span class="info_details"> <?=$villa_details[0]['no']?></span></p>
				 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
				 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
				 </div><!--END SHOWING DATES AND VILLA-->

			     <div class="book_inserted2">
			      	<p class="bloques2">Booking Reference Number:<span class="info_details2"> <?=$ref?></span></p>
			     </div><!--END SHOWING REF NUMBER-->
			    <? if ($status==1){?>
			     <div class="book_inserted3">

					 <!--PRINT INVOICE FOR THIS BOOK-->
					<table align="center" border="0" cellspacing="0" cellpadding="10">
						<tr>
							<td>
								<form  name="invoice" method="post" action="customers_invoices_print.php" target="_blank"/>
									<input type="hidden" name="ref" value="<?=$ref?>"/>
									<input class="book_but" type="submit" name="invoice" value="Print Invoice" onClick="this.disabled=true; this.value='Printing...'; this.form.submit();"/>
								    </form>
							       <!--END PRINT INVOICE FOR THIS BOOK-->
							</td>
							<td>
							       <!--PRINT REGISTER SHEET FOR THIS BOOK-->
								    <form  name="register_sheet" method="post" action="customers_register_print.php" target="_blank">
									    <input type="hidden" name="ref" value="<?=$ref?>" />
									    <input class="book_but" type="submit" name="register" value="Register Sheet" onClick="this.disabled=true; this.value='Printing...'; this.form.submit();" />
								    </form>
							</td>
						</tr>
					</table>

				  </div>   <!--END SHOWING PRINT DETAILS FOR CKECKED IN-->
				<?}?>
			     <div class="book_inserted4">
			     	<h2>Book successfuly created</h2>
			     	<a href="booking-calendar.php"><img class="calendar_img" src="images/calendar_booked.png" width="127px" height="49px" alt="calendar" title="go to calendar" /></a>
			        <a href="booking-calendar.php"><p class="link_calendar">Go to Calendar</p></a>
			     </div>
	<?

	}else{
      	 new_booking_busy_error($_POST['starting_date'], $_POST['ending_date'], $link="booking-calendar.php");
    }
 }else{
	 header('Location:login.php');
	 die();
 }
?>