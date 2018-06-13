<?
 if ($_SESSION['info']){
   if (!$_SESSION['NO_REFRESH']) die('Impossible send info again');
	/*//VARIABLES START*/
   if ($_POST){
   	/*//------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
     $starting_date=$_POST['starting_date']; $ending_date=$_POST['ending_date']; $starting=date_to_insert($starting_date);
	 $ending=date_to_insert($ending_date);
  	 $id_villa=$_POST['id_villa'];   /*//$id_adm=$_POST['id_adm'];*/
     /*//------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
  	 $ref=$_POST['ref']; /*$id_ocupacion=$_POST['busyid']; */$id_customer=$_POST['id_customer']; $adults_qty=$_POST['adults_qty']; $children_qty=$_POST['children_qty'];
  	 $interm_id=$_POST['interm_id']; $qty_nights=$_POST['qty_nights']; $price_per_night=$_POST['price_per_night'];/*// $amount_commision=?*/
     $sub_total_rent=$_POST['sub_total_rent']; $ITBIS=$_POST['ITBIS']; $services_amount=$_POST['services_amount'];  $deposit=$_POST['deposit'];
     $general_amount=$_POST['general_amount'];  $status=$_POST['status'];$reserve_comment=$_POST['reserve_comment'];
    /* $amount_per_nights=$_POST['amount_per_nights'];*/
    /*//---------------------------------------------------------------------------------------------*/
		$priceHS=$_POST['priceHS']; $LS_nights=$_POST['LS_nights']; $HS_nights=$_POST['HS_nights'];
	 /*//---------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
     $massage_id=$_POST['massage_id']; 		$massage_amount=$_POST['massage_amount'];		$massage_comment=$_POST['massage_comment'];
     $pickup_id=$_POST['pickup_id']; 		$pickup_amount=$_POST['pickup_amount'];   		$pickup_comment=$_POST['pickup_comment'] ;
     $VIPpickup_id=$_POST['VIPpickup_id'];	$VIPpickup_amount=$_POST['VIPpickup_amount'];   $VIPpickup_comment=$_POST['VIPpickup_comment'];
     $chef_id=$_POST['chef_id'];			$chef_amount=$_POST['chef_amount'];         	$chef_comment=$_POST['chef_comment'];
     $fridge_id=$_POST['fridge_id'];		$fridge_amount=$_POST['fridge_amount'];         $fridge_comment=$_POST['fridge_comment'];
     /*//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
    //VARIABLES END*/
	$db= new subDB (); /*//CONNECT TO DATABASE*/
	$data=new getQueries ();/*//connect and make a query - Ej. get info from a ref number*/
    $book=$data->see_occupancy_ref($ref);
    $b=$book[0];
    $peopleBooked=$data->people($b['reserveid']);
	$ServBooked=$data->services_reserved($b['reserveid']);
	
	/*echo "Precio LS:".$b['ppn']; echo "<br/>";
	echo "Precio HS:".$b['PHS']; echo "<br/>";
	echo "Precio LS new:".$price_per_night; echo "<br/>";
	echo "Precio HS new:".$priceHS; echo "<br/>";
	
	die('Fin salida');*/

	$id_ocupacion_mod=$db->in_ocupacion_mod($b['start'], $b['end'], /*$b['type']*/1, $b['villa'], $_SESSION['info']['id'], $b['note']); /*//insert ocupation and returm id of insertion*/
	 /*// echo $b['type'];*/

	$id_reserve_mod=$db->in_res_mod($ref, $id_ocupacion_mod, $b['client'], $b['adults'], $b['kids'],  $b['vehicles'], $b['interm'], $b['nights'], $b['NHS'],$b['NLS'], $b['ppn'],$b['PHS'], $b['apc'], $b['subtotal'], $b['itbis'], $b['aps'], $b['dep'], $b['total'], $b['status'],$b['rc']);

      /*//$counted_adult=0; $counted_kids=0;*/
	  foreach ($peopleBooked as $k){    /*//INSERT PEOPLE CHANGED*/
		$db->in_persons_mod($id_reserve_mod, $k['name'], $k['lastname'], $k['comment'], $k['type']);
		/*//if ($k['type']==1) $counted_adult++; if ($k['type']==2) $counted_kids++;*/
	  }

      foreach ($ServBooked as $s){   /* //INSERT SERVICES CHANGED*/
	 	$db->InAddServMod($s['serviceid'], $id_reserve_mod, $s['qty'], $s['price'], $s['comment']);
	  }
	/*//-----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	$db->update_busy($_POST['busyid'],$starting, $ending, $id_villa, $b['adm'], $id_ocupacion_mod, $b['date']);
	/*//----------------------------------------------------------------------------------------------------------------------------------------------------------------

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	$db->update_reserva($_POST['reserveid'], $ref, $_POST['busyid'], $id_customer, $adults_qty, $children_qty, $_POST['vehiculos'], $interm_id, $qty_nights, $HS_nights, $LS_nights, $price_per_night, $priceHS, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status);
	/*//-------------------------------------------------------------------------------------------------------------------------------------------------------------------
		//==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================*/
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$db->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='', $id_villa, $id_ocupacion_mod);
		/*//=====================================================================================================*/
	//===============================================================START SAVING PRICE CHANGED ON EDIT BOOKING ===========================================
		 $data=new getQueries ();
		 $villa_reserva=$data->villa($id_villa);
		 $villainfo=$villa_reserva[0];
		 if($b['ppn']!=$price_per_night){$prices_changd1="True";}//LS price changed
		 if($b['PHS']!=$priceHS){$prices_changd2="True";}//HS price changed
		 
		 if($_SESSION['info']['reception']==1){
			 $sentm=1;
		 }else{
			 $sentm=0;
		 }
		 
		 if(($prices_changd1=="True")||($prices_changd2=="True")){
			 
		   $inf5=array('ref'=>$ref,
					    'pricevilla'=>$b['ppn'],
					    'pricevilla2'=>$b['PHS'],
					    'pricediscounted'=>$price_per_night,
					    'pricediscounted2'=>$priceHS,
					    'userid'=>$_SESSION['info']['id'],
					    'date'=>time(),
					    'sentmail'=>$sentm,
					    'tipo'=>'2');
		   $inf_desc=$db->insert_gral($inf5, $table='villa_discount');
		   if($sentm==1){
			   //enviar correo electronico a Christian en este caso
			   $mailbody=infoPriceChanged($username=$_SESSION['info']['name']." ".$_SESSION['info']['lastname'], $ref, $villano=$villainfo['no']);
			   sendMail($mailbody, $address='rentalmanager@casalindacity.com', $subject="Price edited to booking no. $ref", $from_add='noreply@casalindcity.com', $from_name='Reservation System');
			   
		   }
		 }
		//===============================================================END SAVING PRICE CHANGED ON EDIT BOOKING ===========================================
    $link=new DB();
	$link->delete_items($table='cars_rented', $field='ref', $value=$ref); /*borrar carros hayas seleccionados o no*/  /*//table - field_condition - value*/

	if($_SESSION['cars']){ /*si hay carros seleccionados*/


                 /*//insertarlos en la base de datos .*/
                  foreach($_SESSION['cars'] AS $k){
                  	$total4thiscar=$_SESSION['cars_qty'][$k]*$_SESSION['car_price'][$k];
                  	$car_taxes=$total4thiscar*0.18;
	                 $inf_data=array('ref'=>$ref,
					                 'date'=>date("Y-m-d G:i:s"),
					                 'qty_days'=>$_SESSION['cars_qty'][$k],
					                 'id_car'=>$k,
					                 'price'=>$_SESSION['car_price'][$k],
					                 'taxes'=>$car_taxes,
					                 'status'=>'1',
					                 'ip_address'=>$_SERVER['REMOTE_ADDR'],
					                 'user_id'=>$_SESSION['info']['id']);

				  	$in_cars=$db->insert_gral($inf_data, $table='cars_rented');
				  }
				  unset($_SESSION['cars']);
	}
  /*//echo "$status Estatus<br />"; echo $_POST['busyid']."id busy";*/
   }else{
	   echo ("<meta http-equiv=\"refresh\" content=\"0;url=booking-calendar.php\">"); /*//send people to calendar*/
	   die();
   }

	/*//DELETE OLD SAVED SERVICES*/
	$link=new DB();
	/*===============BORRAR SOLO LOS SERVICIOS QUE NO SON RENTA CARS SI SON VIEJOS================*/
	/*buscar cada servicio en la base de datos*/
	 $servicios_reserva=$data->services_reserved($_POST['reserveid']); /*//get services reserved*/
		 if($servicios_reserva){
			 $link->delete_items('serv_reserv', 'id_reserve', $_POST['reserveid']);
			/*foreach($servicios_reserva AS $servReser){
				//si el tipo de servicio es diferrente de renta car borrar este servicio
				if($servReser['type']!='Car_Rental'){
					$link->delOneService($id_service=$servReser['serviceid'], $id_reserva=$_POST['reserveid']);
				}
			}*/
		}

 	/*=======================================================================================================*/
	/*//END DELETE OLD SAVED PEOPLE*/
	$link->delete_items('people', 'id_reserve', $_POST['reserveid']);   /*//table - field_condition - value*/

	if ($adults_qty>0){    /*//si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos*/
	  for ($x=1;$x<=$adults_qty; $x++){
	  	$a_name="a_name$x"; $a_lastname="a_lastname$x"; $a_cedula="cedula$x";
	  	$name=$_POST[$a_name]; $lastname=$_POST[$a_lastname]; $cedula=$_POST[$a_cedula];
	    $db->insert_adults($_POST['reserveid'], $name, $lastname, $cedula);
	  	}
	}

	if ($children_qty>0){   /* //si la cantidad de niños sobrepasa 1 entonces son insertado en la base de datos*/
	  for ($c=1;$c<=$children_qty; $c++){
	  	$c_name="c_name$c"; $c_lastname="c_lastname$c"; $c_passport="passport$c";
	  	$name=$_POST[$c_name]; $lastname=$_POST[$c_lastname]; $passport=$_POST[$c_passport];
	    $db->insert_children($_POST['reserveid'], $name, $lastname, $passport);
	  }
	}

   /*//NUEVO CODIGO PARA INSERTAR LOS SERVICIOS*/
   if($_POST['ids_services']){
      foreach($_POST['ids_services'] AS $ids){
      	if ($_POST['qty_services'][$ids]>0){$qty=$_POST['qty_services'][$ids];}else{$qty=1;}
         $db->insert_additional_services($ids, 
										 $_POST['reserveid'],
										 $qty, 
										 $_POST['amount_services'][$ids],
										 $desc=$_POST['desc_services'][$ids],
										 $tax=$_POST['tax_services'][$ids],
										 $tipo=$_POST['tipo_services'][$ids],
										 $unit=$_POST['unit_services'][$ids]);
      }
   }
    /*//TERMINA NUEVO CODIGO PARA INSERTAR LOS SERVICIOS

       //-----------------------DISCOUNT FOR THIS BOOKING-------------------------------------------------------------------------------------*/
	   /*if ($_POST['promotion_id']>0){
			$link= new getQueries();
			$descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');//details discount before saved as discount
			$desc=$descuento_anterior[0];
			$this_pro=$link->show_active_limit1("promotion", "id", $_POST['promotion_id'], "=");//details for this promotion
     	   $pro=$this_pro[0];
		  if ($descuento_anterior){
		  	$id_upd_d=$db->insert_discount_modified($desc['fecha'],$desc['reference'],$desc['pro_code'],$desc['pro_id'],$desc['pro_from'],$desc['pro_to'],$desc['pro_type'],$desc['pro_qty'],$desc['min_days'],$desc['qty_days'], $desc['id_adm']);
		    $actualizarlo=$db->update_discount($desc['id'],$ref,$pro['code'],$pro['id'],$pro['desde'],$pro['hasta'],$pro['tipo'],$pro['cant_porc'],$pro['min_days'],$pro['qty_days'], $id_adm,$id_upd_d);
		  }else{
			$result=$db->insert_discount($ref,$pro['code'],$pro['id'],$pro['desde'],$pro['hasta'],$pro['tipo'],$pro['cant_porc'],$pro['min_days'],$pro['qty_days'], $id_adm);
		  }
	    }*/
   /*//----------------------- TERMINA DISCOUNT FOR THIS BOOKING ----------------------------------------------------------------------------
   
    //-----------------------DISCOUNT FOR THIS BOOKING-------------------------------------------------------------------------------------*/
		   if ($_SESSION['amount_discounted']>0){
		    $link= new getQueries();
		    $descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');/*//details discount before saved as discount*/
		    $desc=$descuento_anterior[0];
			
	     	/*$this_pro=$link->show_active_limit1("promotion", "id", $_SESSION['id_promotion'], "=");*//*//details for this promotion*/
			$this_pro=$link->show_any_data_limit1("promotion", "id", $_SESSION['id_promotion'], "=");/*//details for this promotion*/
			
	     	   $pro=$this_pro[0];
			  if ($descuento_anterior){
			  	$id_upd_d=$db->insert_discount_modified(
												$desc['fecha'],
												$desc['reference'],
												$desc['pro_code'],
												$desc['pro_id'],
												$desc['pro_from'],
												$desc['pro_to'],
												$desc['pro_type'],
												$desc['pro_qty'],
												$desc['min_days'],
												$desc['max_days'], 
												$desc['tobookfrom'], 
												$desc['tobookto'], 
												$desc['discounted'], 
												$desc['id_adm']);
												
			    $actualizarlo=$db->update_discount(
												$desc['id'],
												$ref,
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
												$id_adm,
												$id_upd_d);
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
											$id_adm,
											$new=1);
			  }
		    }else{
				$link= new getQueries();
				$descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');/*//details discount before saved as discount*/
				$desc=$descuento_anterior[0];
				
				$link= new DB();
				$link->delete_items($table='discount', $field='id', $value=$desc['id']);
			}
	   /*//----------------------- TERMINA DISCOUNT FOR THIS BOOKING ----------------------------------------------------------------------------*/
	/*if($_SESSION['amount_discounted']>0){
		
		$link= new getQueries();
		    $descuento_anterior=$link->show_any_data_limit1('discount', 'reference', $ref, '=');//details discount before saved as discount
		    $desc=$descuento_anterior[0];
	     	$this_pro=$link->show_active_limit1("promotion", "id", $_SESSION['id_promotion'], "=");//details for this promotion
	     	   $pro=$this_pro[0];
			  if ($descuento_anterior){
			  	$id_upd_d=$db->insert_discount_modified($desc['fecha'],
				$desc['reference'],
				$desc['pro_code'],
				$desc['pro_id'],
				$desc['pro_from'],
				$desc['pro_to'],
				$desc['pro_type'],
				$desc['pro_qty'],
				$desc['min_days'],
				$desc['qty_days'], 
				$desc['id_adm']);
				
			    $actualizarlo=$db->update_discount($desc['id'],
				$ref,
				$pro['code'],
				$pro['id'],
				$pro['desde'],
				$pro['hasta'],
				$pro['tipo'],
				$pro['cant_porc'],
				$pro['min_days'],
				$pro['qty_days'],
				$id_adm,
				$id_upd_d);
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
											$_POST['amount_discounted'],
											$id_adm,
											$new=1);
			  }
	}*/

    /*//----------------------- COMIENZO VEHICULO PARA ESTA RESERVA-------------------------------------------------------------------------------------*/
	   if ($_POST['vehiculos']!='0' ){ /*//si hay vehiculos*/
	    $link= new getQueries();
	    $vehiculo_anterior=$link->show_any_data_limit1('vehicle', 'ref_book', $ref, '=');
        /*//DELETE OLD SAVED SERVICES*/
		$db=new subDB();
	 	$db->delete_items('vehicle', 'ref_book', $ref);   /*//table - field_condition - value*/

		 for ($i=1; $i<=$_POST['vehiculos']; $i++){
		 	$marca="marca$i"; $modelo="modelo$i"; $placa="placa$i"; $color="color$i";
			$result=$db->insert_vehicule($ref, $_POST[$marca], $_POST[$modelo], $_POST[$placa], $_POST[$color]);
            /*// echo $marca; echo "<br/>";*/
			}

	    }
   /*//----------------------- TERMINA VEHICULO PARA ESTA RESERVA ----------------------------------------------------------------------------*/

    unset($_SESSION['NO_REFRESH']);

     /*//-----------------------REFERAL FOR THIS BOOKING-------------------------------------------------------------------------------------*/
	   if ($_POST['id_referal']>0){
	    $link= new getQueries();
	    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');

		  if ($referido_anterior){
		  	/*#echo "actualizar";*/
		  	$id_update=$db->insert_assign_modified($referido_anterior[0]['ref_book'], $referido_anterior[0]['id_referal'], $referido_anterior[0]['id_adm'], $referido_anterior[0]['fecha']);
		  	/*//echo $referido_anterior[0]['id_referal'];*/
		    $actualizado=$db->update_assign($referido_anterior[0]['id'], $ref, $_POST['id_referal'], $id_adm, $id_update);

		  	/*//echo "<p>&nbsp;</p><p style='color:red; font-size:16px; text-align:center;'>Booking successfully reassigned</p>";*/

		  }else{

			$result=$db->Assign_a_booking($ref, $_POST['id_referal'], $id_adm);
			 if ($result){
			/*// echo "<p>&nbsp;</p><p style='color:blue; font-size:16px; text-align:center;'>Booking successfully assigned</p>";*/

			 }
		    /*#echo "insertar";*/
		  }
	   }else{
	     $link= new getQueries();
	    $referido_anterior=$link->show_any_data_limit1('bookingreferred', 'ref_book', $ref, '=');
	    if ($referido_anterior){
	     /*//borrar referral anterio*/
	     $link=new DB();
         $link->delete_items('bookingreferred', 'ref_book', $ref);   /*//table - field_condition - value*/
	    }
	   }
   /*//----------------------- TERMINA REFERAL FOR THIS BOOKING ----------------------------------------------------------------------------*/
      /*insert or update an expedia info below*/
		     if (($_POST['id_referal']>0)&&($_SESSION['exp_id']!='')&&($_SESSION['exp_amount']!='')){
               insert_or_update_exp($rcl_ref=$ref, $id_referral=$_POST['id_referal'], $expedia_id=$_SESSION['exp_id'], $expedia_amount=$_SESSION['exp_amount']);
		     }

   /*//INSERTAR EXCURSIONES MAS ABAJOS*/
      if ($_SESSION['EX']['id_selected']){   /*//SI HAY EXCURSIONES AHORA*/
	       $link= new getQueries();
		   $excursiones_reserva=$link->excrusiones_reserved($_POST['reserveid']); /*//obtener las excursiones anteriores*/
		   if($excursiones_reserva){
		   	   foreach($excursiones_reserva as $ke){
	             $excursiones=$db->in_excur_booked_mod($ke['id_excursion'], $id_reserve_mod, $ke['qty_a'], $ke['qty_c'], $ke['price_a'], $ke['price_c'], $ke['total']); /*//save in excursiones modificadas*/
		   	   }
		   }
        /*//DELETE OLD SAVED EXCRUSIONS*/
		$db=new subDB();
	 	$db->delete_items('excursions_booked', 'id_reserve', $_POST['reserveid']);   /*//table - field OF condition - value*/

      	foreach($_SESSION['EX']['id_selected'] AS $k){
			$id_excursion=$k;
			$id_reserva=$_POST['reserveid'];
			$qty_adult=$_SESSION['EX'][$k]['adults'];
			$qty_child=$_SESSION['EX'][$k]['kids'];
			$precio_a=$_SESSION['EX'][$k]['price_a'];
			$precio_c=$_SESSION['EX'][$k]['price_c'];
			$total_excursion=(($qty_adult*$precio_a)+($qty_child*$precio_c));
         	$excursiones=$db->in_excur_booked($id_excursion, $id_reserva, $qty_adult, $qty_child, $precio_a, $precio_c, $total_excursion); /*//insert ESTA EXCURSION*/
      	}
      }else{
      	  $link= new getQueries();
		   $excursiones_reserva=$link->excrusiones_reserved($_POST['reserveid']); /*//obtener las excursiones anteriores*/
		   if($excursiones_reserva){
		   	   foreach($excursiones_reserva as $ke){
	             $excursiones=$db->in_excur_booked_mod($ke['id_excursion'], $id_reserve_mod, $ke['qty_a'], $ke['qty_c'], $ke['price_a'], $ke['price_c'], $ke['total']); /*//save in excursiones modificadas*/
		   	   }
		   }
        /*//DELETE OLD SAVED EXCRUSIONS*/
        $db=new subDB();
	 	$db->delete_items('excursions_booked', 'id_reserve', $_POST['reserveid']);   /*//BORRAR EXCURSIONES SI EXISTIAN ANTERIORMENTE*/
      }
      /*//INSERTAR EXCURIONES MAS ARRIBAS*/

 	 $villa_details=$data->villa($id_villa);

 	 if($status==4 || $status==14){  /*mean the the booking is checked out*/
         /*//enviar email de trip advisor*/
        $db= new getQueries();
        $cl=$db->customer($id_customer);/*//get cliente details*/
         if($_POST['tripadvisor']=="yes"){
        	$tripadvisor1=sent_tripadvisor_request($cl, $ref);
        	echo $tripadvisor1;
         }
 	 }
	 if(($status==4) || ($status==14) || ($status==37)){  /*mean the the booking is checked out*/
		put_villa_dirty($villaid=$id_villa);
	 }
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