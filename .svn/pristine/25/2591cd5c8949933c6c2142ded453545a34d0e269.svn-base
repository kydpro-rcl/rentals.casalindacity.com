<?
 if ($_SESSION['info']){
   if (!$_SESSION['NO_REFRESH']) die('Impossible send info again');
	//VARIABLES START
   if ($_POST){
   	//------------------------------------------------------------------------------------------------------------------------------------------------------------------
     $starting_date=$_POST['starting_date']; $ending_date=$_POST['ending_date']; $starting=date_to_insert($starting_date);
	 $ending=date_to_insert($ending_date);
  	 $id_villa=$_POST['id_villa'];   $id_adm=$_POST['id_adm'];
     //------------------------------------------------------------------------------------------------------------------------------------------------------------------
  	 $ref=$_POST['ref']; /*$id_ocupacion=$_POST['busyid']; */$id_customer=$_POST['id_customer']; $adults_qty=$_POST['adults_qty']; $children_qty=$_POST['children_qty'];
  	 $interm_id=$_POST['interm_id']; $qty_nights=$_POST['qty_nights']; $price_per_night=$_POST['price_per_night'];// $amount_commision=?
     $sub_total_rent=$_POST['sub_total_rent']; $ITBIS=$_POST['ITBIS']; $services_amount=$_POST['services_amount'];  $deposit=$_POST['deposit'];
     $general_amount=$_POST['general_amount'];  $status=$_POST['status'];$reserve_comment=$_POST['reserve_comment'];
    /* $amount_per_nights=$_POST['amount_per_nights'];*/
    //---------------------------------------------------------------------------------------------
		$priceHS=$_POST['priceHS']; $LS_nights=$_POST['LS_nights']; $HS_nights=$_POST['HS_nights'];
	 //---------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------
     $massage_id=$_POST['massage_id']; 		$massage_amount=$_POST['massage_amount'];		$massage_comment=$_POST['massage_comment'];
     $pickup_id=$_POST['pickup_id']; 		$pickup_amount=$_POST['pickup_amount'];   		$pickup_comment=$_POST['pickup_comment'] ;
     $VIPpickup_id=$_POST['VIPpickup_id'];	$VIPpickup_amount=$_POST['VIPpickup_amount'];   $VIPpickup_comment=$_POST['VIPpickup_comment'];
     $chef_id=$_POST['chef_id'];			$chef_amount=$_POST['chef_amount'];         	$chef_comment=$_POST['chef_comment'];
     $fridge_id=$_POST['fridge_id'];		$fridge_amount=$_POST['fridge_amount'];         $fridge_comment=$_POST['fridge_comment'];
     //-----------------------------------------------------------------------------------------------------------------------------------------------------------------
    //VARIABLES END
	$db= new subDB (); //CONNECT TO DATABASE
	$data=new getQueries ();//connect and make a query - Ej. get info from a ref number
    $book=$data->see_occupancy_ref($ref);
    $b=$book[0];
    $peopleBooked=$data->people($b['reserveid']);
	$ServBooked=$data->services_reserved($b['reserveid']);

	$id_ocupacion_mod=$db->in_ocupacion_mod($b['start'], $b['end'], /*$b['type']*/1, $b['villa'], $_SESSION['info']['id'], $b['note']); //insert ocupation and returm id of insertion
	 // echo $b['type'];

	$id_reserve_mod=$db->in_res_mod($ref, $id_ocupacion_mod, $b['client'], $b['adults'], $b['kids'], $b['vehicles'], $b['interm'], $b['nights'], $b['NHS'],$b['NLS'], $b['ppn'],$b['PHS'], $b['apc'], $b['subtotal'], $b['itbis'], $b['aps'], $b['dep'], $b['total'], $b['status'],$b['rc']);

      //$counted_adult=0; $counted_kids=0;
	  foreach ($peopleBooked as $k){    //INSERT PEOPLE CHANGED
		$db->in_persons_mod($id_reserve_mod, $k['name'], $k['lastname'], $k['comment'], $k['type']);
		//if ($k['type']==1) $counted_adult++; if ($k['type']==2) $counted_kids++;
	  }

      foreach ($ServBooked as $s){    //INSERT SERVICES CHANGED
	 	$db->InAddServMod($s['serviceid'], $id_reserve_mod, $s['qty'], $s['price'], $s['comment']);
	  }
	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
	$db->update_busy($_POST['busyid'],$starting, $ending, $id_villa, $id_adm, $id_ocupacion_mod, $b['date']);
	//----------------------------------------------------------------------------------------------------------------------------------------------------------------

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------
	$db->update_reserva($_POST['reserveid'], $ref, $_POST['busyid'], $id_customer, $adults_qty, $children_qty,$_POST['vehiculos'], $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status);
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------
	if(($status==21)||($status==25)){  /*mean the the booking is checked out*/
		put_villa_dirty($villaid=$id_villa);
	 }
	
  //echo "$status Estatus<br />"; echo $_POST['busyid']."id busy";
   }else{
	   echo ("<meta http-equiv=\"refresh\" content=\"0;url=booking-calendar.php\">"); //send people to calendar
	   die();
   }

	//DELETE OLD SAVED SERVICES
	$link=new DB();
 	$link->delete_items('serv_reserv', 'id_reserve', $_POST['reserveid']);   //table - field_condition - value
	//DELETE OLD SAVED PEOPLE
	$link->delete_items('people', 'id_reserve', $_POST['reserveid']);   //table - field_condition - value

	if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
	  for ($x=1;$x<=$adults_qty; $x++){
	  	$a_name="a_name$x"; $a_lastname="a_lastname$x"; $a_cedula="cedula$x";
	  	$name=$_POST[$a_name]; $lastname=$_POST[$a_lastname];$cedula=$_POST[$a_cedula];
	    $db->insert_adults($_POST['reserveid'], $name, $lastname, $cedula);
	  	}
	}

	if ($children_qty>0){    //si la cantidad de niños sobrepasa 1 entonces son insertado en la base de datos
	  for ($c=1;$c<=$children_qty; $c++){
	  	$c_name="c_name$c"; $c_lastname="c_lastname$c"; $c_passport="passport$c";
	  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname]; $passport=$_POST[$c_passport];
	    $db->insert_children($_POST['reserveid'], $name, $lastname, $passport);
	  	}
	}
	//-----------------------------------------------------------------------------------------------------------------------------------
	if ($massage_id>0) $db->insert_additional_services($massage_id, $_POST['reserveid'],$qty=1, $massage_amount, $massage_comment);
	if ($pickup_id>0) $db->insert_additional_services($pickup_id, $_POST['reserveid'],$qty=1, $pickup_amount, $pickup_comment);
	if ($VIPpickup_id>0) $db->insert_additional_services($VIPpickup_id, $_POST['reserveid'],$qty=1, $VIPpickup_amount, $VIPpickup_comment);
	if ($chef_id>0) $db->insert_additional_services($chef_id, $_POST['reserveid'],$qty=1, $chef_amount, $chef_comment);
	if ($fridge_id>0) $db->insert_additional_services($fridge_id, $_POST['reserveid'],$qty=1, $fridge_amount, $fridge_comment);
   //-----------------------------------------------------------------------------------------------------------------------------------
     	//==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$db->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='', $id_villa, $id_ocupacion_mod);
		//=====================================================================================================

     unset($_SESSION['NO_REFRESH']);

     //-----------------------REFERAL FOR THIS BOOKING-------------------------------------------------------------------------------------
	   if ($_POST['id_referal']>0){
	    $link= new getQueries();
	    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');

		  if ($referido_anterior){
		  	#echo "actualizar";
		  	$id_update=$db->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
		  	//echo $referido_anterior[0]['id_referal'];
		    $actualizado=$db->update_assign($referido_anterior[0]['id'], $ref, $_POST['id_referal'], $id_adm, $id_update);

		  }else{

			$result=$db->Assign_a_booking($ref, $_POST['id_referal'], $id_adm);
			 if ($result){

			 }
		    #echo "insertar";
		  }
	    }
   //----------------------- TERMINA REFERAL FOR THIS BOOKING ----------------------------------------------------------------------------

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


 	 $villa_details=$data->villa($id_villa);
      /*
 	 if($status==21){  #mean the the booking is checked out
         //enviar email de trip advisor.
        $db= new getQueries();
        #$cl=$db->customer($id_customer);//get cliente details

        $owner=$db->show_id('owners', $id_customer); //if owner staying
        $cl=$owner[0];//get owner details
         if($_POST['tripadvisor']=="yes"){
	   		$tripadvisor1=sent_tripadvisor_request($cl, $ref);

	   		echo $tripadvisor1;
         }

 	 }  */
	?>
     <h2>Edition Result</h2><hr />
	 <div class="book_inserted1">
	 	<p class="bloques">Villa No.:<span class="info_details"> <?=$villa_details[0]['no']?></span></p>
	 	<p class="bloques">From:<span class="info_details"> <?=formatear_fecha($starting_date);?></span></p>
	 	<p class="bloques">To:<span class="info_details"> <?=formatear_fecha($ending_date);?></span></p>
	 </div><!--END SHOWING DATES AND VILLA-->

     <div class="book_inserted2">
      	<p class="bloques2">Booking Reference Number:<span class="info_details2"> <?=$ref?></span></p>
     </div><!--END SHOWING REF NUMBER-->

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