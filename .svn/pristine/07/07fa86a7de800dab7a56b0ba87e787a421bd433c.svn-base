<?
 if ($_SESSION['info']){
     if (!$_SESSION['NO_REFRESH']) die('Impossible send info again');
	//VARIABLES START
	 //----------------------------------------------------------------------
     $new_busy=check_villa_new($_POST['id_villa'], $_POST['starting_date'], $_POST['ending_date']);
	 $cant_new=count($new_busy);
	 if(!$cant_new>0){
     //-----------------------------------------------------------------------
			   if ($_POST){

			      $db= new subDB (); //CONNECT TO DATABASE
				 //--------------------OCUPATION TABLE---------------------------
			         	$starting_date=$_POST['starting_date'];       $starting=date_to_insert($starting_date);
			         	$ending_date=$_POST['ending_date'];         $ending=date_to_insert($ending_date);
				 		$id_villa=$_POST['id_villa'];
				 		$id_adm=$_POST['id_adm'];
				 		$id_ocupacion=$db->insert_ocupacion_short_reserve($starting, $ending, $id_villa, $id_adm); //insert ocupation and returm id of insertion
				 //----------------------OCUPATION TALBE--------------------------
				  //--------------------RESERVE TABLE---------------------------
			        $ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
			        $id_customer=$_POST['id_customer'];
			        $adults_qty=$_POST['adults_qty'];
			        $children_qty=$_POST['children_qty'];
			        $interm_id=$_POST['interm_id'];
			        $qty_nights=$_POST['qty_nights']; //CANTIDAD DE NOCHES TOTAL
			        $HS_nights=0; $LS_nights=0;
			        $price_per_night=$_POST['price_per_extra_night']; //PRECIO POR NOCHES EXTRAS
			        $priceHS=0;
			        $amount_commision=0;
			        $sub_total_rent=$_POST['sub_total_rent'];//precio total de la reserva sin itbis
			        $ITBIS=$_POST['ITBIS'];
			        $services_amount=$_POST['services_amount']; //monthly charges per services
			        $deposit=$_POST['deposit'];
			        $general_amount=$_POST['general_amount'];   //TOTAL PARA ESTA RESERVA incluyendo impuestos
			        $status=$_POST['status'];
			        $reserve_comment=$_POST['reserve_comment'];

			        $pago_qty=$_POST['qty_pagos'];  //CANTIDA DE PAGOS
			        $pagos_monto=$_POST['monto_pagos'];  //monto mensual a pagar
			        $price_long=$_POST['long_price'];   //precio de villa por mes
			        $qty_nights_extra=$_POST['qty_nights_extra']; //CANTIDAD DE NOCHES EXTRAS

					$id_reserve=$db->insert_long_reserva($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $pago_qty,$pagos_monto,$price_long,$qty_nights_extra);  //INSERT RESERVE AND TAKE IT ID
				 //----------------------RESERVE TALBE--------------------------
				  switch($_POST['rate']){				  	case 'flat_month':
				  						flat_amount($ref, $flat_type=1, $flat_amount=$_POST['flat_qty']);
				  						break;
					case 'flat_booking':
				  						flat_amount($ref, $flat_type=2, $flat_amount=$_POST['flat_qty']);
				  						break;
				  }

				 //--------------------PEOPLE TABLE---------------------------
				    if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
					  for ($x=1;$x<=$adults_qty; $x++){

					  	 $a_name="a_name$x"; $a_lastname="a_lastname$x";  $a_cedula="cedula$x";
					  	 $name=$_POST[$a_name]; $lastname=$_POST[$a_lastname]; $cedula=$_POST[$a_cedula];

					    $db->insert_adults($id_reserve, $name, $lastname, $cedula);
					  	}
					}

					if ($children_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
					  for ($c=1;$c<=$children_qty; $c++){

					  	$c_name="c_name$c"; $c_lastname="c_lastname$c"; $c_passport="passport$c";
					  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname]; $passport=$_POST[$c_passport];
					    $db->insert_children($id_reserve, $name, $lastname, $passport);
					  	}
					}
				 //----------------------PEOPLE TALBE--------------------------
				 //--------------------SERVICE LONG TABLE---------------------------
				  foreach ($_SESSION['long_services'] AS $s){

				 	$name=$s['name']; $precio=$s['price'];
				 	//echo $name."-".$precio;
				 	//echo "<br/>";
			        $db->insert_servicios_long($id_reserve, $name, $precio);
			       }
			     //----------------------SERVICE LONG TALBE--------------------------
				 //--------------------PAYMENT DATES TABLE---------------------------
			       foreach ($_SESSION['payments'] AS $k){			        $fecha_de_pago=date_to_insert($k['year']."-".$k['month']."-".$k['day']);
			        //echo $fecha_de_pago;
				 	//echo "<br/>";
			       $db->insert_fechas_de_pago($id_reserve, $fecha_de_pago);
			       }
				 //----------------------PAYMENT DATES TALBE--------------------------

			      //VARIABLES END
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
			    <? if ($status==8){			    }?>
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