<?
 if ($_SESSION['info']){
  if (!$_SESSION['NO_REFRESH']) die('Impossible send info again');
	//VARIABLES START
   if ($_POST){
      $ref=$_POST['ref'];
      //$_POST['reserveid'];  //reserva id
      //--------------------OCUPATION TABLE---------------------------
         	$starting_date=$_POST['starting_date'];       $starting=date_to_insert($starting_date);
         	$ending_date=$_POST['ending_date'];         $ending=date_to_insert($ending_date);
	 		$id_villa=$_POST['id_villa'];
	 		$id_adm=$_POST['id_adm'];

		//--------------------RESERVE TABLE---------------------------
	        //$ref=str_pad($id_ocupacion, 9, "0", STR_PAD_LEFT);
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
	 //----------------------OCUPATION TALBE--------------------------

      $db= new subDB (); //CONNECT TO DATABASE
      $data=new getQueries ();//connect and make a query - Ej. get info from a ref number
      $book=$data->see_occupancy_ref($ref);
      $b=$book[0];
      $peopleBooked=$data->people($b['reserveid']);
	  $servicios_reserva_long=$data->services_reserved_long($b['reserveid']);
	  $payments_date=$data->payments_date($b['reserveid']); //get payments date per long rental
     //===================================================================================================================================================================
	  $id_ocupacion_mod=$db->in_ocupacion_mod($b['start'], $b['end'], 1, $b['villa'], $id_adm, $b['note']); //insert ocupation and returm id of insertion

      $id_reserve_mod_long=$db->insert_long_reserva_mod($ref, $id_ocupacion_mod, $b['client'], $b['adults'], $b['kids'], $b['vehicles'], $b['interm'], $b['nights'], $b['NHS'], $b['NLS'], $b['ppn'], $b['PHS'], $b['apc'], $b['subtotal'], $b['itbis'], $b['aps'], $b['dep'], $b['total'], $b['status'], $b['rc'],$b['PAYM'],$b['PMV'],$b['PL'],$b['EN']);
    //===================================================================================================================================================================
	
	 foreach ($peopleBooked as $k){    //INSERT PEOPLE CHANGED
		$db->in_persons_mod($id_reserve_mod_long, $k['name'], $k['lastname'], $k['comment'], $k['type']);
	 }

      foreach ($servicios_reserva_long as $s){    //INSERT SERVICES CHANGED
	 	$db->insert_servicios_long_mod($id_reserve_mod_long, $s['name'], $s['price']);
	  }

	 foreach ($payments_date as $pa){    //INSERT DATES CHANGED
	 	$db->insert_fechas_de_pago_mod($id_reserve_mod_long, $pa['fecha_pago']);
	  }
    //====================================================================================================================================================================
     switch($_POST['rate']){
		case 'flat_month':
						flat_amount($ref, $flat_type=1, $flat_amount=$_POST['flat_qty']);
						break;
		case 'flat_booking':
						flat_amount($ref, $flat_type=2, $flat_amount=$_POST['flat_qty']);
						break;

	 }
	  //DELETE OLD SAVED SERVICES, DATES, AND PEOPLE
	$link=new DB();
 	$link->delete_items('serv_long', 'id_reserve', $b['reserveid']);   //table - field_condition - value
	//DELETE OLD SAVED PEOPLE
	$link->delete_items('people', 'id_reserve', $b['reserveid']);   //table - field_condition - value
	//DELETE OLD dates saved
	$link->delete_items('long_pay', 'id_reserve', $b['reserveid']);   //table - field_condition - value

     //----------------------------------------------------actualizar reserva de largo plazo----------------------------------------
	 //-----------------------------------------------------------------------------------------------------------------------------------------------------------------
	$db->update_busy($b['busyid'],$starting, $ending, $id_villa, $b['adm'], $id_ocupacion_mod, $b['date']);
	//----------------------------------------------------------------------------------------------------------------------------------------------------------------

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------
	$db->update_reserva_long($b['reserveid'], $ref, $b['busyid'], $id_customer, $adults_qty, $children_qty, $_POST['vehiculos'], $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $pago_qty,$pagos_monto,$price_long,$qty_nights_extra);
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	if(($status==11)||($status==25)||($status==33)){  /*mean the the booking is checked out*/
		put_villa_dirty($villaid=$id_villa);
	 }


		 //----------------------RESERVE TALBE--------------------------
		 //--------------------PEOPLE TABLE---------------------------
		    if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
			  for ($x=1;$x<=$adults_qty; $x++){
			  	 $a_name="a_name$x"; $a_lastname="a_lastname$x";  $a_cedula="cedula$x";
			  	 $name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];  $cedula=$_POST[$a_cedula];
			     $db->insert_adults($b['reserveid'], $name, $lastname, $cedula);
			  	}
			}

			if ($children_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
			  for ($c=1;$c<=$children_qty; $c++){
			  	$c_name="c_name$c"; $c_lastname="c_lastname$c"; $c_passport="passport$c";
			  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname]; $passport=$_POST[$c_passport];
			    $db->insert_children($b['reserveid'], $name, $lastname, $passport);
			  	}
			}
		 //----------------------PEOPLE TALBE--------------------------
		 //--------------------SERVICE LONG TABLE---------------------------
		  foreach ($_SESSION['long_services'] AS $s){
		 	$name=$s['name']; $precio=$s['price'];
	        $db->insert_servicios_long($b['reserveid'], $name, $precio);
	       }
	     //----------------------SERVICE LONG TALBE--------------------------
		 //--------------------PAYMENT DATES TABLE---------------------------
	       foreach ($_SESSION['payments'] AS $k){
	        $fecha_de_pago=date_to_insert($k['year']."-".$k['month']."-".$k['day']);
	        $db->insert_fechas_de_pago($b['reserveid'], $fecha_de_pago);
	       }
		 //----------------------PAYMENT DATES TALBE--------------------------



	//----------------------- COMIENZO VEHICULO PARA ESTA RESERVA-------------------------------------------------------------------------------------
	   if ($_POST['vehiculos']!='0' ){ //si hay vehiculos
	    $link= new getQueries();
	    $vehiculo_anterior=$link->show_any_data_limit1('vehicle', 'ref_book', $ref, '=');
        //DELETE OLD SAVED SERVICES
		$db=new subDB();
	 	$db->delete_items('vehicle', 'ref_book', $ref);   //table - field_condition - value

		 for ($i=1; $i<=$_POST['vehiculos']; $i++){
		 	$marca="marca$i"; $modelo="modelo$i"; $placa="placa$i"; $color="color$i";
			$result=$db->insert_vehicule($ref, $_POST[$marca], $_POST[$modelo], $_POST[$placa], $_POST[$color]);
            // echo $marca; echo "<br/>";
			}

	    }
   //----------------------- TERMINA VEHICULO PARA ESTA RESERVA ----------------------------------------------------------------------------
        	//==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$db->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='', $id_villa, $id_ocupacion_mod);
		//=====================================================================================================
      unset($_SESSION['NO_REFRESH']);
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



	//IF IT IS CHECK IN YOU CAN PRINT ITS INVOICE AND REGISTER SHEET SHOW REF. NUMBER
    // $data=new getQueries ();
 	 $villa_details=$data->villa($id_villa);
	?>
     <p class="header">Long Term Rental <span style="color:black" >No. <?=$ref?></span></p>
      <div style="width:571px; height:33px; text-align:center; margin: 0 auto;"><img src="images/steps/4-4.png" alt="" width="571px" height="33px"/> </div>
     <hr />
	 <div class="book_inserted1">
	 	<p class="bloques">Villa No.:<span class="info_details"> <?=$villa_details[0]['no']?></span></p>
	 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
	 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
	 </div><!--END SHOWING DATES AND VILLA-->

     <div class="book_inserted2">
      	<!--//<p class="bloques2">Booking Reference Number:<span class="info_details2"> <?/*=$ref*/?></span></p>//-->
     </div><!--END SHOWING REF NUMBER-->
    <? if ($status==8){


    }?>
     <div class="book_inserted4">
     	<h2>Book successfuly changed</h2>
     	<a href="booking-calendar.php"><img class="calendar_img" src="images/calendar_booked.png" width="127px" height="49px" alt="calendar" title="go to calendar" /></a>
        <a href="booking-calendar.php"><p class="link_calendar">Go to Calendar</p></a>
     </div>
	<?
 }else{
	 header('Location:login.php');
	 die();
 }
?>